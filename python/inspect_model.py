import tensorflow as tf
import numpy as np
import os

MODEL_PATH = "potato_disease_model.h5"
CLASS_NAMES = ["Bacteria", "Bukan_Daun_Kentang", "Fungi", "Healthy", "Nematode", "Pest", "Phytopthora", "Virus"]

try:
    if not os.path.exists(MODEL_PATH):
        print("Model file not found!")
    else:
        model = tf.keras.models.load_model(MODEL_PATH)
        print("=== Model Summary ===")
        model.summary()
        
        # Test with dummy inputs
        print("\n=== Testing Dummy Inputs ===")
        
        # Zeros (black image)
        dummy_zeros = np.zeros((1, 256, 256, 3))
        pred_zeros = model.predict(dummy_zeros)
        class_zeros = CLASS_NAMES[np.argmax(pred_zeros[0])]
        print(f"Zeros prediction: {class_zeros} (Confidence: {np.max(pred_zeros[0]):.4f}) -> Raw: {pred_zeros[0]}")
        
        # Ones (white image)
        dummy_ones = np.ones((1, 256, 256, 3)) * 255
        pred_ones = model.predict(dummy_ones)
        class_ones = CLASS_NAMES[np.argmax(pred_ones[0])]
        print(f"Ones (255) prediction: {class_ones} (Confidence: {np.max(pred_ones[0]):.4f}) -> Raw: {pred_ones[0]}")
        
except Exception as e:
    print("Error:", e)
