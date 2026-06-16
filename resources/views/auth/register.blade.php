<x-guest-layout>
    <!-- SUNTIKAN STYLE: Memperbaiki Hubungan Judul-Field & Proporsi Tombol Sesuai image_2ced3c.png -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        
        /* WARNA BACKGROUND DI BELAKANG FORM (Transparan Maroon + Butter) */
        div.min-h-screen {
            background-color: #fcfbf9 !important;
            background-image: 
                linear-gradient(135deg, rgba(88, 28, 36, 0.09) 0%, rgba(252, 251, 249, 0.6) 50%, rgba(88, 28, 36, 0.06) 100%),
                linear-gradient(to right, rgba(88, 28, 36, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(88, 28, 36, 0.03) 1px, transparent 1px) !important;
            background-size: 100% 100%, 22px 22px, 22px 22px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Ukuran Form Dioptimalkan Agar Rapi & Presisi */
        div.w-full.sm\:max-w-md.bg-white {
            background-color: #fdfbf7 !important; 
            border: 1px solid rgba(88, 28, 36, 0.05) !important;
            border-radius: 28px !important;
            box-shadow: 0 25px 50px -12px rgba(88, 28, 36, 0.12) !important;
            padding: 3rem 2.5rem !important; 
            width: 100% !important;
            max-width: 400px !important; 
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        /* STRUKTUR INPUT MINIMALIS */
        .input-minimalis {
            background-color: transparent !important;
            border: none !important;
            border-bottom: 1px solid #e5e7eb !important;
            border-radius: 0px !important;
            padding: 0.3rem 0.1rem !important; /* Di-press sedikit agar menempel ke judulnya */
            width: 100% !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }
        
        .input-minimalis:focus {
            outline: none !important;
            box-shadow: none !important;
            border-bottom: 2px solid #581c24 !important;
        }

        /* Tombol Kapsul Mantap Sesuai Proporsional Desain */
        .btn-maroon-pill-fixed {
            background-color: #581c24 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            transition: all 0.2s ease-in-out !important;
        }
        .btn-maroon-pill-fixed:hover {
            background-color: #3f1319 !important;
            box-shadow: 0 4px 12px rgba(88, 28, 36, 0.2) !important;
        }
    </style>

    <!-- JUDUL ATAS -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Sign Up</h2>
        <p class="text-xs text-gray-400 mt-1.5 tracking-wide">Daftarkan akun baru sistem BILSPORT Anda.</p>
    </div>

    <!-- FORM PROSES -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- FIELD NAMA (Judul nempel ke input, jarak renggang ditaruh di bawah div kelompok) -->
        <div class="block mb-6">
            <x-input-label for="name" value="Nama Lengkap" class="text-xs font-semibold text-gray-700 pl-0.5 tracking-wide block mb-1" />
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="input-minimalis text-gray-800" 
                placeholder="Nama Anda">
            <x-input-error :messages="$errors->get('name')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- FIELD EMAIL -->
        <div class="block mb-6">
            <x-input-label for="email" value="Email" class="text-xs font-semibold text-gray-700 pl-0.5 tracking-wide block mb-1" />
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="input-minimalis text-gray-800" 
                placeholder="iqis@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- FIELD PASSWORD -->
        <div class="block mb-6">
            <x-input-label for="password" value="Password Baru" class="text-xs font-semibold text-gray-700 pl-0.5 tracking-wide block mb-1" />
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="input-minimalis text-gray-800" 
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- FIELD KONFIRMASI PASSWORD -->
        <div class="block mb-8">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-xs font-semibold text-gray-700 pl-0.5 tracking-wide block mb-1" />
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="input-minimalis text-gray-800" 
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- TOMBOL DAFTAR (Ukurannya Lebih Tebal & Berisi) -->
        <div class="pt-1">
            <button type="submit" class="w-full btn-maroon-pill-fixed text-sm py-3 shadow-md active:scale-[0.99] tracking-wider uppercase">
                {{ __('Register') }}
            </button>
        </div>

        <!-- TEKS BAWAH -->
        <div class="text-center pt-4">
            <p class="text-xs text-gray-400 tracking-wide">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-[#581c24] hover:underline transition ml-1">
                    Login
                </a>
            </p>
        </div>

    </form>
</x-guest-layout>