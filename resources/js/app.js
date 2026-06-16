import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// --- LOGIKA KHUSUS BILSPORT ---

// Fungsi Search & Filter yang tetap mau kamu pakai secara client-side
window.handleSearch = () => {
    const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('#listLapanganTable tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });
};

// Logika modal (Hanya jika kamu tidak ingin pakai modal bawaan Breeze/Alpine)
window.openModal = (id) => {
    const modal = document.getElementById(id);
    if(modal) modal.style.display = 'flex';
};

window.closeModal = (id) => {
    const modal = document.getElementById(id);
    if(modal) modal.style.display = 'none';
};

// Event listener untuk input harga di filter
document.addEventListener('DOMContentLoaded', () => {
    const filterHarga = document.getElementById('filterHarga');
    if (filterHarga) {
        filterHarga.addEventListener('input', function() {
            const label = document.getElementById('labelHarga');
            if(label) label.innerText = "Rp " + parseInt(this.value).toLocaleString();
        });
    }
});