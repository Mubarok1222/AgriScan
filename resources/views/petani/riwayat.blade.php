@extends('layouts.app')

@section('title', 'Riwayat Pemeriksaan - AgriScan')
@section('breadcrumb', 'Riwayat')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Riwayat pemeriksaan</h1>
            <p class="text-sm text-[#6B7280] mt-1">Lihat kembali foto dan hasil yang sudah tersimpan.</p>
        </div>
    </div>

    <!-- Periode Filter Dropdown -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <form method="GET" action="{{ route('riwayat') }}" class="flex items-center space-x-3 w-full sm:w-auto">
            <div>
                <label class="block text-xs font-medium text-[#4B5563] mb-1">Periode</label>
                <div class="relative w-44">
                    <select name="periode" onchange="this.form.submit()" class="w-full appearance-none bg-white border border-[#D0DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1F2937] focus:outline-none focus:border-[#2D7A38]">
                        <option value="2026-10" {{ $periode === '2026-10' ? 'selected' : '' }}>Oktober 2026</option>
                        <option value="2026-11" {{ $periode === '2026-11' ? 'selected' : '' }}>November 2026</option>
                        <option value="all" {{ $periode === 'all' ? 'selected' : '' }}>Semua periode</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#6B7280]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#4B5563] mb-1">Status Hasil</label>
                <div class="relative w-44">
                    <select name="status" onchange="this.form.submit()" class="w-full appearance-none bg-white border border-[#D0DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1F2937] focus:outline-none focus:border-[#2D7A38]">
                        <option value="">Semua Status</option>
                        <option value="Sehat" {{ request('status') === 'Sehat' ? 'selected' : '' }}>Sehat</option>
                        <option value="Dugaan Penyakit" {{ request('status') === 'Dugaan Penyakit' ? 'selected' : '' }}>Dugaan Penyakit</option>
                        <option value="Tidak Meyakinkan" {{ request('status') === 'Tidak Meyakinkan' ? 'selected' : '' }}>Tidak Meyakinkan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#6B7280]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </form>

        <a 
            href="{{ route('deteksi') }}" 
            class="px-4 py-2.5 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium flex items-center space-x-1.5 transition shadow-sm"
        >
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            <span>Pemeriksaan Baru</span>
        </a>
    </div>

    <!-- Riwayat Table Card -->
    <div class="bg-white rounded-2xl border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] overflow-hidden">
        <div class="p-6 border-b border-[#EEF2EE]">
            <h3 class="text-base font-semibold text-[#1F2937]">Catatan pemeriksaan</h3>
            <p class="text-xs text-[#6B7280] mt-0.5">
                Menampilkan {{ $riwayatList->firstItem() ?? 0 }} - {{ $riwayatList->lastItem() ?? 0 }} dari {{ $riwayatList->total() }} pemeriksaan
            </p>
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
                    @forelse($riwayatList as $item)
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
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-12 h-12 rounded-full bg-[#EAF3EA] flex items-center justify-center mx-auto mb-3 text-[#2D7A38]">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </div>
                                <h4 class="text-base font-medium text-[#1F2937]">Tidak ada riwayat ditemukan</h4>
                                <p class="text-xs text-[#6B7280] mt-1">
                                    Belum ada catatan pemeriksaan sesuai filter yang dipilih.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar (Figma Design) -->
        @if($riwayatList->hasPages())
            <div class="p-6 border-t border-[#EEF2EE] space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if($riwayatList->onFirstPage())
                        <button type="button" disabled class="py-3 px-4 rounded-xl bg-[#EAF3EA] text-[#8B988B] font-medium text-sm flex items-center justify-center space-x-2 cursor-not-allowed">
                            <span>&larr;</span>
                            <span>Sebelumnya</span>
                        </button>
                    @else
                        <a href="{{ $riwayatList->previousPageUrl() }}" class="py-3 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-[#F3F6F3] text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-2 transition shadow-xs">
                            <span>&larr;</span>
                            <span>Sebelumnya</span>
                        </a>
                    @endif

                    @if($riwayatList->hasMorePages())
                        <a href="{{ $riwayatList->nextPageUrl() }}" class="py-3 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-[#F3F6F3] text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-2 transition shadow-xs">
                            <span>Berikutnya</span>
                            <span>&rarr;</span>
                        </a>
                    @else
                        <button type="button" disabled class="py-3 px-4 rounded-xl bg-[#EAF3EA] text-[#8B988B] font-medium text-sm flex items-center justify-center space-x-2 cursor-not-allowed">
                            <span>Berikutnya</span>
                            <span>&rarr;</span>
                        </button>
                    @endif
                </div>
                <div class="text-center text-xs text-[#6B7280]">
                    Halaman {{ $riwayatList->currentPage() }} dari {{ $riwayatList->lastPage() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Footer Info Banner -->
    <div class="rounded-2xl bg-[#EAF3EA] p-5 flex items-start space-x-3.5">
        <div class="mt-0.5 text-[#2D7A38] shrink-0">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="16" x2="12" y2="12" />
                <line x1="12" y1="8" x2="12.01" y2="8" />
            </svg>
        </div>
        <div>
            <h4 class="text-sm font-semibold text-[#183B1E]">Catatan untuk pengamatan</h4>
            <p class="text-xs text-[#3E5C3E] mt-0.5 leading-relaxed">
                Hasil prediksi bukan diagnosis pasti. Gunakan catatan ini saat berdiskusi dengan penyuluh.
            </p>
        </div>
    </div>

</div>
@endsection
