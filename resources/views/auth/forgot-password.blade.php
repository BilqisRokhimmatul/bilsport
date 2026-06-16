<x-guest-layout>
    <!-- SUNTIKAN STYLE: Menyamakan 100% Desain dengan Halaman Login Minimalis -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        
        /* WARNA BACKGROUND DI BELAKANG FORM (Transparan Maroon + Butter) */
        div.min-h-screen {
            background-color: #fcfbf9 !important; /* Base warna butter lembut */
            background-image: 
                linear-gradient(135deg, rgba(88, 28, 36, 0.09) 0%, rgba(252, 251, 249, 0.6) 50%, rgba(88, 28, 36, 0.06) 100%),
                linear-gradient(to right, rgba(88, 28, 36, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(88, 28, 36, 0.03) 1px, transparent 1px) !important;
            background-size: 100% 100%, 22px 22px, 22px 22px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Ukuran Form Ramping Warna Butter Lembut */
        div.w-full.sm\:max-w-md.bg-white {
            background-color: #fdfbf7 !important; 
            border: 1px solid rgba(88, 28, 36, 0.05) !important;
            border-radius: 28px !important;
            box-shadow: 0 25px 50px -12px rgba(88, 28, 36, 0.12) !important;
            padding: 3rem 2.5rem !important;
            width: 100% !important;
            max-width: 390px !important; 
            margin-top: 1rem !important;
        }

        /* STRUKTUR INPUT MINIMALIS (Hanya Garis Bawah) */
        .input-minimalis {
            background-color: transparent !important;
            border: none !important;
            border-bottom: 1px solid #e5e7eb !important;
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

        /* Tombol Lonjong Kapsul Maroon Solid (DIPERTEBAL DAN DIBESARKAN) */
        .btn-maroon-pill-large {
            background-color: #581c24 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border-radius: 9999px !important;
            transition: all 0.2s ease-in-out !important;
        }
        .btn-maroon-pill-large:hover {
            background-color: #3f1319 !important;
            box-shadow: 0 4px 12px rgba(88, 28, 36, 0.2) !important;
        }
    </style>

    <!-- JUDUL ATAS Halaman Reset -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Reset Password</h2>
    </div>

    <!-- Teks Penjelasan Singkat -->
    <div class="mb-6 text-xs text-gray-400 text-center leading-relaxed tracking-wide px-2">
        {{ __('Lupa password? Tidak masalah. Masukkan alamat email Anda di bawah ini dan kami akan mengirimkan link tautan untuk mengatur ulang password baru.') }}
    </div>

    <!-- KONDISI STATUS SESI / NOTIFIKASI BERHASIL KIRIM EMAIL -->
    <x-auth-session-status class="mb-5 text-sm text-center text-green-600 font-semibold" :status="session('status')" />

    <!-- FORM PROSES -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- FIELD EMAIL -->
        <div class="flex flex-col space-y-1">
            <x-input-label for="email" value="Email Universitas / Akun" class="text-xs font-semibold text-gray-500 pl-0.5 tracking-wide" />
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="input-minimalis text-gray-800" 
                placeholder="iqis@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 mt-1 pl-0.5" />
        </div>

        <!-- TOMBOL KIRIM LINK RESET (Sekarang Lebih Besar dan Tebal Sesuai Request) -->
        <div class="pt-2">
            <button type="submit" class="w-full btn-maroon-pill-large text-sm py-4 shadow-md active:scale-[0.99] tracking-wider uppercase">
                {{ __('Kirim Link Reset Password') }}
            </button>
        </div>

        <!-- TOMBOL KEMBALI KE LOGIN -->
        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-[#581c24] transition tracking-wide flex items-center justify-center gap-1">
                ← Kembali ke halaman Login
            </a>
        </div>

    </form>
</x-guest-layout>