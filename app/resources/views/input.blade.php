@extends('layouts.app')

@section('title', 'Deteksi Penyakit Daun - Anugrah Agro Putra')

@section('styles')
<style>
    .scanner-viewport {
        position: relative;
        overflow: hidden;
    }
    .scanner-line {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to bottom, rgba(0, 168, 89, 0), rgba(0, 168, 89, 1));
        box-shadow: 0 0 16px 3px rgba(0, 168, 89, 0.9);
        animation: scan 2s ease-in-out infinite;
        z-index: 10;
        pointer-events: none;
    }
    @keyframes scan {
        0% { top: 0%; }
        50% { top: 100%; }
        100% { top: 0%; }
    }
</style>
@endsection

@section('content')
<div class="py-6 md:py-10 bg-theme-bgLight border-b border-theme-borderLight">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header Section -->
        <div class="text-center space-y-2">
            <span class="tp-section-title-pre">Image Analyzer</span>
            <h2 class="text-xl md:text-3xl font-extrabold text-theme-blue">Klasifikasi Citra Daun Kentang</h2>
            <p class="text-theme-textMuted text-xs max-w-md mx-auto">
                Unggah gambar daun kentang Anda untuk diagnosis penyakit patogen tanaman secara instan.
            </p>
        </div>


        <!-- Horizontal Grid Layout (Row Menyamping) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Left Column: Upload Form (Span 5) -->
            <div class="lg:col-span-5 bg-white rounded-2xl p-4 sm:p-5 md:p-6 border border-theme-borderLight shadow space-y-4">
                <!-- Tab Navigation -->
                <div class="flex border-b border-theme-borderLight mb-4">
                    <button type="button" id="tabCameraBtn" class="w-1/2 pb-2 text-center text-xs font-bold text-theme-green border-b-2 border-theme-green focus:outline-none">
                        <i class="fa-solid fa-camera mr-1.5"></i>Ambil Foto
                    </button>
                    <button type="button" id="tabUploadBtn" class="w-1/2 pb-2 text-center text-xs font-bold text-theme-textMuted border-b-2 border-transparent hover:text-theme-blue focus:outline-none">
                        <i class="fa-solid fa-file-arrow-up mr-1.5"></i>Unggah File
                    </button>
                </div>

                <form id="uploadForm" class="space-y-4">
                    @csrf
                    
                    <!-- Upload File Tab Content -->
                    <div id="uploadTabContent" class="hidden space-y-4">
                        <div class="border-2 border-dashed border-theme-green/30 hover:border-theme-green rounded-xl py-8 px-4 cursor-pointer transition-all duration-300 bg-theme-bgLight relative text-center" id="dropzone">
                            <div class="text-4xl text-theme-green mb-3"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="text-theme-textDark font-bold text-xs">Seret & taruh gambar daun di sini, atau klik</p>
                            <p class="text-theme-textMuted text-[0.65rem] mt-1.5">Mendukung format JPG, JPEG, PNG (Maksimal 5MB)</p>
                            <input type="file" id="fileInput" name="file" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <!-- Camera Tab Content -->
                    <div id="cameraTabContent" class="space-y-4">
                        <div class="border-2 border-theme-green/30 rounded-xl overflow-hidden bg-theme-bgLight relative text-center flex flex-col items-center justify-center min-h-[220px] scanner-viewport">
                            <!-- Scanner Line Overlay -->
                            <div id="scannerLine" class="scanner-line hidden"></div>
                            
                            <!-- Video Stream -->
                            <video id="cameraStream" autoplay playsinline class="w-full h-auto max-h-[220px] object-cover hidden"></video>
                            
                            <!-- Initial Camera Prompt -->
                            <div id="cameraPrompt" class="py-8 px-4 space-y-3">
                                <div class="text-4xl text-theme-green"><i class="fa-solid fa-camera-retro"></i></div>
                                <p class="text-theme-textDark font-bold text-xs">Akses kamera diperlukan</p>
                                <button type="button" id="startCameraBtn" class="px-4 py-2 bg-theme-green text-white text-xs font-bold rounded-lg hover:bg-theme-green/90 transition-all duration-200">
                                    Aktifkan Kamera
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center space-x-2">
                            <button type="button" id="captureBtn" class="hidden px-4 py-2 bg-theme-blue text-white text-xs font-bold rounded-lg hover:bg-theme-blue/90 transition-all duration-200">
                                <i class="fa-solid fa-circle-dot mr-1.5"></i>Ambil Foto
                            </button>
                            <button type="button" id="stopCameraBtn" class="hidden px-4 py-2 bg-red-600 text-white text-xs font-bold rounded-lg hover:bg-red-700 transition-all duration-200">
                                <i class="fa-solid fa-power-off mr-1.5"></i>Matikan Kamera
                            </button>
                        </div>
                    </div>

                    <!-- Common Image Preview (used by both) -->
                    <div id="previewContainer" class="hidden border border-theme-borderLight rounded-xl p-3 bg-theme-bgLight relative text-center space-y-3">
                        <img id="imagePreview" class="max-w-full max-h-[220px] rounded-lg mx-auto object-cover border-2 border-theme-green" alt="Pratinjau Gambar">
                        <div class="flex justify-center">
                            <button type="button" id="clearPreviewBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                                <i id="clearPreviewIcon" class="fa-solid fa-arrows-rotate"></i>
                                <span id="clearPreviewText">Foto Ulang</span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" id="btnSubmit" class="tp-btn w-full font-bold py-3 text-sm opacity-50 cursor-not-allowed" disabled>
                        Mulai Analisis
                    </button>
                </form>
            </div>

            <!-- Right Column: Results Panel (Span 7) -->
            <div class="lg:col-span-7 bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow min-h-[350px] flex flex-col justify-center relative">
                
                <!-- Default Placeholder (Sebelum Analisis) -->
                <div id="resultPlaceholder" class="text-center py-8 space-y-3">
                    <span class="text-4xl block">🍃</span>
                    <h3 class="text-base font-bold text-theme-blue">Menunggu Analisis Gambar</h3>
                    <p class="text-theme-textMuted text-xs max-w-sm mx-auto leading-relaxed">
                        Silakan unggah foto daun kentang pada panel sebelah kiri, kemudian klik tombol **"Mulai Analisis"** untuk memulai diagnosis kecerdasan buatan (AI).
                    </p>
                </div>

                <!-- Result Card Box (Muncul setelah analisis sukses) -->
                <div class="hidden space-y-4 text-left" id="resultBox">
                    <div class="flex justify-between items-center border-b border-theme-borderLight pb-3">
                        <h3 class="text-lg font-bold text-theme-blue">Hasil Diagnosis:</h3>
                        <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full font-extrabold text-[0.7rem] shadow-sm" id="confidenceBadge">0% Cocok</span>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-3 overflow-y-auto max-h-[350px] pr-2">
                        <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight text-xs">
                            <div class="font-bold text-theme-green text-[0.65rem] uppercase tracking-wider mb-0.5">Nama Penyakit / Status</div>
                            <div class="text-theme-blue text-base font-extrabold" id="resPenyakit">-</div>
                        </div>

                        <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight text-xs">
                            <div class="font-bold text-theme-green text-[0.65rem] uppercase tracking-wider mb-0.5">Penyebab</div>
                            <div class="text-theme-textDark leading-relaxed" id="resPenyebab">-</div>
                        </div>

                        <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight text-xs">
                            <div class="font-bold text-theme-green text-[0.65rem] uppercase tracking-wider mb-0.5">Rekomendasi Pestisida</div>
                            <div class="text-theme-textDark leading-relaxed" id="resPestisida">-</div>
                        </div>

                        <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight text-xs">
                            <div class="font-bold text-theme-green text-[0.65rem] uppercase tracking-wider mb-0.5">Pola Penyiraman</div>
                            <div class="text-theme-textDark leading-relaxed" id="resPenyiraman">-</div>
                        </div>

                        <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight text-xs">
                            <div class="font-bold text-theme-green text-[0.65rem] uppercase tracking-wider mb-0.5">Langkah Pencegahan</div>
                            <div class="text-theme-textDark leading-relaxed" id="resPencegahan">-</div>
                        </div>
                    </div>

                    @auth
                    <div class="p-2.5 bg-emerald-50 border border-emerald-200 rounded-lg text-center text-[0.7rem] text-emerald-800 font-semibold">
                        ✔️ Analisis ini telah berhasil disimpan ke dalam riwayat **Hasil Tanaman** Anda.
                    </div>
                    @else
                    <div class="p-2.5 bg-theme-bgLight rounded-lg text-center text-[0.7rem] text-theme-textMuted">
                        💡 <a href="{{ route('login') }}" class="text-theme-green font-bold hover:underline">Masuk</a> atau <a href="{{ route('register') }}" class="text-theme-green font-bold hover:underline">Daftar</a> terlebih dahulu untuk menyimpan riwayat deteksi secara otomatis.
                    </div>
                    @endauth
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const fileInput = document.getElementById('fileInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('previewContainer');
    const clearPreviewBtn = document.getElementById('clearPreviewBtn');
    const uploadForm = document.getElementById('uploadForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const resultBox = document.getElementById('resultBox');
    const resultPlaceholder = document.getElementById('resultPlaceholder');

    // Tab elements
    const tabUploadBtn = document.getElementById('tabUploadBtn');
    const tabCameraBtn = document.getElementById('tabCameraBtn');
    const uploadTabContent = document.getElementById('uploadTabContent');
    const cameraTabContent = document.getElementById('cameraTabContent');

    // Camera elements
    const cameraStream = document.getElementById('cameraStream');
    const cameraPrompt = document.getElementById('cameraPrompt');
    const startCameraBtn = document.getElementById('startCameraBtn');
    const captureBtn = document.getElementById('captureBtn');
    const stopCameraBtn = document.getElementById('stopCameraBtn');
    const scannerLine = document.getElementById('scannerLine');

    let stream = null;
    let capturedBlob = null;
    let activeTab = 'camera'; // 'upload' or 'camera'

    // Tab Switching
    tabUploadBtn.addEventListener('click', () => {
        switchTab('upload');
    });

    tabCameraBtn.addEventListener('click', () => {
        switchTab('camera');
    });

    function switchTab(tab) {
        if (activeTab === tab) return;
        
        // Reset preview status saat pindah tab agar bersih
        resetPreview(false);
        
        activeTab = tab;
        if (tab === 'upload') {
            // UI tabs
            tabUploadBtn.className = "w-1/2 pb-2 text-center text-xs font-bold text-theme-green border-b-2 border-theme-green focus:outline-none";
            tabCameraBtn.className = "w-1/2 pb-2 text-center text-xs font-bold text-theme-textMuted border-b-2 border-transparent hover:text-theme-blue focus:outline-none";
            
            // Content
            uploadTabContent.classList.remove('hidden');
            uploadTabContent.style.display = 'block';
            cameraTabContent.classList.add('hidden');
            cameraTabContent.style.display = 'none';
            
            // Stop camera if running
            stopCamera();
        } else {
            // UI tabs
            tabCameraBtn.className = "w-1/2 pb-2 text-center text-xs font-bold text-theme-green border-b-2 border-theme-green focus:outline-none";
            tabUploadBtn.className = "w-1/2 pb-2 text-center text-xs font-bold text-theme-textMuted border-b-2 border-transparent hover:text-theme-blue focus:outline-none";
            
            // Content
            cameraTabContent.classList.remove('hidden');
            cameraTabContent.style.display = 'block';
            uploadTabContent.classList.add('hidden');
            uploadTabContent.style.display = 'none';
            
            startCamera();
        }
        
        updateSubmitButtonState();
    }

    // Camera control
    async function startCamera(isAutoload = false) {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'environment', // back camera preferred for leaf photos
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                },
                audio: false
            });
            cameraStream.srcObject = stream;
            
            // Gunakan style.display untuk memastikan elemen benar-benar sembunyi/muncul
            cameraStream.style.display = 'block';
            cameraPrompt.style.display = 'none';
            captureBtn.style.display = 'inline-block';
            stopCameraBtn.style.display = 'inline-block';
            if (scannerLine) {
                scannerLine.classList.remove('hidden');
                scannerLine.style.display = 'block';
            }
            
            cameraStream.classList.remove('hidden');
            cameraPrompt.classList.add('hidden');
            captureBtn.classList.remove('hidden');
            stopCameraBtn.classList.remove('hidden');
        } catch (err) {
            console.error("Camera access error:", err);
            // Jangan tampilkan alert jika gagal auto-start (karena kebijakan autoplay browser)
            if (isAutoload !== true) {
                alert("Gagal mengakses kamera: " + err.message + "\nPastikan Anda memberikan izin kamera.");
            }
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        cameraStream.srcObject = null;
        
        // Gunakan style.display untuk memastikan elemen benar-benar sembunyi/muncul
        cameraStream.style.display = 'none';
        cameraPrompt.style.display = 'block';
        captureBtn.style.display = 'none';
        stopCameraBtn.style.display = 'none';
        if (scannerLine) {
            scannerLine.classList.add('hidden');
            scannerLine.style.display = 'none';
        }
        
        cameraStream.classList.add('hidden');
        cameraPrompt.classList.remove('hidden');
        captureBtn.classList.add('hidden');
        stopCameraBtn.classList.add('hidden');
    }

    startCameraBtn.addEventListener('click', () => startCamera(false));
    stopCameraBtn.addEventListener('click', stopCamera);

    // Capture photo
    captureBtn.addEventListener('click', () => {
        if (!cameraStream.videoWidth) return;

        const canvas = document.createElement('canvas');
        canvas.width = cameraStream.videoWidth;
        canvas.height = cameraStream.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(cameraStream, 0, 0, canvas.width, canvas.height);

        canvas.toBlob((blob) => {
            capturedBlob = blob;
            const url = URL.createObjectURL(blob);
            imagePreview.src = url;
            previewContainer.classList.remove('hidden');
            
            // Sembunyikan tab content kamera agar 'Akses kamera diperlukan' hilang
            cameraTabContent.classList.add('hidden');
            cameraTabContent.style.display = 'none';
            
            // Update button text & icon
            document.getElementById('clearPreviewText').innerText = 'Foto Ulang';
            document.getElementById('clearPreviewIcon').className = 'fa-solid fa-camera-rotate';
            
            // Turn off camera stream to save resources now that we got the picture
            stopCamera();
            updateSubmitButtonState();
        }, 'image/jpeg', 0.95);
    });

    // Preview uploaded image
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                
                // Sembunyikan tab content upload
                uploadTabContent.classList.add('hidden');
                uploadTabContent.style.display = 'none';
                
                // Update button text & icon
                document.getElementById('clearPreviewText').innerText = 'Ganti Gambar';
                document.getElementById('clearPreviewIcon').className = 'fa-solid fa-file-arrow-up';
                
                updateSubmitButtonState();
            }
            reader.readAsDataURL(file);
        }
    });

    // Clear preview handler
    clearPreviewBtn.addEventListener('click', () => resetPreview(true));

    function resetPreview(autoStartCamera = true) {
        const startCam = autoStartCamera !== false;
        
        imagePreview.src = '';
        previewContainer.classList.add('hidden');
        fileInput.value = '';
        capturedBlob = null;
        updateSubmitButtonState();
        
        // Tampilkan kembali tab content yang sesuai
        if (activeTab === 'camera') {
            cameraTabContent.classList.remove('hidden');
            cameraTabContent.style.display = 'block';
            if (startCam) {
                startCamera();
            }
        } else {
            uploadTabContent.classList.remove('hidden');
            uploadTabContent.style.display = 'block';
        }
    }

    function updateSubmitButtonState() {
        let hasImage = false;
        if (activeTab === 'upload' && fileInput.files.length > 0) {
            hasImage = true;
        } else if (activeTab === 'camera' && capturedBlob !== null) {
            hasImage = true;
        }

        if (hasImage) {
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Handle AJAX prediction submission
    uploadForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        let fileToSend = null;
        if (activeTab === 'upload') {
            fileToSend = fileInput.files[0];
        } else if (activeTab === 'camera') {
            fileToSend = capturedBlob ? new File([capturedBlob], "daun_camera.jpg", { type: "image/jpeg" }) : null;
        }

        if (!fileToSend) return;

        btnSubmit.disabled = true;
        btnSubmit.innerText = "Menganalisis Citra...";
        resultBox.classList.add('hidden');
        resultPlaceholder.classList.remove('hidden');

        const formData = new FormData();
        formData.append('file', fileToSend);

        try {
            const response = await fetch("{{ route('predict') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            if (!response.ok) {
                const errData = await response.json();
                throw new Error(errData.error || "Gagal memproses gambar.");
            }

            const data = await response.json();
            
            if (data.status === 'success') {
                // Update UI values
                document.getElementById('confidenceBadge').innerText = `${(data.confidence * 100).toFixed(1)}% Akurasi`;
                document.getElementById('resPenyakit').innerText = data.solusi.penyakit;
                document.getElementById('resPenyebab').innerText = data.solusi.penyebab;
                document.getElementById('resPestisida').innerText = data.solusi.pestisida;
                document.getElementById('resPenyiraman').innerText = data.solusi.penyiraman;
                document.getElementById('resPencegahan').innerText = data.solusi.pencegahan;
                
                // Toggle visibility
                resultPlaceholder.classList.add('hidden');
                resultBox.classList.remove('hidden');
            } else {
                alert("Error: " + (data.error || "Gagal menganalisis gambar."));
                resultPlaceholder.classList.remove('hidden');
                resultBox.classList.add('hidden');
            }
        } catch (err) {
            alert("Kesalahan analisis: " + err.message);
            resultPlaceholder.classList.remove('hidden');
            resultBox.classList.add('hidden');
        } finally {
            btnSubmit.disabled = false;
            btnSubmit.innerText = "Mulai Analisis";
            updateSubmitButtonState();
        }
    });

    // Start camera automatically on page load
    window.addEventListener('DOMContentLoaded', () => {
        startCamera(true);
    });
</script>
@endsection
