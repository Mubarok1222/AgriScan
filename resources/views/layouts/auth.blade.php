<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AgriScan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAF8] text-[#1F2937] font-sans antialiased min-h-screen flex items-center justify-center p-4 sm:p-8">
    <div class="w-full max-w-6xl min-h-[720px] bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-[#E5EAE5] p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        
        <!-- Left Side: AgriScan Info Panel (Figma Design) -->
        <div class="lg:col-span-5 bg-[#EAF3EA] rounded-2xl p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
            <!-- Brand Logo -->
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 rounded-xl bg-[#2D7A38] flex items-center justify-center text-white shadow-sm">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22v-7" />
                        <path d="M9 15c0-4 3-7 7-7 0 4-3 7-7 7z" />
                        <path d="M9 15c0-2-1.5-3.5-3.5-3.5-2 0-3.5 1.5-3.5 3.5 0 2 1.5 3.5 3.5 3.5H9" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-[#183B1E]">AgriScan</span>
            </div>

            <!-- Main Taglines -->
            <div class="my-8">
                <h1 class="text-3xl sm:text-4xl font-medium tracking-tight text-[#1F2937] leading-[1.2]">
                    Kenali kondisi daun.<br>
                    Rawat tanaman lebih<br>
                    baik.
                </h1>
                <p class="mt-4 text-[#4B5563] text-sm sm:text-base leading-relaxed">
                    Pendamping sederhana untuk memeriksa foto daun padi.
                </p>
            </div>

            <!-- Stylized Leaf Illustration -->
            <div class="my-4 flex items-center justify-center">
                <svg class="w-48 h-48 sm:w-56 sm:h-56 drop-shadow-sm" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Main Leaf Body -->
                    <path d="M45 135 C 30 75, 115 25, 165 40 C 175 95, 130 165, 75 160 C 58 158, 48 148, 45 135 Z" fill="#2D7A38" />
                    <!-- Stem & Main Vein -->
                    <path d="M30 170 L 165 40" stroke="#FBBF24" stroke-width="3" stroke-linecap="round" />
                    <!-- Vein 1 -->
                    <path d="M60 145 L 85 145" stroke="#FBBF24" stroke-width="3" stroke-linecap="round" />
                    <!-- Vein 2 -->
                    <path d="M85 120 L 130 125" stroke="#FBBF24" stroke-width="3" stroke-linecap="round" />
                    <!-- Vein 3 -->
                    <path d="M50 120 L 40 100" stroke="#FBBF24" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            <!-- Footer Disclaimer -->
            <div class="pt-6">
                <p class="text-xs text-[#526352] leading-relaxed">
                    Hasil prediksi membantu pengamatan awal, bukan pengganti pemeriksaan penyuluh.
                </p>
            </div>
        </div>

        <!-- Right Side: Dynamic Auth Form -->
        <div class="lg:col-span-7 flex flex-col justify-center px-4 sm:px-12 py-6">
            <div class="max-w-md w-full mx-auto">
                @yield('content')
            </div>
        </div>

    </div>
</body>
</html>

