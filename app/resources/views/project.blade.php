@extends('layouts.app')

@section('title', 'Detail Teknis AI - Greenvision')

@section('content')
<div class="py-10 bg-theme-bgLight border-b border-theme-borderLight">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="text-center space-y-2">
            <span class="tp-section-title-pre">Technical Specifications</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-theme-blue">Detail Model AI & Dataset</h2>
            <p class="text-theme-textMuted text-xs max-w-lg mx-auto">Dokumentasi teknis lengkap arsitektur CNN, proses pelatihan, dan spesifikasi dataset yang digunakan dalam sistem Greenvision.</p>
        </div>

        {{-- Section 1: Arsitektur CNN --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-microchip text-xs"></i></span>
                    Arsitektur Jaringan Saraf Konvolusional (CNN)
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Greenvision menggunakan arsitektur <strong>Convolutional Neural Network (CNN) Sequential</strong> yang dirancang secara custom menggunakan framework <strong>TensorFlow/Keras</strong>. Model ini mengimplementasikan ekstraksi fitur spasial secara bertingkat melalui empat blok konvolusi untuk memindai dan mengidentifikasi berbagai jenis penyakit dan kondisi pada permukaan daun kentang. Model mengklasifikasikan citra ke dalam <strong>8 kelas diagnosis</strong>.
                </p>

                <div class="bg-theme-blue text-white/90 p-4 rounded-xl font-mono text-xs leading-relaxed overflow-x-auto shadow-inner">
                    <div class="text-theme-green font-bold mb-2">// Struktur Layer Convolutional Neural Network (CNN)</div>
                    <div class="text-white/60">// Input: Citra RGB daun kentang 256×256 piksel</div>
                    <div class="mt-1">Input Layer  : Shape <span class="text-emerald-300">(256, 256, 3)</span> — RGB Image</div>
                    <div>Rescaling    : <span class="text-emerald-300">1./255</span> — Normalisasi piksel [0,255] → [0,1]</div>
                    <div class="mt-2 text-white/60">// Feature Extraction Blocks</div>
                    <div>Block 1      : Conv2D (<span class="text-amber-300">32</span> filters, 3×3, ReLU) → MaxPooling2D (2×2)</div>
                    <div>Block 2      : Conv2D (<span class="text-amber-300">64</span> filters, 3×3, ReLU) → MaxPooling2D (2×2)</div>
                    <div>Block 3      : Conv2D (<span class="text-amber-300">64</span> filters, 3×3, ReLU) → MaxPooling2D (2×2)</div>
                    <div>Block 4      : Conv2D (<span class="text-amber-300">64</span> filters, 3×3, ReLU) → MaxPooling2D (2×2)</div>
                    <div class="mt-2 text-white/60">// Classification Head</div>
                    <div>Flatten      : Mengubah feature map 3D → vektor 1D</div>
                    <div>Dense        : <span class="text-amber-300">64</span> units, aktivasi ReLU</div>
                    <div>Output       : Dense (<span class="text-amber-300">8</span> units, <span class="text-emerald-300">Softmax</span>) — Probabilitas 8 kelas</div>
                </div>
            </div>
        </div>

        {{-- Section 2: 8 Kelas Diagnosis --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-database text-xs"></i></span>
                    8 Kelas Diagnosis Penyakit & Dataset
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Model CNN dilatih untuk mengklasifikasikan citra daun kentang ke dalam <strong>8 kategori diagnosis</strong> yang mencakup berbagai jenis patogen, organisme pengganggu, serta validasi citra bukan daun kentang. Setiap kelas menggunakan dataset citra berkualitas tinggi yang dikurasi secara ilmiah.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 pt-1">
                    {{-- Bacteria --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-orange-50 border-b border-orange-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs"><i class="fa-solid fa-bacterium"></i></div>
                                <div>
                                    <div class="font-extrabold text-orange-700 text-xs">Bacteria</div>
                                    <div class="text-[0.55rem] text-orange-500 font-bold">Kelas 0</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Infeksi bakteri patogen (Ralstonia, Erwinia, Pectobacterium)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Lesi berair, layu bakteri, busuk lunak pada batang dan daun</p>
                        </div>
                    </div>

                    {{-- Bukan Daun Kentang --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-gray-50 border-b border-gray-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs"><i class="fa-solid fa-ban"></i></div>
                                <div>
                                    <div class="font-extrabold text-gray-700 text-xs">Bukan Daun Kentang</div>
                                    <div class="text-[0.55rem] text-gray-500 font-bold">Kelas 1</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Fungsi:</strong> Kelas penolakan untuk citra yang bukan daun kentang</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Tujuan:</strong> Mencegah false positive dari objek atau tanaman lain yang tidak relevan</p>
                        </div>
                    </div>

                    {{-- Fungi --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-amber-50 border-b border-amber-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xs"><i class="fa-solid fa-seedling"></i></div>
                                <div>
                                    <div class="font-extrabold text-amber-700 text-xs">Fungi</div>
                                    <div class="text-[0.55rem] text-amber-500 font-bold">Kelas 2</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Infeksi jamur (Alternaria solani — Early Blight)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Bercak cokelat kering melingkar konsentris (target spot) pada daun tua</p>
                        </div>
                    </div>

                    {{-- Healthy --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-emerald-50 border-b border-emerald-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs"><i class="fa-solid fa-heart-pulse"></i></div>
                                <div>
                                    <div class="font-extrabold text-emerald-700 text-xs">Healthy</div>
                                    <div class="text-[0.55rem] text-emerald-500 font-bold">Kelas 3</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Kondisi:</strong> Daun kentang sehat, bebas patogen</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Ciri:</strong> Hijau segar, tidak ada bercak, klorosis, atau nekrosis patologis</p>
                        </div>
                    </div>

                    {{-- Nematode --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-yellow-50 border-b border-yellow-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xs"><i class="fa-solid fa-worm"></i></div>
                                <div>
                                    <div class="font-extrabold text-yellow-700 text-xs">Nematode</div>
                                    <div class="text-[0.55rem] text-yellow-500 font-bold">Kelas 4</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Cacing nematoda parasit (Globodera, Meloidogyne)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Daun menguning, kerdil, layu meskipun cukup air, akar bergumpal</p>
                        </div>
                    </div>

                    {{-- Pest --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-rose-50 border-b border-rose-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-xs"><i class="fa-solid fa-bugs"></i></div>
                                <div>
                                    <div class="font-extrabold text-rose-700 text-xs">Pest</div>
                                    <div class="text-[0.55rem] text-rose-500 font-bold">Kelas 5</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Serangan hama (kutu daun, ulat, thrips, kumbang Colorado)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Lubang gigitan, daun mengeriting, bekas makan serangga</p>
                        </div>
                    </div>

                    {{-- Phytopthora --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-red-50 border-b border-red-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs"><i class="fa-solid fa-skull-crossbones"></i></div>
                                <div>
                                    <div class="font-extrabold text-red-700 text-xs">Phytopthora</div>
                                    <div class="text-[0.55rem] text-red-500 font-bold">Kelas 6</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Oomycete Phytophthora infestans (Late Blight)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Lesi basah kehitaman, miselium putih, penyakit paling destruktif pada kentang</p>
                        </div>
                    </div>

                    {{-- Virus --}}
                    <div class="border border-theme-borderLight rounded-xl overflow-hidden bg-theme-bgLight group hover:shadow-md transition-all">
                        <div class="bg-purple-50 border-b border-purple-200 p-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs"><i class="fa-solid fa-virus"></i></div>
                                <div>
                                    <div class="font-extrabold text-purple-700 text-xs">Virus</div>
                                    <div class="text-[0.55rem] text-purple-500 font-bold">Kelas 7</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Penyebab:</strong> Infeksi virus (PVX, PVY, PLRV, Mosaic Virus)</p>
                            <p class="text-[0.65rem] text-theme-textMuted leading-relaxed"><strong>Gejala:</strong> Mosaik, daun keriting, kerdil, nekrosis vena, perubahan warna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 3: Hyperparameter Pelatihan --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-sliders text-xs"></i></span>
                    Hyperparameter & Konfigurasi Pelatihan
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Proses pelatihan model menggunakan konfigurasi hyperparameter yang dioptimalkan untuk mencapai keseimbangan antara akurasi tinggi dan generalisasi yang baik terhadap data baru.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-1">
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Optimizer</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">Adam</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Adaptive Moment Estimation dengan learning rate default (0.001)</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Loss Function</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">Sparse Categorical Crossentropy</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Fungsi rugi untuk klasifikasi multi-kelas dengan label integer</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Epochs</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">10 Iterasi</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Jumlah siklus penuh pelatihan terhadap seluruh dataset</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Batch Size</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">32 Sampel</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Jumlah gambar yang diproses per iterasi gradien</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Resolusi Input</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">256 × 256 px</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Setiap citra di-resize ke resolusi tetap dengan 3 channel (RGB)</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                        <div class="text-[0.65rem] text-theme-textMuted uppercase font-bold tracking-wider">Data Split</div>
                        <div class="text-base font-extrabold text-theme-blue mt-1">80% / 20%</div>
                        <p class="text-[0.65rem] text-theme-textMuted mt-1">Proporsi training vs validation, seed = 123 untuk reproduktibilitas</p>
                    </div>
                </div>

                <div class="bg-theme-blue text-white/90 p-4 rounded-xl font-mono text-xs leading-relaxed overflow-x-auto shadow-inner mt-3">
                    <div class="text-theme-green font-bold mb-2">// Konfigurasi Parameter (train.py)</div>
                    <div>IMAGE_SIZE  = <span class="text-amber-300">256</span></div>
                    <div>BATCH_SIZE  = <span class="text-amber-300">32</span></div>
                    <div>CHANNELS    = <span class="text-amber-300">3</span></div>
                    <div>EPOCHS      = <span class="text-amber-300">10</span></div>
                    <div>DATASET_DIR = <span class="text-emerald-300">"dataset"</span></div>
                    <div class="mt-2 text-white/60">// Optimisasi Dataset Pipeline</div>
                    <div>AUTOTUNE    = <span class="text-emerald-300">tf.data.AUTOTUNE</span></div>
                    <div>train_ds    = train_ds.<span class="text-amber-300">cache()</span>.<span class="text-amber-300">shuffle(1000)</span>.<span class="text-amber-300">prefetch</span>(buffer_size=AUTOTUNE)</div>
                    <div>val_ds      = val_ds.<span class="text-amber-300">cache()</span>.<span class="text-amber-300">prefetch</span>(buffer_size=AUTOTUNE)</div>
                </div>
            </div>
        </div>

        {{-- Section 4: Pipeline Inferensi --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-gears text-xs"></i></span>
                    Pipeline Inferensi & Alur Prediksi
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Alur kerja lengkap dari unggahan citra oleh pengguna hingga hasil diagnosis ditampilkan di layar. Setiap tahap berjalan secara otomatis tanpa intervensi manual.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 pt-1">
                    <div class="bg-theme-bgLight rounded-xl p-4 border border-theme-borderLight text-center space-y-2">
                        <div class="w-10 h-10 rounded-full bg-theme-blue text-white flex items-center justify-center mx-auto text-sm font-bold">1</div>
                        <div class="text-xs font-bold text-theme-blue">Upload Citra</div>
                        <p class="text-[0.65rem] text-theme-textMuted">Pengguna mengunggah foto daun via antarmuka Laravel</p>
                    </div>
                    <div class="bg-theme-bgLight rounded-xl p-4 border border-theme-borderLight text-center space-y-2">
                        <div class="w-10 h-10 rounded-full bg-theme-blue text-white flex items-center justify-center mx-auto text-sm font-bold">2</div>
                        <div class="text-xs font-bold text-theme-blue">Kirim ke Flask</div>
                        <p class="text-[0.65rem] text-theme-textMuted">Laravel mengirim gambar via cURL POST ke Flask API</p>
                    </div>
                    <div class="bg-theme-bgLight rounded-xl p-4 border border-theme-borderLight text-center space-y-2">
                        <div class="w-10 h-10 rounded-full bg-theme-blue text-white flex items-center justify-center mx-auto text-sm font-bold">3</div>
                        <div class="text-xs font-bold text-theme-blue">Preprocessing</div>
                        <p class="text-[0.65rem] text-theme-textMuted">PIL membuka citra, resize 256×256px, konversi ke numpy array</p>
                    </div>
                    <div class="bg-theme-bgLight rounded-xl p-4 border border-theme-borderLight text-center space-y-2">
                        <div class="w-10 h-10 rounded-full bg-theme-blue text-white flex items-center justify-center mx-auto text-sm font-bold">4</div>
                        <div class="text-xs font-bold text-theme-blue">Prediksi CNN</div>
                        <p class="text-[0.65rem] text-theme-textMuted">Model TensorFlow memprediksi probabilitas 8 kelas via Softmax</p>
                    </div>
                    <div class="bg-theme-bgLight rounded-xl p-4 border border-theme-borderLight text-center space-y-2">
                        <div class="w-10 h-10 rounded-full bg-theme-green text-white flex items-center justify-center mx-auto text-sm font-bold">5</div>
                        <div class="text-xs font-bold text-theme-blue">Hasil & Solusi</div>
                        <p class="text-[0.65rem] text-theme-textMuted">Diagnosis, confidence, dan rekomendasi solusi ditampilkan ke user</p>
                    </div>
                </div>

                <div class="bg-theme-blue text-white/90 p-4 rounded-xl font-mono text-xs leading-relaxed overflow-x-auto shadow-inner mt-3">
                    <div class="text-theme-green font-bold mb-2">// Kode Inferensi di app.py (Flask)</div>
                    <div>image     = Image.<span class="text-amber-300">open</span>(file.stream).<span class="text-amber-300">convert</span>(<span class="text-emerald-300">"RGB"</span>)</div>
                    <div>image     = image.<span class="text-amber-300">resize</span>((<span class="text-emerald-300">256</span>, <span class="text-emerald-300">256</span>))</div>
                    <div>img_array = tf.keras.preprocessing.image.<span class="text-amber-300">img_to_array</span>(image)</div>
                    <div>img_batch = np.<span class="text-amber-300">expand_dims</span>(img_array, <span class="text-emerald-300">0</span>)  <span class="text-white/60">// Shape: (1, 256, 256, 3)</span></div>
                    <div class="mt-1">predictions     = model.<span class="text-amber-300">predict</span>(img_batch)</div>
                    <div>predicted_class = CLASS_NAMES[np.<span class="text-amber-300">argmax</span>(predictions[<span class="text-emerald-300">0</span>])]</div>
                    <div>confidence      = <span class="text-amber-300">float</span>(np.<span class="text-amber-300">max</span>(predictions[<span class="text-emerald-300">0</span>]))</div>
                </div>
            </div>
        </div>

        {{-- Section 5: Stack Teknologi --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-layer-group text-xs"></i></span>
                    Stack Teknologi & Library
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Daftar lengkap framework, library, dan teknologi yang digunakan dalam sistem Greenvision.
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 pt-1">
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-brands fa-python"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">Python 3.9</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Backend AI Engine</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-solid fa-brain"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">TensorFlow ≥2.10</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Deep Learning Framework</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-solid fa-flask"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">Flask ≥2.0</div>
                        <div class="text-[0.55rem] text-theme-textMuted">REST API Server</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-solid fa-eye"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">OpenCV ≥4.5</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Computer Vision</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-solid fa-image"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">Pillow ≥9.0</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Image Processing</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-solid fa-calculator"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">NumPy ≥1.21</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Numerical Computing</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-brands fa-laravel"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">Laravel 10</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Web Application</div>
                    </div>
                    <div class="border border-theme-borderLight rounded-lg p-3 bg-theme-bgLight text-center hover:shadow-sm transition-all">
                        <div class="text-lg text-theme-blue mb-1"><i class="fa-brands fa-docker"></i></div>
                        <div class="text-[0.65rem] font-bold text-theme-blue">Docker Compose</div>
                        <div class="text-[0.55rem] text-theme-textMuted">Containerization</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 6: API Endpoint --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-4 text-left">
            <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-code text-xs"></i></span>
                Endpoint API Flask (Inferensi)
            </h3>
            <div class="bg-theme-blue text-white/90 p-4 rounded-xl font-mono text-xs leading-relaxed overflow-x-auto shadow-inner">
                <div class="text-theme-green font-bold mb-2">// Flask API Endpoints</div>
                <div class="text-white/60">// 1. Health Check</div>
                <div><span class="text-emerald-300">GET</span>  http://python_ai:<span class="text-amber-300">8001</span>/</div>
                <div class="text-white/60">// Response: {{"{"}} "message": "Greenvision Anugrah Agro Putra CNN API Server is running!" {{"}"}} </div>
                <div class="mt-2 text-white/60">// 2. Prediksi Penyakit Daun</div>
                <div><span class="text-amber-300">POST</span> http://python_ai:<span class="text-amber-300">8001</span>/predict</div>
                <div class="mt-1 text-white/60">// Request (multipart/form-data)</div>
                <div>Content-Type : <span class="text-emerald-300">multipart/form-data</span></div>
                <div>Body Key     : <span class="text-amber-300">file</span> (citra daun kentang, format JPG/PNG)</div>
                <div class="mt-1 text-white/60">// Response (JSON)</div>
                <div>{</div>
                <div>  "<span class="text-emerald-300">status</span>"     : "success",</div>
                <div>  "<span class="text-emerald-300">prediction</span>" : "Phytopthora",</div>
                <div>  "<span class="text-emerald-300">confidence</span>" : 0.9847</div>
                <div>}</div>
            </div>
        </div>

        {{-- Section 7: Model File --}}
        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-4 text-left">
            <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-file-zipper text-xs"></i></span>
                File Model & Output Pelatihan
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-cube text-theme-green"></i>
                        <span class="text-xs font-bold text-theme-blue">potato_disease_model.h5</span>
                    </div>
                    <p class="text-[0.65rem] text-theme-textMuted leading-relaxed">Model CNN terlatih dalam format HDF5 Keras. Berisi bobot (weights), arsitektur, dan konfigurasi optimizer. Ukuran file: ~10.3 MB.</p>
                </div>
                <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-chart-line text-theme-green"></i>
                        <span class="text-xs font-bold text-theme-blue">training_history.png</span>
                    </div>
                    <p class="text-[0.65rem] text-theme-textMuted leading-relaxed">Grafik visualisasi Training vs Validation Accuracy dan Loss selama 10 epoch pelatihan. Dihasilkan otomatis oleh Matplotlib.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
