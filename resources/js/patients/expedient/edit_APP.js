import {
    validarCampo,
    RegexPositiveNumer,
    regexDescription,
    calculateEPOC,
    manageDrugAddictions,
} from "../../helpers/index.js";
import {
    IconInfo,
    IconWarning,
    Confirm,
    ShowErrors,
} from "../../templates/ExpedientTemplate.js";

$(document).ready(function () {
    console.log("Editar APP");
    EventEditAPP();
});

/*
    HABILITAR LA EDICION DE APP
    Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAPP() {
    $("#Edit-APP").on("change", function () {
        const isChecked = $("#Edit-APP").is(":checked");
        if (isChecked) {
            $(".alert-APP").html(IconInfo("Ahora estás en modo de edición."));
            $(".APP-data").removeClass("d-none").hide().fadeIn(400);
            console.log("Abrir la nueva ventana");
             var path = window.location.pathname;
             var segments = path.split("/");
             var id = segments[segments.length - 1];
            window.location.href =
                "/patients/medical_record/APP/" + id;
        } else {
            /* Cancelar edicion */
            $(".APP-data")
                .addClass("animate__fadeOutUp")
                .fadeOut(400, function () {
                    $(this)
                        .addClass("d-none")
                        .removeClass("animate__fadeOutUp");
                });
        }
    });
}
