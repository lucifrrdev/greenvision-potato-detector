import tensorflow as tf
from tensorflow.keras import layers, models
import matplotlib.pyplot as plt
import os

# 1. Konfigurasi Parameter
IMAGE_SIZE = 256
BATCH_SIZE = 32
CHANNELS = 3
EPOCHS = 10
DATASET_DIR = "dataset" # Letakkan folder dataset Anda di sini (mengandung subfolder kelas)

def build_model(num_classes):
    """
    Membuat arsitektur CNN sederhana untuk klasifikasi citra daun kentang.
    """
    model = models.Sequential([
        # Rescaling piksel dari [0, 255] ke [0, 1]
        layers.Rescaling(1./255, input_shape=(IMAGE_SIZE, IMAGE_SIZE, CHANNELS)),
        
        # Layer Konvolusi 1
        layers.Conv2D(32, (3, 3), activation='relu'),
        layers.MaxPooling2D((2, 2)),
        
        # Layer Konvolusi 2
        layers.Conv2D(64, (3, 3), activation='relu'),
        layers.MaxPooling2D((2, 2)),
        
        # Layer Konvolusi 3
        layers.Conv2D(64, (3, 3), activation='relu'),
        layers.MaxPooling2D((2, 2)),
        
        # Layer Konvolusi 4
        layers.Conv2D(64, (3, 3), activation='relu'),
        layers.MaxPooling2D((2, 2)),
        
        # Flatten & Fully Connected Layer
        layers.Flatten(),
        layers.Dense(64, activation='relu'),
        
        # Output Layer (Probabilitas untuk setiap kelas)
        layers.Dense(num_classes, activation='softmax')
    ])
    
    model.compile(
        optimizer='adam',
        loss=tf.keras.losses.SparseCategoricalCrossentropy(from_logits=False),
        metrics=['accuracy']
    )
    return model

if __name__ == "__main__":
    print("=== Greenvision CNN Training Script ===")
    if not os.path.exists(DATASET_DIR):
        print(f"Folder '{DATASET_DIR}' tidak ditemukan.")
        print("Silakan buat folder 'dataset' dan masukkan subfolder kelas gambar daun kentang di dalamnya.")
    else:
        # Load Dataset secara otomatis menggunakan utility keras
        dataset = tf.keras.preprocessing.image_dataset_from_directory(
            DATASET_DIR,
            shuffle=True,
            image_size=(IMAGE_SIZE, IMAGE_SIZE),
            batch_size=BATCH_SIZE
        )
        
        class_names = dataset.class_names
        print("Kelas yang terdeteksi:", class_names)
        
        # Split dataset menjadi Train dan Validation (80% - 20%)
        train_ds = tf.keras.preprocessing.image_dataset_from_directory(
            DATASET_DIR,
            validation_split=0.2,
            subset="training",
            seed=123,
            image_size=(IMAGE_SIZE, IMAGE_SIZE),
            batch_size=BATCH_SIZE
        )

        val_ds = tf.keras.preprocessing.image_dataset_from_directory(
            DATASET_DIR,
            validation_split=0.2,
            subset="validation",
            seed=123,
            image_size=(IMAGE_SIZE, IMAGE_SIZE),
            batch_size=BATCH_SIZE
        )
        
        class_names = train_ds.class_names
        print("Kelas yang terdeteksi:", class_names)
        
        # Mengoptimalkan pembacaan dataset ke memori
        AUTOTUNE = tf.data.AUTOTUNE
        train_ds = train_ds.cache().shuffle(1000).prefetch(buffer_size=AUTOTUNE)
        val_ds = val_ds.cache().prefetch(buffer_size=AUTOTUNE)

        # Membangun model
        model = build_model(len(class_names))
        model.summary()
        
        # Proses latih (training)
        print("Memulai pelatihan model...")
        history = model.fit(
            train_ds,
            validation_data=val_ds,
            epochs=EPOCHS
        )
        
        # Menyimpan model
        model.save("potato_disease_model.h5")
        print("Model berhasil dilatih dan disimpan dengan nama 'potato_disease_model.h5'.")

        # Membuat visualisasi akurasi dan loss
        acc = history.history['accuracy']
        val_acc = history.history['val_accuracy']
        loss = history.history['loss']
        val_loss = history.history['val_loss']

        epochs_range = range(EPOCHS)

        plt.figure(figsize=(12, 6))
        plt.subplot(1, 2, 1)
        plt.plot(epochs_range, acc, label='Training Accuracy')
        plt.plot(epochs_range, val_acc, label='Validation Accuracy')
        plt.legend(loc='lower right')
        plt.title('Training and Validation Accuracy')

        plt.subplot(1, 2, 2)
        plt.plot(epochs_range, loss, label='Training Loss')
        plt.plot(epochs_range, val_loss, label='Validation Loss')
        plt.legend(loc='upper right')
        plt.title('Training and Validation Loss')
        
        plt.savefig('training_history.png')
        print("Grafik hasil pelatihan disimpan dengan nama 'training_history.png'.")

