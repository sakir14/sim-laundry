<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
        </div>
        <h2 class="text-xl font-black text-slate-800">Lupa Password?</h2>
        <p class="text-slate-500 text-sm mt-1">Masukkan email Anda untuk menerima link reset password</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <div class="relative">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input-modern pl-10 @error('email') border-red-400 @enderror" placeholder="email@contoh.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
        </div>
        <button type="submit" class="w-full btn-primary justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Kirim Link Reset
        </button>
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-blue-600 font-semibold transition-colors">← Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>
