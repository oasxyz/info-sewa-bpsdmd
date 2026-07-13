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