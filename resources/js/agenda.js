import { Calendar } from '@fullcalendar/core';
import { AlertError } from './helpers/Alertas';
import { configDefaultCalendar } from './helpers/configCalendar';


const colorPorTipoProfesional = {
    'Doctora': 'rgb(14 165 233);',
    'Nutrióloga': 'rgba(19, 87, 78,1)',
};


$(function () {
    var calendarEl = document.getElementById('calendar');

    const manageEventDateClick = (info) => {

        const fechaSeleccionada = info.date;
        const day = fechaSeleccionada.getDay();
        const currentDate = new Date().toISOString().split('T')[0];

        // Validate if the day before the current day
        if (fechaSeleccionada < currentDate) {
            AlertError('Día no disponible', 'No se pueden agendar citas en días anteriores a la fecha actual');
            return;
        }

        if (day === 0 || day === 6) {
            AlertError('Día no disponible', 'No se pueden agendar citas en sábado y domingo');
            return;
        }

        // Redirect to the page of details of the appointment for the selected date
        window.location.href = '/citas?fecha=' + info.dateStr;
    }

    const manageEvents = async (_, successCallback, failureCallback) => {
        try {
            const { data } = await axios.get('/proxima-cita');

            if (!data) {
                successCallback([]);
                return;
            }

            // Dentro del mapeo de eventos
            const eventosCitas = data.map(cita => ({
                title: `${cita.hora}\n${cita.nombre}`,
                start: cita.fecha,
                color: colorPorTipoProfesional[cita.tipo_profesional], // Color gris por defecto si no se encuentra
            }));

            successCallback(eventosCitas);
        } catch (error) {
            console.error('Error al obtener la próxima cita:', error);
            failureCallback(error);
        }
    }


    var calendar = new Calendar(calendarEl, {
        ...configDefaultCalendar,
        dateClick: manageEventDateClick,
        events: manageEvents,
    });

    calendar.render();


});



