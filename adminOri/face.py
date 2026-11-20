import tkinter as tk
from tkinter import messagebox
import cv2
import os
from PIL import Image
import numpy as np
import mysql.connector
import flask
from datetime import datetime
import time



# Initialize Tkinter window
window = tk.Tk()
window.title("Face Recognition System")

# Labels and entry fields
l1 = tk.Label(window, text="Name", font=("Algerian", 20))
l1.grid(column=0, row=0)
t1 = tk.Entry(window, width=50, bd=5)
t1.grid(column=1, row=0)

l2 = tk.Label(window, text="Age", font=("Algerian", 20))
l2.grid(column=0, row=1)
t2 = tk.Entry(window, width=50, bd=5)
t2.grid(column=1, row=1)

l3 = tk.Label(window, text="Address", font=("Algerian", 20))
l3.grid(column=0, row=2)
t3 = tk.Entry(window, width=50, bd=5)
t3.grid(column=1, row=2)

l4 = tk.Label(window, text="class", font=("Algerian", 20))
l4.grid(column=0, row=3)
t4 = tk.Entry(window, width=50, bd=5)
t4.grid(column=1, row=3)

# Training classifier function
def train_classifier():
    data_dir = "./data"
    path = [os.path.join(data_dir, f) for f in os.listdir(data_dir)]
    faces = []
    ids = []

    for image in path:
        img = Image.open(image).convert('L')
        image_np = np.array(img, 'uint8')
        id = int(os.path.split(image)[1].split(".")[1])

        faces.append(image_np)
        ids.append(id)
    ids = np.array(ids)

    # Train the classifier and save
    clf = cv2.face.LBPHFaceRecognizer_create()
    clf.train(faces, ids)
    clf.write("classifier.xml")
    messagebox.showinfo('Result', 'Training dataset completed!!!')

b1 = tk.Button(window, text="Training", font=("Algerian", 20), bg='orange', fg='red', command=train_classifier)
b1.grid(column=0, row=4)

# # Detect face function
# def detect_face():
#     def draw_boundary(img, classifier, scaleFactor, minNeighbors, color, text, clf):
#         gray_image = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
#         features = classifier.detectMultiScale(gray_image, scaleFactor, minNeighbors)

#         coords = []

#         for (x, y, w, h) in features:
#             cv2.rectangle(img, (x, y), (x + w, y + h), color, 2)
#             id, pred = clf.predict(gray_image[y:y + h, x:x + w])
#             confidence = int(100 * (1 - pred / 300))

#             # Database connection
#             mydb = mysql.connector.connect(
#                 host="localhost",
#                 user="root",
#                 passwd="",
#                 database="authorized_user"
#             )
#             mycursor = mydb.cursor()
#             mycursor.execute("SELECT name FROM siswa WHERE id=" + str(id))
#             s = mycursor.fetchone()
#             s = '' + ''.join(s) if s else "UNKNOWN"

#             if confidence > 74:
#                 cv2.putText(img, s, (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, color, 1, cv2.LINE_AA)
#             else:
#                 cv2.putText(img, "UNKNOWN", (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 1, cv2.LINE_AA)

#             coords = [x, y, w, h]
#         return coords

#     def recognize(img, clf, faceCascade):
#         coords = draw_boundary(img, faceCascade, 1.1, 10, (255, 255, 255), "Face", clf)
#         return img

#     faceCascade = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")
#     clf = cv2.face.LBPHFaceRecognizer_create()
#     clf.read("classifier.xml")

#     video_capture = cv2.VideoCapture(0)

#     while True:
#         ret, img = video_capture.read()
#         img = recognize(img, clf, faceCascade)
#         cv2.imshow("Face Detection", img)

#         if cv2.waitKey(1) == 13:  # Press Enter to exit
#             break

#     video_capture.release()
#     cv2.destroyAllWindows()

# b2 = tk.Button(window, text="Detect the face", font=("Algerian", 20), bg='green', fg='white', command=detect_face)
# b2.grid(column=1, row=4)


# Set durasi delay dalam detik
DELAY_ABSENSI = 3 # Misalnya, 10 detik

# Variabel global untuk menyimpan waktu absensi terakhir
last_absen_time = {}

# Fungsi untuk menyimpan hasil deteksi ke database hanya sekali per hari
def save_to_database(name):
    global last_absen_time

    # Dapatkan waktu dan tanggal saat ini
    current_date = datetime.now().strftime("%Y-%m-%d")  # Format tanggal
    current_time = datetime.now().strftime("%H:%M:%S")  # Format waktu

    # Periksa jika sudah ada absensi hari ini dan delay waktu absen sebelumnya
    if name in last_absen_time:
        time_since_last_absen = time.time() - last_absen_time[name]
        if time_since_last_absen < DELAY_ABSENSI:
            print(f"Absen untuk {name} masih dalam delay. Tunggu {DELAY_ABSENSI - time_since_last_absen:.2f} detik lagi.")
            return  # Keluar jika masih dalam waktu delay

    # Koneksi ke database dan periksa jika data sudah ada untuk hari ini
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="authorized_user"
    )
    mycursor = mydb.cursor()

    # Cek apakah entri untuk nama dan tanggal hari ini sudah ada
    check_sql = "SELECT * FROM absen WHERE nama = %s AND tanggal = %s"
    mycursor.execute(check_sql, (name, current_date))
    result = mycursor.fetchone()

    if result:
        print(f"Data untuk {name} sudah ada hari ini.")
    else:
        # Jika belum ada, masukkan data baru
        insert_sql = "INSERT INTO absen (nama, tanggal, jam) VALUES (%s, %s, %s)"
        values = (name, current_date, current_time)
        mycursor.execute(insert_sql, values)
        mydb.commit()
        print(f"Data tersimpan: {name}, {current_date}, {current_time}")

        # Update waktu absensi terakhir
        last_absen_time[name] = time.time()

    mydb.close()

