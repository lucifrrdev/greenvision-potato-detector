@extends('layouts.app')

@section('title', 'Daftar Akun - Greenvision')

@section('content')
<div class="py-20 bg-theme-bgLight border-b border-theme-borderLight text-left">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-3xl p-8 border border-theme-borderLight shadow-lg space-y-6">
            <div class="text-center space-y-2">
                <span class="tp-section-title-pre">Join Us</span>
                <h1 class="text-2xl font-bold text-theme-blue">
                    Daftar Akun Baru
                </h1>
                <p class="text-theme-textMuted text-xs">
                    Gabung untuk menyimpan riwayat analisis kesehatan daun kentang Anda.
                </p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-theme-textDark mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-theme-textDark mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-theme-textDark mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-theme-textDark mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                </div>

                <!-- Submit -->
                <button type="submit" class="tp-btn w-full font-bold py-3.5 mt-2">
                    Daftar Akun
                </button>
            </form>

            <div class="text-center text-xs text-theme-textMuted pt-4 border-t border-theme-borderLight">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="text-theme-green hover:underline font-bold">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
