@extends('layouts.app')

@section('title', 'Hasil Tanaman (Riwayat) - Greenvision')

@section('content')
<div class="py-10 bg-theme-bgLight border-b border-theme-borderLight">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-theme-borderLight pb-4 gap-3">
            <div class="text-left space-y-1">
                <span class="tp-section-title-pre">Diagnosis Dashboard</span>
                <h2 class="text-2xl font-extrabold text-theme-blue">Hasil Tanaman & Riwayat Deteksi</h2>
                <p class="text-theme-textMuted text-xs">
                    Kelola dan pantau semua hasil diagnosis kesehatan daun kentang Anda.
                </p>
            </div>
            <a href="{{ route('input') }}" class="tp-btn text-xs py-2.5 px-5">
                + Diagnosis Baru
            </a>
        </div>

        @if($detections->isEmpty())
            <div class="bg-white rounded-2xl p-10 text-center border border-theme-borderLight shadow-sm space-y-3">
                <span class="text-4xl block">📭</span>
                <h3 class="text-lg font-bold text-theme-blue">Belum ada riwayat diagnosis</h3>
                <p class="text-theme-textMuted text-xs max-w-sm mx-auto leading-relaxed">
                    Anda belum mengunggah gambar apa pun untuk dianalisis. Silakan mulai analisis pertama Anda.
                </p>
            </div>
        @else
            <!-- Statistics Dashboard Card -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total -->
                <div class="bg-white rounded-xl p-4 border border-theme-borderLight shadow-sm flex items-center justify-between text-xs">
                    <div class="text-left">
                        <span class="text-[0.6rem] text-theme-textMuted font-bold uppercase tracking-wider">Total Analisis</span>
                        <h3 class="text-xl font-extrabold text-theme-blue mt-0.5">{{ $totalDetections }}</h3>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>

                <!-- Sehat -->
                <div class="bg-white rounded-xl p-4 border border-theme-borderLight shadow-sm flex items-center justify-between text-xs">
                    <div class="text-left">
                        <span class="text-[0.6rem] text-theme-textMuted font-bold uppercase tracking-wider">Tanaman Sehat</span>
                        <h3 class="text-xl font-extrabold text-theme-green mt-0.5">{{ $healthyCount }}</h3>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                </div>

                <!-- Early Blight -->
                <div class="bg-white rounded-xl p-4 border border-theme-borderLight shadow-sm flex items-center justify-between text-xs">
                    <div class="text-left">
                        <span class="text-[0.6rem] text-theme-textMuted font-bold uppercase tracking-wider">Early Blight</span>
                        <h3 class="text-xl font-extrabold text-amber-600 mt-0.5">{{ $earlyBlightCount }}</h3>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                </div>

                <!-- Late Blight -->
                <div class="bg-white rounded-xl p-4 border border-theme-borderLight shadow-sm flex items-center justify-between text-xs">
                    <div class="text-left">
                        <span class="text-[0.6rem] text-theme-textMuted font-bold uppercase tracking-wider">Late Blight</span>
                        <h3 class="text-xl font-extrabold text-red-600 mt-0.5">{{ $lateBlightCount }}</h3>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-skull-crossbones"></i>
                    </div>
                </div>
            </div>

            <!-- Card Grid View -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                @foreach($detections as $detection)
                    @php
                        $isHealthy = stripos($detection->disease_name, 'healthy') !== false || stripos($detection->disease_name, 'sehat') !== false;
                        $isEarly = stripos($detection->disease_name, 'early') !== false || stripos($detection->disease_name, 'bercak') !== false;
                        $badgeClass = $isHealthy ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($isEarly ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200');
                    @endphp
                    <div class="bg-white rounded-xl border border-theme-borderLight overflow-hidden flex flex-col justify-between hover:border-theme-green hover:shadow transition-all duration-300 group">
                        <!-- Image -->
                        <div class="h-40 overflow-hidden relative bg-slate-900">
                            <img src="{{ asset('predictions/' . $detection->image_name) }}" alt="Daun Kentang" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <!-- Accuracy Badge -->
                            <div class="absolute bottom-2 right-2 bg-white/90 text-theme-textDark py-0.5 px-2 rounded-full font-bold text-[0.7rem] shadow-sm">
                                {{ number_format($detection->confidence * 100, 1) }}% Akurasi
                            </div>
                        </div>

                        <!-- Card Info -->
                        <div class="p-4 flex-grow space-y-3 text-left">
                            <div class="flex justify-between items-start">
                                <span class="text-[0.7rem] text-theme-textMuted font-bold">{{ $detection->created_at->translatedFormat('d M Y, H:i') }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[0.6rem] font-bold border {{ $badgeClass }}">
                                    {{ $isHealthy ? 'Sehat' : ($isEarly ? 'Bercak Kering' : 'Busuk Daun') }}
                                </span>
                            </div>
                            <h3 class="text-base font-extrabold text-theme-blue mt-0.5 leading-snug">{{ $detection->disease_name }}</h3>

                            @if($detection->details)
                                <div class="space-y-2 pt-2 text-[0.7rem] border-t border-theme-borderLight">
                                    <div>
                                        <span class="font-bold text-theme-green block mb-0.5">Penyebab:</span>
                                        <p class="text-theme-textMuted line-clamp-2 leading-relaxed">{{ $detection->details['penyebab'] ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <span class="font-bold text-theme-green block mb-0.5">Rekomendasi Solusi:</span>
                                        <p class="text-theme-textMuted line-clamp-2 leading-relaxed">{{ $detection->details['pestisida'] ?? '-' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-4 pt-0 flex space-x-2">
                            <a href="{{ route('history.detail', $detection->id) }}" class="flex-grow text-center bg-theme-bgLight hover:bg-theme-green hover:text-white text-theme-textDark font-bold py-2 rounded-lg text-[0.7rem] transition-all border border-theme-borderLight hover:border-theme-green">
                                <i class="fa-regular fa-folder-open mr-1"></i> Detail Solusi
                            </a>
                            <form action="{{ route('history.destroy', $detection->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus diagnosis ini secara permanen?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-50 hover:bg-red-500 text-red-500 hover:text-white border border-red-200 hover:border-red-500 p-2 rounded-lg text-[0.7rem] transition-colors" title="Hapus Diagnosis">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
