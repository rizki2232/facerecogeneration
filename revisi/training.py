import os
import cv2
import numpy as np
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Flatten, Dense
from tensorflow.keras.utils import to_categorical

def train_classifier():
    # Load dataset
    path = [os.path.join(DATA_DIR, f) for f in os.listdir(DATA_DIR) if f.endswith(".jpg")]
    faces = []
    ids = []
    DATA_DIR = "C:/xampp/htdocs/facerecogeneration_benar/revisi/data"

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
    model.fit(X_train, y_train, epochs=50, validation_data=(X_test, y_test), batch_size=32)

    # Save the model
    model.save("classifier_cnn.h5")


if __name__ == "_main_":
    train_classifier()