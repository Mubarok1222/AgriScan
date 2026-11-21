@extends('layouts.app')

@section('title', 'Beranda - AgriScan')
@section('breadcrumb', 'Beranda')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Selamat pagi, {{ Auth::user()->nama_lengkap }}</h1>
            <p class="text-sm text-[#6B7280] mt-1">Mari lihat catatan pemeriksaan daun Anda.</p>
        </div>
    </div>

    <!-- Green Call-To-Action Banner -->
    <div class="bg-[#183B1E] rounded-2xl p-6 sm:p-7 text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
        <div>
            <h2 class="text-xl sm:text-2xl font-medium tracking-tight">Bagaimana kondisi daun hari ini?</h2>
            <p class="text-white/80 text-sm mt-1">Unggah satu foto daun padi, lalu lihat hasil prediksi.</p>
        </div>
        <a 
            href="{{ route('deteksi') }}" 
            class="px-5 py-3 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-sm font-medium flex items-center space-x-2 transition shadow-sm shrink-0"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
            </svg>
            <span>Deteksi Daun</span>
        </a>
    </div>

    @if($totalPemeriksaan > 0)
        <!-- Periode Filter Dropdown -->
        <div>
            <label class="block text-xs font-medium text-[#4B5563] mb-1.5">Periode</label>
            <form method="GET" action="{{ route('dashboard') }}" class="relative w-full max-w-xs">
                <select name="periode" onchange="this.form.submit()" class="w-full appearance-none bg-white border border-[#D0DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1F2937] focus:outline-none focus:border-[#2D7A38] focus:ring-1 focus:ring-[#2D7A38]">
                    <option value="2026-10" {{ $periode === '2026-10' ? 'selected' : '' }}>Oktober 2026</option>
                    <option value="2026-11" {{ $periode === '2026-11' ? 'selected' : '' }}>November 2026</option>
                    <option value="all" {{ $periode === 'all' ? 'selected' : '' }}>Semua Periode</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-[#6B7280]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </form>
        </div>

        <!-- 4 Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Pemeriksaan -->
            <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                    <span class="w-1 h-3.5 rounded-full bg-[#2D7A38]"></span>
                    <span>Total pemeriksaan</span>
                </div>
                <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ $totalPemeriksaan }}</div>
                <div class="text-xs text-[#6B7280] mt-1">Foto diperiksa</div>
            </div>

            <!-- Sehat -->
            <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                    <span class="w-1 h-3.5 rounded-full bg-[#2D7A38]"></span>
                    <span>Sehat</span>
                </div>
                <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ $totalSehat }}</div>
                <div class="text-xs text-[#6B7280] mt-1">Foto diperiksa</div>
            </div>

            <!-- Dugaan Penyakit -->
            <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                    <span class="w-1 h-3.5 rounded-full bg-[#D97706]"></span>
                    <span>Dugaan penyakit</span>
                </div>
                <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ $totalDugaan }}</div>
                <div class="text-xs text-[#6B7280] mt-1">Foto diperiksa</div>
            </div>

            <!-- Belum Meyakinkan -->
            <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
                <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                    <span class="w-1 h-3.5 rounded-full bg-[#9CA3AF]"></span>
                    <span>Belum meyakinkan</span>
                </div>
                <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ $totalTidakMeyakinkan }}</div>
                <div class="text-xs text-[#6B7280] mt-1">Foto diperiksa</div>
            </div>
        </div>

        <!-- 2 Chart Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Tren Pemeriksaan (Bar Chart) -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                <div>
                    <h3 class="text-base font-semibold text-[#1F2937]">Tren pemeriksaan</h3>
                    <p class="text-xs text-[#6B7280] mt-0.5">Jumlah foto &bull; Periode {{ $periode === 'all' ? 'Semua' : $periode }}</p>
                </div>

                <!-- Custom Bar Visualisation -->
                <div class="my-8 flex items-end justify-center space-x-6 sm:space-x-10 h-44 pt-6">
                    <!-- Bar 1 -->
                    <div class="flex flex-col items-center">
                        <span class="text-xs font-medium text-[#1F2937] mb-2">{{ $tren1 }}</span>
                        <div class="w-16 sm:w-20 bg-[#2D7A38] rounded-xl transition hover:bg-[#25682F]" style="height: {{ max(16, min(140, $tren1 * 25)) }}px"></div>
                        <span class="text-xs text-[#6B7280] mt-3">1–3 Okt</span>
                    </div>
                    <!-- Bar 2 -->
                    <div class="flex flex-col items-center">
                        <span class="text-xs font-medium text-[#1F2937] mb-2">{{ $tren2 }}</span>
                        <div class="w-16 sm:w-20 bg-[#2D7A38] rounded-xl transition hover:bg-[#25682F]" style="height: {{ max(16, min(140, $tren2 * 25)) }}px"></div>
                        <span class="text-xs text-[#6B7280] mt-3">4–6 Okt</span>
                    </div>
                    <!-- Bar 3 -->
                    <div class="flex flex-col items-center">
                        <span class="text-xs font-medium text-[#1F2937] mb-2">{{ $tren3 }}</span>
                        <div class="w-16 sm:w-20 bg-[#2D7A38] rounded-xl transition hover:bg-[#25682F]" style="height: {{ max(16, min(140, $tren3 * 25)) }}px"></div>
                        <span class="text-xs text-[#6B7280] mt-3">7–9 Okt</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#EEF2EE] text-xs text-[#6B7280]">
                    Total {{ $totalPemeriksaan }} foto pada periode ini.
                </div>
            </div>

            <!-- Proporsi Sampel (Donut Chart) -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col justify-between">
                <div>
                    <h3 class="text-base font-semibold text-[#1F2937]">Proporsi Sampel Terdeteksi Sehat</h3>
                </div>

                <div class="my-6 flex flex-col sm:flex-row items-center justify-around gap-6">
                    <!-- Donut SVG -->
                    <div class="relative w-40 h-40 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <!-- Background Circle -->
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#E5E7EB" stroke-width="12" />
                            <!-- Dugaan Penyakit -->
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#D97706" stroke-width="12" stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * ($totalDugaan / max(1, $totalPemeriksaan))) }}" />
                            <!-- Sehat -->
                            <circle cx="50" cy="50" r="40" fill="transparent" stroke="#2D7A38" stroke-width="12" stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * ($totalSehat / max(1, $totalPemeriksaan))) }}" stroke-linecap="round" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-bold text-[#1F2937]">{{ number_format($persenSehat, 1, ',', '.') }}%</span>
                        </div>
                    </div>

                    <!-- Right Info & Legend -->
                    <div class="space-y-4">
                        <div>
                            <div class="text-base font-semibold text-[#1F2937]">{{ $totalSehat }} dari {{ $totalValid }} hasil valid</div>
                            <div class="text-xs text-[#6B7280]">{{ $periode === 'all' ? 'Semua Periode' : 'Oktober 2026' }}</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between w-48">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-[#2D7A38]"></span>
                                    <span class="text-[#4B5563]">Sehat</span>
                                </div>
                                <span class="font-medium text-[#1F2937]">{{ $totalSehat }} foto</span>
                            </div>
                            <div class="flex items-center justify-between w-48">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-[#D97706]"></span>
                                    <span class="text-[#4B5563]">Dugaan penyakit</span>
                                </div>
                                <span class="font-medium text-[#1F2937]">{{ $totalDugaan }} foto</span>
                            </div>
                            <div class="flex items-center justify-between w-48">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-[#9CA3AF]"></span>
                                    <span class="text-[#4B5563]">Belum meyakinkan</span>
                                </div>
                                <span class="font-medium text-[#1F2937]">{{ $totalTidakMeyakinkan }} foto</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-xs text-transparent select-none">-</div>
            </div>
        </div>

        <!-- Info Box Banner -->
        <div class="rounded-2xl bg-[#EAF3EA] p-4 sm:p-5 flex items-start space-x-3.5">
            <div class="mt-0.5 text-[#2D7A38] shrink-0">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="16" x2="12" y2="12" />
                    <line x1="12" y1="8" x2="12.01" y2="8" />
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-[#183B1E]">Ringkasan dari foto yang diperiksa</h4>
                <p class="text-xs text-[#3E5C3E] mt-0.5 leading-relaxed">
                    Angka ini hanya berasal dari foto yang diperiksa, bukan kondisi seluruh luas lahan.
                </p>
            </div>
        </div>

        <!-- Pemeriksaan Terbaru Table Card -->
        <div class="bg-white rounded-2xl border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="p-6 border-b border-[#EEF2EE]">
                <h3 class="text-base font-semibold text-[#1F2937]">Pemeriksaan terbaru</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#FAFBF9] text-[#6B7280] text-xs font-medium border-b border-[#EEF2EE]">
                        <tr>
                            <th class="py-3 px-6">Foto</th>
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-6">Tanaman</th>
                            <th class="py-3 px-6">Hasil</th>
                            <th class="py-3 px-6">Status</th>
                            <th class="py-3 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EEF2EE] text-[#1F2937]">
                        @forelse($pemeriksaanTerbaru as $item)
                            <tr class="hover:bg-[#F9FAF9] transition">
                                <td class="py-4 px-6">
                                    <img src="{{ $item->foto_url }}" alt="Foto Daun" class="w-12 h-12 rounded-xl object-cover border border-[#E5ECE5]">
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-medium">{{ $item->tanggal_deteksi->format('j M Y') }}</div>
                                    <div class="text-xs text-[#6B7280]">{{ $item->tanggal_deteksi->format('H.i') }}</div>
                                </td>
                                <td class="py-4 px-6 font-medium">Padi</td>
                                <td class="py-4 px-6">
                                    @if($item->status_hasil === 'Sehat')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#EAF3EA] text-[#2D7A38]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#2D7A38] mr-1.5"></span>
                                            Sehat
                                        </span>
                                        <div class="text-xs text-[#6B7280] mt-1">Skor: {{ number_format($item->skor_akurasi, 0) }}%</div>
                                    @elseif($item->status_hasil === 'Dugaan Penyakit')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEF3C7] text-[#92400E]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#D97706] mr-1.5"></span>
                                            Dugaan penyakit
                                        </span>
                                        <div class="text-xs text-[#6B7280] mt-1">Skor: {{ number_format($item->skor_akurasi, 0) }}%</div>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F3F4F6] text-[#4B5563]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#9CA3AF] mr-1.5"></span>
                                            Belum meyakinkan
                                        </span>
                                        <div class="text-xs text-[#6B7280] mt-1">Skor: Tidak tersedia</div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#EAF3EA] text-[#2D7A38]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#2D7A38] mr-1.5"></span>
                                        Tersimpan
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('detail', $item->id_deteksi) }}" class="inline-flex items-center space-x-1 text-xs font-medium text-[#2D7A38] hover:underline">
                                        <span>Lihat Detail</span>
                                        <span>&rarr;</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sm text-[#6B7280]">
                                    Belum ada data pemeriksaan pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Button: Lihat Riwayat -->
            <div class="p-6 border-t border-[#EEF2EE]">
                <a 
                    href="{{ route('riwayat') }}" 
                    class="w-full py-3 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-[#F3F6F3] text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-2 transition"
                >
                    <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 14 14" />
                        <path d="M3.05 11a9 9 0 0 1 .5-2" />
                    </svg>
                    <span>Lihat Riwayat</span>
                </a>
            </div>
        </div>

    @else
        <!-- Empty State jika belum ada riwayat sama sekali -->
        <div class="bg-white rounded-3xl border border-[#E5ECE5] p-12 text-center max-w-xl mx-auto shadow-sm my-12">
            <div class="w-16 h-16 rounded-full bg-[#EAF3EA] flex items-center justify-center mx-auto mb-4 text-[#2D7A38]">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 22v-7" />
                    <path d="M9 15c0-4 3-7 7-7 0 4-3 7-7 7z" />
                    <path d="M9 15c0-2-1.5-3.5-3.5-3.5-2 0-3.5 1.5-3.5 3.5 0 2 1.5 3.5 3.5 3.5H9" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#1F2937]">Mulai pemeriksaan pertama</h3>
            <p class="text-sm text-[#6B7280] mt-2 mb-6 max-w-md mx-auto leading-relaxed">
                Tambahkan foto daun untuk melihat ringkasan. Ringkasan hanya dari foto yang diperiksa, bukan seluruh luas lahan.
            </p>
            <a 
                href="{{ route('deteksi') }}" 
                class="inline-flex items-center space-x-2 px-6 py-3 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-sm font-medium transition shadow-sm"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                    <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                    <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                    <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                </svg>
                <span>Deteksi Daun</span>
            </a>
        </div>
    @endif

</div>
@endsection
