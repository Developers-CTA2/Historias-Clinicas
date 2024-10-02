import { Calendar } from '@fullcalendar/core';
import { AlertError } from './helpers/Alertas';
import { configDefaultCalendar } from './helpers/configCalendar';

const selectColor = (cantidad) => {
    let color = '';
    if (cantidad <= 2) {
        color = colorPorTipoProfesional['Pocas'];
    } else if (cantidad <= 5) {
        color = colorPorTipoProfesional['Algunas'];
    } else {
        color = colorPorTipoProfesional['Muchas'];
    }
    console.log('Color:', color);
    return color;
}

const colorPorTipoProfesional = {
    'Pocas': 'rgb(22 163 74)',
    'Algunas': 'rgb(234 88 12)',
    'Muchas' : 'rgb(239 68 68)',
};


$(function () {
    var calendarEl = document.getElementById('calendar');

    const manageEventDateClick = (info) => {

        const day = info.date.getDay();
        const dateSelected = info.dateStr;
        const currentDate = new Date().toISOString().split('T')[0];


        // Validate if the day before the current day
        if (dateSelected < currentDate) {
            AlertError('Día no disponible', 'No se pueden agendar citas en días anteriores a la fecha actual');
            return;
        }

        if (day === 0 || day === 6) {
            AlertError('Día no disponible', 'No se pueden agendar citas en sábado y domingo');
            return;
        }

        // Redirect to the page of details of the appointment for the selected date
        window.location.href = `/agenda/citas/${dateSelected}`;
    }

    const manageEvents = async (_, successCallback, failureCallback) => {
        try {
            const { data } = await axios.get('/agenda/proxima-cita');

            if (!data) {
                successCallback([]);
                return;
            }

            console.log('Próxima cita:', data);

            
            // Dentro del mapeo de eventos
            const eventosCitas = data.map(cita => ({
                title: `${cita.cantidad} citas pendientes`,
                start: cita.fecha,
                color: selectColor(cita.cantidad), // Color gris por defecto si no se encuentra
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



