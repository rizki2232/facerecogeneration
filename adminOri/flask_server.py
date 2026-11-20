from flask import Flask, Response, jsonify
import cv2
import threading
import time
import mysql.connector
from datetime import datetime

app = Flask(__name__)

# Konstanta untuk delay absensi
DELAY_ABSENSI = 3  # Delay waktu dalam detik
last_absen_time = {}

# Koneksi ke kamera
video_capture = cv2.VideoCapture(0)

# Fungsi untuk menyimpan hasil deteksi ke database hanya sekali per hari
def save_to_database(name):
    global last_absen_time
    current_date = datetime.now().strftime("%Y-%m-%d")
    current_time = datetime.now().strftime("%H:%M:%S")

    if name in last_absen_time:
        time_since_last_absen = time.time() - last_absen_time[name]
        if time_since_last_absen < DELAY_ABSENSI:
            print(f"Absen untuk {name} masih dalam delay. Tunggu {DELAY_ABSENSI - time_since_last_absen:.2f} detik lagi.")
            return

    try:
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()

        check_sql = "SELECT * FROM absen WHERE nama = %s AND tanggal = %s"
        mycursor.execute(check_sql, (name, current_date))
        result = mycursor.fetchone()

        if result:
            print(f"Data untuk {name} sudah ada hari ini.")
        else:
            insert_sql = "INSERT INTO absen (nama, tanggal, jam) VALUES (%s, %s, %s)"
            values = (name, current_date, current_time)
            mycursor.execute(insert_sql, values)
            mydb.commit()
            print(f"Data tersimpan: {name}, {current_date}, {current_time}")

            last_absen_time[name] = time.time()

    except mysql.connector.Error as err:
        print(f"Error: {err}")
    finally:
        if mydb.is_connected():
            mycursor.close()
            mydb.close()

# Fungsi untuk menggambar boundary dan mendeteksi wajah
# Pastikan classifier dan model dikenali dengan benar
def draw_boundary(img, classifier, scaleFactor, minNeighbors, color, text, clf):
    gray_image = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    features = classifier.detectMultiScale(gray_image, scaleFactor=1.2, minNeighbors=5)

    for (x, y, w, h) in features:
        cv2.rectangle(img, (x, y), (x + w, y + h), color, 2)
        id, pred = clf.predict(gray_image[y:y + h, x:x + w])
        confidence = int(100 * (1 - pred / 300))

        try:
            # Mengambil nama dari database berdasarkan ID
            mydb = mysql.connector.connect(
                host="localhost",
                user="root",
                passwd="",
                database="authorized_user"
            )
            mycursor = mydb.cursor()
            mycursor.execute("SELECT name FROM siswa WHERE id=%s", (id,))
            result = mycursor.fetchone()

            name = ''.join(result) if result else "UNKNOWN"
            save_to_database(name)

            if confidence > 60:
                cv2.putText(img, name, (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, color, 1, cv2.LINE_AA)
            else:
                cv2.putText(img, "UNKNOWN", (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 1, cv2.LINE_AA)

        except mysql.connector.Error as err:
            print(f"Error: {err}")
        finally:
            if mydb.is_connected():
                mycursor.close()
                mydb.close()


# Fungsi untuk mengenali wajah
def recognize(img, clf, faceCascade):
    draw_boundary(img, faceCascade, 1.1, 10, (255, 255, 255), "Face", clf)
    return img

# Fungsi untuk mendeteksi wajah
def detect_face():
    faceCascade = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")
    clf = cv2.face.LBPHFaceRecognizer_create()
    clf.read("classifier.xml")

    while True:
        ret, img = video_capture.read()
        if not ret:
            print("Gagal membaca dari kamera.")
            break

        # Proses pengenalan wajah
        img = recognize(img, clf, faceCascade)

        # Simpan gambar yang sudah dikenali (streaming)
        _, buffer = cv2.imencode('.jpg', img)
        frame = buffer.tobytes()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')


# Mulai deteksi wajah dalam thread terpisah
def start_face_detection():
    detection_thread = threading.Thread(target=detect_face)
    detection_thread.daemon = True
    detection_thread.start()

# Route untuk video feed
@app.route('/video_feed')
def video_feed():
    def generate():
        while True:
            ret, frame = video_capture.read()
            if not ret:
                break
            _, buffer = cv2.imencode('.jpg', frame)
            frame = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')

    return Response(generate(), mimetype='multipart/x-mixed-replace; boundary=frame')

# Route untuk memulai deteksi wajah
@app.route('/start_detection', methods=['GET'])
def start_detection():
    start_face_detection()
    return jsonify({"status": "Face detection started"})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
