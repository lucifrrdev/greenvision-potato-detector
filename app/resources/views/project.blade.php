@extends('layouts.app')

@section('title', 'Detail Teknis AI - Greenvision')

@section('content')
<div class="py-10 bg-theme-bgLight border-b border-theme-borderLight">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="text-center space-y-2">
            <span class="tp-section-title-pre">Technical Specifications</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-theme-blue">Detail Model AI & Dataset</h2>
        </div>

        <div class="bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-6 text-left">
            <div class="space-y-3">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-microchip text-xs"></i></span>
                    Arsitektur Jaringan Saraf Konvolusional (CNN)
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Sistem ini mengimplementasikan ekstraksi fitur spasial secara bertingkat menggunakan Convolutional Neural Network (CNN) untuk memindai struktur klorosis, pola nekrotik, dan bercak konsentris pada permukaan daun kentang.
                </p>
                
                <div class="bg-theme-blue text-white/90 p-4 rounded-xl font-mono text-xs leading-relaxed overflow-x-auto shadow-inner">
                    <div class="text-theme-green font-bold mb-1">// Struktur Layer Convolutional Neural Network (CNN)</div>
                    <div>Input Layer  : Shape (256, 256, 3)</div>
                    <div>Block 1       : Conv2D (32 filters, 3x3) -> MaxPooling2D (2x2)</div>
                    <div>Block 2       : Conv2D (64 filters, 3x3) -> MaxPooling2D (2x2)</div>
                    <div>Block 3       : Conv2D (64 filters, 3x3) -> MaxPooling2D (2x2)</div>
                    <div>Dense layers  : Flatten -> Dense (64 units, ReLU) -> Dense (3, Softmax Output)</div>
                </div>
            </div>

            <div class="space-y-3 border-t border-theme-borderLight pt-4">
                <h3 class="text-xl font-extrabold text-theme-blue flex items-center">
                    <span class="w-8 h-8 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center mr-2 text-base"><i class="fa-solid fa-database text-xs"></i></span>
                    Spesifikasi Kategori Kelas Dataset
                </h3>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Model dilatih menggunakan dataset daun kentang publik yang terbagi menjadi tiga kelas diagnosis utama:
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-1">
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight text-xs">
                        <div class="font-bold text-amber-600 mb-1">Early Blight</div>
                        <p class="text-[0.7rem] text-theme-textMuted leading-relaxed">Disebabkan oleh jamur Alternaria solani dengan bercak cokelat kering melingkar konsentris.</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight text-xs">
                        <div class="font-bold text-red-600 mb-1">Late Blight</div>
                        <p class="text-[0.7rem] text-theme-textMuted leading-relaxed">Phytophthora infestans dengan gejala busuk daun basah kehitaman yang cepat meluas.</p>
                    </div>
                    <div class="border border-theme-borderLight rounded-xl p-4 bg-theme-bgLight text-xs">
                        <div class="font-bold text-theme-green mb-1">Healthy</div>
                        <p class="text-[0.7rem] text-theme-textMuted leading-relaxed">Kondisi daun kentang yang segar dan tidak menunjukkan gejala klorosis atau nekrosis patologis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
