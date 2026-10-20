@extends('layouts.app')

@section('title', 'greenvision - Platform Diagnosis & Proteksi Tanaman Kentang')

@section('content')
<!-- Hero Slider Section -->
<div class="relative bg-white pt-10 pb-12 overflow-hidden border-b border-theme-borderLight">
    <!-- Decorative Shapes -->
    <div class="absolute top-6 left-6 w-48 h-48 bg-theme-green/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-6 right-6 w-64 h-64 bg-theme-blue/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Content -->
            <div class="lg:col-span-7 space-y-4 text-left">
                @auth
                    <span class="tp-section-title-pre">
                        🌾 Dashboard Deteksi Petani
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-theme-blue leading-tight tracking-tight">
                        Selamat Datang Kembali, {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-theme-textMuted text-sm md:text-base max-w-xl leading-relaxed">
                        Sistem kecerdasan buatan Greenvision siap membantu memindai dan mendiagnosis kesehatan daun tanaman kentang Anda secara akurat untuk hasil panen optimal.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-3 items-center">
                        <a class="tp-btn py-3 px-6 text-sm" href="{{ route('input') }}">Mulai Analisis Instan</a>
                        <a class="text-theme-blue hover:text-theme-green font-bold text-sm transition-colors flex items-center" href="{{ route('about') }}">
                            <span class="w-8 h-8 rounded-full bg-theme-green/10 flex items-center justify-center mr-2 text-theme-green"><i class="fa-solid fa-play text-[0.65rem]"></i></span>
                            Cara Kerja Sistem
                        </a>
                    </div>
                @else
                    <span class="tp-section-title-pre">
                        Digital Crop Protection Platform
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-theme-blue leading-tight tracking-tight">
                        Lindungi Hasil Panen Kentang dengan Deteksi Dini AI.
                    </h2>
                    <p class="text-theme-textMuted text-sm md:text-base max-w-xl leading-relaxed">
                        greenvision memadukan teknologi Convolutional Neural Network (CNN) untuk mendeteksi penyakit daun kentang secara akurat, memberi solusi pestisida tepat guna, serta panduan penyiraman berkala.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-3 items-center">
                        <a class="tp-btn py-3 px-6 text-sm" href="{{ route('login') }}">Masuk untuk Mulai Analisis</a>
                        <a class="bg-white border-2 border-theme-green text-theme-green hover:bg-theme-green hover:text-white font-bold py-3 px-6 rounded text-sm transition-all" href="{{ route('register') }}">
                            Daftar Akun Petani
                        </a>
                    </div>
                @endauth
            </div>
            <!-- Right Banner Image / Illustration -->
            <div class="lg:col-span-5 relative flex justify-center w-full">
                <div class="relative w-full max-w-lg aspect-[4/3] rounded-2xl overflow-hidden shadow-lg border-2 border-white">
                    <img src="{{ asset('hero_leaf_scan.webp') }}" alt="AI Deteksi Daun Kentang" class="w-full h-full object-cover">
                </div>
                <!-- Mini Badge 1 -->
                <div class="absolute -top-4 -left-4 bg-white border border-theme-borderLight rounded-xl p-3 shadow flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-sm">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <div class="text-[0.6rem] text-theme-textMuted font-bold uppercase">Akurasi AI</div>
                        <div class="text-xs font-extrabold text-theme-blue">Hingga 98.5%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expert Advisor Area -->
<div class="bg-theme-bgLight py-6 border-b border-theme-borderLight">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="text-2xl text-theme-green"><i class="fa-solid fa-user-doctor"></i></div>
                <span class="text-xs font-bold text-theme-blue">
                    Butuh bantuan teknis atau konsultasi penyakit? <a href="{{ route('about') }}" class="text-theme-green hover:underline">Hubungi Ahli Proteksi Tanaman Kami</a>
                </span>
            </div>
            <span class="text-[0.65rem] text-theme-textMuted font-bold">Layanan analisis 24/7 gratis berbasis cloud AI</span>
        </div>
    </div>
</div>

<!-- Services / Feature Cards -->
<div id="services" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
        <div class="space-y-2">
            <span class="tp-section-title-pre">Our Services</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-theme-blue">Layanan Diagnosis Utama Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
            <!-- Service item 1 -->
            <div class="border border-theme-borderLight hover:border-theme-green rounded-xl p-6 text-center bg-theme-bgLight transition-all duration-300 hover:-translate-y-1 group">
                <div class="w-12 h-12 rounded-full bg-theme-green/10 text-theme-green text-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-theme-green group-hover:text-white transition-all">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <h4 class="text-lg font-bold text-theme-blue mb-2">Deteksi Bercak Daun (Early Blight)</h4>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Identifikasi tanda-tanda awal bercak cokelat kering melingkar pada permukaan daun kentang akibat jamur Alternaria solani.
                </p>
            </div>

            <!-- Service item 2 -->
            <div class="border border-theme-borderLight hover:border-theme-green rounded-xl p-6 text-center bg-theme-bgLight transition-all duration-300 hover:-translate-y-1 group">
                <div class="w-12 h-12 rounded-full bg-theme-green/10 text-theme-green text-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-theme-green group-hover:text-white transition-all">
                    <i class="fa-solid fa-skull-crossbones"></i>
                </div>
                <h4 class="text-lg font-bold text-theme-blue mb-2">Deteksi Busuk Daun (Late Blight)</h4>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Klasifikasi dini penyakit busuk daun basah kehitaman akibat serangan oomiset Phytophthora infestans yang sangat menular.
                </p>
            </div>

            <!-- Service item 3 -->
            <div class="border border-theme-borderLight hover:border-theme-green rounded-xl p-6 text-center bg-theme-bgLight transition-all duration-300 hover:-translate-y-1 group">
                <div class="w-12 h-12 rounded-full bg-theme-green/10 text-theme-green text-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-theme-green group-hover:text-white transition-all">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <h4 class="text-lg font-bold text-theme-blue mb-2">Pemantauan Kesehatan (Healthy)</h4>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Memastikan dan memvalidasi bahwa kondisi daun tanaman kentang Anda dalam keadaan sehat dan bebas dari patogen patologis.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
