<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIM-LAUNDRY') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Animated Background -->
        <div class="min-h-screen relative overflow-hidden flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
             style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #1e40af 100%);">

            <!-- Animated Bubbles -->
            <div id="bubbles-container" class="absolute inset-0 pointer-events-none overflow-hidden"></div>

            <!-- Grid Pattern Overlay -->
            <div class="absolute inset-0 opacity-5"
                 style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 50px 50px;"></div>

            <!-- Top Glow -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 rounded-full opacity-20 blur-3xl"
                 style="background: radial-gradient(circle, #60a5fa 0%, transparent 70%);"></div>

            <!-- Logo + Branding -->
            <div data-aos="fade-down" data-aos-duration="800" class="z-10 mb-6">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-2xl blur-lg opacity-60 group-hover:opacity-80 transition-opacity"
                             style="background: linear-gradient(135deg, #2563eb, #06b6d4);"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-cyan-500 p-4 rounded-2xl shadow-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="text-3xl font-black text-white tracking-widest drop-shadow-lg">
                            AWAN<span class="text-cyan-400">-LAUNDRY</span>
                        </h1>
                        <p class="text-blue-200 text-sm font-medium tracking-widest mt-1">SISTEM INFORMASI MANAJEMEN</p>
                    </div>
                </a>
            </div>

            <!-- Card -->
            <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="150"
                 class="z-10 w-full sm:max-w-md mx-4">
                <div class="relative bg-white/95 backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                    <!-- Top gradient bar -->
                    <div class="h-1.5 w-full" style="background: linear-gradient(90deg, #2563eb, #06b6d4, #2563eb); background-size: 200% 100%; animation: shimmer 2s linear infinite;"></div>
                    <div class="px-8 py-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div data-aos="fade-up" data-aos-delay="400" class="z-10 mt-8 text-sm text-blue-300/60 font-medium">
                &copy; {{ date('Y') }} AWAN LAUNDRY EXPRESS — All rights reserved.
            </div>
        </div>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 700, once: true });

            // Create animated bubbles
            const container = document.getElementById('bubbles-container');
            for (let i = 0; i < 18; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                const size = Math.random() * 60 + 20;
                bubble.style.cssText = `
                    width: ${size}px; height: ${size}px;
                    left: ${Math.random() * 100}%;
                    bottom: ${Math.random() * 30}%;
                    animation-duration: ${Math.random() * 8 + 6}s;
                    animation-delay: ${Math.random() * 5}s;
                `;
                container.appendChild(bubble);
            }
        </script>
    </body>
</html>
