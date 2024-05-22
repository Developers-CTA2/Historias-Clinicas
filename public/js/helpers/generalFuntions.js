



function automaicScroll(campo) {
    $("html, body").animate(
        // hacer scroll hacia la seccion siguiente
        {
            scrollTop: $(campo).offset().top,
        },
        2000
    );
}


 function CalcularTiempos(fecha) {
    // Parsea la fecha de nacimiento en formato 'yyyy-mm-dd' a un objeto Date
    var fecha_1 = new Date(fecha);
    var fechaActual = new Date();
    var diffMilisegundos = fechaActual - fecha_1;
    
    var edad = Math.floor(diffMilisegundos / (1000 * 60 * 60 * 24 * 365.25));
    
    return edad;
}
