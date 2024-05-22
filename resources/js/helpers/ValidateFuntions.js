/* Funcion para validar los campos segun su contenido con la expresion Regular, y marcando el error con rojo */
export function validarCampo(valor, regex, campo) {
    if (!regex.test(valor)) {
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