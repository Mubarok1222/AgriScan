@extends('layouts.app')

@section('title', 'Hasil Pemeriksaan Daun - AgriScan')
@section('breadcrumb', 'Deteksi / Hasil')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Hasil pemeriksaan daun</h1>
            <p class="text-sm text-[#6B7280] mt-1">Gunakan hasil ini sebagai pengamatan awal.</p>
        </div>
    </div>

    <!-- Stepper Navigation (Step 3 Active) -->
    <div class="grid grid-cols-3 gap-3">
        <a href="{{ route('deteksi') }}" class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#EAF3EA] text-[#2D7A38] hover:bg-[#E2EDE2]">
            1 &bull; Foto Daun &rarr;
        </a>
        <a href="{{ route('deteksi') }}" class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#EAF3EA] text-[#2D7A38] hover:bg-[#E2EDE2]">
            2 &bull; Analisis &rarr;
        </a>
        <div class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium bg-[#2D7A38] text-white">
            3 &bull; Hasil
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Photo Card & Saved Status -->
        <div class="lg:col-span-5 space-y-4">
            <!-- Leaf Photo Card -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-5 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-4">
                <div class="rounded-xl overflow-hidden border border-[#E5ECE5] bg-slate-100">
                    <img src="{{ $deteksi->foto_url }}" alt="Foto Daun Diperiksa" class="w-full h-80 object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[#1F2937]">Padi</h3>
                    <p class="text-xs text-[#6B7280] mt-0.5">{{ $deteksi->tanggal_deteksi->format('j M Y • H.i') }}</p>
                    <p class="text-xs text-[#9CA3AF] mt-2">Foto yang diperiksa</p>
                </div>
            </div>

            <!-- Saved Alert Banner (Figma Design) -->
            <div class="rounded-2xl bg-[#EAF3EA] p-4 flex items-start space-x-3 text-xs">
                <svg class="h-5 w-5 text-[#2D7A38] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <div>
                    <span class="font-semibold text-[#183B1E] block">Tersimpan di Riwayat</span>
                    <span class="text-[#3E5C3E] block mt-0.5">Foto, hasil, dan rekomendasi sudah tersimpan di akun Anda.</span>
                </div>
            </div>
        </div>

        <!-- Right Column: AI Results & Next Steps -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Card 1: Hasil Prediksi -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-6 sm:p-7 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-4">
                <h3 class="text-base font-semibold text-[#1F2937]">Hasil Prediksi</h3>

                <!-- Badge Status -->
                <div>
                    @if($deteksi->status_hasil === 'Sehat')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#EAF3EA] text-[#2D7A38]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2D7A38] mr-1.5"></span>
                            <span>Sehat</span>
                        </span>
                    @elseif($deteksi->status_hasil === 'Dugaan Penyakit')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#FEF3C7] text-[#92400E]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#D97706] mr-1.5"></span>
                            <span>Dugaan penyakit</span>
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#F3F4F6] text-[#4B5563]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#9CA3AF] mr-1.5"></span>
                            <span>Belum meyakinkan</span>
                        </span>
                    @endif
                </div>

                <!-- Main Result Title & Explanation -->
                <div class="space-y-2 pt-1">
                    @if($deteksi->status_hasil === 'Sehat')
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            Pada foto ini, model tidak menemukan dugaan gejala penyakit.
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            Kondisi daun tampak normal dan sehat. Tetap amati kondisi tanaman secara berkala untuk menjaga kualitas panen.
                        </p>
                    @elseif($deteksi->status_hasil === 'Dugaan Penyakit')
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            {{ $deteksi->penyakit ? $deteksi->penyakit->nama_penyakit : 'Dugaan gejala penyakit terdeteksi' }}
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            {{ $deteksi->penyakit ? $deteksi->penyakit->deskripsi : 'Model menemukan dugaan gejala pada foto ini. Hasil ini membantu pengamatan awal sebelum pemeriksaan penyuluh.' }}
                        </p>
                    @else
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            Model belum dapat memberikan hasil yang meyakinkan dari foto ini.
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            Foto daun kurang fokus, pencahayaan kurang terang, atau objek daun terpotong. Silakan ambil ulang foto yang lebih jelas.
                        </p>
                    @endif
                </div>

                <!-- Confidence Score Box -->
                <div class="pt-4 border-t border-[#EEF2EE]">
                    <div class="text-xs text-[#6B7280]">Skor Keyakinan Model</div>
                    <div class="text-4xl font-bold text-[#1F2937] tracking-tight mt-1 mb-2">
                        @if($deteksi->skor_akurasi)
                            {{ number_format($deteksi->skor_akurasi, 0) }}%
                        @else
                            Tidak tersedia
                        @endif
                    </div>
                    <p class="text-xs text-[#6B7280] leading-relaxed">
                        Skor adalah keyakinan model pada hasil prediksi, bukan akurasi atau kepastian diagnosis mutlak.
                    </p>
                </div>
            </div>

            <!-- Card 2: Langkah Berikutnya & Rekomendasi Penanganan -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-6 sm:p-7 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-4">
                <h3 class="text-base font-semibold text-[#1F2937]">Langkah berikutnya</h3>

                <ul class="space-y-3.5 text-xs sm:text-sm text-[#374151]">
                    @if($deteksi->penyakit && $deteksi->penyakit->saran_penanganan)
                        @foreach(explode("\n", $deteksi->penyakit->saran_penanganan) as $saran)
                            @if(trim($saran) !== '')
                                <li class="flex items-start space-x-3">
                                    <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <polyline points="22 4 12 14.01 9 11.01" />
                                        </svg>
                                    </div>
                                    <span class="leading-relaxed">{{ trim($saran) }}</span>
                                </li>
                            @endif
                        @endforeach
                    @elseif($deteksi->status_hasil === 'Sehat')
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Lanjutkan pemupukan berimbang sesuai fase pertumbuhan tanaman.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Amati berkala kondisi petak sawah saat pergantian cuaca.</span>
                        </li>
                    @else
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Ambil ulang foto dengan cahaya cukup dan fokus yang jelas.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Pastikan daun padi berada di bagian tengah frame dan tidak blur.</span>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Action Buttons Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a 
                    href="{{ route('deteksi') }}" 
                    class="py-3 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white font-medium text-sm flex items-center justify-center space-x-2 transition shadow-sm"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                        <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                        <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                        <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                    </svg>
                    <span>{{ $deteksi->status_hasil === 'Tidak Meyakinkan' ? 'Ambil Ulang Foto' : 'Deteksi Lagi' }}</span>
                </a>

                <a 
                    href="{{ route('riwayat') }}" 
                    class="py-3 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-[#F3F6F3] text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-2 transition shadow-xs"
                >
                    <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 14 14" />
                        <path d="M3.05 11a9 9 0 0 1 .5-2" />
                    </svg>
                    <span>Lihat Riwayat</span>
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
