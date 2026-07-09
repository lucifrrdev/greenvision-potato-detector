@extends('layouts.app')

@section('title', 'Profil Akun - Greenvision')

@section('content')
<div class="py-20 bg-theme-bgLight border-b border-theme-borderLight text-left">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Profile Info / Stats Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-theme-borderLight shadow-sm text-center space-y-4">
                <div class="w-20 h-20 bg-theme-green/10 text-theme-green rounded-full flex items-center justify-center text-3xl mx-auto shadow-inner">
                    👤
                </div>
                <div>
                    <h3 class="text-xl font-bold text-theme-blue">{{ $user->name }}</h3>
                    <p class="text-theme-textMuted text-xs mt-0.5">{{ $user->email }}</p>
                </div>
                <div class="text-[0.75rem] text-theme-textMuted pt-2 border-t border-theme-borderLight">
                    Anggota sejak: {{ $user->created_at->translatedFormat('d F Y') }}
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-theme-borderLight shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs text-theme-textMuted font-bold uppercase tracking-wider">Total Deteksi Anda</span>
                    <h2 class="text-4xl font-extrabold text-theme-green">{{ $totalDetections }}</h2>
                </div>
                <div class="text-3xl text-theme-borderLight"><i class="fa-solid fa-seedling"></i></div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-borderLight shadow-sm space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-theme-blue">
                        Pengaturan Profil
                    </h2>
                    <p class="text-theme-textMuted text-sm mt-0.5">
                        Perbarui informasi akun dan kata sandi Anda.
                    </p>
                </div>

                <form action="{{ route('profile') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-theme-textDark mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-theme-textDark mb-1.5">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-theme-borderLight my-4 pt-4">
                        <h3 class="text-sm font-bold text-theme-blue uppercase tracking-wider mb-1">Ubah Kata Sandi (Opsional)</h3>
                        <p class="text-theme-textMuted text-xs">Biarkan kosong jika Anda tidak ingin mengubah kata sandi.</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-theme-textDark mb-1.5">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password"
                               class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-theme-textDark mb-1.5">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full bg-theme-bgLight border border-theme-borderLight rounded-xl px-4 py-3 text-theme-textDark placeholder-slate-400 focus:outline-none focus:border-theme-green transition-all">
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="tp-btn w-full font-bold mt-4 py-3.5">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
