@extends('layouts.admin')

@section('title', 'Kelola User - Greenvision')

@section('content')
<!-- Admin Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-theme-borderLight pb-5 mb-8 gap-4">
    <div>
        <span class="tp-section-title-pre">🛡️ PENGATURAN HAK AKSES</span>
        <h1 class="text-3xl font-extrabold text-theme-blue">Kelola Pengguna</h1>
    </div>
</div>

@if(session('error'))
    <div class="mb-6">
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-lg flex items-center justify-between shadow-sm">
            <span class="text-sm font-semibold">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-rose-800 hover:text-rose-950 font-bold">&times;</button>
        </div>
    </div>
@endif

<!-- Filter & Search Panel -->
<div class="bg-white rounded-xl border border-theme-borderLight shadow-sm p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4">
        
        <!-- Form Pencarian -->
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex-grow max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau role..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-theme-borderLight focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
                <span class="absolute left-3 top-3.5 text-gray-400">
                    🔍
                </span>
                @if($search)
                    <a href="{{ route('admin.users.index') }}" class="absolute right-3 top-3 text-sm text-gray-400 hover:text-theme-textDark">Clear</a>
                @endif
            </div>
        </form>

        <!-- Tambah User Baru -->
        <div class="flex-shrink-0">
            <a href="{{ route('admin.users.create') }}" class="tp-btn py-2.5 px-5 text-sm inline-flex items-center">
                ➕ Tambah Pengguna Baru
            </a>
        </div>
    </div>
</div>

<!-- Tabel Daftar User -->
<div class="bg-white border border-theme-borderLight rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-theme-borderLight">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Peran (Role)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-theme-textMuted uppercase tracking-wider">Tanggal Dibuat</th>
                    <th scope="col" class="px-6 py-3 class-right text-xs font-semibold text-theme-textMuted uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-theme-borderLight">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-theme-bgLight flex items-center justify-center font-bold text-theme-green mr-3">
                                    👤
                                </div>
                                <div class="text-sm font-bold text-theme-textDark">
                                    {{ $user->name }}
                                    @if(auth()->id() === $user->id)
                                        <span class="ml-2 text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-normal">Anda</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-textDark">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-textMuted">
                            {{ $user->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1.5 bg-amber-50 text-amber-700 hover:bg-amber-100 rounded-md transition-colors text-xs font-bold">
                                    ✏️ Edit
                                </a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini beserta semua riwayat scan-nya? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 hover:bg-rose-100 rounded-md transition-colors text-xs font-bold">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-theme-textMuted text-sm">
                            Tidak ada data pengguna ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Link -->
    @if($users->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-theme-borderLight">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
