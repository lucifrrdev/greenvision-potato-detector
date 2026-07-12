# Panduan Implementasi Modul CNN & API Flask (Python) - CV Anugrah Agro Putra

Dokumen ini menjelaskan struktur, alur kerja, dan cara menjalankan modul kecerdasan buatan berbasis **Convolutional Neural Network (CNN)** untuk klasifikasi penyakit tanaman kentang pada sistem **Greenvision Anugrah Agro Putra**.

---

## 📂 Struktur Folder Modul Python

```text
greenvision/python/
├── requirements.txt         # Daftar dependensi pustaka Python (TensorFlow, Flask, OpenCV, Pillow)
├── train.py                 # Script untuk melatih model CNN
├── app.py                   # Server API Flask untuk klasifikasi gambar (Rebranded AAP)
├── dataset/                 # Folder dataset gambar
│   ├── Potato___Early_blight/  # Berisi citra daun terkena penyakit bercak awal
│   ├── Potato___Late_blight/   # Berisi citra daun terkena penyakit busuk daun
│   └── Potato___healthy/       # Berisi citra daun kentang sehat
├── potato_disease_model.h5  # Berkas model CNN hasil pelatihan (dihasilkan setelah training)
└── training_history.png     # Grafik akurasi & loss pelatihan (dihasilkan setelah training)
```

---

## 🐋 Integrasi & Cara Menjalankan dengan Docker

Modul Python ini dirancang untuk berjalan sebagai salah satu microservice di dalam lingkungan Docker Compose.

### 1. Build & Menjalankan Kontainer
Untuk memulai server API Flask di dalam kontainer Docker:
```bash
docker compose -f greenvision/docker-compose.yml up -d --build python_ai
```

### 2. URL Endpoint Kontainer
Di dalam arsitektur Docker Compose, Flask API ini dapat diakses oleh kontainer Laravel menggunakan hostname:
```text
http://python_ai:8001/predict
```
Sedangkan dari sisi browser lokal Anda (host), API dapat diakses pada:
```text
http://127.0.0.1:8001/
```

---

## 🏋️ Tahap Pelatihan Model Secara Manual (Lokal)

Jika Anda ingin melatih ulang model CNN secara manual pada mesin lokal Anda:

1. Buat virtual environment baru di folder `greenvision/python/`:
   ```bash
   python3 -m venv venv
   source venv/bin/activate  # macOS / Linux
   # atau
   .\venv\Scripts\activate   # Windows
   ```
2. Instal dependensi pustaka:
   ```bash
   pip install -r requirements.txt
   ```
3. Unduh dataset daun kentang dan letakkan pada subfolder `dataset/`.
4. Jalankan script pelatihan:
   ```bash
   python train.py
   ```
5. Setelah pelatihan selesai, salin file `potato_disease_model.h5` baru Anda untuk menggantikan file lama.
