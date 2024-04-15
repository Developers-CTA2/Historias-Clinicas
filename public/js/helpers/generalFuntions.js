/* Expresiones regulares para validar los datos */ 
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/;
const regexLetters = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ ]+$/;
const regexCode = /^[0-9]{7,10}$/;
const regexLetrasHorario = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ\s-]+$/;
const regexHorario = /^\d{2}:\d{2}\s-\s\d{2}:\d{2}$/;

const regexNumero = /^(?=.*\d)/;
const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const regexDecimal = /^(?=.*\d)(?:\d*\.\d+|\d+)$/;


/* Funcion para validar los campos segun su contenido con la expresion Regular, y marcando el error con rojo */
function validarCampo(valor, regex, campo) {
    if (!regex.test(valor)) {
        mostrarerr(campo);
        return false; // Devuelve falso si la validación falla
    } else {
        ocultarerr(campo);
        return true; // Devuelve verdadero si la validación es exitosa
    }
}

/* mostrar el error en el span */
function mostrarerr(campo) {
    $(campo).addClass("border border-danger");
    $(campo).next("span").show();
}

/* ocultar el error en el span */
function ocultarerr(campo) {
    $(campo).next("span").hide(); // Oculta el siguiente elemento <span>
    $(campo).removeClass("border border-danger"); // Elimina la clase border-danger del campo
}

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
