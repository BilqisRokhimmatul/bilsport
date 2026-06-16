<x-app-layout>
    <div style="max-w: 500px; margin: 40px auto; padding: 20px;">
        <div id="card-pengaturan" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid maroon;">
            
            <h3 id="title-pengaturan" style="color: maroon; font-weight: bold; font-size: 1.4rem; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                ⚙️ Pengaturan Tampilan Bilsport
            </h3>
            
            <form id="form-preferensi">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 0.95rem;">Pilih Tema Halaman:</label>
                    <select id="pref-theme" name="theme" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; color: black; font-family: 'Poppins', sans-serif;">
                        <option value="light">☀️ Mode Terang (Light)</option>
                        <option value="dark">🌙 Mode Gelap (Dark)</option>
                        <option value="system">💻 Ikuti Sistem (System)</option>
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 0.95rem;">Ukuran Font Teks:</label>
                    <select id="pref-font" name="font_size" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; color: black; font-family: 'Poppins', sans-serif;">
                        <option value="text-sm">Kecil</option>
                        <option value="text-base">Normal</option>
                        <option value="text-xl">Besar</option>
                    </select>
                </div>

                <button type="submit" style="width: 100%; background: maroon; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; font-size: 1rem; cursor: pointer; font-family: 'Poppins', sans-serif;">
                    Simpan Preferensi Tampilan
                </button>
            </form>
        </div>

        <br> <div id="card-kunjungan" style="background: white; color: black; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #ff4d4d;">
            
            <h4 style="font-weight: bold; font-size: 1.2rem; margin-bottom: 15px; font-family: 'Poppins', sans-serif;">
                📊 Statistik Kunjungan Anda
            </h4>

            @if(session('success_reset'))
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.9rem;">
                    {{ session('success_reset') }}
                </div>
            @endif

            <table style="width: 100%; font-size: 0.9rem; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                <tr style="height: 35px;">
                    <td style="font-weight: bold; width: 50%;">Jumlah Kunjungan:</td>
                    <td><span style="background: maroon; color: white; padding: 4px 12px; border-radius: 12px; font-weight: bold;">{{ session('jumlah_kunjungan', 0) }} kali</span></td>
                </tr>
                <tr style="height: 35px;">
                    <td style="font-weight: bold;">Kunjungan Pertama:</td>
                    <td style="color: #666;" id="txt-kunjungan-awal">{{ session('kunjungan_pertama', '-') }}</td>
                </tr>
                <tr style="height: 35px;">
                    <td style="font-weight: bold;">Kunjungan Terakhir:</td>
                    <td style="color: #666;" id="txt-kunjungan-akhir">{{ session('kunjungan_terakhir', '-') }}</td>
                </tr>
            </table>

            <form action="{{ route('reset.kunjungan') }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mereset riwayat kunjungan?')" style="width: 100%; background: transparent; color: #ff4d4d; border: 2px solid #ff4d4d; padding: 10px; border-radius: 8px; font-weight: bold; font-size: 0.9rem; cursor: pointer; font-family: 'Poppins', sans-serif; transition: 0.2s;">
                    🔄 Reset Hitungan Kunjungan
                </button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const savedTheme = getCookie('theme') || 'light';
        const savedFont = getCookie('font_size') || 'text-base';
        
        document.getElementById('pref-theme').value = savedTheme;
        document.getElementById('pref-font').value = savedFont;

        if(savedTheme === 'dark') {
            document.getElementById('card-pengaturan').style.setProperty('background', '#1e1e1e', 'important');
            document.getElementById('card-pengaturan').style.setProperty('color', '#ffffff', 'important');
            document.getElementById('title-pengaturan').style.setProperty('color', '#ff4d4d', 'important');
        }
    });

    document.getElementById('form-preferensi').addEventListener('submit', async function(e) {
        e.preventDefault();
        let theme = document.getElementById('pref-theme').value;
        const font_size = document.getElementById('pref-font').value;

        if (theme === 'system') {
            const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            theme = isDarkMode ? 'dark' : 'light';
        }

        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        try {
            const response = await fetch('/api/save-preferences', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ theme, font_size })
            });

            setCookie('theme', theme, 30);
            setCookie('font_size', font_size, 30);

            alert('🎉 Preferensi tampilan berhasil disimpan via Cookie!');
            window.location.reload();
        } catch (error) {
            console.error(error);
        }
    });
    </script>
</x-app-layout>