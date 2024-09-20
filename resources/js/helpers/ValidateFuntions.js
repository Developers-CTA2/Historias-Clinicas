/* Funcion para validar los campos segun su contenido con la expresion Regular, y marcando el error con rojo */
export function validarCampo(valor, regex, campo) {
    if (!regex.test(valor)) {
        console.log("Error en el campo");
        mostrarerr(campo);
        return false; // Devuelve falso si la validación falla
    } else {
        ocultarerr(campo);
        return true; // Devuelve verdadero si la validación es exitosa
    }
}

/* mostrar el error en el span */
export function mostrarerr(campo) {
    $(campo).addClass("border border-danger");
    $(campo).next("span").show();
}

/* ocultar el error en el span */
export function ocultarerr(campo) {
    $(campo).next("span").hide(); // Oculta el siguiente elemento <span>
    $(campo).removeClass("border border-danger"); // Elimina la clase border-danger del campo
}

/*
    Funcion para mostrar u ocultar la alerta de error ene l modal
*/
export function ShowOrHideAlert(Type, campo) {
    if (Type == 1) {
        // Ocultar alerta
        if (!$(campo).hasClass("d-none")) {
            $(campo).addClass("d-none");
        }
    } else {
        //mostrar alerta
        if ($(campo).hasClass("d-none")) {
            $(campo).removeClass("d-none").hide().fadeIn(400);
        }
    }
}