document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  // dummy data — nanti diganti fetch ke route Laravel yang return JSON dari DB
  var dummyEvents = [
    { title: 'AKAD DAN RESEPSI', start: '2026-07-04', color: '#e8834e' },
    { title: 'RESEPSI',          start: '2026-07-04', color: '#e8834e' },
    { title: 'RESEPSI',          start: '2026-07-05', color: '#e8834e' },
    { title: 'AKAD DAN RESEPSI', start: '2026-07-11', color: '#e8834e' },
    { title: 'RESEPSI',          start: '2026-07-12', color: '#6aa84f' },
    { title: 'RESEPSI PERNIKAHAN', start: '2026-07-18', color: '#e8834e' },
    { title: 'AKAD DAN RESEPSI', start: '2026-07-19', color: '#6aa84f' },
    { title: 'RESEPSI',          start: '2026-07-19', color: '#e8834e' },
    { title: 'RESEPSI',          start: '2026-07-25', color: '#6aa84f' },
    { title: 'AKAD DAN RESEPSI', start: '2026-07-26', color: '#e8834e' },
    { title: 'AKAD DAN RESEPSI', start: '2026-07-26', color: '#6aa84f' },
    { title: 'AKAD',             start: '2026-08-01', color: '#6aa84f' },
    { title: 'RESEPSI NGUNDUH',  start: '2026-08-01', color: '#e8834e' },
    { title: 'RESEPSI PERNIKAHAN', start: '2026-08-02', color: '#e8834e' },
    { title: 'IJAB DAN RESEPSI', start: '2026-08-08', color: '#e8834e' },
  ];

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    height: 'auto',
    headerToolbar: { left: 'title', center: '', right: 'today prev,next' },
    dayMaxEvents: 2,
    events: dummyEvents
  });

  calendar.render();
});
