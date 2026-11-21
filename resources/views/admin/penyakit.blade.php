@extends('layouts.app')

@section('title', 'Kelola Penyakit - AgriScan Admin')
@section('breadcrumb', 'Admin / Kelola Penyakit')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Kelola Penyakit Tanaman</h1>
            <p class="text-sm text-[#6B7280] mt-1">Pustaka referensi penyakit, gejala daun padi, dan parameter kelas model AI.</p>
        </div>
        <div>
            <button 
                type="button" 
                onclick="openTambahModal()" 
                class="px-5 py-3 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-sm font-medium flex items-center space-x-2 transition shadow-sm"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span>Tambah Penyakit</span>
            </button>
        </div>
    </div>

    <!-- 3 Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
            <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                <span class="w-1 h-3.5 rounded-full bg-[#2D7A38]"></span>
                <span>Total database penyakit</span>
            </div>
            <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ $totalPenyakit }}</div>
            <div class="text-xs text-[#6B7280] mt-1">Terdaftar di sistem</div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
            <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                <span class="w-1 h-3.5 rounded-full bg-[#2D7A38]"></span>
                <span>Kelas AI Terverifikasi</span>
            </div>
            <div class="text-3xl font-medium text-[#1F2937] mt-3">{{ min(4, $totalPenyakit) }}</div>
            <div class="text-xs text-[#6B7280] mt-1">Dikenali model klasifikasi</div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
            <div class="flex items-center space-x-2 text-xs font-medium text-[#4B5563]">
                <span class="w-1 h-3.5 rounded-full bg-[#D97706]"></span>
                <span>Total Kasus Terdeteksi</span>
            </div>
            <div class="text-3xl font-medium text-[#1F2937] mt-3">
                {{ $penyakitList->sum('riwayat_deteksi_count') }}
            </div>
            <div class="text-xs text-[#6B7280] mt-1">Laporan dari riwayat petani</div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-2xl p-4 border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.penyakit') }}" class="relative w-full sm:w-96">
            <input 
                type="text" 
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari penyakit atau gejala daun..." 
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[#D0DCD0] focus:border-[#2D7A38] focus:ring-1 focus:ring-[#2D7A38] text-sm text-[#1F2937] placeholder-[#9CA3AF] transition outline-none"
            >
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#9CA3AF]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </div>
        </form>

        @if(request('q'))
            <a href="{{ route('admin.penyakit') }}" class="text-xs text-[#DC2626] hover:underline font-medium">
                Reset Pencarian
            </a>
        @endif
    </div>

    <!-- Diseases Table -->
    <div class="bg-white rounded-2xl border border-[#E5ECE5] shadow-[0_2px_8px_rgba(0,0,0,0.02)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#FAFBF9] text-[#6B7280] text-xs font-medium border-b border-[#EEF2EE]">
                    <tr>
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Nama Penyakit</th>
                        <th class="py-3 px-6">Deskripsi & Gejala</th>
                        <th class="py-3 px-6">Saran Penanganan</th>
                        <th class="py-3 px-6">Kasus</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EEF2EE] text-[#1F2937]">
                    @forelse($penyakitList as $item)
                        <tr class="hover:bg-[#F9FAF9] transition">
                            <td class="py-4 px-6 font-mono text-xs text-[#6B7280]">
                                PYK-{{ str_pad($item->id_penyakit, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-[#1F2937]">{{ $item->nama_penyakit }}</div>
                            </td>
                            <td class="py-4 px-6 text-xs text-[#4B5563] max-w-xs leading-relaxed">
                                <p class="line-clamp-2">{{ $item->deskripsi }}</p>
                            </td>
                            <td class="py-4 px-6 text-xs text-[#4B5563] max-w-xs leading-relaxed">
                                <p class="line-clamp-2">{{ $item->saran_penanganan }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#EAF3EA] text-[#2D7A38]">
                                    {{ $item->riwayat_deteksi_count }} kali
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap space-x-2">
                                <button 
                                    type="button" 
                                    onclick="openEditModal({{ $item->id_penyakit }}, '{{ addslashes($item->nama_penyakit) }}', '{{ addslashes($item->deskripsi) }}', '{{ addslashes($item->saran_penanganan) }}')" 
                                    class="text-xs font-medium text-[#2D7A38] hover:underline"
                                >
                                    Edit
                                </button>
                                <span class="text-[#D0DCD0]">&bull;</span>
                                <form action="{{ route('admin.penyakit.destroy', $item->id_penyakit) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penyakit ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-[#DC2626] hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-sm text-[#6B7280]">
                                Belum ada data penyakit yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penyakitList->hasPages())
            <div class="p-4 border-t border-[#EEF2EE]">
                {{ $penyakitList->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Tambah Penyakit -->
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-[#E5ECE5] space-y-5">
        <div class="flex items-center justify-between pb-3 border-b border-[#EEF2EE]">
            <h3 class="text-lg font-semibold text-[#1F2937]">Tambah Penyakit Baru</h3>
            <button type="button" onclick="closeTambahModal()" class="text-[#9CA3AF] hover:text-[#4B5563]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.penyakit.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Nama Penyakit</label>
                <input type="text" name="nama_penyakit" placeholder="Contoh: Hawar Daun Bakteri (Kresek)" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]">
            </div>

            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Deskripsi & Gejala Daun</label>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsikan patogen penyebab dan bentuk gejala bercak daun..." required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]"></textarea>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Saran Penanganan</label>
                <textarea name="saran_penanganan" rows="3" placeholder="Langkah mitigasi, pemupukan, fungisida/bakterisida yang disarankan..." required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]"></textarea>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-[#EEF2EE]">
                <button type="button" onclick="closeTambahModal()" class="py-2.5 px-4 rounded-xl border border-[#D0DCD0] text-xs font-medium text-[#374151] hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="py-2.5 px-5 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium shadow-sm">
                    Simpan Penyakit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Penyakit -->
<div id="modal-edit" class="hidden fixed inset-0 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-[#E5ECE5] space-y-5">
        <div class="flex items-center justify-between pb-3 border-b border-[#EEF2EE]">
            <h3 class="text-lg font-semibold text-[#1F2937]">Edit Data Penyakit</h3>
            <button type="button" onclick="closeEditModal()" class="text-[#9CA3AF] hover:text-[#4B5563]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <form id="form-edit" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Nama Penyakit</label>
                <input type="text" id="edit-nama" name="nama_penyakit" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]">
            </div>

            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Deskripsi & Gejala Daun</label>
                <textarea id="edit-deskripsi" name="deskripsi" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]"></textarea>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#374151] mb-1">Saran Penanganan</label>
                <textarea id="edit-saran" name="saran_penanganan" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-[#D0DCD0] text-sm outline-none focus:border-[#2D7A38]"></textarea>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-[#EEF2EE]">
                <button type="button" onclick="closeEditModal()" class="py-2.5 px-4 rounded-xl border border-[#D0DCD0] text-xs font-medium text-[#374151] hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="py-2.5 px-5 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white text-xs font-medium shadow-sm">
                    Perbarui Penyakit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTambahModal() {
        document.getElementById('modal-tambah').classList.remove('hidden');
    }
    function closeTambahModal() {
        document.getElementById('modal-tambah').classList.add('hidden');
    }

    function openEditModal(id, nama, deskripsi, saran) {
        document.getElementById('form-edit').action = '/admin/penyakit/' + id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-deskripsi').value = deskripsi;
        document.getElementById('edit-saran').value = saran;
        document.getElementById('modal-edit').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('modal-edit').classList.add('hidden');
    }
</script>
@endsection
