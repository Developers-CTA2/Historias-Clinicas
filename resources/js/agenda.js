import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        locale: 'es',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today',
        },
        buttonText :{
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
        },
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        dateClick: function(info) {
            var fechaSeleccionada = info.date;
            var day = fechaSeleccionada.getDay();
            // 0 = Sunday, 6 = Saturday
            if (day === 0 || day === 6) {
                // No hacer nada en sábado y domingo
                return;
            }
            // Redirigir a la página de detalles de citas para la fecha seleccionada
            window.location.href = '/citas?fecha=' + info.dateStr;
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
                    console.log(data);
                    // Verificar si se recibió correctamente la próxima cita
                    const colorPorTipoProfesional = {
                        'Doctora': 'blue',
                        'Nutrióloga': 'green',
                    };
                    
                    // Dentro del mapeo de eventos
                    const eventosCitas = Object.values(data).map(cita => ({
                        title: `${cita.hora}\n${cita.nombre}`,
                        start: cita.fecha,
                        color: colorPorTipoProfesional[cita.tipo_profesional], // Color gris por defecto si no se encuentra
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
