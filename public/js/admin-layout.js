$(document).ready(function () {
    // Inisialisasi Fancybox
    if ($.fn.fancybox) {
        $('.fancybox').fancybox();
    }

    // Inisialisasi Wysiwyg jika ada
    if ($.fn.wysihtml5) {
        $('.wysihtml5').wysihtml5();
    }
});

// ===== DROPDOWN NAVBAR ADMIN (klik, bukan hover) =====
document.addEventListener('DOMContentLoaded', function () {
    var toggles = document.querySelectorAll('.dropdown-toggle, .admin-user-btn');

    toggles.forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var parent = toggle.closest('.dropdown, .admin-user-dropdown');
            if (!parent) return;

            var sudahKebuka = parent.classList.contains('dropdown-active');

            // Tutup semua dropdown lain yang lagi kebuka dulu
            document.querySelectorAll('.dropdown-active').forEach(function (el) {
                el.classList.remove('dropdown-active');
            });

            // Kalau tadinya ketutup, buka. Kalau tadinya kebuka, ya udah ketutup (toggle).
            if (!sudahKebuka) {
                parent.classList.add('dropdown-active');
            }
        });
    });

    // Klik di luar area dropdown manapun -> tutup semua
    document.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-active').forEach(function (el) {
            el.classList.remove('dropdown-active');
        });
    });
});