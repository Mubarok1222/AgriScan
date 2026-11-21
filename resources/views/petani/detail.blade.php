@extends('layouts.app')

@section('title', 'Detail Pemeriksaan - AgriScan')
@section('breadcrumb', 'Riwayat / Detail Pemeriksaan')

@section('content')
<div class="space-y-6">

    <!-- Top Return Button (Figma Design) -->
    <a 
        href="{{ route('riwayat') }}" 
        class="w-full py-3.5 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-[#F3F6F3] text-sm font-medium text-[#2D7A38] flex items-center justify-center space-x-2 transition shadow-xs"
    >
        <span>&larr;</span>
        <span>Kembali ke Riwayat</span>
    </a>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Detail Pemeriksaan</h1>
            <p class="text-sm text-[#6B7280] mt-1">Catatan yang tersimpan dari pemeriksaan daun.</p>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Image & Saved Status -->
        <div class="lg:col-span-5 space-y-4">
            <!-- Leaf Photo Card -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-5 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-4">
                <div class="rounded-xl overflow-hidden border border-[#E5ECE5] bg-slate-100">
                    <img src="{{ $deteksi->foto_url }}" alt="Foto Daun Padi" class="w-full h-80 object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[#1F2937]">Padi</h3>
                    <p class="text-xs text-[#6B7280] mt-0.5">{{ $deteksi->tanggal_deteksi->format('j M Y • H.i') }}</p>
                    <p class="text-xs text-[#9CA3AF] mt-2">Foto yang diperiksa</p>
                </div>
            </div>

            <!-- Saved Alert Banner -->
            <div class="rounded-2xl bg-[#EAF3EA] p-4 flex items-start space-x-3 text-xs">
                <svg class="h-5 w-5 text-[#2D7A38] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <div>
                    <span class="font-semibold text-[#183B1E] block">Tersimpan di Riwayat</span>
                    <span class="text-[#3E5C3E] block mt-0.5">Catatan ini tersimpan aman di database akun Anda.</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Results & Recommendation -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Card 1: Hasil Prediksi -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-6 sm:p-7 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-4">
                <h3 class="text-base font-semibold text-[#1F2937]">Hasil Prediksi</h3>

                <!-- Badge -->
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

                <!-- Main Prediction -->
                <div class="space-y-2 pt-1">
                    @if($deteksi->status_hasil === 'Sehat')
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            Daun padi terdeteksi dalam kondisi sehat.
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            Tidak ditemukan bercak atau gejala nekrosis yang mengindikasikan infeksi jamur atau bakteri.
                        </p>
                    @elseif($deteksi->status_hasil === 'Dugaan Penyakit')
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            {{ $deteksi->penyakit ? $deteksi->penyakit->nama_penyakit : 'Dugaan Penyakit Padi' }}
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            {{ $deteksi->penyakit ? $deteksi->penyakit->deskripsi : 'Model menemukan dugaan gejala pada foto daun ini.' }}
                        </p>
                    @else
                        <h2 class="text-xl font-semibold text-[#1F2937] leading-snug">
                            Hasil belum dapat dipastikan secara meyakinkan.
                        </h2>
                        <p class="text-sm text-[#4B5563] leading-relaxed">
                            Kualitas foto tidak memenuhi standar kejernihan atau sudut pandang yang optimal.
                        </p>
                    @endif
                </div>

                <!-- Confidence Score -->
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

            <!-- Card 2: Langkah Berikutnya -->
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
                    @else
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Amati daun lain untuk membandingkan kondisi.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Catat gejala dan perubahan yang Anda lihat di lahan.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div class="p-0.5 rounded-full text-[#2D7A38] shrink-0 mt-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <span>Konfirmasi dengan penyuluh lapangan jika ada gejala meragukan.</span>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Action Buttons -->
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
                    <span>Deteksi Baru</span>
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
