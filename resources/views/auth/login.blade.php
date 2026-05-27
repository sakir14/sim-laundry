<x-guest-layout>

    {{-- Session Status --}}
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    {{-- Header --}}
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-slate-800">
            Selamat Datang!
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Masuk ke sistem manajemen laundry
        </p>
    </div>

    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('login') }}"
        class="space-y-6"
    >
        @csrf

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
                            d="M16 12H8m8 0H8m8 0H8m13-4H3m18 8H3"
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
                    autofocus
                    autocomplete="username"
                    placeholder="admin@laundry.com"
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
                Kata Sandi
            </label>

            <div class="relative">

                {{-- LOCK ICON --}}
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
                            d="M12 15v2m6-6V9a6 6 0 10-12 0v2m-2 0h16a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2z"
                        />
                    </svg>

                </div>

                {{-- INPUT --}}
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full rounded-2xl border border-slate-300
                           bg-white py-4 pl-14 pr-14
                           text-slate-700 shadow-sm
                           transition
                           focus:border-blue-500
                           focus:ring focus:ring-blue-200
                           @error('password') border-red-400 @enderror"
                >

                {{-- TOGGLE BUTTON --}}
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute right-4 top-1/2
                           -translate-y-1/2
                           text-slate-400
                           transition
                           hover:text-slate-600"
                >

                    <svg
                        id="eyeIcon"
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
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5
                               12 5c4.478 0 8.268 2.943
                               9.542 7-1.274 4.057-5.064 7
                               -9.542 7-4.477 0-8.268-2.943
                               -9.542-7z"
                        />
                    </svg>

                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2 text-xs text-red-500"
            />

        </div>

        {{-- REMEMBER + FORGOT --}}
        <div class="flex items-center justify-between">

            <label class="flex cursor-pointer items-center gap-3">

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="h-5 w-5 rounded border-slate-300
                           text-blue-600 focus:ring-blue-500"
                >

                <span class="text-sm font-medium text-slate-600">
                    Ingat Saya
                </span>

            </label>

            @if (Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-semibold text-blue-600
                           transition hover:text-blue-800 hover:underline"
                >
                    Lupa Sandi?
                </a>

            @endif

        </div>

        {{-- BUTTON LOGIN --}}
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
                    d="M17 16l4-4m0 0l-4-4m4 4H7"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12h4"
                />
            </svg>

            MASUK SEKARANG

        </button>

        {{-- REGISTER --}}
        @if (Route::has('register'))

            <p class="pt-2 text-center text-sm text-slate-500">

                Belum punya akun?

                <a
                    href="{{ route('register') }}"
                    class="font-bold text-blue-600 hover:underline"
                >
                    Daftar di sini
                </a>

            </p>

        @endif

    </form>

    {{-- SCRIPT --}}
    <script>

        function togglePassword() {

            const passwordInput = document.getElementById('password');

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

            } else {

                passwordInput.type = 'password';

            }

        }

    </script>

</x-guest-layout>