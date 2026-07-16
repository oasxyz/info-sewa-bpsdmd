if (typeof $ !== 'undefined') {
    $(document).ready(function () {
        // Inisialisasi Fancybox
        if ($.fn.fancybox) {
            $('.fancybox').fancybox();
        }

        // Inisialisasi Wysiwyg - toolbar dibatesin cuma Bold/Italic/Underline
        if ($.fn.wysihtml5) {
            $('.wysihtml5').wysihtml5({
                "font-styles": false, // hapus dropdown "Normal text"
                "emphasis": true,      // Bold, Italic, Underline
                "lists": false,        // hapus tombol list
                "html": false,         // hapus tombol edit HTML mentah
                "link": false,         // hapus tombol link
                "image": false,        // hapus tombol gambar
                "color": false         // hapus tombol warna font
            });
        }
    });
}

// ===== SIDEBAR TOGGLE (minimize/maximize) =====
document.addEventListener('DOMContentLoaded', function () {
    const layout = document.getElementById('adminLayout');
    const toggleBtn = document.getElementById('sidebarToggleBtn');

    if (toggleBtn && layout) {
        // Balikin state terakhir (khusus desktop, biar gak ke-reset tiap pindah halaman)
        if (window.innerWidth > 860 && localStorage.getItem('sidebarCollapsed') === '1') {
            layout.classList.add('sidebar-collapsed');
        }

        toggleBtn.addEventListener('click', function () {
            layout.classList.toggle('sidebar-collapsed');

            if (window.innerWidth > 860) {
                localStorage.setItem(
                    'sidebarCollapsed',
                    layout.classList.contains('sidebar-collapsed') ? '1' : '0'
                );
            }
        });
    }

    // ===== ACCORDION SUBMENU (Laporan, Grafik, Pengaturan, dst) =====
    document.querySelectorAll('.submenu-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const item = toggle.closest('.sidebar-item');
            const submenu = item.querySelector('.submenu');
            const sudahKebuka = item.classList.contains('open');

            // Tutup submenu lain yang lagi kebuka
            document.querySelectorAll('.sidebar-item.has-submenu.open').forEach(function (el) {
                el.classList.remove('open');
                const s = el.querySelector('.submenu');
                if (s) s.classList.remove('open');
            });

            if (!sudahKebuka) {
                item.classList.add('open');
                submenu.classList.add('open');
            }
        });
    });
});