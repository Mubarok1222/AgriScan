@extends('layouts.app')

@section('title', 'Deteksi Daun - AgriScan')
@section('breadcrumb', 'Deteksi')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div>
        <h1 class="text-3xl font-medium tracking-tight text-[#1F2937]">Deteksi Daun</h1>
        <p class="text-sm text-[#6B7280] mt-1">Periksa satu foto daun padi.</p>
    </div>

    <!-- Stepper Navigation (Figma Design) -->
    <div class="grid grid-cols-3 gap-3">
        <!-- Step 1 -->
        <div id="step-pill-1" class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#2D7A38] text-white">
            1 &bull; Foto Daun &rarr;
        </div>
        <!-- Step 2 -->
        <div id="step-pill-2" class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#EAF3EA] text-[#2D7A38]">
            2 &bull; Analisis &rarr;
        </div>
        <!-- Step 3 -->
        <div id="step-pill-3" class="py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#EAF3EA] text-[#2D7A38]">
            3 &bull; Hasil
        </div>
    </div>

    <!-- Main 2-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Form Unggah & Analisis -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-[#E5ECE5] p-6 sm:p-8 shadow-[0_2px_8px_rgba(0,0,0,0.02)]">
            <h3 class="text-base font-semibold text-[#1F2937] mb-6">Foto daun</h3>

            @if($errors->any())
                <div class="mb-6 rounded-xl bg-[#FEE2E2] border border-[#FCA5A5] p-4 flex items-start space-x-3 text-sm text-[#991B1B]">
                    <svg class="h-5 w-5 text-[#DC2626] shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <span class="font-semibold block">Gagal mengunggah foto</span>
                        <span class="text-xs text-[#7F1D1D] mt-0.5 block">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <!-- Form Upload Nyata -->
            <form id="form-deteksi" action="{{ route('deteksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden Input 1: Unggah File / Galeri -->
                <input 
                    type="file" 
                    id="foto_daun" 
                    name="foto_daun" 
                    accept="image/jpeg,image/png,image/jpg,image/webp" 
                    class="hidden" 
                    onchange="handleFileSelect(this)"
                >

                <!-- Hidden Input 2: Kamera Langsung (HP / Webcam) -->
                <input 
                    type="file" 
                    id="foto_kamera" 
                    accept="image/*" 
                    capture="environment" 
                    class="hidden" 
                    onchange="handleCameraSelect(this)"
                >

                <!-- 1. INITIAL UPLOAD DROPZONE (Ketika belum ada foto dipilih) -->
                <div id="dropzone-area" class="space-y-6">
                    <div 
                        id="dropzone-box"
                        onclick="document.getElementById('foto_daun').click()"
                        class="border-2 border-dashed border-[#D0DCD0] hover:border-[#2D7A38] rounded-2xl p-6 sm:p-10 text-center bg-[#FAFBF9] hover:bg-[#F4F8F4] cursor-pointer transition group"
                    >
                        <div class="w-14 h-14 rounded-2xl bg-white border border-[#E5ECE5] group-hover:border-[#2D7A38] flex items-center justify-center mx-auto mb-4 text-[#2D7A38] shadow-sm transition">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                        </div>
                        <h4 class="text-base font-semibold text-[#1F2937]">Tambahkan foto daun padi</h4>
                        <p class="text-xs sm:text-sm text-[#6B7280] mt-1 mb-6">Pilih file foto dari perangkat (laptop/HP) atau ambil langsung dengan kamera.</p>

                        <!-- Pilihan Dua Metode: Unggah File vs Buka Kamera -->
                        <div class="max-w-md mx-auto grid grid-cols-1 sm:grid-cols-2 gap-3" onclick="event.stopPropagation()">
                            <!-- Tombol 1: Unggah File / Galeri -->
                            <button 
                                type="button" 
                                onclick="document.getElementById('foto_daun').click()" 
                                class="w-full py-2.5 px-4 rounded-xl border border-[#2D7A38] bg-[#EAF3EA] hover:bg-[#D8EADB] text-xs sm:text-sm font-semibold text-[#183B1E] flex items-center justify-center space-x-2 transition shadow-xs cursor-pointer"
                            >
                                <svg class="h-4 w-4 text-[#2D7A38]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                    <circle cx="9" cy="9" r="2" />
                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                </svg>
                                <span>Unggah Gambar (File)</span>
                            </button>

                            <!-- Tombol 2: Ambil Foto Kamera Langsung -->
                            <button 
                                type="button" 
                                onclick="openLiveCamera()" 
                                class="w-full py-2.5 px-4 rounded-xl border border-[#D0DCD0] bg-white hover:bg-slate-50 text-xs sm:text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-2 transition shadow-xs cursor-pointer"
                            >
                                <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                    <circle cx="12" cy="13" r="3" />
                                </svg>
                                <span>Ambil Foto (Kamera)</span>
                            </button>
                        </div>

                        <p class="text-[11px] text-[#8B988B] mt-4">
                            Tips: Anda juga bisa menyeret langsung file gambar (Drag & Drop) ke kotak ini. Format JPG, PNG, WEBP maks 5 MB.
                        </p>
                    </div>

                    <!-- Disabled State Tombol Analisis -->
                    <button type="button" disabled class="w-full py-3.5 px-4 rounded-xl bg-[#DCE6DC] text-[#93A293] font-medium text-sm flex items-center justify-center space-x-2 cursor-not-allowed">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                        </svg>
                        <span>Analisis Foto</span>
                    </button>
                    <p class="text-xs text-[#6B7280]">Unggah atau ambil foto daun padi untuk melanjutkan analisis.</p>
                </div>

                <!-- 2. PREVIEW FOTO AREA (Ketika foto sudah dipilih) -->
                <div id="preview-area" class="hidden space-y-6">
                    <div class="rounded-2xl overflow-hidden border border-[#E5ECE5] bg-black/5">
                        <img id="img-preview-target" src="" alt="Preview Foto Padi" class="w-full h-72 sm:h-80 object-cover">
                    </div>

                    <div class="text-xs text-[#6B7280]">
                        Foto daun dipilih &bull; Tanaman: Padi
                    </div>

                    <!-- Pilihan Ganti Foto / Foto Ulang -->
                    <div class="grid grid-cols-2 gap-3">
                        <button 
                            type="button" 
                            onclick="document.getElementById('foto_daun').click()" 
                            class="py-2.5 px-3 rounded-xl border border-[#D0DCD0] bg-white hover:bg-slate-50 text-xs sm:text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-1.5 transition shadow-xs cursor-pointer"
                        >
                            <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                <circle cx="9" cy="9" r="2" />
                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                            </svg>
                            <span>Ganti File</span>
                        </button>

                        <button 
                            type="button" 
                            onclick="openLiveCamera()" 
                            class="py-2.5 px-3 rounded-xl border border-[#D0DCD0] bg-white hover:bg-slate-50 text-xs sm:text-sm font-medium text-[#1F2937] flex items-center justify-center space-x-1.5 transition shadow-xs cursor-pointer"
                        >
                            <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                            <span>Foto Ulang</span>
                        </button>
                    </div>

                    <p class="text-xs text-[#6B7280]">Ambil Foto tersedia jika perangkat mendukung kamera.</p>

                    <!-- Active Analisis Button -->
                    <button 
                        type="submit" 
                        onclick="showLoadingProcess()"
                        class="w-full py-3.5 px-4 rounded-xl bg-[#2D7A38] hover:bg-[#25682F] text-white font-medium text-sm flex items-center justify-center space-x-2 transition shadow-sm"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                        </svg>
                        <span>Analisis Foto</span>
                    </button>
                </div>

                <!-- 3. PROCESSING LOADING STATE (Saat formulir disubmit) -->
                <div id="analyzing-area" class="hidden space-y-6">
                    <div class="rounded-2xl overflow-hidden border border-[#E5ECE5] bg-black/5">
                        <img id="img-analyzing-target" src="" alt="Foto Padi Dianalisis" class="w-full h-64 sm:h-72 object-cover">
                    </div>

                    <div class="space-y-3 pt-2">
                        <div class="w-8 h-8 border-3 border-[#2D7A38] border-t-transparent rounded-full animate-spin"></div>
                        <h4 class="text-xl font-medium text-[#1F2937]">Foto daun sedang dianalisis</h4>
                        <p class="text-sm text-[#6B7280]">Menganalisis foto dan memprediksi kesehatan daun...</p>
                        <div class="text-xs text-[#6B7280] flex items-center space-x-2">
                            <span>Foto diunggah</span>
                            <span>&rarr;</span>
                            <span class="font-medium text-[#2D7A38]">Menganalisis</span>
                            <span>&rarr;</span>
                            <span>Hasil</span>
                        </div>
                    </div>

                    <div class="rounded-xl bg-[#EAF3EA] p-4 flex items-start space-x-3 text-xs">
                        <svg class="h-5 w-5 text-[#2D7A38] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="16" x2="12" y2="12" />
                            <line x1="12" y1="8" x2="12.01" y2="8" />
                        </svg>
                        <div>
                            <span class="font-semibold text-[#183B1E] block">Biarkan halaman ini terbuka</span>
                            <span class="text-[#3E5C3E] block mt-0.5">Hasil akan ditampilkan setelah proses selesai. Tidak perlu mengirim foto yang sama lagi.</span>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Right Column: Photography Guidance (Figma Design) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Guidelines Card -->
            <div class="bg-white rounded-2xl border border-[#E5ECE5] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.02)] space-y-5">
                <h3 class="text-base font-semibold text-[#1F2937]">Foto yang membantu</h3>

                <!-- Tip 1 -->
                <div class="flex items-start space-x-3.5">
                    <div class="p-2 rounded-xl bg-[#F4F7F4] text-[#2D7A38] shrink-0 mt-0.5">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2" />
                            <path d="M12 20v2" />
                            <path d="m4.93 4.93 1.41 1.41" />
                            <path d="m17.66 17.66 1.41 1.41" />
                            <path d="M2 12h2" />
                            <path d="M20 12h2" />
                            <path d="m6.34 17.66-1.41 1.41" />
                            <path d="m19.07 4.93-1.41 1.41" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-[#1F2937]">Cahaya cukup</h4>
                        <p class="text-xs text-[#6B7280] mt-0.5">Ambil foto di tempat terang.</p>
                    </div>
                </div>

                <!-- Tip 2 -->
                <div class="flex items-start space-x-3.5">
                    <div class="p-2 rounded-xl bg-[#F4F7F4] text-[#2D7A38] shrink-0 mt-0.5">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-[#1F2937]">Daun terlihat jelas</h4>
                        <p class="text-xs text-[#6B7280] mt-0.5">Fokus pada satu daun.</p>
                    </div>
                </div>

                <!-- Tip 3 -->
                <div class="flex items-start space-x-3.5">
                    <div class="p-2 rounded-xl bg-[#F4F7F4] text-[#2D7A38] shrink-0 mt-0.5">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                            <line x1="9" x2="15" y1="9" y2="15" />
                            <line x1="15" x2="9" y1="9" y2="15" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-[#1F2937]">Tidak buram</h4>
                        <p class="text-xs text-[#6B7280] mt-0.5">Pegang perangkat dengan stabil.</p>
                    </div>
                </div>
            </div>

            <!-- Disclaimer Card -->
            <div class="rounded-2xl bg-[#EAF3EA] p-5 flex items-start space-x-3.5">
                <div class="mt-0.5 text-[#2D7A38] shrink-0">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-[#183B1E]">Pengamatan awal</h4>
                    <p class="text-xs text-[#3E5C3E] mt-0.5 leading-relaxed">
                        Hasil model perlu dilihat bersama gejala tanaman dan pengamatan di lahan.
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal Live Camera Viewfinder (Laptop, PC, Tablet, HP) -->
<div id="camera-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl flex flex-col border border-[#E5ECE5] animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Header -->
        <div class="px-5 py-4 border-b border-[#E5ECE5] flex items-center justify-between bg-white">
            <div class="flex items-center space-x-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                <h3 class="text-sm sm:text-base font-semibold text-[#1F2937]">Kamera Perangkat</h3>
            </div>
            <button 
                type="button" 
                onclick="closeLiveCamera()" 
                class="p-1.5 rounded-xl text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition"
                aria-label="Tutup Kamera"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Video Stream & Viewfinder Target -->
        <div class="relative bg-black flex items-center justify-center w-full h-72 sm:h-84 overflow-hidden select-none">
            <video id="camera-stream" autoplay playsinline muted class="w-full h-full object-cover"></video>
            <canvas id="camera-canvas" class="hidden"></canvas>

            <!-- Guide Box for Rice Leaf -->
            <div class="absolute inset-6 border-2 border-dashed border-white/60 rounded-2xl pointer-events-none flex flex-col justify-between p-3">
                <div class="flex justify-between text-white/70 text-[10px]">
                    <span>[ SUDUT ATAS ]</span>
                    <span>[ SCANNER ]</span>
                </div>
                <div class="self-center text-center">
                    <span class="text-white text-xs px-3 py-1 rounded-full bg-black/50 backdrop-blur-xs border border-white/20">
                        Posisikan daun padi di area ini
                    </span>
                </div>
                <div class="flex justify-between text-white/70 text-[10px]">
                    <span>[ SUDUT BAWAH ]</span>
                    <span>[ AGRISCAN ]</span>
                </div>
            </div>
        </div>

        <!-- Camera Modal Bottom Controls -->
        <div class="p-4 sm:p-5 bg-slate-50 border-t border-[#E5ECE5] flex items-center justify-between">
            <!-- Tombol Ganti Kamera (Depan/Belakang) -->
            <button 
                type="button" 
                onclick="switchCameraFacing()" 
                id="btn-switch-cam"
                class="py-2 px-3 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-xs font-medium text-gray-700 flex items-center space-x-1.5 transition shadow-xs cursor-pointer"
                title="Ganti Kamera Depan/Belakang"
            >
                <svg class="h-4 w-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                </svg>
                <span class="hidden sm:inline">Ganti</span>
            </button>

            <!-- Shutter Capture Button -->
            <button 
                type="button" 
                onclick="snapPhotoFromCamera()" 
                class="h-14 w-14 rounded-full bg-[#2D7A38] hover:bg-[#25682F] text-white flex items-center justify-center shadow-lg shadow-green-900/30 ring-4 ring-green-100 active:scale-90 transition cursor-pointer"
                title="Jepret Foto"
            >
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <circle cx="12" cy="13" r="3" />
                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                </svg>
            </button>

            <!-- Batal Button -->
            <button 
                type="button" 
                onclick="closeLiveCamera()" 
                class="py-2 px-3 rounded-xl text-xs font-medium text-gray-600 hover:text-gray-900 transition"
            >
                Batal
            </button>
        </div>
    </div>
</div>

<script>
    let currentStream = null;
    let currentFacingMode = 'environment'; // Default kamera belakang pada HP

    async function startCameraStream() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }

        const video = document.getElementById('camera-stream');

        try {
            // Coba buka kamera sesuai facingMode (misal kamera belakang)
            currentStream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: currentFacingMode,
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                },
                audio: false
            });
        } catch (err) {
            // Fallback: Jika facingMode environment gagal (seperti webcam laptop biasa), buka kamera apapun yang ada
            try {
                currentStream = await navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                });
            } catch (fallbackErr) {
                console.error("Gagal membuka kamera:", fallbackErr);
                alert("Tidak dapat mengakses kamera perangkat. Pastikan izin kamera telah diizinkan (Allow) di browser Anda, atau gunakan tombol 'Unggah Gambar (File)'.");
                closeLiveCamera();
                return;
            }
        }

        if (video && currentStream) {
            video.srcObject = currentStream;
            video.play();
        }
    }

    function openLiveCamera() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert("Browser atau perangkat ini tidak mendukung akses kamera langsung. Silakan gunakan opsi 'Unggah Gambar (File)'.");
            return;
        }

        const modal = document.getElementById('camera-modal');
        modal.classList.remove('hidden');
        startCameraStream();
    }

    function closeLiveCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }
        const video = document.getElementById('camera-stream');
        if (video) {
            video.srcObject = null;
        }
        const modal = document.getElementById('camera-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function switchCameraFacing() {
        currentFacingMode = (currentFacingMode === 'environment') ? 'user' : 'environment';
        startCameraStream();
    }

    function snapPhotoFromCamera() {
        const video = document.getElementById('camera-stream');
        const canvas = document.getElementById('camera-canvas');
        if (!video || !canvas) return;

        const width = video.videoWidth || 640;
        const height = video.videoHeight || 480;
        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, width, height);

        canvas.toBlob(function(blob) {
            if (!blob) return;

            const file = new File([blob], "foto_daun_kamera_" + Date.now() + ".jpg", { type: "image/jpeg" });

            // Masukkan file hasil tangkapan kamera ke input form utama (foto_daun)
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('foto_daun').files = dataTransfer.files;

            // Matikan kamera dan tampilkan foto yang dijepret di layar preview
            closeLiveCamera();
            displayImagePreview(file);
        }, 'image/jpeg', 0.92);
    }

    function displayImagePreview(file) {
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img-preview-target').src = e.target.result;
            document.getElementById('img-analyzing-target').src = e.target.result;
            document.getElementById('dropzone-area').classList.add('hidden');
            document.getElementById('preview-area').classList.remove('hidden');

            // Update stepper step 2
            document.getElementById('step-pill-1').className = 'py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#EAF3EA] text-[#2D7A38]';
            document.getElementById('step-pill-2').className = 'py-2.5 px-4 rounded-xl text-center text-xs sm:text-sm font-medium transition bg-[#2D7A38] text-white';
        };
        reader.readAsDataURL(file);
    }

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            displayImagePreview(input.files[0]);
        }
    }

    function showLoadingProcess() {
        document.getElementById('preview-area').classList.add('hidden');
        document.getElementById('analyzing-area').classList.remove('hidden');
    }

    // Dukungan Drag and Drop
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = document.getElementById('dropzone-box');
        if (!dropzone) return;

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('border-[#2D7A38]', 'bg-[#EAF3EA]');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('border-[#2D7A38]', 'bg-[#EAF3EA]');
            }, false);
        });

        dropzone.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length > 0) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                document.getElementById('foto_daun').files = dataTransfer.files;
                displayImagePreview(files[0]);
            }
        }, false);
    });
</script>
@endsection
