document.addEventListener('DOMContentLoaded', function () {
  var offcanvasEl = document.getElementById('offcanvasNav');
  if (!offcanvasEl) return;

  offcanvasEl.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var href = link.getAttribute('href');
      if (href && href.startsWith('#')) {
        e.preventDefault();
        var bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (bsOffcanvas) bsOffcanvas.hide();

        var target = document.querySelector(href);
        if (target) {
          setTimeout(function () {
            target.scrollIntoView({ behavior: 'smooth' });
          }, 350);
        }
      }
    });
  });
});
