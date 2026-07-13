document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    height: 'auto',
    headerToolbar: { left: 'title', center: '', right: 'today prev,next' },
    dayMaxEvents: 2,
    events: '/api/jadwal'
  });

  calendar.render();
});
