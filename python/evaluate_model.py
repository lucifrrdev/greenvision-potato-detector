import tensorflow as tf
import os

MODEL_PATH = "potato_disease_model.h5"
DATASET_DIR = "dataset"
IMAGE_SIZE = 256
BATCH_SIZE = 32

if not os.path.exists(MODEL_PATH):
    print("Model not found!")
    exit(1)

model = tf.keras.models.load_model(MODEL_PATH)

val_ds = tf.keras.preprocessing.image_dataset_from_directory(
    DATASET_DIR,
    validation_split=0.2,
    subset="validation",
    seed=123,
    image_size=(IMAGE_SIZE, IMAGE_SIZE),
    batch_size=BATCH_SIZE
)

print("Evaluating model on validation set...")
loss, accuracy = model.evaluate(val_ds)
print(f"Validation Loss: {loss:.4f}")
print(f"Validation Accuracy: {accuracy:.4f}")
