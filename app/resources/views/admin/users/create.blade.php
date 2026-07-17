@extends('layouts.admin')

@section('title', 'Tambah Pengguna - Greenvision')

@section('content')
<!-- Header -->
<div class="flex items-center space-x-2 mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-theme-green hover:underline font-semibold flex items-center">
        ← Kembali ke Kelola User
    </a>
</div>

<div class="bg-white border border-theme-borderLight rounded-xl shadow-sm overflow-hidden max-w-3xl">
    <div class="px-6 py-5 border-b border-theme-borderLight bg-gray-50/50">
        <h1 class="text-xl font-bold text-theme-blue">Tambah Pengguna Baru</h1>
        <p class="text-xs text-theme-textMuted mt-1">Buat akun user baru atau admin baru di sistem.</p>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-sm font-bold text-theme-textDark mb-2">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 rounded-lg border @error('name') border-red-500 @else border-theme-borderLight @enderror focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-bold text-theme-textDark mb-2">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email aktif" class="w-full px-4 py-2.5 rounded-lg border @error('email') border-red-500 @else border-theme-borderLight @enderror focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-bold text-theme-textDark mb-2">Peran (Role)</label>
            <select id="role" name="role" class="w-full px-4 py-2.5 rounded-lg border @error('role') border-red-500 @else border-theme-borderLight @enderror focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm bg-white">
                <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>USER (Pengguna Biasa)</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>ADMIN (Administrator)</option>
            </select>
            @error('role')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kata Sandi -->
        <div>
            <label for="password" class="block text-sm font-bold text-theme-textDark mb-2">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" class="w-full px-4 py-2.5 rounded-lg border @error('password') border-red-500 @else border-theme-borderLight @enderror focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-theme-textDark mb-2">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" class="w-full px-4 py-2.5 rounded-lg border border-theme-borderLight focus:outline-none focus:ring-2 focus:ring-theme-green focus:border-transparent text-sm">
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t border-theme-borderLight">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-theme-textDark font-bold rounded-lg text-sm transition-colors">
                Batal
            </a>
            <button type="submit" class="tp-btn py-2.5 px-6 text-sm">
                Simpan Pengguna
            </button>
        </div>
    </form>
</div>
@endsection
