@extends('layouts.auth')

@section('title', 'Daftar Akun - AgriScan')

@section('content')
<div>
    <!-- Header -->
    <h2 class="text-3xl font-medium text-[#1F2937] tracking-tight">Buat akun AgriScan</h2>
    <p class="text-sm text-[#6B7280] mt-1.5 mb-5">Simpan pemeriksaan daun dalam satu tempat.</p>

    <!-- Form Registrasi Asli -->
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama Lengkap Input -->
        <div>
            <label for="nama_lengkap" class="block text-sm font-medium text-[#374151] mb-1">Nama Lengkap</label>
            <input 
                type="text" 
                id="nama_lengkap" 
                name="nama_lengkap" 
                placeholder="Masukkan nama lengkap Anda" 
                value="{{ old('nama_lengkap') }}"
                required
                class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('nama_lengkap') ? 'border-[#DC2626] bg-[#FEF2F2]' : 'border-[#D0DCD0]' }} focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
            >
            @error('nama_lengkap')
                <p class="text-xs text-[#DC2626] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Input -->
        <div>
            <label for="email" class="block text-sm font-medium text-[#374151] mb-1">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Masukkan email Anda" 
                value="{{ old('email') }}"
                required
                class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-[#DC2626] bg-[#FEF2F2]' : 'border-[#D0DCD0]' }} focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
            >
            @error('email')
                <p class="text-xs text-[#DC2626] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div>
            <label for="reg-password" class="block text-sm font-medium text-[#374151] mb-1">Kata sandi</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="reg-password" 
                    name="password" 
                    placeholder="Minimal 6 karakter" 
                    required
                    class="w-full px-4 py-2.5 pr-11 rounded-xl border {{ $errors->has('password') ? 'border-[#DC2626] bg-[#FEF2F2]' : 'border-[#D0DCD0]' }} focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
                >
                <button type="button" onclick="toggleRegPassword('reg-password')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9CA3AF] hover:text-[#4B5563]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-xs text-[#DC2626] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Input -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-[#374151] mb-1">Konfirmasi kata sandi</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi kata sandi" 
                    required
                    class="w-full px-4 py-2.5 pr-11 rounded-xl border border-[#D0DCD0] focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
                >
                <button type="button" onclick="toggleRegPassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9CA3AF] hover:text-[#4B5563]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Checkbox: Tampilkan Sandi -->
        <div class="flex items-center">
            <input 
                id="reg-show-password" 
                type="checkbox" 
                onchange="toggleAllPasswords(this)" 
                class="h-4 w-4 rounded border-[#D0DCD0] text-[#2D7A38] focus:ring-[#2D7A38]"
            >
            <label for="reg-show-password" class="ml-2 block text-xs sm:text-sm text-[#4B5563]">
                Tampilkan sandi
            </label>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full py-3.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#23632D] text-white font-medium text-sm flex items-center justify-center space-x-2 transition shadow-sm"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="8.5" cy="7" r="4" />
                <line x1="20" y1="8" x2="20" y2="14" />
                <line x1="23" y1="11" x2="17" y2="11" />
            </svg>
            <span>Daftar</span>
        </button>
    </form>

    <!-- Login Link -->
    <p class="text-sm text-[#4B5563] mt-4">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="font-medium text-[#2D7A38] hover:underline">Masuk</a>
    </p>

    <!-- Info Box -->
    <div class="mt-6 rounded-2xl bg-[#EAF3EA] p-4 flex items-start space-x-3">
        <div class="mt-0.5 text-[#2D7A38] shrink-0">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="16" x2="12" y2="12" />
                <line x1="12" y1="8" x2="12.01" y2="8" />
            </svg>
        </div>
        <div>
            <h4 class="text-xs font-semibold text-[#183B1E]">Foto Anda, catatan Anda</h4>
            <p class="text-xs text-[#3E5C3E] mt-0.5 leading-relaxed">
                Pemeriksaan tersimpan membantu Anda membandingkan pengamatan berikutnya.
            </p>
        </div>
    </div>
</div>

<script>
    function toggleRegPassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function toggleAllPasswords(checkbox) {
        document.getElementById('reg-password').type = checkbox.checked ? 'text' : 'password';
        document.getElementById('password_confirmation').type = checkbox.checked ? 'text' : 'password';
    }
</script>
@endsection
