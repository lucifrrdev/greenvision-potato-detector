@extends('layouts.app')

@section('title', 'Masuk - Greenvision')

@section('content')
<div class="py-20 bg-theme-bgLight border-b border-theme-borderLight text-left">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-3xl p-8 border border-theme-borderLight shadow-lg space-y-6">
            <div class="text-center space-y-2">
                <span class="tp-section-title-pre">Secure Access</span>
                <h1 class="text-2xl font-bold text-theme-blue">
                    Masuk ke Greenvision
                </h1>
                <p class="text-theme-textMuted text-xs">
                    Pantau kesehatan tanaman kentang Anda dengan mudah.
                </p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-theme-textDark mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
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

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-theme-borderLight text-theme-green focus:ring-theme-green focus:ring-2">
                    <label for="remember" class="ml-2 block text-xs font-bold text-theme-textMuted select-none">Ingat saya</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="tp-btn w-full font-bold py-3.5 mt-2">
                    Masuk
                </button>
            </form>

            <div class="text-center text-xs text-theme-textMuted pt-4 border-t border-theme-borderLight">
                Belum punya akun? <a href="{{ route('register') }}" class="text-theme-green hover:underline font-bold">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
