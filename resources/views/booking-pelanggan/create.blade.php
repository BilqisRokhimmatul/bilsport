<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking - {{ $lapangan->nama_lapangan }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-maroon-bilsport { background-color: #4a121a; }
        .text-maroon-bilsport { color: #4a121a; }
    </style>
    <script>
        // Sinkronisasi tema dark mode dari localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-[#fdfbf7] dark:bg-zinc-900 text-gray-900 dark:text-zinc-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-200">

    <div class="max-w-3xl mx-auto bg-white dark:bg-zinc-950 rounded-3xl shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
        
        <div class="bg-maroon-bilsport p-8 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider bg-white/20 px-3 py-1 rounded-md mb-2 inline-block">Konfirmasi Sewa</span>
                <h1 class="text-2xl font-black tracking-tight">{{ $lapangan->nama_lapangan }}</h1>
                <p class="text-sm text-gray-300 mt-1">🏷️ Kategori: <strong>{{ $lapangan->kategori }}</strong> | Kode: {{ $lapangan->kode_lapangan }}</p>
            </div>
            <div class="text-left sm:text-right">
                <p class="text-xs text-gray-300 uppercase font-bold">Harga Sewa</p>
                <p class="text-xl font-black text-amber-400">Rp {{ number_format($lapangan->harga_per_jam) }}<span class="text-xs text-white font-normal">/jam</span></p>
            </div>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Nama Pemesan</label>
                    <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full bg-gray-50 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm font-bold text-gray-500 focus:outline-none cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Nomor WhatsApp (Aktif)</label>
                    <input type="tel" name="no_whatsapp" required placeholder="Contoh: 081234567xxx" class="w-full bg-transparent border border-gray-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:border-maroon-bilsport dark:focus:border-red-400 transition">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Tanggal Jadwal Main</label>
                    <input type="date" name="tanggal_main" required class="w-full bg-transparent border border-gray-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:border-maroon-bilsport dark:focus:border-red-400 transition">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-3">
                        Pilih Slot Jam Tersedia (Operasional: 07:00 - 22:00)
                    </label>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3" id="slot-jam-container">
                        @php
                            $slots = [
                                '07:00' => '07:00 - 08:00', '08:00' => '08:00 - 09:00', '09:00' => '09:00 - 10:00',
                                '10:00' => '10:00 - 11:00', '11:00' => '11:00 - 12:00', '12:00' => '12:00 - 13:00',
                                '13:00' => '13:00 - 14:00', '14:00' => '14:00 - 15:00', '15:00' => '15:00 - 16:00',
                                '16:00' => '16:00 - 17:00', '17:00' => '17:00 - 18:00', '18:00' => '18:00 - 19:00',
                                '19:00' => '19:00 - 20:00', '20:00' => '20:00 - 21:00', '21:00' => '21:00 - 22:00'
                            ];
                        @endphp

                        @foreach($slots as $value => $label)
                            <label class="slot-label flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 cursor-pointer select-none transition hover:border-maroon-bilsport">
                                <input type="checkbox" name="jam_sewa[]" value="{{ $value }}" class="slot-checkbox w-4 h-4 rounded border-gray-300 text-[#4a121a] focus:ring-[#4a121a]">
                                <div class="flex flex-col text-left">
                                    <span class="slot-text text-xs font-bold text-gray-700 dark:text-zinc-300">
                                        {{ $label }}
                                    </span>
                                    <span class="status-booked hidden text-[9px] text-red-500 font-extrabold mt-0.5">❌ Booked</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-[11px] text-gray-400 mt-2">💡 *Anda bisa memilih lebih dari 1 slot jam secara bersamaan untuk durasi main yang lama.</p>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Catatan Tambahan (Opsional)</label>
                    <input type="text" name="catatan" placeholder="Misal: Sewa raket / rompi tim" class="w-full bg-transparent border border-gray-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:border-maroon-bilsport dark:focus:border-red-400 transition">
                </div>
            </div>

            <div class="border-t border-dashed border-gray-200 dark:border-zinc-800 pt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 dark:bg-zinc-900 p-4 rounded-2xl border border-gray-200 dark:border-zinc-800 text-center flex flex-col items-center justify-center">
                    <p class="text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Silahkan Scan QRIS BILSPORT</p>
                    <img src="{{ asset('images/qris.png') }}" alt="QRIS BILSPORT" class="w-40 h-40 object-contain rounded-lg shadow-xs border bg-white p-2">
                    
                    <div class="mt-3 bg-white dark:bg-zinc-950 px-4 py-2 rounded-xl border border-gray-100 dark:border-zinc-800 w-full">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Total Harus Dibayar:</p>
                        <p class="text-md font-black text-maroon-bilsport dark:text-red-400 mt-0.5" id="total-pembayaran-display">Rp 0</p>
                    </div>
                </div>

                <div class="flex flex-col justify-center">
                    <label class="block text-xs font-black text-gray-500 dark:text-zinc-400 uppercase tracking-wider mb-2">Upload Bukti Pembayaran (Format: JPG/PNG)</label>
                    <input type="file" name="bukti_pembayaran" required class="w-full text-xs font-semibold text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-maroon-bilsport/10 file:text-maroon-bilsport hover:file:bg-maroon-bilsport/20 file:cursor-pointer border border-gray-200 dark:border-zinc-800 p-3 rounded-xl bg-transparent focus:outline-none">
                    <p class="text-[10px] text-gray-400 mt-2">⚠️ Pastikan nominal transfer sesuai dengan total harga di samping.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-zinc-800 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-maroon-bilsport dark:hover:text-red-400 transition order-2 sm:order-1">
                    ← Kembali ke Beranda
                </a>
                <button type="submit" class="w-full sm:w-auto bg-maroon-bilsport dark:bg-zinc-800 hover:bg-[#320a10] dark:hover:bg-zinc-700 text-white font-bold text-sm px-8 py-3.5 rounded-xl transition shadow-md order-1 sm:order-2 cursor-pointer">
                    Kirim & Ajukan Booking ⚡
                </button>
            </div>
        </form>
    </div>

    <script>
        const tanggalInput = document.querySelector('input[name="tanggal_main"]');
        const lapanganId = document.querySelector('input[name="lapangan_id"]').value;
        const hargaPerJam = {{ $lapangan->harga_per_jam }}; // Mengambil nominal harga asli lapangan dari controller
        const displayTotal = document.getElementById('total-pembayaran-display');

        // Set tanggal minimal adalah hari ini
        tanggalInput.min = new Date().toISOString().split("T")[0];

        // 1. Fungsi AJAX Cek Slot Jam Kosong berdasarkan tanggal pilihan
        tanggalInput.addEventListener('change', async function() {
            const tanggal = this.value;
            if (!tanggal) return;

            const checkboxes = document.querySelectorAll('.slot-checkbox');
            
            try {
                const response = await fetch(`/api/cek-jadwal?lapangan_id=${lapanganId}&tanggal=${tanggal}`);
                const jamTerpakai = await response.json();

                checkboxes.forEach(cb => {
                    const labelContainer = cb.closest('.slot-label');
                    const statusText = labelContainer.querySelector('.status-booked');
                    
                    if (jamTerpakai.includes(cb.value)) {
                        cb.disabled = true;
                        cb.checked = false;
                        labelContainer.classList.add('opacity-40', 'bg-gray-100', 'dark:bg-zinc-900', 'cursor-not-allowed');
                        labelContainer.classList.remove('hover:border-maroon-bilsport', 'bg-maroon-bilsport/10', 'border-[#4a121a]');
                        statusText.classList.remove('hidden');
                    } else {
                        cb.disabled = false;
                        labelContainer.classList.remove('opacity-40', 'bg-gray-100', 'dark:bg-zinc-900', 'cursor-not-allowed');
                        labelContainer.classList.add('hover:border-maroon-bilsport');
                        statusText.classList.add('hidden');
                    }
                });

                // Reset hitungan harga display setiap kali tanggal berubah ganti jadwal
                hitungTotalBayar();

            } catch (error) {
                console.error("Gagal memuat jadwal:", error);
            }
        });

        // 2. Logika ganti warna background & hitung harga akumulasi otomatis secara real-time
        document.querySelectorAll('.slot-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const labelContainer = this.closest('.slot-label');
                if (this.checked) {
                    labelContainer.classList.add('bg-maroon-bilsport/10', 'border-[#4a121a]');
                } else {
                    labelContainer.classList.remove('bg-maroon-bilsport/10', 'border-[#4a121a]');
                }

                // Panggil fungsi kalkulator harga
                hitungTotalBayar();
            });
        });

        // Fungsi pembantu menghitung total harga (jumlah tercentang * harga per jam)
        function hitungTotalBayar() {
            const jumlahTerpilih = document.querySelectorAll('.slot-checkbox:checked').length;
            const totalBiaya = jumlahTerpilih * hargaPerJam;
            
            // Format angka ke format mata uang Rupiah Indonesia
            displayTotal.innerText = 'Rp ' + totalBiaya.toLocaleString('id-ID');
        }
    </script>

</body>
</html>