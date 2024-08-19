import { Modal } from "bootstrap";

import { validarCampo } from "../../helpers/ValidateFuntions.js";
import { RegexPositiveNumer, regexDescription } from "../../helpers/Regex.js";
import {
    IconInfo,
    IconWarning,
    Confirm,
    ShowErrors,
} from "../../templates/ExpedientTemplate.js";

$(document).ready(function () {
    console.log("Editar APNP");
    EventEditAPNP();
});

/*
    HABILITAR LA EDICION DE AHF
    Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAPNP() {
    $("#Edit-apnp").on("change", function () {
        const isChecked = $("#Edit-apnp").is(":checked");
        if (isChecked) {
            $(".alert-APNP").html(IconInfo("Ahora estás en modo de edición."));
            $(".APNP-data").removeClass("d-none").hide().fadeIn(400);

            $(".apnp-edit").removeClass("d-none").hide().fadeIn(400); // Mostrar inputs
            EventHemotipo();
            EventSchool();
            listenDrugs();
        } else {
            /* Cancelar edicion */
            $(".APNP-data")
                .addClass("animate__fadeOutUp")
                .fadeOut(400, function () {
                    $(this)
                        .addClass("d-none")
                        .removeClass("animate__fadeOutUp");
                });
        }
    });
}

/*
    Funcion para validar el nuevo dato en caso de que se edite el tipo de sangre 
*/
async function EventHemotipo() {
    $("#save-Hemotipo").off("click");
    $("#save-Hemotipo").on("click", function () {
        let Old_hemotipo = $("#id_hemotipo").text().trim();
        let New_hemotipo = $("#new_hemotipo").val();
        console.log(Old_hemotipo);
        console.log(New_hemotipo);
        if (Old_hemotipo == New_hemotipo) {
            $(".alert-APNP").html(
                IconWarning("No se ha realizado ningun cambio.")
            );
        } else {
            console.log("sI EDITAR");
            Confirm(
                "¿Estás seguro de editar el hemotipo?",
                "El nuevo dato será parte del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    RequestUpdate(New_hemotipo, null, 1); // 1 = Hemotipo
                } else {
                    console.log("nooooo  EDITAR");
                }
            });
        }
    });
}

async function EventSchool() {
    $("#save-School").off("click");
    $("#save-School").on("click", function () {
        let Old_school = $("#id_escolaridad").text().trim();
        let New_school = $("#new_school").val();

        if (Old_school == New_school) {
            $(".alert-APNP").html(
                IconWarning("No se ha realizado ningun cambio.")
            );
        } else {
            Confirm(
                "¿Estás seguro de editar el hemotipo?",
                "El nuevo dato será parte del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    RequestUpdate(null, New_school, 2); // 1 = Hemotipo
                } else {
                    console.log("nooooo  EDITAR");
                }
            });
        }
    });
}

/*
    Funcion que hace la consulta al controlador para la edicion o eliminacion del registro
*/
async function RequestUpdate(Hemotipo, school, Type) {
    var path = window.location.pathname;
    var segments = path.split("/");
    var id = segments[segments.length - 1];

    const Data = {
        Id_person: parseInt(id),
        Id_hemotipo: parseInt(Hemotipo),
        Id_school: parseInt(school),
        Type: parseInt(Type),
    };
    try {
        const response = await axios.post(
            "/patients/medical_record/Update_APNP",
            Data
        );

        ShowAlerts(Type);

        console.log(response);
    } catch (error) {
        const { type, msg, errors } = error.response.data;
        await ShowErrors(
            "¡Error!",
            "No fue posible la edición de los datos",
            "error",
            errors
        );

        console.log(errors);
        console.log(error);
    }
}

function ShowAlerts(type) {
    if (type == 1) {
        if ($(".apnp-refresh-homo").hasClass("d-none")) {
            $(".apnp-refresh-homo").removeClass("d-none").hide().fadeIn(400); // Mostrar inputs
        } // Mostrar inputs)
    } else {
        if ($(".apnp-refresh-esc").hasClass("d-none")) {
            $(".apnp-refresh-esc").removeClass("d-none").hide().fadeIn(400); // Mostrar inputs
        }
    }

    ClicRefresh();
}

