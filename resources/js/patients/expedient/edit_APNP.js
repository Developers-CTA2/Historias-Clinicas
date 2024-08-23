import {
    validarCampo,
    RegexPositiveNumer,
    regexDescription,
    calculateEPOC,
    manageDrugAddictions,
} from "../../helpers";
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
    HABILITAR LA EDICION DE APNP
        Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAPNP() {
    $("#Edit-apnp").on("change", function () {
        const isChecked = $("#Edit-apnp").is(":checked");
        if (isChecked) {
            $(".alert-APNP").html(IconInfo("Ahora estás en modo de edición."));
            $(".APNP-data").removeClass("d-none").hide().fadeIn(400);
            //$(".apnp-edit").removeClass("d-none").hide().fadeIn(400); // Mostrar inputs

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
            Confirm(
                "¿Estás seguro de editar el hemotipo?",
                "El nuevo dato será parte del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    RequestUpdate(New_hemotipo, null, 1); // 1 = Hemotipo
                }
            });
        }
    });
}
/*
    Funcion para editar el dato de la escolaridad 
*/
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
    };
    try {
        let response = "";
        if (Type == 1) {// Update BloodType
            response = await axios.post(
                "/patients/medical_record/Add_Disease",
                Data
            );
        } else {// Update school
              response = await axios.post(
                  "/patients/medical_record/Update_School",
                  Data
              );
        }  
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
async function listenDrugs() {
    ListenInputsSmoking();

    $("#new_toxic").on("change", function () {
        if (!$(".Add_drug").hasClass("d-none")) {
            $(".Add_drug").addClass("d-none").hide().fadeOut(400);
        }
        if ($("#new_toxic").val() == 1) {
            ShowForm("#optionSmoking", "d-none", "#optionOthersDrugAddiction"); // Mostrar form smoking
        } else {
            ShowForm("#optionOthersDrugAddiction", "d-none", "#optionSmoking"); // Mostrar form others
        }
    });

    $("#saveDrugs").off("click");
    $("#saveDrugs").on("click", function () {
        if ($("#new_toxic").val() == "" || $("#new_toxic").val() == null) {
            $(".alert-add-Drug").html(
                IconWarning("No se ha detectado ningun cambio.")
            );
            $(".Add_drug").removeClass("d-none").hide().fadeIn(400);
        } else {
            let Data = ValidateDataAdictions($("#new_toxic").val());

            if (Data != []) {
                Confirm(
                    "¿Estás seguro de agregar una nueva toxicomanía?",
                    "El nuevo dato será parte del expediente.",
                    "warning"
                ).then((isConfirmed) => {
                    if (isConfirmed) {
                        var path = window.location.pathname;
                        var segments = path.split("/");
                        var id = segments[segments.length - 1];
                        RequestAddiction(id, Data);
                    }
                });
            }
        }
    });
}
/*
    Funcion para mostrar y ocultar los formularios segun sea necesario en la opcion seleccionada en el select
*/
function ShowForm(Mostrar, type, ocultar) {
    if ($(Mostrar).hasClass(type)) {
        $(Mostrar).removeClass(type); // Show smoking
    }
    $(ocultar).addClass(type);
}
/*
    Funcion para extraer los datos de smoking y mandarlos a la funcin para calculo del riesgo
*/
function ListenInputsSmoking() {
    let Data = {
        numberOfCigarettes: "",
        howDateSmoking: "",
    };
    // Desde cuando
    $("#desdeCuandoFuma").on("change", function () {
        Data.howDateSmoking = $(this).val();
        const Result = calculateEPOC(Data);
        const { risk, html } = Result;
        $("#riegoEPOC").html(html);
    });

    // Cantidad
    $("#cantidadCigarros").on("change", function () {
        Data.numberOfCigarettes = $(this).val();
        const Result = calculateEPOC(Data);
        const { risk, html } = Result;
        $("#riegoEPOC").html(html);
    });
}
/*
    Funcion para validar los datos de la nueva adiccion
*/
function ValidateDataAdictions(idAdiction) {
    let TimeSmoking = $("#desdeCuandoFuma").val().trim();
    let QuantitySmoking = $("#cantidadCigarros").val().trim();
    let TimeOthers = $("#desdeCuandoOtros").val().trim();
    let DescriptionOthers = $("#descripcionOtros").val().trim();
    let DataDrug = {};
    if (idAdiction == 1) {
        // smoking
        let V_Time_Smoking = validarCampo(
            TimeSmoking,
            RegexPositiveNumer,
            "#desdeCuandoFuma"
        );
        let V_Quantity_Smoking = validarCampo(
            QuantitySmoking,
            RegexPositiveNumer,
            "#cantidadCigarros"
        );

        console.log($("#riegoEPOC span").text());
        if (V_Time_Smoking && V_Quantity_Smoking) {
            let Data = {
                optionDrugAddiction: idAdiction,
                valueNumberOfCigarettes: QuantitySmoking,
                valueHowDateSmoking: TimeSmoking,
                valueHowOtherDrugs: "",
                valueDescriptionOtherDrugs: "",
                riskEPOCGlobal: $("#riegoEPOC span").text(),
            };
            const DataDrug = manageDrugAddictions(Data);
            return DataDrug;
        }
    } else {
        // Other addictions
        let V_Time_Others = validarCampo(
            TimeOthers,
            RegexPositiveNumer,
            "#desdeCuandoOtros"
        );
        let V_Descripion = validarCampo(
            DescriptionOthers,
            regexDescription,
            "#descripcionOtros"
        );

        if (V_Time_Others && V_Descripion) {
            let Data = {
                optionDrugAddiction: idAdiction,
                valueNumberOfCigarettes: "",
                valueHowDateSmoking: "",
                valueHowOtherDrugs: TimeOthers,
                valueDescriptionOtherDrugs: DescriptionOthers,
                riskEPOCGlobal: "",
            };
            DataDrug = manageDrugAddictions(Data);
            return DataDrug;
        }
    }
}
/* 
    Funcion que hace la consulta al controlador para la edicion o eliminacion del registro
*/
async function RequestAddiction(idPerson, Datos) {
    const Data = {
        IdPerson: parseInt(idPerson),
        Data: Datos,
    };
    console.log(Data);
    try {
        const response = await axios.post(
            "/patients/medical_record/Add_Adiction",
            Data
        );
        console.log(response);
        $("#add-toxic").modal("hide");
        ClicRefresh();
    } catch (error) {
        console.log(error);
        const { data } = error.response;

        console.log(data);
        $(".alert-AHF").html(
            '<svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><path fill="#FF473E" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg> <strong> ¡Error! </strong> Algo salio mal, intentalo más tarde.'
        );
        await ShowErrors(
            "¡Error!",
            "Error en los datos.",
            "error",
            data.errors
        );
    }
}