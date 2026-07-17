@extends('layouts.admin')

@section('title', 'Admin Dashboard - Greenvision')

@section('content')
<!-- Admin Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-theme-borderLight pb-5 mb-8 gap-4">
    <div>
        <span class="tp-section-title-pre">📊 RINGKASAN SISTEM</span>
        <h1 class="text-3xl font-extrabold text-theme-blue">Dashboard Analisis</h1>
    </div>
</div>

<!-- Statistik KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <!-- Total Pengguna -->
    <div class="bg-white rounded-xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Total Pengguna</p>
            <h3 class="text-2xl font-bold text-theme-blue mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-theme-green flex items-center justify-center text-xl font-bold">
            👥
        </div>
    </div>

    <!-- Total Scan -->
    <div class="bg-white rounded-xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Total Scan</p>
            <h3 class="text-2xl font-bold text-theme-blue mt-1">{{ $totalDetections }}</h3>
        </div>
        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-theme-green flex items-center justify-center text-xl font-bold">
            📸
        </div>
    </div>

    <!-- Sehat -->
    <div class="bg-white rounded-xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Daun Sehat</p>
            <h3 class="text-2xl font-bold text-emerald-600 mt-1">{{ $healthyCount }}</h3>
        </div>
        <div class="w-12 h-12 rounded-lg bg-emerald-100/50 text-emerald-600 flex items-center justify-center text-xl font-bold">
            🍃
        </div>
    </div>

    <!-- Early Blight -->
    <div class="bg-white rounded-xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Early Blight</p>
            <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $earlyBlightCount }}</h3>
        </div>
        <div class="w-12 h-12 rounded-lg bg-amber-100/50 text-amber-600 flex items-center justify-center text-xl font-bold">
            🍂
        </div>
    </div>

    <!-- Late Blight -->
    <div class="bg-white rounded-xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Late Blight</p>
            <h3 class="text-2xl font-bold text-rose-600 mt-1">{{ $lateBlightCount }}</h3>
        </div>
        <div class="w-12 h-12 rounded-lg bg-rose-100/50 text-rose-600 flex items-center justify-center text-xl font-bold">
            🥀
        </div>
    </div>
</div>

<!-- Recent Tables -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Scan Terakhir (2/3 width) -->
    <div class="lg:col-span-2 bg-white border border-theme-borderLight rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-theme-borderLight flex justify-between items-center bg-gray-50/50">
            <h2 class="font-bold text-theme-blue">Scan Diagnosis Terakhir</h2>
            <a href="{{ route('admin.detections.index') }}" class="text-xs font-bold text-theme-green hover:underline">Lihat Semua</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-theme-borderLight">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Gambar & Hasil</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Confidence</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-theme-borderLight">
                    @forelse($recentDetections as $det)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-lg object-cover border border-theme-borderLight" src="{{ asset('predictions/' . $det->image_name) }}" alt="Daun">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-theme-textDark">
                                            {{ $det->disease_name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-theme-textDark">{{ $det->user ? $det->user->name : 'Guest/Deleted' }}</div>
                                <div class="text-xs text-theme-textMuted">{{ $det->user ? $det->user->email : '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-emerald-50 text-emerald-800">
                                    {{ number_format($det->confidence * 100, 2) }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-textMuted">
                                {{ $det->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-theme-textMuted text-sm">
                                Belum ada riwayat scan diagnosis.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Terakhir (1/3 width) -->
    <div class="bg-white border border-theme-borderLight rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-theme-borderLight flex justify-between items-center bg-gray-50/50">
            <h2 class="font-bold text-theme-blue">User Baru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-theme-green hover:underline">Lihat Semua</a>
        </div>
        
        <ul class="divide-y divide-theme-borderLight">
            @forelse($recentUsers as $usr)
                <li class="p-6 flex justify-between items-center hover:bg-gray-50/30 transition-colors">
                    <div>
                        <h4 class="text-sm font-bold text-theme-textDark truncate w-32">{{ $usr->name }}</h4>
                        <p class="text-xs text-theme-textMuted truncate w-32">{{ $usr->email }}</p>
                        <span class="px-2 py-0.5 mt-1 inline-flex text-[10px] leading-4 font-bold rounded-full {{ $usr->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ strtoupper($usr->role) }}
                        </span>
                    </div>
                    <div class="text-xs text-theme-textMuted font-medium">
                        {{ $usr->created_at->format('d/m/Y') }}
                    </div>
                </li>
            @empty
                <li class="p-6 text-center text-theme-textMuted text-sm">
                    Belum ada user terdaftar.
                </li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