/* Funcion para recargar la pagina y ver los cambios refeljados ya en la vista */
function ClicRefresh() {
    // Mostramos alertas y el boton de refresh
    $(".apnp-refresh").removeClass("d-none").hide().fadeIn(400); // Mostrar inputs
    $(".alert-APNP").html(
        IconWarning(" Recarga la página para ver los cambios.")
    );

    $(".apnp-refresh").off("click");
    $(".apnp-refresh").on("click", function () {
        window.location.reload();
    });
}

////////////////////////////  TOXICOMANIAS         //////////////////////////////////
/*
    Funcion que muestra el formulario segun la opcion que de seleccione en el input
*/
function listenDrugs() {
    $("#new_toxic").on("change", function () {
        if (!$(".Add_drug").hasClass("d-none")) {
            $(".Add_drug").addClass("d-none").hide().fadeOut(400);
        }
        if ($("#new_toxic").val() == 1) {
            
            if ($("#optionSmoking").hasClass("d-none")) {
                $("#optionSmoking").removeClass("d-none"); // Show smoking
            }
            $("#optionOthersDrugAddiction").addClass("d-none");

            smoking();
            ClicSaveDrugs(1, $("#new_toxic").val());
        } else {
            if ($("#optionOthersDrugAddiction").hasClass("d-none")) {
                $("#optionOthersDrugAddiction").removeClass("d-none"); // Show others
            }
            $("#optionSmoking").addClass("d-none");
            ClicSaveDrugs(2, $("#new_toxic").val());
        }
    });

    $("#saveDrugs").off("click");
    $("#saveDrugs").on("click", function () {
        if (
            $("#desdeCuandoFuma").val().trim() == "" ||
            $("#desdeCuandoFuma").val().trim() == null
        ) {
            $(".alert-add-Drug").html(
                IconWarning("No se ha detectado ningun cambio.")
            );
            $(".Add_drug").removeClass("d-none").hide().fadeIn(400);
        }
    });
}

/*
    Funcion para extraer los datos de smoking y mandarlos a la funcin para calculo del riesgo
*/
function smoking() {
    $("#desdeCuandoFuma").on("change", function () {
        let desde = $("#desdeCuandoFuma").val().trim();
        $("#cantidadCigarros").on("change", function () {
            let cantidad = $("#cantidadCigarros").val().trim();
            Risk(desde, cantidad);
        });
    });
}

/*
    Funcion para hacer el calculo y mostrar el riesgo
*/

function Risk(tiempo, cantidad) {
    let result = (cantidad * tiempo) / 20;
    let riskEPOCGlobal = riskEPOCresult(result);
    console.log(riskEPOCGlobal);
    $("#riegoEPOC").html(riskEPOCGlobal.html);
}

/*
    Mostrar en tiempo real el calculo
*/
function riskEPOCresult(result) {
    if (result < 10)
        return {
            text: "Nulo",
            html: '<span class="badge-custom badge-custom-success">Nulo</span>',
        };
    if (result >= 10 && result <= 20)
        return {
            text: "Moderado",
            html: '<span class="badge-custom badge-custom-moderade">Moderado</span>',
        };
    if (result > 20 && result < 41)
        return {
            text: "Intenso",
            html: '<span class="badge-custom badge-custom-warning">Intenso</span>',
        };
    if (result > 40)
        return {
            text: "Alto",
            html: '<span class="badge-custom badge-custom-danger">Alto</span>',
        };

    return "Sin dato";
}

function ClicSaveDrugs(opc, Id) {
    $("#saveDrugs").off("click");
    $("#saveDrugs").on("click", function () {
        if (opc == 1) {
            //Smoking
            let desde = $("#desdeCuandoFuma").val().trim();
            let cantidad = $("#cantidadCigarros").val().trim();

            let V_desde = validarCampo(
                desde,
                RegexPositiveNumer,
                "#desdeCuandoFuma"
            );
            let V_cantidad = validarCampo(
                cantidad,
                RegexPositiveNumer,
                "#cantidadCigarros"
            );

            if (V_cantidad && V_desde) {
                console.log("Todo bien");
            }
        } else {
            let desde = $("#desdeCuandoOtros").val().trim();
            let descripcion = $("#descripcionOtros").val().trim();

            let V_desde = validarCampo(
                desde,
                RegexPositiveNumer,
                "#desdeCuandoOtros"
            );
            let V_descripcion = validarCampo(
                descripcion,
                regexDescription,
                "#descripcionOtros"
            );

              if (V_desde && V_descripcion) {
                  console.log("Todo bien");
              }
        }
    });
}