# Fungsi untuk menggambar boundary dan mendeteksi wajah
def draw_boundary(img, classifier, scaleFactor, minNeighbors, color, text, clf):
    gray_image = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    features = classifier.detectMultiScale(gray_image, scaleFactor, minNeighbors)

    for (x, y, w, h) in features:
        cv2.rectangle(img, (x, y), (x + w, y + h), color, 2)
        id, pred = clf.predict(gray_image[y:y + h, x:x + w])
        confidence = int(100 * (1 - pred / 300))

        # Koneksi ke database untuk mendapatkan nama berdasarkan ID
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT name FROM siswa WHERE id=" + str(id))
        result = mycursor.fetchone()

        # Periksa jika `result` kosong (None)
        if result:
            name = ''.join(result)  # Jika result ada, gabungkan ke dalam string
        else:
            name = "UNKNOWN"  # Jika tidak ada hasil, beri label "UNKNOWN"

        # Simpan hasil deteksi ke database
        save_to_database(name)

        # Tampilkan nama atau "UNKNOWN" di layar
        if confidence > 74:
            cv2.putText(img, name, (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, color, 1, cv2.LINE_AA)
        else:
            cv2.putText(img, "UNKNOWN", (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 1, cv2.LINE_AA)

# Fungsi untuk mengenali wajah
def recognize(img, clf, faceCascade):
    draw_boundary(img, faceCascade, 1.1, 10, (255, 255, 255), "Face", clf)
    return img

# Fungsi utama untuk mendeteksi wajah
def detect_face():
    faceCascade = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")
    clf = cv2.face.LBPHFaceRecognizer_create()
    clf.read("classifier.xml")

    video_capture = cv2.VideoCapture(0)

    while True:
        ret, img = video_capture.read()
        img = recognize(img, clf, faceCascade)
        cv2.imshow("Face Detection", img)

        if cv2.waitKey(1) == 13:  # Tekan Enter untuk keluar
            break

    video_capture.release()
    cv2.destroyAllWindows()

# Membuat GUI dengan tkinter
window = tk.Tk()
window.title("Face Recognition System")

# Tombol untuk memulai deteksi wajah
b2 = tk.Button(window, text="Detect the face", font=("Algerian", 20), bg='green', fg='white', command=detect_face)
b2.grid(column=1, row=4)




# Generate dataset function
def generate_dataset():
    if t1.get() == "" or t2.get() == "" or t3.get() == "" or t4.get() == "" :
        messagebox.showinfo('Result', 'Please provide complete details of the user')
    else:
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="authorized_user"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT * FROM siswa")
        myresult = mycursor.fetchall()
        id = len(myresult) + 1

        sql = "INSERT INTO siswa(id, Name, Age, Address, class) VALUES (%s, %s, %s, %s, %s)"
        val = (id, t1.get(), t2.get(), t3.get() , t4.get())
        mycursor.execute(sql, val)
        mydb.commit()

        face_classifier = cv2.CascadeClassifier("haarcascade_frontalface_default.xml")

        def face_cropped(img):
            gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
            faces = face_classifier.detectMultiScale(gray, 1.3, 5)
            if len(faces) == 0:
                return None
            for (x, y, w, h) in faces:
                cropped_face = img[y:y + h, x:x + w]
            return cropped_face

        cap = cv2.VideoCapture(0)
        img_id = 0

        while True:
            ret, frame = cap.read()
            cropped_face = face_cropped(frame)
            if cropped_face is not None:
                img_id += 1
                face = cv2.resize(cropped_face, (200, 200))
                face = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)
                file_name_path = f"data/user.{id}.{img_id}.jpg"
                cv2.imwrite(file_name_path, face)
                cv2.putText(face, str(img_id), (50, 50), cv2.FONT_HERSHEY_COMPLEX, 1, (0, 255, 0), 2)

                cv2.imshow("Cropped Face", face)
                if cv2.waitKey(1) == 13 or img_id == 200:
                    break
        cap.release()
        cv2.destroyAllWindows()
        messagebox.showinfo('Result', 'Generating dataset completed!!!')

b3 = tk.Button(window, text="Generate dataset", font=("Algerian", 20), bg='pink', fg='black', command=generate_dataset)
b3.grid(column=2, row=4)

window.geometry("800x200")
window.mainloop()
