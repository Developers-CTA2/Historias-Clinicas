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
                .then(response => response.json())
                .then(data => {
                    // Verificar si se recibió correctamente la próxima cita
                    if (data && data.hora && data.nombre) {
                        // Resaltar la cita más próxima en el calendario
                        successCallback([
                            {
                                title: `${data.hora}\n${data.nombre}`,
                                start: data.fecha,
                                color: 'red' // Color de la cita resaltada
                            }
                        ]);
                    } else {
                        // Si no hay próxima cita, llamar a failureCallback para evitar errores
                        failureCallback();
                    }
                })
                .catch(error => {
                    console.error('Error al obtener la próxima cita:', error);
                    failureCallback(error);
                });
        }
    });

    calendar.render();
});


