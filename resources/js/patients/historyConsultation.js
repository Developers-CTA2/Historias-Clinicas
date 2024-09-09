import { AlertErrorHistoryConsultation, requestGetConsultation } from "../helpers";
import { historyConsultationTemplate } from '../templates'

// Request 
const limit = 10;
let page = 0;
let lastElement = '';
let idPersona = '';
let totalConsultations = 0;
let showConsultation = 0;


// Intersecting Observer for infinite scroll
let observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            return;
        }
        page++;

        if(showConsultation >= totalConsultations){
            observer.unobserve(lastElement[0]);
            return;
        }

        requestHistoryReportFuncion(limit, page);
    })

}, {
    rootMargin: '0px 0px 50px 0px',
    threshold: 0.5
});

const requestHistoryReportFuncion = (limit, page) => {
    requestGetConsultation({ limit, page, idPersona })
        .then(data => {

            manageObserver(data);

        })
        .catch(error => {
            console.log(error);
            $('#containerListConsultation').html(`<p class="text-center text-danger"> Error al cargar los datos del historial...! </p>`)
            AlertErrorHistoryConsultation('Error', 'Ha ocurrido un error al cargar los datos del historial...!');
        })
}

const manageObserver = (data) => {
     // Si no hay datos, detener el observer
     if (data.length === 0 ) {
                
        if (lastElement) observer.unobserve(lastElement[0]);
        return;
    }

    // Si ya se ha realizado una petición, detener el observer del último elemento
    if (lastElement) {
        observer.unobserve(lastElement[0]);
    }

    updateUI(data);
    
    observer.observe(lastElement[0]);
    showConsultation += data.length;
}

const updateUI = (data) => {
    // Agregar los datos al template
    $('#containerListConsultation').append(historyConsultationTemplate(data));
    lastElement = $('#containerListConsultation').children().last();
}




$(function () {

    idPersona = $('#idPersona').val();
    totalConsultations = $('#totalConsultas').val();

    if(totalConsultations > 0){
        requestHistoryReportFuncion(limit, page);
    }else{
        $('#containerListConsultation').html(`<p class="fw-bold text-muted m-0"> No hay consultas registradas... </p>`)
    }
    

})
    
