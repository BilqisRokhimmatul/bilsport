<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin BILSPORT</title>
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

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black tracking-tight text-maroon-bilsport dark:text-red-400">Manajemen Transaksi Masuk</h1>
            <p class="text-xs text-gray-500 dark:text-zinc-400 mt-1 font-semibold">Validasi bukti pembayaran QRIS pelanggan dan ubah status sewa lapangan di bawah ini.</p>
        </div>

        <!-- Alert Sukses Ubah Status -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900 text-emerald-800 dark:text-emerald-400 px-4 py-3 rounded-xl text-xs font-bold">
                🎉 {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Transaksi -->
        <div class="bg-white dark:bg-zinc-950 rounded-3xl border border-gray-100 dark:border-zinc-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-zinc-900 text-[10px] font-black uppercase tracking-wider text-gray-400 dark:text-zinc-500 border-b border-gray-100 dark:border-zinc-800">
                            <th class="py-4 px-6">ID / Pelanggan</th>
                            <th class="py-4 px-6">Lapangan</th>
                            <th class="py-4 px-6">Jadwal Main</th>
                            <th class="py-4 px-6">Total Bayar</th>
                            <th class="py-4 px-6 text-center">Bukti TF</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-right">Aksi Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800 text-xs font-semibold">
                        @forelse($transaksi as $tx)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-900/30 transition">
                                <!-- Pelanggan -->
                                <td class="py-4 px-6">
                                    <span class="text-[10px] font-mono text-gray-400 block">#{{ $tx->id }}</span>
                                    <span class="text-gray-900 dark:text-zinc-100 font-bold block text-sm">{{ $tx->user->name }}</span>
                                    <span class="text-[11px] text-gray-400 block mt-0.5">📱 {{ $tx->no_whatsapp }}</span>
                                </td>

                                <!-- Lapangan -->
                                <td class="py-4 px-6">
                                    <span class="text-gray-800 dark:text-zinc-200 font-bold block">{{ $tx->lapangan->nama_lapangan }}</span>
                                    <span class="text-[10px] bg-gray-100 dark:bg-zinc-900 px-1.5 py-0.5 rounded text-gray-400 mt-1 inline-block">{{ $tx->lapangan->kategori }}</span>
                                </td>

                                <!-- Jadwal -->
                                <td class="py-4 px-6 space-y-1">
                                    <span class="text-gray-800 dark:text-zinc-200 block font-bold">📅 {{ \Carbon\Carbon::parse($tx->tanggal_main)->translatedFormat('d M Y') }}</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(json_decode($tx->jam_sewa) as $jam)
                                            <span class="bg-maroon-bilsport/5 dark:bg-red-400/5 text-maroon-bilsport dark:text-red-400 px-1.5 py-0.5 rounded text-[10px] font-bold">{{ $jam }}</span>
                                        @endforeach
                                    </div>
                                    @if($tx->catatan)
                                        <span class="text-[10px] text-gray-400 block italic mt-1">💡 "{{ $tx->catatan }}"</span>
                                    @endif
                                </td>

                                <!-- Total Harga -->
                                <td class="py-4 px-6 text-sm font-black text-maroon-bilsport dark:text-red-400">
                                    Rp {{ number_format($tx->total_harga) }}
                                </td>

                                <!-- Bukti TF -->
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ asset('images/bukti-transfer/' . $tx->bukti_pembayaran) }}" target="_blank" class="inline-block bg-gray-100 dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 px-3 py-1.5 rounded-xl hover:bg-maroon-bilsport/10 hover:text-maroon-bilsport transition text-[11px] font-bold shadow-2xs">
                                        👁️ Lihat Gambar
                                    </a>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-6 text-center">
                                    @if($tx->status == 'menunggu')
                                        <span class="text-[10px] font-black uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-200 px-2 py-0.5 rounded-md block text-center">⏳ Menunggu</span>
                                    @elseif($tx->status == 'lunas')
                                        <span class="text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200 px-2 py-0.5 rounded-md block text-center">✅ Lunas</span>
                                    @else
                                        <span class="text-[10px] font-black uppercase tracking-wider bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded-md block text-center">❌ Batal</span>
                                    @endif
                                </td>

                                <!-- Form Aksi Ubah Status -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Setujui / Lunas -->
                                        @if($tx->status !== 'lunas')
                                            <form action="{{ route('booking-admin.update', $tx->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lunas">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-2.5 py-1.5 rounded-xl font-bold text-[11px] transition cursor-pointer shadow-xs" title="Setujui Pembayaran">
                                                    Setujui ✓
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Batalkan -->
                                        @if($tx->status !== 'batal')
                                            <form action="{{ route('booking-admin.update', $tx->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="batal">
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi sewa ini?')" class="bg-gray-100 hover:bg-red-50 hover:text-red-600 text-gray-500 border border-gray-200 dark:border-zinc-800 dark:bg-zinc-900 px-2.5 py-1.5 rounded-xl font-bold text-[11px] transition cursor-pointer" title="Batalkan Booking">
                                                    Batalkan ✕
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400 font-bold">
                                    📥 Belum ada transaksi booking masuk dari pelanggan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Tombol Balik ke Dashboard Admin -->
                <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold bg-white dark:bg-zinc-950 border border-gray-200 dark:border-zinc-800 px-4 py-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-zinc-900 transition shadow-xs flex items-center gap-1 cursor-pointer">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

</body>
</html>