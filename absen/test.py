import mysql.connector
from sklearn.neighbors import KNeighborsClassifier
import cv2
import pickle
import numpy as np
import os
import time
from datetime import datetime
from win32com.client import Dispatch

# Fungsi untuk menghubungkan dan menyimpan data ke database MySQL
def initialize_database():
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="authorized_user"
    )  
    conn.commit()
    conn.close()

def save_to_database(name, timestamp, date):
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="db_attendance"
    )
    cursor = conn.cursor()
    print(f"Saving to database: Name: {name}, Timestamp: {timestamp}, Date: {date}")
    cursor.execute('INSERT INTO attendance (name, time, date) VALUES (%s, %s, %s)', (name, timestamp, date))
    conn.commit()
    conn.close()  # Pastikan koneksi ditutup setelah menyimpan

initialize_database()

# Fungsi untuk text-to-speech
def speak(str1):
    speak = Dispatch("SAPI.SpVoice")
    speak.Speak(str1)

video = cv2.VideoCapture(0)
facedetect = cv2.CascadeClassifier('data/haarcascade_frontalface_default.xml')

# Load model dan data pelatihan
with open('data/names.pkl', 'rb') as w:
    LABELS = pickle.load(w)
with open('data/faces_data.pkl', 'rb') as f:
    FACES = pickle.load(f)

print('Shape of Faces matrix --> ', FACES.shape)

# Inisialisasi KNN untuk prediksi wajah
knn = KNeighborsClassifier(n_neighbors=5)
knn.fit(FACES, LABELS)

# Background frame untuk tampilan
imgBackground = cv2.imread("background.png")

while True:
    ret, frame = video.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = facedetect.detectMultiScale(gray, 1.3, 5)
    
    for (x, y, w, h) in faces:
        crop_img = frame[y:y+h, x:x+w, :]
        resized_img = cv2.resize(crop_img, (50, 50)).flatten().reshape(1, -1)
        output = knn.predict(resized_img)
        name = str(output[0]) if len(output) > 0 else "Unknown"
        
        cv2.rectangle(frame, (x, y), (x+w, y+h), (0, 0, 255), 1)
        cv2.rectangle(frame, (x, y-40), (x+w, y), (50, 50, 255), -1)
        cv2.putText(frame, str(output[0]), (x, y-15), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 1)

    imgBackground[162:162 + 480, 55:55 + 640] = frame
    cv2.imshow("Frame", imgBackground)
    
    k = cv2.waitKey(1)
    
    if k == ord('o'):
        timestamp = str(datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
        date = str(datetime.now().strftime('%Y-%m-%d'))
        # Menyimpan data ke database MySQL saat menekan tombol 'O'
        save_to_database(name, timestamp, date)
        speak("Attendance Taken.")
        time.sleep(5)
    if k == ord('q'):
        break

video.release()
cv2.destroyAllWindows()
