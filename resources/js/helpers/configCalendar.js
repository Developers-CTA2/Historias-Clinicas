import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

export const configDefaultCalendar = {
    locale: 'es',
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'today',
    },
    buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
    },
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
}