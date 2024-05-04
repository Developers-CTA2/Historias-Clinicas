import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth', // Puedes cambiar la vista inicial si lo deseas
        // Aquí puedes agregar más configuraciones según tus necesidades
    });

    calendar.render();
});
