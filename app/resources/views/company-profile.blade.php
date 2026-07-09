@extends('layouts.app')

@section('title', 'Profil Perusahaan - CV Anugrah Agro Putra')

@section('content')
<!-- Company Header -->
<div class="py-10 bg-white border-b border-theme-borderLight">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left: Text -->
            <div class="lg:col-span-7 space-y-4 text-left">
                <span class="tp-section-title-pre">CV ANUGRAH AGRO PUTRA</span>
                <h1 class="text-3xl font-extrabold text-theme-blue leading-tight">
                    Benih Kentang Bersertifikat Hasan Nurdin
                </h1>
                <p class="text-theme-textMuted text-sm leading-relaxed">
                    Sejak tahun 2005, kami berkomitmen menghadirkan benih kentang terbaik untuk hasil panen optimal. Semua produk benih kami telah tersertifikasi resmi oleh **BPSB (Balai Pengawasan dan Sertifikasi Benih)**, terbukti bebas penyakit, subur, dan tangguh di lapangan.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/628123456789" target="_blank" class="tp-btn bg-emerald-600 hover:bg-emerald-700 py-3 px-6 text-sm">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Hubungi WhatsApp Admin
                    </a>
                </div>
            </div>

            <!-- Right: Logo & Badge -->
            <div class="lg:col-span-5 flex justify-center relative">
                <div class="w-56 h-56 bg-gradient-to-br from-emerald-50 to-emerald-100 border border-theme-borderLight rounded-2xl flex items-center justify-center text-7xl shadow relative overflow-hidden">
                    🥔
                </div>
                <div class="absolute -bottom-4 -right-4 bg-theme-blue text-white py-2 px-4 rounded-xl shadow-lg">
                    <div class="text-[0.55rem] text-theme-green uppercase font-bold tracking-wider">Established Since</div>
                    <div class="text-sm font-extrabold">Tahun 2005</div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Product Showcase -->
<div class="py-12 bg-theme-bgLight border-b border-theme-borderLight">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="text-center space-y-2">
            <span class="tp-section-title-pre">Our Certified Seeds</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-theme-blue">Pilihan Produk Benih Terbaik</h2>
            <p class="text-theme-textMuted text-xs max-w-md mx-auto">Kami memproduksi benih kentang bermutu tinggi melewati berbagai generasi seleksi ketat.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- G0 -->
            <div class="bg-white rounded-xl p-5 border border-theme-borderLight shadow-sm hover:shadow transition-all flex flex-col justify-between">
                <div class="space-y-3 text-left">
                    <span class="bg-emerald-50 text-theme-green px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border border-theme-green/20">Generasi 0</span>
                    <h3 class="text-base font-bold text-theme-blue mt-1">Benih Dasar (G0)</h3>
                    <p class="text-theme-textMuted text-xs leading-relaxed">
                        Benih awal super steril bebas patogen yang dihasilkan langsung dari kultur jaringan di dalam rumah kaca kedap serangga.
                    </p>
                </div>
            </div>

            <!-- G1 -->
            <div class="bg-white rounded-xl p-5 border border-theme-borderLight shadow-sm hover:shadow transition-all flex flex-col justify-between">
                <div class="space-y-3 text-left">
                    <span class="bg-emerald-50 text-theme-green px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border border-theme-green/20">Generasi 1</span>
                    <h3 class="text-base font-bold text-theme-blue mt-1">Benih Pokok (G1)</h3>
                    <p class="text-theme-textMuted text-xs leading-relaxed">
                        Benih generasi pertama hasil perbanyakan dari benih dasar G0 yang telah ditanam di lapangan dengan pengawasan ketat.
                    </p>
                </div>
            </div>

            <!-- G2 -->
            <div class="bg-white rounded-xl p-5 border border-theme-borderLight shadow-sm hover:shadow transition-all flex flex-col justify-between">
                <div class="space-y-3 text-left">
                    <span class="bg-emerald-50 text-theme-green px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border border-theme-green/20">Generasi 2</span>
                    <h3 class="text-base font-bold text-theme-blue mt-1">Benih Sebar (G2)</h3>
                    <p class="text-theme-textMuted text-xs leading-relaxed">
                        Benih generasi kedua hasil perbanyakan G1 yang siap didistribusikan untuk ditanam oleh petani kentang komersial.
                    </p>
                </div>
            </div>

            <!-- Planlet -->
            <div class="bg-white rounded-xl p-5 border border-theme-borderLight shadow-sm hover:shadow transition-all flex flex-col justify-between">
                <div class="space-y-3 text-left">
                    <span class="bg-emerald-50 text-theme-green px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border border-theme-green/20">In-Vitro</span>
                    <h3 class="text-base font-bold text-theme-blue mt-1">Planlet Kentang</h3>
                    <p class="text-theme-textMuted text-xs leading-relaxed">
                        Tanaman in-vitro hasil kultur jaringan laboratorium yang steril dan siap untuk proses aklimatisasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Company Contact Details -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-start text-left">
        <!-- Contact Details -->
        <div class="space-y-4">
            <span class="tp-section-title-pre">Contact Us</span>
            <h2 class="text-2xl font-bold text-theme-blue">Siap Membantu Kebutuhan Anda</h2>
            <p class="text-theme-textMuted text-xs leading-relaxed">
                Kunjungi kantor operasional kami atau hubungi kontak admin resmi untuk pemesanan benih kentang bersertifikat.
            </p>

            <div class="space-y-3 pt-3 border-t border-theme-borderLight">
                <div class="flex items-start space-x-3 text-xs">
                    <div class="text-theme-green mt-0.5 text-base"><i class="fa-solid fa-map-location-dot"></i></div>
                    <div>
                        <h4 class="font-bold text-theme-blue">Alamat Kantor</h4>
                        <p class="text-theme-textMuted">Jalan PTPN VIII Kertamanah No.17 Pangalengan, Bandung, Jawa Barat</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3 text-xs">
                    <div class="text-theme-green mt-0.5 text-base"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <h4 class="font-bold text-theme-blue">Surel / Email</h4>
                        <p class="text-theme-textMuted">anugrahagroputra@gmail.com</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3 text-xs">
                    <div class="text-theme-green mt-0.5 text-base"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <h4 class="font-bold text-theme-blue">Jam Operasional</h4>
                        <p class="text-theme-textMuted">Senin – Jumat (08.00 – 15.40 WIB)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Maps Mock -->
        <div class="w-full h-64 bg-theme-bgLight border border-theme-borderLight rounded-2xl overflow-hidden flex items-center justify-center text-theme-textMuted relative shadow-inner">
            <div class="text-center p-4 space-y-1">
                <i class="fa-solid fa-map-pin text-3xl text-theme-green"></i>
                <div class="font-bold text-theme-blue text-xs">Lokasi Pangalengan Bandung</div>
                <div class="text-[0.65rem]">CV Anugrah Agro Putra (Benih Kentang Hasan Nurdin)</div>
            </div>
        </div>
    </div>
</div>
@endsection
