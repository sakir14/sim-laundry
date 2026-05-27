<nav x-data="{ open: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
     :class="scrolled ? 'shadow-lg bg-white' : 'bg-white/95 backdrop-blur-md shadow-sm'"
     class="sticky top-0 z-50 border-b border-slate-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-xl blur-sm opacity-0 group-hover:opacity-60 transition-opacity bg-gradient-to-br from-blue-500 to-cyan-500"></div>
                        <div class="relative bg-gradient-to-br from-blue-600 to-blue-700 p-2 rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <span class="text-lg font-black text-slate-800 tracking-wide leading-none">AWAN<span class="text-blue-600">-LAUNDRY</span></span>
                        <p class="text-[10px] text-slate-400 font-semibold tracking-widest">MANAGEMENT SYSTEM</p>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden sm:flex items-center gap-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Transaksi
                    </x-nav-link>
                    <x-nav-link :href="route('pelanggan.index')" :active="request()->routeIs('pelanggan.*')"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Pelanggan
                    </x-nav-link>
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('layanan.index')" :active="request()->routeIs('layanan.*')"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Layanan
                        </x-nav-link>
                        <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Laporan
                        </x-nav-link>
                        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.*')"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Kasir
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right: User Menu -->
            <div class="hidden sm:flex items-center">
                <x-dropdown align="right" width="52">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 px-3 py-2 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-sm font-bold shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left hidden lg:block">
                                <p class="text-xs font-bold text-slate-700 truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wider">{{ Auth::user()->role }}</p>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-xs text-slate-500 font-medium">Masuk sebagai</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Saya
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2 text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white border-t border-slate-100 shadow-xl">
        <div class="pt-2 pb-3 px-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Transaksi
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pelanggan.index')" :active="request()->routeIs('pelanggan.*')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pelanggan
            </x-responsive-nav-link>
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('layanan.index')" :active="request()->routeIs('layanan.*')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">Layanan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">Laporan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.*')" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold">Kasir</x-responsive-nav-link>
            @endif
        </div>
        <div class="pt-3 pb-3 border-t border-slate-100 bg-slate-50 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil Saya</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
