import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            var fechaSeleccionada = info.dateStr;
            // Redirigir a la página de detalles de citas para la fecha seleccionada
            window.location.href = '/citas?fecha=' + fechaSeleccionada;
        },
        events: function(info, successCallback, failureCallback) {
            // Obtener la cita más próxima
            fetch('/proxima-cita')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // Verificar si se recibió correctamente la próxima cita
                    const eventosCitas = Object.values(data).map(cita => ({
                        title: `${cita.hora}\n${cita.nombre}`,
                        start: cita.fecha,
                        color: 'red' // Color de la cita resaltada
                    }));

                    successCallback(eventosCitas);
                })
                .catch(error => {
                    console.error('Error al obtener la próxima cita:', error);
                    failureCallback(error);
                });
        }
    });

    calendar.render();
});


