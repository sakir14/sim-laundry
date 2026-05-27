<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
            <input id="name" name="name" type="text" class="input-modern" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-1 text-xs text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
            <div class="relative">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <input id="email" name="email" type="email" class="input-modern pl-10" value="{{ old('email', $user->email) }}" required autocomplete="username">
            </div>
            <x-input-error class="mt-1 text-xs text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-700">
                Email belum terverifikasi.
                <button form="send-verification" class="underline font-bold hover:text-yellow-900 ml-1">Kirim ulang verifikasi</button>
                @if (session('status') === 'verification-link-sent')
                <p class="mt-1 font-bold text-green-600">Link verifikasi sudah dikirim!</p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit" class="btn-primary text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
               class="text-sm text-emerald-600 font-bold flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Tersimpan!
            </p>
            @endif
        </div>
    </form>
</section>
