<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenvision - Deteksi Penyakit Kentang</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom animation for fading in results */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-50 min-height-screen flex flex-col items-center justify-center p-5 font-sans min-h-screen">
    <div class="w-full max-w-[650px] bg-slate-800 rounded-[24px] p-10 shadow-2xl border border-white/5 text-center">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-400 to-emerald-300 bg-clip-text text-transparent mb-2">
            Greenvision
        </h1>
        <p class="text-slate-400 text-base mb-8">
            Deteksi Penyakit Daun Kentang Instan via AI (CNN)
        </p>

        <form id="uploadForm" class="space-y-6">
            <div class="border-2 border-dashed border-emerald-500/40 rounded-2xl py-10 px-5 cursor-pointer transition-all duration-300 bg-emerald-500/[0.02] relative hover:border-emerald-500 hover:bg-emerald-500/[0.05]" id="dropzone">
                <div class="text-5xl text-emerald-500 mb-3">🍃</div>
                <p class="text-slate-300">Seret & taruh gambar daun kentang di sini, atau klik untuk memilih file</p>
                <input type="file" id="fileInput" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer">
                <img id="imagePreview" class="max-w-full max-h-[250px] rounded-xl hidden mx-auto mt-4 object-cover border-2 border-emerald-500" alt="Pratinjau Gambar">
            </div>
            <button type="submit" id="btnSubmit" class="w-full bg-emerald-500 text-white py-4 font-semibold text-lg rounded-xl transition-all duration-300 shadow-[0_4px_12px_rgba(16,185,129,0.3)] hover:bg-emerald-600 hover:-translate-y-0.5 disabled:bg-slate-500 disabled:cursor-not-allowed disabled:shadow-none disabled:transform-none">
                Mulai Analisis
            </button>
        </form>

        <div class="mt-8 text-left hidden animate-fade-in" id="resultBox">
            <div class="flex justify-between items-center border-b border-white/10 pb-3 mb-4">
                <h3 class="text-lg font-bold">Hasil Diagnosis:</h3>
                <span class="bg-amber-500 text-slate-900 py-1 px-3 rounded-full font-bold text-[0.85rem]" id="confidenceBadge">0% Cocok</span>
            </div>
            
            <div class="space-y-4">
                <div>
                    <div class="font-semibold text-emerald-500 text-sm mb-1">Nama Penyakit / Status</div>
                    <div class="text-slate-50 text-lg font-semibold" id="resPenyakit">-</div>
                </div>

                <div>
                    <div class="font-semibold text-emerald-500 text-sm mb-1">Penyebab</div>
                    <div class="text-slate-300 text-sm leading-relaxed" id="resPenyebab">-</div>
                </div>

                <div>
                    <div class="font-semibold text-emerald-500 text-sm mb-1">Rekomendasi Pestisida</div>
                    <div class="text-slate-300 text-sm leading-relaxed" id="resPestisida">-</div>
                </div>

                <div>
                    <div class="font-semibold text-emerald-500 text-sm mb-1">Pola Penyiraman</div>
                    <div class="text-slate-300 text-sm leading-relaxed" id="resPenyiraman">-</div>
                </div>

                <div>
                    <div class="font-semibold text-emerald-500 text-sm mb-1">Langkah Pencegahan</div>
                    <div class="text-slate-300 text-sm leading-relaxed" id="resPencegahan">-</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadForm = document.getElementById('uploadForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const resultBox = document.getElementById('resultBox');

        // Ganti URL ke API server Flask Anda
        const API_URL = "http://127.0.0.1:8001/predict";

        // Tampilkan Pratinjau Gambar saat file dipilih
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Submit form untuk upload ke Flask API
        uploadForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const file = fileInput.files[0];
            if (!file) return;

            btnSubmit.disabled = true;
            btnSubmit.innerText = "Menganalisis Citra...";
            resultBox.classList.add('hidden');

            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error("Gagal menghubungi server API.");
                }

                const data = await response.json();
                
                if (data.status === 'success') {
                    // Update data ke UI
                    document.getElementById('confidenceBadge').innerText = `${(data.confidence * 100).toFixed(1)}% Akurasi`;
                    document.getElementById('resPenyakit').innerText = data.solusi.penyakit;
                    document.getElementById('resPenyebab').innerText = data.solusi.penyebab;
                    document.getElementById('resPestisida').innerText = data.solusi.pestisida;
                    document.getElementById('resPenyiraman').innerText = data.solusi.penyiraman;
                    document.getElementById('resPencegahan').innerText = data.solusi.pencegahan;
                    
                    // Tampilkan box hasil
                    resultBox.classList.remove('hidden');
                } else {
                    alert("Error: " + (data.error || "Gagal menganalisis gambar."));
                }
            } catch (err) {
                alert("Kesalahan koneksi ke Flask API Server: " + err.message);
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.innerText = "Mulai Analisis";
            }
        });
    </script>
</body>
</html>
