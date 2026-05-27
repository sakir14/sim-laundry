<x-guest-layout>

    {{-- HEADER --}}
    <div class="mb-8 text-center">

        <h2 class="text-3xl font-black text-slate-800">
            Buat Akun Baru
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Daftarkan akun untuk akses sistem
        </p>

    </div>

    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('register') }}"
        class="space-y-6"
    >
        @csrf

        {{-- NAMA --}}
        <div>

            <label
                for="name"
                class="mb-2 block text-sm font-bold uppercase tracking-wider text-slate-600"
            >
                Nama Lengkap
            </label>

            <div class="relative">

                {{-- ICON --}}
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16
                               c2.5 0 4.847.655 6.879 1.804M15 11
                               a3 3 0 11-6 0 3 3 0 016 0z"
                        />

                    </svg>

                </div>

                {{-- INPUT --}}
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama lengkap Anda"
                    class="w-full rounded-2xl border border-slate-300
                           bg-white py-4 pl-14 pr-4
                           text-slate-700 shadow-sm
                           transition
                           focus:border-blue-500
                           focus:ring focus:ring-blue-200
                           @error('name') border-red-400 @enderror"
                >

            </div>

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2 text-xs text-red-500"
            />

        </div>

        {{-- EMAIL --}}
        <div>

            <label
                for="email"
                class="mb-2 block text-sm font-bold uppercase tracking-wider text-slate-600"
            >
                Alamat Email
            </label>

            <div class="relative">

                {{-- ICON --}}
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8
                               M5 19h14a2 2 0 002-2V7a2 2 0
                               00-2-2H5a2 2 0 00-2 2v10
                               a2 2 0 002 2z"
                        />

                    </svg>

                </div>

                {{-- INPUT --}}
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="email@contoh.com"
                    class="w-full rounded-2xl border border-slate-300
                           bg-white py-4 pl-14 pr-4
                           text-slate-700 shadow-sm
                           transition
                           focus:border-blue-500
                           focus:ring focus:ring-blue-200
                           @error('email') border-red-400 @enderror"
                >

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2 text-xs text-red-500"
            />

        </div>

        {{-- PASSWORD --}}
        <div>

            <label
                for="password"
                class="mb-2 block text-sm font-bold uppercase tracking-wider text-slate-600"
            >
                Password
            </label>

            <div class="relative">

                {{-- ICON --}}
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2m6-6V9a6 6 0 10-12 0v2
                               m-2 0h16a2 2 0 012 2v6a2 2 0
                               01-2 2H4a2 2 0 01-2-2v-6
                               a2 2 0 012-2z"
                        />

                    </svg>

                </div>

                {{-- INPUT --}}
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="w-full rounded-2xl border border-slate-300
                           bg-white py-4 pl-14 pr-14
                           text-slate-700 shadow-sm
                           transition
                           focus:border-blue-500
                           focus:ring focus:ring-blue-200
                           @error('password') border-red-400 @enderror"
                >

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2 text-xs text-red-500"
            />

        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div>

            <label
                for="password_confirmation"
                class="mb-2 block text-sm font-bold uppercase tracking-wider text-slate-600"
            >
                Konfirmasi Password
            </label>

            <div class="relative">

                {{-- ICON --}}
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2
                               a9 9 0 11-18 0
                               9 9 0 0118 0z"
                        />

                    </svg>

                </div>

                {{-- INPUT --}}
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                    class="w-full rounded-2xl border border-slate-300
                           bg-white py-4 pl-14 pr-4
                           text-slate-700 shadow-sm
                           transition
                           focus:border-blue-500
                           focus:ring focus:ring-blue-200"
                >

            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2 text-xs text-red-500"
            />

        </div>

        {{-- BUTTON --}}
        <button
            type="submit"
            class="flex w-full items-center justify-center gap-3
                   rounded-2xl
                   bg-gradient-to-r from-blue-600 to-blue-700
                   px-6 py-4
                   text-lg font-bold text-white
                   shadow-lg shadow-blue-300/30
                   transition-all duration-200
                   hover:-translate-y-0.5
                   hover:from-blue-700
                   hover:to-blue-800"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3
                       m-2-5a4 4 0 11-8 0 4 4 0
                       018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                />
            </svg>

            BUAT AKUN

        </button>

        {{-- LOGIN --}}
        <p class="pt-2 text-center text-sm text-slate-500">

            Sudah punya akun?

            <a
                href="{{ route('login') }}"
                class="font-bold text-blue-600 hover:underline"
            >
                Masuk di sini
            </a>

        </p>

    </form>

</x-guest-layout>