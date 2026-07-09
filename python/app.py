import os
import json
from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
import numpy as np
from PIL import Image

app = Flask(__name__)
CORS(app) # Mengizinkan request dari frontend Laravel

MODEL_PATH = "potato_disease_model.h5"
CLASS_NAMES = ["Bacteria", "Bukan_Daun_Kentang", "Fungi", "Healthy", "Nematode", "Pest", "Phytopthora", "Virus"]
IMAGE_SIZE = 256

model = None
if os.path.exists(MODEL_PATH):
    model = tf.keras.models.load_model(MODEL_PATH)
    print("Model berhasil dimuat.")
else:
    print("WARNING: Model file 'potato_disease_model.h5' tidak ditemukan. Jalankan train.py terlebih dahulu.")

@app.route("/predict", methods=["POST"])
def predict():
    if model is None:
        return jsonify({"error": "Model CNN belum dimuat atau belum dilatih"}), 500
        
    if "file" not in request.files:
        return jsonify({"error": "Tidak ada file gambar yang dikirim"}), 400
        
    file = request.files["file"]
    try:
        # Buka gambar dan ubah ukurannya sesuai input model CNN (256x256)
        image = Image.open(file.stream).convert("RGB")
        image = image.resize((IMAGE_SIZE, IMAGE_SIZE))
        
        # Konversi ke array numpy dan tambahkan dimensi batch (1, 256, 256, 3)
        img_array = tf.keras.preprocessing.image.img_to_array(image)
        img_batch = np.expand_dims(img_array, 0)
        
        # Lakukan prediksi
        predictions = model.predict(img_batch)
        predicted_class = CLASS_NAMES[np.argmax(predictions[0])]
        confidence = float(np.max(predictions[0]))
        
        return jsonify({
            "status": "success",
            "prediction": predicted_class,
            "confidence": confidence
        })
        
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route("/", methods=["GET"])
def index():
    return jsonify({"message": "Greenvision Anugrah Agro Putra CNN API Server is running!"})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5001, debug=True)
