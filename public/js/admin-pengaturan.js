document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.settings-tab-btn');
  var tabPanels = document.querySelectorAll('.settings-tab-panel');

  tabButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var target = btn.getAttribute('data-tab');

      tabButtons.forEach(function (b) { b.classList.remove('active'); });
      tabPanels.forEach(function (p) { p.classList.remove('active'); });

      btn.classList.add('active');
      document.getElementById('tab-' + target).classList.add('active');
    });
  });
});