@extends('layouts.auth')

@section('title', 'Masuk - AgriScan')

@section('content')
<div>
    <!-- Flash Success Notification -->
    @if(session('success'))
        <div class="mb-5 rounded-xl bg-[#EAF3EA] border border-[#C2DEC2] p-4 flex items-center space-x-3 text-sm text-[#183B1E]">
            <svg class="h-5 w-5 text-[#2D7A38] shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <h2 class="text-3xl font-medium text-[#1F2937] tracking-tight">Selamat datang kembali</h2>
    <p class="text-sm text-[#6B7280] mt-1.5 mb-6">Masuk untuk melihat pemeriksaan tanaman Anda.</p>

    <!-- Error Alert jika login gagal -->
    @if($errors->any())
        <div class="mb-6 rounded-xl bg-[#FEE2E2] border border-[#FCA5A5] p-4 flex items-start space-x-3 text-sm text-[#991B1B]">
            <svg class="h-5 w-5 text-[#DC2626] shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <div>
                <span class="font-semibold block">Belum berhasil masuk</span>
                <span class="text-xs text-[#7F1D1D] mt-0.5 block">
                    {{ $errors->first('email') ?: 'Email atau kata sandi tidak sesuai. Periksa kembali dan coba lagi.' }}
                </span>
            </div>
        </div>
    @endif

    <!-- Form Login Asli -->
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email Input -->
        <div>
            <label for="email" class="block text-sm font-medium text-[#374151] mb-1.5">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Masukkan email Anda" 
                value="{{ old('email') }}"
                required
                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-[#DC2626] bg-[#FEF2F2]' : 'border-[#D0DCD0]' }} focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
            >
            @error('email')
                <p class="text-xs text-[#DC2626] mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div>
            <label for="password" class="block text-sm font-medium text-[#374151] mb-1.5">Kata sandi</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan kata sandi" 
                    required
                    class="w-full px-4 py-3 pr-11 rounded-xl border {{ $errors->has('password') ? 'border-[#DC2626] bg-[#FEF2F2]' : 'border-[#D0DCD0]' }} focus:border-[#2D7A38] focus:ring-2 focus:ring-[#2D7A38]/20 text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
                >
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9CA3AF] hover:text-[#4B5563]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-xs text-[#DC2626] mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <!-- Checkbox: Tampilkan Sandi & Ingat Saya -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input 
                    id="show-password" 
                    type="checkbox" 
                    onchange="togglePasswordVisibilityFromCheckbox(this)" 
                    class="h-4 w-4 rounded border-[#D0DCD0] text-[#2D7A38] focus:ring-[#2D7A38]"
                >
                <label for="show-password" class="ml-2 block text-xs sm:text-sm text-[#4B5563]">
                    Tampilkan sandi
                </label>
            </div>
            <div class="flex items-center">
                <input 
                    id="remember" 
                    name="remember"
                    type="checkbox" 
                    class="h-4 w-4 rounded border-[#D0DCD0] text-[#2D7A38] focus:ring-[#2D7A38]"
                >
                <label for="remember" class="ml-2 block text-xs sm:text-sm text-[#4B5563]">
                    Ingat saya
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full py-3.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#23632D] text-white font-medium text-sm flex items-center justify-center space-x-2 transition shadow-sm"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                <polyline points="10 17 15 12 10 7" />
                <line x1="15" y1="12" x2="3" y2="12" />
            </svg>
            <span>Masuk</span>
        </button>
    </form>

    <!-- Register Link -->
    <p class="text-sm text-[#4B5563] mt-5">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-medium text-[#2D7A38] hover:underline">Daftar</a>
    </p>

    <!-- Info Box (Bottom) -->
    <div class="mt-8 rounded-2xl bg-[#EAF3EA] p-4 flex items-start space-x-3">
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
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        document.getElementById('show-password').checked = isPassword;
    }

    function togglePasswordVisibilityFromCheckbox(checkbox) {
        document.getElementById('password').type = checkbox.checked ? 'text' : 'password';
    }
</script>
@endsection
