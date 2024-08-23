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


/* Funcion que muestra los errores que manda el controlador*/
export function showErrors(errors, campoAlerta, campoLista) {
    if (errors) {
        const errorList = $(campoLista);
      
            errorList.empty(); // Limpiar la lista de errores existente
            $.each(errors, function (key, value) {
                $.each(value, function (index, errorMessage) {
                    errorList.append($("<li>").text(errorMessage));
                });
            });
            // Mostrar la alerta de error
            $(campoAlerta).show();
        
    } 
}
