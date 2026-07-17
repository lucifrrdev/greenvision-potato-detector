@extends('layouts.admin')

@section('title', 'Detail Diagnosis Tanaman - Admin Greenvision')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <a href="{{ route('admin.detections.index') }}" class="text-theme-green hover:underline font-semibold flex items-center">
        ← Kembali ke Kelola Hasil Scan
    </a>
    
    <div class="flex items-center space-x-2">
        <button onclick="window.print()" class="bg-white hover:bg-slate-50 text-theme-textDark border border-theme-borderLight px-3 py-2 rounded-lg text-xs font-bold transition-colors flex items-center shadow-sm">
            🖨️ Cetak Laporan
        </button>
        
        <form action="{{ route('admin.detections.destroy', $detection->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-200 hover:border-rose-500 px-3 py-2 rounded-lg text-xs font-bold transition-colors flex items-center shadow-sm">
                🗑️ Hapus Riwayat
            </button>
        </form>
    </div>
</div>

@php
    $isHealthy = stripos($detection->disease_name, 'healthy') !== false || stripos($detection->disease_name, 'sehat') !== false;
    $isEarly = stripos($detection->disease_name, 'early') !== false || stripos($detection->disease_name, 'bercak') !== false;
    $statusName = $isHealthy ? 'Sehat (Healthy)' : ($isEarly ? 'Bercak Kering (Early Blight)' : 'Busuk Daun (Late Blight)');
    $statusClass = $isHealthy ? 'text-emerald-700 bg-emerald-50 border-emerald-200' : ($isEarly ? 'text-amber-700 bg-amber-50 border-amber-200' : 'text-red-700 bg-red-50 border-red-200');
@endphp

<!-- Main Detail Layout Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    
    <!-- Left Side: Image & Confidence Card -->
    <div class="lg:col-span-4 bg-white rounded-2xl p-5 border border-theme-borderLight shadow space-y-4">
        <div class="aspect-square bg-slate-900 rounded-xl overflow-hidden shadow-sm relative border border-theme-borderLight">
            <img src="{{ asset('predictions/' . $detection->image_name) }}" alt="Diagnosis Daun" class="w-full h-full object-cover">
        </div>

        <div class="pt-3 border-t border-theme-borderLight text-center space-y-2">
            <span class="text-[10px] text-theme-textMuted font-bold uppercase tracking-wider block">Tingkat Keyakinan AI</span>
            <div class="inline-flex items-center justify-center p-3 bg-theme-bgLight rounded-full border border-theme-borderLight relative shadow-inner">
                <div class="text-xl font-extrabold text-theme-blue">
                    {{ number_format($detection->confidence * 100, 1) }}%
                </div>
            </div>
        </div>

        <!-- User Information -->
        <div class="pt-4 border-t border-theme-borderLight space-y-2 text-xs">
            <span class="text-[10px] text-theme-textMuted font-bold uppercase tracking-wider block">Pengunggah (User)</span>
            <div class="bg-theme-bgLight p-3 rounded-lg border border-theme-borderLight">
                <p class="font-bold text-theme-blue">{{ $detection->user ? $detection->user->name : 'Guest/Deleted' }}</p>
                <p class="text-theme-textMuted mt-0.5">{{ $detection->user ? $detection->user->email : '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Solution details panel -->
    <div class="lg:col-span-8 bg-white rounded-2xl p-5 md:p-6 border border-theme-borderLight shadow space-y-4">
        
        <!-- Top Details Title -->
        <div class="border-b border-theme-borderLight pb-3 space-y-1">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <span class="text-xs text-theme-textMuted font-semibold">
                    Tanggal Scan: {{ $detection->created_at->translatedFormat('d F Y, H:i') }} WIB
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusClass }}">
                    {{ $statusName }}
                </span>
            </div>
            <h1 class="text-xl md:text-2xl font-extrabold text-theme-blue leading-snug">
                {{ $detection->disease_name }}
            </h1>
        </div>

        <!-- Solution & Recommendation Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Penyebab -->
            <div class="bg-theme-bgLight p-4 rounded-xl border border-theme-borderLight space-y-1.5 text-xs">
                <div class="font-bold text-theme-green uppercase tracking-wider flex items-center border-b border-theme-borderLight pb-1.5 mb-1.5 text-[10px]">
                    🧪 Penyebab & Gejala
                </div>
                <p class="text-theme-textDark leading-relaxed">
                    {{ $detection->details['penyebab'] ?? 'Informasi detail mengenai penyebab dan gejala tidak tersedia.' }}
                </p>
            </div>

            <!-- Rekomendasi Pestisida -->
            <div class="bg-theme-bgLight p-4 rounded-xl border border-theme-borderLight space-y-1.5 text-xs">
                <div class="font-bold text-theme-green uppercase tracking-wider flex items-center border-b border-theme-borderLight pb-1.5 mb-1.5 text-[10px]">
                    🛡️ Rekomendasi Pestisida
                </div>
                <p class="text-theme-textDark leading-relaxed">
                    {{ $detection->details['pestisida'] ?? 'Informasi rekomendasi solusi kimia/pestisida tidak tersedia.' }}
                </p>
            </div>

            <!-- Pola Penyiraman -->
            <div class="bg-theme-bgLight p-4 rounded-xl border border-theme-borderLight space-y-1.5 text-xs">
                <div class="font-bold text-theme-green uppercase tracking-wider flex items-center border-b border-theme-borderLight pb-1.5 mb-1.5 text-[10px]">
                    💧 Pola Penyiraman
                </div>
                <p class="text-theme-textDark leading-relaxed">
                    {{ $detection->details['penyiraman'] ?? 'Informasi penyiraman optimal tidak tersedia.' }}
                </p>
            </div>

            <!-- Langkah Pencegahan -->
            <div class="bg-theme-bgLight p-4 rounded-xl border border-theme-borderLight space-y-1.5 text-xs">
                <div class="font-bold text-theme-green uppercase tracking-wider flex items-center border-b border-theme-borderLight pb-1.5 mb-1.5 text-[10px]">
                    🍃 Langkah Pencegahan
                </div>
                <p class="text-theme-textDark leading-relaxed">
                    {{ $detection->details['pencegahan'] ?? 'Informasi langkah-langkah pencegahan preventif tidak tersedia.' }}
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
