<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgriScan - Sistem Deteksi Penyakit Daun Padi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAF8] text-[#1F2937] font-sans antialiased min-h-screen py-12 px-4 sm:px-8">
    <div class="max-w-6xl mx-auto space-y-10">
        
        <!-- Header & Brand Presentation -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center space-x-3 mb-2">
                <div class="h-12 w-12 rounded-2xl bg-[#2D7A38] flex items-center justify-center text-white shadow-md">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22v-7" />
                        <path d="M9 15c0-4 3-7 7-7 0 4-3 7-7 7z" />
                        <path d="M9 15c0-2-1.5-3.5-3.5-3.5-2 0-3.5 1.5-3.5 3.5 0 2 1.5 3.5 3.5 3.5H9" />
                    </svg>
                </div>
                <span class="text-3xl font-bold tracking-tight text-[#183B1E]">AgriScan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-[#1F2937]">Hasil Implementasi Desain UI Figma</h1>
            <p class="text-base text-[#6B7280] max-w-2xl mx-auto">
                Semua screenshot desain di folder <code class="text-xs bg-[#EAF3EA] text-[#2D7A38] px-2 py-1 rounded font-mono">resources/figma_images</code> telah dianalisis, dikelompokkan, dan dibuatkan view Blade dengan Tailwind CSS.
            </p>
        </div>

        <!-- Cards Navigation Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card 1: Login -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Autentikasi</span>
                        <span class="text-xs text-[#9CA3AF]">Masuk.png</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Halaman Masuk (Login)</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Tampilan split panel dua sisi dengan kartu info AgriScan dan formulir input email, password (toggle intip), serta validasi error.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Halaman Login</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 2: Register -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Autentikasi</span>
                        <span class="text-xs text-[#9CA3AF]">Daftar.png</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Halaman Daftar (Register)</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Form pendaftaran akun petani dengan field nama, email, password, dan konfirmasi kata sandi.
                    </p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Halaman Daftar</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 3: Dashboard Petani -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Ruang Petani</span>
                        <span class="text-xs text-[#9CA3AF]">Dashboard.png</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Dashboard Petani</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Banner ajakan scan daun, 4 kartu ringkasan, bar chart tren pemeriksaan, donut chart proporsi sehat (72,7%), dan tabel pemeriksaan terbaru.
                    </p>
                </div>
                <a href="{{ route('dashboard') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Dashboard</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 4: Form Unggah & Deteksi -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Deteksi</span>
                        <span class="text-xs text-[#9CA3AF]">Deteksi / Unggah / Preview</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Form Unggah & Scan Daun</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Alur 3 langkah stepper, dropzone unggah foto, preview daun terpilih, animasi proses analisis, panduan foto, dan state error format.
                    </p>
                </div>
                <a href="{{ route('deteksi') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Form Deteksi</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 5: Hasil Pemeriksaan -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Hasil</span>
                        <span class="text-xs text-[#9CA3AF]">Hasil / Dugaan / Sehat / Belum</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Hasil Pemeriksaan Daun</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Hasil skor keyakinan model (82% dugaan penyakit, 94% sehat, belum meyakinkan), rekomendasi tindakan lanjut, dan status tersimpan di riwayat.
                    </p>
                </div>
                <a href="{{ route('hasil') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Hasil Pemeriksaan</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 6: Riwayat Deteksi -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Riwayat</span>
                        <span class="text-xs text-[#9CA3AF]">Riwayat.png</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Riwayat Pemeriksaan</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Tabel riwayat dengan filter periode Oktober 2026, status tersimpan, paginasi tombol sebelumnya/berikutnya, dan state riwayat kosong.
                    </p>
                </div>
                <a href="{{ route('riwayat') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Riwayat Pemeriksaan</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 7: Detail Pemeriksaan -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Detail</span>
                        <span class="text-xs text-[#9CA3AF]">Detail Pemeriksaan.png</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Detail Pemeriksaan</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Halaman inspeksi satu rekaman pemeriksaan spesifik dengan tombol "Kembali ke Riwayat" dan daftar langkah penanganan.
                    </p>
                </div>
                <a href="{{ route('detail', 1) }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Detail Pemeriksaan</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Card 8: Kelola Penyakit Admin -->
            <div class="bg-white rounded-3xl border border-[#E5ECE5] p-6 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#2D7A38] bg-[#EAF3EA] px-2.5 py-1 rounded-full">Ruang Admin</span>
                        <span class="text-xs text-[#9CA3AF]">Kelola Penyakit</span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F2937] mb-1.5">Kelola Penyakit Admin</h3>
                    <p class="text-xs text-[#6B7280] leading-relaxed mb-4">
                        Pustaka database penyakit padi (Hawar daun kresek, blas, bercak coklat, tungro), indikator keparahan, status AI, dan modal tambah penyakit baru.
                    </p>
                </div>
                <a href="{{ route('admin.penyakit') }}" class="w-full py-2.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium text-center transition flex items-center justify-center space-x-1.5">
                    <span>Buka Kelola Penyakit</span>
                    <span>&rarr;</span>
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div class="text-center pt-8 border-t border-[#EEF2EE] text-xs text-[#6B7280]">
            Agriscan &bull; Laravel 11 &bull; Tailwind CSS v4 &bull; Sesuai Desain Figma Desktop 1440px
        </div>

    </div>
</body>
</html>
