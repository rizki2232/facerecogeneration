from flask import Flask, request, jsonify, Response
from flask_cors import CORS
import os
import cv2
import numpy as np
import base64
import tensorflow as tf
from tensorflow.keras.models import Sequential, load_model
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Flatten, Dense
from tensorflow.keras.utils import to_categorical
from sklearn.model_selection import train_test_split
from datetime import datetime
import mysql.connector
import gc
import multiprocessing

multiprocessing.freeze_support()
app = Flask(__name__)
CORS(app)

tf.autograph.set_verbosity(0)
DELAY_ABSENSI = 3
last_absen_time = {}
DATA_DIR = "D:/xampp/htdocs/PBL/facerecogeneration/data"
os.makedirs(DATA_DIR, exist_ok=True)

faceCascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")

# Fungsi pelatihan model CNN
def train_classifier():
    # Load dataset
    path = [os.path.join(DATA_DIR, f) for f in os.listdir(DATA_DIR) if f.endswith(".jpg")]
    faces = []
    ids = []

    for image in path:
        img = cv2.imread(image, cv2.IMREAD_GRAYSCALE)
        img = cv2.resize(img, (64, 64))  # Resize ke ukuran tetap
        id = int(os.path.split(image)[1].split(".")[1])
        faces.append(img)
        ids.append(id)

    faces = np.array(faces).reshape(-1, 64, 64, 1).astype('float32') / 255.0  # Normalisasi
    ids = to_categorical(ids)  # One-hot encode labels

    # Split dataset
    X_train, X_test, y_train, y_test = train_test_split(faces, ids, test_size=0.2, random_state=42)

    # Build CNN model
    model = Sequential([
        Conv2D(32, (3, 3), activation='relu', input_shape=(64, 64, 1)),
        MaxPooling2D((2, 2)),
        Conv2D(64, (3, 3), activation='relu'),
        MaxPooling2D((2, 2)),
        Flatten(),
        Dense(128, activation='relu'),
        Dense(ids.shape[1], activation='softmax')  # Output layer
    ])

    model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])

    # Train the model
    model.fit(X_train, y_train, epochs=10, validation_data=(X_test, y_test), batch_size=8)

    # Save the model
    model.save("classifier_cnn.h5")
    gc.collect()  # Bersihkan memori

# Fungsi untuk menyimpan ke database absen
def save_to_database(name):
    current_date = datetime.now().strftime("%Y-%m-%d")
    current_time = datetime.now().strftime("%H:%M:%S")

    if name in last_absen_time:
        time_since_last_absen = datetime.now().timestamp() - last_absen_time[name]
        if time_since_last_absen < DELAY_ABSENSI:
            return False, f"Absen untuk {name} masih dalam delay."

    try:
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()

        # Periksa apakah data absen sudah ada untuk hari ini
        check_sql = "SELECT * FROM absen WHERE nama = %s AND tanggal = %s"
        mycursor.execute(check_sql, (name, current_date))
        result = mycursor.fetchone()

        if result:
            return False, f"Data untuk {name} sudah ada hari ini."

        # Simpan data baru
        insert_sql = "INSERT INTO absen (nama, tanggal, jam) VALUES (%s, %s, %s)"
        values = (name, current_date, current_time)
        mycursor.execute(insert_sql, values)
        mydb.commit()
        last_absen_time[name] = datetime.now().timestamp()
        return True, f"Data tersimpan: {name}, {current_date}, {current_time}"
    finally:
        mydb.close()

@app.route('/absen', methods=['POST'])
def absen():
    data = request.json
    if not data or 'image' not in data:
        return jsonify({"status": "error", "message": "No image data received"}), 400

    image_data = data['image']
    image_data = image_data.split(",")[1]  # Remove the base64 header
    nparr = np.frombuffer(base64.b64decode(image_data), np.uint8)
    frame = cv2.imdecode(nparr, cv2.IMREAD_COLOR)

    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = faceCascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5)

    if len(faces) == 0:
        return jsonify({"status": "error", "message": "No face detected"})

    # Load the trained CNN model
    model = load_model("classifier_cnn.h5")

    for (x, y, w, h) in faces:
        face = gray[y:y + h, x:x + w]
        face = cv2.resize(face, (64, 64))  # Resize sesuai ukuran model
        face = face.reshape(1, 64, 64, 1) / 255.0  # Normalisasi

        predictions = model.predict(face)
        id = np.argmax(predictions[0])  # ID wajah dengan probabilitas tertinggi

        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT Name FROM siswa WHERE id = %s", (str(id),))
        result = mycursor.fetchone()
        name = result[0] if result else "UNKNOWN"

        success, message = save_to_database(name)
        return jsonify({"status": "success" if success else "error", "message": message})

    return jsonify({"status": "success", "faces": faces})

@app.route('/register', methods=['POST'])
def register():
    if 'name' not in request.form or 'NISN' not in request.form or 'class' not in request.form:
        return jsonify({"status": "error", "message": "Incomplete data. 'name', 'NISN', and 'class' are required."}), 400

    name = request.form['name']
    NISN = request.form['NISN']
    class_name = request.form['class']

    try:
        # Koneksi ke database
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()
        sql = "INSERT INTO siswa (name, NISN, class) VALUES (%s, %s, %s)"
        val = (name, NISN, class_name)
        mycursor.execute(sql, val)
        user_id = mycursor.lastrowid
        mydb.commit()
    finally:
        mydb.close()

    # Inisialisasi kamera untuk pengambilan gambar
    cap = cv2.VideoCapture(0)
    if not cap.isOpened():
        return jsonify({"status": "error", "message": "Could not open camera."}), 500

    img_id = 0
    while True:
        ret, frame = cap.read()
        if not ret:
            break
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = faceCascade.detectMultiScale(gray, 1.3, 5)

        for (x, y, w, h) in faces:
            img_id += 1
            face = gray[y:y + h, x:x + w]
            face = cv2.resize(face, (64, 64))
            file_name_path = f"{DATA_DIR}/user.{user_id}.{img_id}.jpg"
            cv2.imwrite(file_name_path, face)
            cv2.putText(frame, f"Capturing image {img_id}/200", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)

        cv2.imshow("Preview - Capturing Faces", frame)
        if cv2.waitKey(1) == 13 or img_id == 200:  # 13 adalah tombol Enter
            break

    cap.release()
    cv2.destroyAllWindows()

    train_classifier()  # Pastikan fungsi ini sudah diimplementasikan
    return jsonify({"status": "success", "message": f"User {name} registered successfully with {img_id} images."})

if __name__ == "_main_":
    app.run(host='0.0.0.0', port=5000, debug=True, use_reloader=False)