@extends('layouts.app')

@section('title', 'Tentang Greenvision - Sistem Proteksi Tanaman')

@section('content')
<div class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
            
            <!-- Left Column: Decorative Image block -->
            <div class="lg:col-span-6 relative flex justify-center">
                <div class="relative w-64 h-80 sm:w-80 sm:h-96 rounded-2xl overflow-hidden shadow border-4 border-white bg-slate-100">
                    <div class="w-full h-full bg-gradient-to-tr from-emerald-100 to-teal-100 flex items-center justify-center text-8xl">
                        🔬
                    </div>
                </div>
                <!-- Float card -->
                <div class="absolute -bottom-4 -left-4 bg-theme-blue text-white rounded-xl p-4 shadow-lg space-y-0.5">
                    <div class="text-[0.6rem] text-theme-green uppercase font-extrabold tracking-wider">Metode RAD</div>
                    <div class="text-sm font-bold">Rapid Development</div>
                </div>
            </div>

            <!-- Right Column: Content -->
            <div class="lg:col-span-6 space-y-4">
                <span class="tp-section-title-pre">System Architecture</span>
                <h2 class="text-3xl font-extrabold text-theme-blue">Pengembangan Sistem Cepat & Andal</h2>
                <p class="text-theme-textMuted text-xs leading-relaxed">
                    Greenvision dikembangkan menggunakan metodologi **Rapid Application Development (RAD)** untuk menghasilkan sistem klasifikasi citra daun kentang yang cepat, tepat, dan andal berbasis web.
                </p>

                <!-- RAD Stages list -->
                <div class="space-y-3 pt-3 border-t border-theme-borderLight">
                    <div class="flex items-start space-x-2.5 text-xs">
                        <span class="w-5 h-5 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center text-[0.6rem] mt-0.5 shrink-0"><i class="fa-solid fa-check"></i></span>
                        <div>
                            <h4 class="font-bold text-theme-blue">1. Perencanaan Kebutuhan</h4>
                            <p class="text-theme-textMuted">Menentukan sasaran sistem diagnosis dan jenis penyakit tanaman kentang.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2.5 text-xs">
                        <span class="w-5 h-5 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center text-[0.6rem] mt-0.5 shrink-0"><i class="fa-solid fa-check"></i></span>
                        <div>
                            <h4 class="font-bold text-theme-blue">2. Desain & Prototyping</h4>
                            <p class="text-theme-textMuted">Merancang arsitektur model CNN, skema database ERD, dan antarmuka Blade Laravel.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2.5 text-xs">
                        <span class="w-5 h-5 rounded-full bg-theme-green/10 text-theme-green flex items-center justify-center text-[0.6rem] mt-0.5 shrink-0"><i class="fa-solid fa-check"></i></span>
                        <div>
                            <h4 class="font-bold text-theme-blue">3. Konstruksi & Pengujian</h4>
                            <p class="text-theme-textMuted">Membangun integrasi controller Laravel dengan endpoint model AI Flask API.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('input') }}" class="tp-btn py-3 px-6 text-sm">Mulai Coba Sekarang</a>
                </div>
            </div>

        </div>

        <!-- Visual RAD Diagram Section -->
        <div class="border-t border-theme-borderLight pt-10 mt-10">
            <div class="space-y-4 text-center">
                <span class="tp-section-title-pre">RAD Methodology Workflow</span>
                <h3 class="text-2xl font-extrabold text-theme-blue">Visualisasi Siklus Rapid Application Development</h3>
                <p class="text-theme-textMuted text-xs max-w-xl mx-auto leading-relaxed">
                    Berikut adalah representasi visual diagram tahapan RAD yang diimplementasikan dalam siklus pembuatan sistem Greenvision sesuai dengan alur pengembangan sistem:
                </p>

                <!-- HTML/CSS RAD Diagram -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center pt-6 max-w-4xl mx-auto text-xs text-white font-bold">
                    <!-- Phase 1: Requirements Planning -->
                    <div class="md:col-span-3 bg-blue-700 rounded-2xl p-5 shadow min-h-[140px] flex flex-col justify-center border border-blue-800 text-center">
                        <div class="text-[0.6rem] uppercase tracking-wider mb-1 text-theme-green">Phase 1</div>
                        <h4 class="text-sm font-extrabold mb-1.5">Requirements Planning</h4>
                        <p class="text-[0.65rem] font-normal text-white/90 leading-relaxed">Mengidentifikasi tujuan dan kebutuhan informasi</p>
                    </div>

                    <!-- Arrow 1 -->
                    <div class="md:col-span-1 flex justify-center text-blue-700 text-xl py-2 md:py-0">
                        <i class="fa-solid fa-circle-arrow-right hidden md:block"></i>
                        <i class="fa-solid fa-circle-arrow-down md:hidden"></i>
                    </div>

                    <!-- Phase 2: RAD Design Workshop Box -->
                    <div class="md:col-span-5 border-2 border-slate-900 rounded-2xl p-4 bg-slate-50 shadow-inner relative min-h-[140px] flex flex-col justify-center">
                        <div class="absolute -top-3 left-4 bg-white px-2 py-0.5 border border-slate-900 rounded text-[0.6rem] text-slate-900 uppercase font-black tracking-wider">
                            RAD Design Workshop
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <!-- Loop Card 2A -->
                            <div class="bg-blue-700 rounded-xl p-3 text-center border border-blue-800 flex flex-col justify-center min-h-[80px]">
                                <p class="text-[0.65rem] font-normal text-white leading-relaxed">Bekerja sama dengan pengguna untuk merancang sistem</p>
                            </div>
                            <!-- Loop Card 2B -->
                            <div class="bg-blue-700 rounded-xl p-3 text-center border border-blue-800 flex flex-col justify-center min-h-[80px]">
                                <p class="text-[0.65rem] font-normal text-white leading-relaxed">Membangun sistem</p>
                            </div>
                        </div>
                        <!-- Loop Arrow Symbol -->
                        <div class="text-center text-blue-700 mt-2 text-[0.65rem]">
                            <i class="fa-solid fa-arrows-spin mr-1"></i> <span class="text-[0.55rem] text-slate-600 font-extrabold uppercase">Iterasi Perancangan & Pembangunan</span>
                        </div>
                    </div>

                    <!-- Arrow 2 -->
                    <div class="md:col-span-1 flex justify-center text-blue-700 text-xl py-2 md:py-0">
                        <i class="fa-solid fa-circle-arrow-right hidden md:block"></i>
                        <i class="fa-solid fa-circle-arrow-down md:hidden"></i>
                    </div>

                    <!-- Phase 3: Implementation -->
                    <div class="md:col-span-2 bg-blue-700 rounded-2xl p-5 shadow min-h-[140px] flex flex-col justify-center border border-blue-800 text-center">
                        <div class="text-[0.6rem] uppercase tracking-wider mb-1 text-theme-green">Phase 3</div>
                        <h4 class="text-sm font-extrabold mb-1.5">Implementation</h4>
                        <p class="text-[0.65rem] font-normal text-white/90 leading-relaxed">Memperkenalkan sistem baru</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
