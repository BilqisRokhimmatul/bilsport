<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - BILSPORT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-maroon-bilsport { background-color: #4a121a; }
        .text-maroon-bilsport { color: #4a121a; }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-[#fdfbf7] dark:bg-zinc-900 text-gray-900 dark:text-zinc-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-200">

    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-maroon-bilsport dark:text-red-400">Riwayat Booking Anda</h1>
                <p class="text-xs text-gray-500 dark:text-zinc-400 mt-1 font-semibold">Pantau status pembayaran dan jadwal sewa lapangan BILSPORT Anda di sini.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-bold bg-white dark:bg-zinc-950 border border-gray-200 dark:border-zinc-800 px-4 py-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-zinc-900 transition shadow-xs">
                ← Kembali Ke Beranda
            </a>
        </div>

        @if($riwayat->isEmpty())
            <div class="bg-white dark:bg-zinc-950 rounded-3xl p-12 text-center border border-gray-100 dark:border-zinc-800 shadow-md">
                <span class="text-4xl">🗓️</span>
                <h3 class="text-base font-bold text-gray-700 dark:text-zinc-300 mt-4">Belum Ada Riwayat Booking</h3>
                <p class="text-xs text-gray-400 mt-1">Anda belum pernah melakukan pemesanan lapangan sama sekali.</p>
                <a href="{{ route('dashboard') }}" class="mt-4 inline-block bg-maroon-bilsport text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow-md hover:bg-[#320a10] transition">
                    Pesan Lapangan Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($riwayat as $bk)
                    <div class="bg-white dark:bg-zinc-950 rounded-2xl border border-gray-100 dark:border-zinc-800 shadow-sm p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition hover:shadow-md">
                        
                        <div class="space-y-2 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="text-lg font-black tracking-tight text-gray-800 dark:text-zinc-100">{{ $bk->lapangan->nama_lapangan }}</h3>
                                
                                @if($bk->status == 'menunggu')
                                    <span class="text-[10px] font-black uppercase tracking-wider bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-900 px-2.5 py-0.5 rounded-md">⏳ Menunggu Konfirmasi</span>
                                @elseif($bk->status == 'lunas')
                                    <span class="text-[10px] font-black uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900 px-2.5 py-0.5 rounded-md">✅ Lunas / Disetujui</span>
                                @else
                                    <span class="text-[10px] font-black uppercase tracking-wider bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900 px-2.5 py-0.5 rounded-md">❌ Dibatalkan</span>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs font-semibold text-gray-500 dark:text-zinc-400 pt-1">
                                <div>
                                    <p class="text-[10px] uppercase font-black text-gray-400 dark:text-zinc-500">Tanggal Main</p>
                                    <p class="mt-0.5 text-gray-800 dark:text-zinc-200">📆 {{ \Carbon\Carbon::parse($bk->tanggal_main)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-black text-gray-400 dark:text-zinc-500">Slot Jam Main</p>
                                    <p class="mt-0.5 text-gray-800 dark:text-zinc-200 flex flex-wrap gap-1">
                                        @foreach(json_decode($bk->jam_sewa) as $jam)
                                            <span class="bg-gray-100 dark:bg-zinc-900 px-1.5 py-0.5 rounded text-[11px] font-bold">{{ $jam }}</span>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <p class="text-[10px] uppercase font-black text-gray-400 dark:text-zinc-500">Nomor WhatsApp</p>
                                    <p class="mt-0.5 text-gray-800 dark:text-zinc-200">📱 {{ $bk->no_whatsapp }}</p>
                                </div>
                            </div>

                            @if($bk->catatan)
                                <p class="text-[11px] bg-gray-50 dark:bg-zinc-900/50 text-gray-400 dark:text-zinc-500 p-2 rounded-lg italic font-medium">
                                    📝 Catatan: "{{ $bk->catatan }}"
                                </p>
                            @endif
                        </div>

                        <div class="w-full md:w-auto flex md:flex-col justify-between items-end md:items-end border-t md:border-t-0 border-gray-100 dark:border-zinc-800 pt-4 md:pt-0 shrink-0">
                            <div class="text-left md:text-right">
                                <p class="text-[10px] uppercase font-black text-gray-400 dark:text-zinc-500">Total Biaya</p>
                                <p class="text-xl font-black text-maroon-bilsport dark:text-red-400">Rp {{ number_format($bk->total_harga) }}</p>
                            </div>
                            
                            <div class="mt-2">
                                <a href="{{ asset('images/bukti-transfer/' . $bk->bukti_pembayaran) }}" target="_blank" class="text-[11px] font-bold text-gray-400 hover:text-maroon-bilsport dark:hover:text-red-400 underline flex items-center gap-1">
                                    📂 Lihat Bukti TF
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>