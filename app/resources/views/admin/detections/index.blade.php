@extends('layouts.admin')

@section('title', 'Kelola Hasil Scan - Greenvision')

@section('content')
<!-- Admin Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-theme-borderLight pb-5 mb-8 gap-4">
    <div>
        <span class="tp-section-title-pre">🔍 RIWAYAT DETEKSI</span>
        <h1 class="text-3xl font-extrabold text-theme-blue">Kelola Hasil Scan</h1>
    </div>
</div>

<!-- Filter & Search Panel -->
<div class="bg-white rounded-xl border border-theme-borderLight shadow-sm p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4">
        
        <!-- Form Pencarian -->
        <form action="{{ route('admin.detections.index') }}" method="GET" class="flex-grow">
            <div class="relative flex flex-col md:flex-row gap-3">
                <div class="relative flex-grow">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama penyakit, nama user, atau email..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-theme-borderLight focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
                    <span class="absolute left-3 top-3.5 text-gray-400">
                        🔍
                    </span>
                </div>
                <div class="flex-shrink-0 flex gap-2">
                    <button type="submit" class="tp-btn py-2 px-5 text-sm">
                        Filter
                    </button>
                    @if($search)
                        <a href="{{ route('admin.detections.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-theme-textDark font-bold rounded-lg text-sm transition-colors flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Daftar Detections -->
<div class="bg-white border border-theme-borderLight rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-theme-borderLight">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Gambar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Hasil Klasifikasi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Pengguna</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Kepercayaan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Tanggal & Waktu</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-theme-borderLight">
                @forelse($detections as $det)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ asset('predictions/' . $det->image_name) }}" target="_blank" class="block flex-shrink-0 h-12 w-12 group relative">
                                <img class="h-12 w-12 rounded-lg object-cover border border-theme-borderLight group-hover:opacity-75 transition-opacity" src="{{ asset('predictions/' . $det->image_name) }}" alt="Daun">
                                <span class="absolute inset-0 bg-black/40 text-[10px] text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">🔍 Zoom</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-theme-textDark">
                                {{ $det->disease_name }}
                            </div>
                            <div class="text-xs text-theme-textMuted max-w-xs truncate">
                                {{ $det->image_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-theme-textDark font-semibold">
                                {{ $det->user ? $det->user->name : 'Guest/Deleted' }}
                            </div>
                            <div class="text-xs text-theme-textMuted">
                                {{ $det->user ? $det->user->email : '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-emerald-50 text-emerald-800">
                                {{ number_format($det->confidence * 100, 2) }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-textMuted">
                            {{ $det->created_at->format('d M Y, H:i') }}
                            <span class="block text-xs font-normal text-gray-400">({{ $det->created_at->diffForHumans() }})</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('history.detail', $det->id) }}" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-md transition-colors text-xs font-bold">
                                    👁️ Detail
                                </a>
                                <form action="{{ route('admin.detections.destroy', $det->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat diagnosis ini secara permanen dari server?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 hover:bg-rose-100 rounded-md transition-colors text-xs font-bold">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-theme-textMuted text-sm">
                            Tidak ada data hasil scan ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Link -->
    @if($detections->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-theme-borderLight">
            {{ $detections->links() }}
        </div>
    @endif
</div>
@endsection
