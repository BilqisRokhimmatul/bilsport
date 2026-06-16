<x-guest-layout>
    <!-- SUNTIKAN STYLE: Mengikuti Gaya Minimalis Garis Bawah Sesuai image_36e52e.png -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        
        /* WARNA BACKGROUND DI BELAKANG FORM DIUBAH JADI TRANSPARAN MAROON + BUTTER */
        div.min-h-screen {
            background-color: #fcfbf9 !important; /* Base warna butter lembut */
            background-image: 
                linear-gradient(135deg, rgba(88, 28, 36, 0.09) 0%, rgba(252, 251, 249, 0.6) 50%, rgba(88, 28, 36, 0.06) 100%),
                linear-gradient(to right, rgba(88, 28, 36, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(88, 28, 36, 0.03) 1px, transparent 1px) !important;
            background-size: 100% 100%, 22px 22px, 22px 22px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Ukuran Form Ramping Warna Butter Lembut dengan Sudut Halus */
        div.w-full.sm\:max-w-md.bg-white {
            background-color: #fdfbf7 !important; /* Latar Form Butter */
            border: 1px solid rgba(88, 28, 36, 0.05) !important;
            border-radius: 28px !important;
            box-shadow: 0 20px 40px rgba(88, 28, 36, 0.06) !important;
            padding: 3rem 2.5rem !important;
            width: 100% !important;
            max-width: 390px !important; /* Ramping sesuai gambar */
            margin-top: 1rem !important;
        }

        /* STRUKTUR INPUT MINIMALIS: Hanya Garis Bawah Sesuai Gambar Referensi */
        .input-minimalis {
            background-color: transparent !important;
            border: none !important;
            border-bottom: 1px solid #d1d5db !important;
            border-radius: 0px !important;
            padding: 0.5rem 0.25rem !important;
            width: 100% !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }
        
        /* Efek Saat Kolom Diklik: Garis Berubah Jadi Maroon */
        .input-minimalis:focus {
            outline: none !important;
            box-shadow: none !important;
            border-bottom: 2px solid #581c24 !important;
        }

        /* Tombol Lonjong Khas Gaya Modern Minimalis */
        .btn-maroon-pill {
            background-color: #581c24 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            border-radius: 9999px !important; /* Membuat ujungnya bulat lonjong sempurna */
            transition: all 0.2s ease-in-out !important;
        }
        .btn-maroon-pill:hover {
            background-color: #3f1319 !important;
            box-shadow: 0 4px 12px rgba(88, 28, 36, 0.2) !important;
        }
    </style>

    <!-- KONDISI STATUS SESI -->
    <x-auth-session-status class="mb-5 text-sm text-center" :status="session('status')" />

    <!-- JUDUL ATAS (Gaya Minimalis Elegan) -->
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Sign In</h2>
    </div>

    <!-- FORM UTAMA -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- FIELD EMAIL (Style Minimalis Garis Bawah) -->
        <div class="flex flex-col space-y-1">
            <x-input-label for="email" value="Email" class="text-xs font-semibold text-gray-500 pl-0.5 tracking-wide" />
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="input-minimalis text-gray-800" 
                placeholder="iqis@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- FIELD PASSWORD -->
        <div class="flex flex-col space-y-1">
            <div class="flex items-center justify-between pl-0.5">
                <x-input-label for="password" value="Password" class="text-xs font-semibold text-gray-500 tracking-wide" />
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-bold text-[#581c24] hover:underline transition" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="input-minimalis text-gray-800" 
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- REMEMBER ME -->
        <div class="flex items-center pl-0.5 pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded border-gray-300 text-[#581c24] focus:ring-[#581c24] w-4 h-4">
                <span class="ms-2 text-xs font-semibold text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- TOMBOL SIGN IN (Bentuk Kapsul/Pill Maroon Solid) -->
        <div class="pt-4">
            <button type="submit" class="w-full btn-maroon-pill text-sm py-3 shadow-md active:scale-[0.99] tracking-wider">
                Sign In
            </button>
        </div>

        <!-- TEKS BAWAH (Pertanyaan & Link Registrasi Sesuai Request) -->
        <div class="text-center pt-4">
            <p class="text-xs text-gray-500 tracking-wide">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-[#581c24] hover:underline transition ml-1">
                    Register
                </a>
            </p>
        </div>

    </form>
</x-guest-layout>