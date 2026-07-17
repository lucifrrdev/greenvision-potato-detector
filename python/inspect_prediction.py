import tensorflow as tf
import numpy as np
import os
from PIL import Image

MODEL_PATH = "potato_disease_model.h5"
CLASS_NAMES = ["Bacteria", "Bukan_Daun_Kentang", "Fungi", "Healthy", "Nematode", "Pest", "Phytopthora", "Virus"]

model = tf.keras.models.load_model(MODEL_PATH)

# Ambil 2 file contoh dari Healthy
healthy_dir = "dataset/Healthy"
healthy_files = [os.path.join(healthy_dir, f) for f in os.listdir(healthy_dir) if f.endswith(('.jpg', '.png', '.jpeg'))][:3]

print("=== TESTING HEALTHY IMAGES ===")
for hf in healthy_files:
    image = Image.open(hf).convert("RGB").resize((256, 256))
    img_array = tf.keras.preprocessing.image.img_to_array(image)
    img_batch = np.expand_dims(img_array, 0)
    pred = model.predict(img_batch)[0]
    pred_class = CLASS_NAMES[np.argmax(pred)]
    print(f"File: {os.path.basename(hf)}")
    print(f"Prediction: {pred_class} (Conf: {np.max(pred):.4f})")
    for name, score in zip(CLASS_NAMES, pred):
        print(f"  - {name}: {score:.6f}")

# Ambil 2 file contoh dari Phytopthora
phyt_dir = "dataset/Phytopthora"
phyt_files = [os.path.join(phyt_dir, f) for f in os.listdir(phyt_dir) if f.endswith(('.jpg', '.png', '.jpeg'))][:3]

print("\n=== TESTING PHYTOPTHORA IMAGES ===")
for pf in phyt_files:
    image = Image.open(pf).convert("RGB").resize((256, 256))
    img_array = tf.keras.preprocessing.image.img_to_array(image)
    img_batch = np.expand_dims(img_array, 0)
    pred = model.predict(img_batch)[0]
    pred_class = CLASS_NAMES[np.argmax(pred)]
    print(f"File: {os.path.basename(pf)}")
    print(f"Prediction: {pred_class} (Conf: {np.max(pred):.4f})")
    for name, score in zip(CLASS_NAMES, pred):
        print(f"  - {name}: {score:.6f}")
