import {
    IconInfo,
    IconWarning,
    ShowErrors,
    IconError,
    Confirm,
    ClicRefresh,
} from "../../templates/ExpedientTemplate.js";

import {
    validarCampo,
    regexDescription,
    regexFecha,
} from "../../helpers/index.js";
import { AlertaSweerAlert } from "../../helpers/Alertas.js";

$(document).ready(function () {
    Hospital();
    Transfusiones();
    Surgeries();
    Traumas();
});

/*
   Funcion para gestionar los eventos del apartado de Hospitalizacione 
*/
function Hospital() {
    $($(".add-Hospital")).on("click", function () {
        let Ids = {
            Alerta: ".Hospital",
            text_Alert: ".Hospital-Text",
            Show: ".icon-refresh-Hospital",
        };
        ShowORHideAlert(1);
        ShowModalData("Agregar un registro de ", "Hospitalización");

        ClicButtonSave(1, Ids, ""); // 1 = Hospitalizacion
    });

    $($(".edit-hospital")).on("click", function () {
        let Ids = {
            Alerta: ".Hospital",
            text_Alert: ".Hospital-Text",
            Show: ".icon-refresh-Hospital",
        };

        console.log("Clic Editar");
        ShowORHideAlert(1);
        ShowModalData("Editar un registro de ", "Hospitalización");

        var Id_reg = $(this).data("id_reg");
        var date = $(this).data("date");
        var description = $(this).data("description");
        console.log(date, description);

        let OldData = {
            Id: Id_reg,
            OldDate: date,
            OldDescription: description,
        };

        ShowModalDataEdit(date, description);
        ShowModalData();
        ClicButtonSave(5, Ids, OldData); // 1 = Hospitalizacion
    });
}
/*
  Funcion para gestionar los eventos del apartado de transfusiones
*/
function Transfusiones() {
    $($(".add-Trans")).on("click", function () {
        let Ids = {
            Alerta: ".Trans",
            text_Alert: ".Trans-Text",
            Show: ".icon-refresh-Trans",
        };

        ShowORHideAlert(1);
        ShowModalData("Agregar un registro de una ", "Transfusión");

        ClicButtonSave(2, Ids, ""); // 2 = Transfusion
    });

     $($(".edit-trans")).on("click", function () {
         let Ids = {
             Alerta: ".Trans",
             text_Alert: ".Trans-Text",
             Show: ".icon-refresh-Trans",
         };

         ShowORHideAlert(1);
         ShowModalData("Editar un registro de ", "Transfusiones");

         var Id_reg = $(this).data("id_reg");
         var date = $(this).data("date");
         var description = $(this).data("description");

         let OldData = {
             Id: Id_reg,
             OldDate: date,
             OldDescription: description,
         };

         ShowModalDataEdit(date, description);
         ShowModalData();
         ClicButtonSave(6, Ids, OldData); // 1 = Hospitalizacion
     });
}
/*
Funcion para gestionar los eventos del apartado de cirigias 
*/
function Surgeries() {
    $($(".add-Surgery")).on("click", function () {
        let Ids = {
            Alerta: ".Surgery",
            text_Alert: ".Surgery-Text",
            Show: ".icon-refresh-Surgery",
        };

        ShowORHideAlert(1);
        ShowModalData("Agregar un registro de una ", "Cirugía");

        ClicButtonSave(3, Ids, ""); // 2 = Transfusion
    });

    $($(".edit-Surgery")).on("click", function () {
         let Ids = {
             Alerta: ".Surgery",
             text_Alert: ".Surgery-Text",
             Show: ".icon-refresh-Surgery",
         };
       
        ShowORHideAlert(1);
        ShowModalData("Editar un registro de ", "Cirugía");

        var Id_reg = $(this).data("id_reg");
        var date = $(this).data("date");
        var description = $(this).data("description");
 
        let OldData = {
            Id: Id_reg,
            OldDate: date,
            OldDescription: description,
        };

        ShowModalDataEdit(date, description);
        ShowModalData();
        ClicButtonSave(7, Ids, OldData); // 1 = Hospitalizacion
    });
}

function Traumas() {
    $($(".add-Trauma")).on("click", function () {
        let Ids = {
            Alerta: ".Trauma",
            text_Alert: ".Trauma-Text",
            Show: ".icon-refresh-Trauma",
        };

        ShowORHideAlert(1);
        ShowModalData("Agregar un registro de un ", "Traumatismo");

        ClicButtonSave(4, Ids); // 2 = Transfusion
    });

     $($(".edit-Trauma")).on("click", function () {
         let Ids = {
             Alerta: ".Trauma",
             text_Alert: ".Trauma-Text",
             Show: ".icon-refresh-Trauma",
         };

         ShowORHideAlert(1);
         ShowModalData("Editar un registro de ", "Traumatismo");

         var Id_reg = $(this).data("id_reg");
         var date = $(this).data("date");
         var description = $(this).data("description");

         let OldData = {
             Id: Id_reg,
             OldDate: date,
             OldDescription: description,
         };

         ShowModalDataEdit(date, description);
         ShowModalData();
         ClicButtonSave(8, Ids, OldData); // 1 = Hospitalizacion
     });
}



function ShowORHideAlert(Type) {
    if (Type == 1) {
        // Oculatar alerta
        if (!$(".Modal-Alert").hasClass("d-none")) {
            $(".Modal-Alert").addClass("d-none");
        }
    } else {
        //mostrar alerta
        if ($(".Modal-Alert").hasClass("d-none")) {
            $(".Modal-Alert").removeClass("d-none").hide().fadeIn(400);
        }
    }
}

/*
Funcion para mostrar los datos en los inputs cuando se va a hacer una edicion
*/
function ShowModalDataEdit(Date, Description) {
    $("#New-Data").val(Date);
    $("#text_Description").val(Description);
}

/*
Funcion para mostrar la funcion que se va realizar en los encabezados del modal 
*/
function ShowModalData(Title, Text) {
    $(".Title-accion").text(Title);
    $(".text-accion").text(Text);
}

/*  
    Funcion que al dar clic al boton de guardar valide los datos y haga la comfirmacion en caso de que los datis son correctos 
*/
function ClicButtonSave(Type, Ids, OldData) {
    $("#saveAPP").on("click", function () {
        let ValidateData = ClicValidateData(Type, OldData);
        console.log(ValidateData);

        if (Object.keys(ValidateData).length !== 0) {
            // Oculatar alerta
            // if (!$(".Modal-Alert").hasClass("d-none")) {
            //     $(".Modal-Alert").addClass("d-none");
            // }
            ShowORHideAlert(1);
            Confirm(
                "¿Estás seguro de realizar la acción?",
                "El nuevo dato será parte del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    Request(Type, ValidateData, Ids);
                }
            });
        }
    });
}

/*
    Validar que haya algo en el select al dar clic al guardar
*/
function ClicValidateData(Type, OldData) {
    let result = {};
    let description = $("#text_Description").val().trim();
    let Date = $("#New-Data").val();
    var id_person;
    if (description == "" || Date == "") {
        // Error en los datos
        console.log($("#New-Data").val());

        $(".Modal-Alert-Text").html(
            IconInfo("Parece que hay errores en los datos.")
        );
        ShowORHideAlert(2);

        console.log(description);
        let V_desc = validarCampo(
            description,
            regexDescription,
            "#text_Description"
        );
        let V_Date = validarCampo(Date, regexFecha, "#New-Data");
    } else {
        // Oculatar alerta
        ShowORHideAlert(1);

        let V_desc = validarCampo(
            description,
            regexDescription,
            "#text_Description"
        );
        let V_Date = validarCampo(Date, regexFecha, "#New-Data");

        if (Type >= 5) {
            // Comparar datos nuevos con datos viejos
            const { OldDate, OldDescription, Id } = OldData;

            if (Date == OldDate && description === OldDescription) {
                console.log("Edicion")
                $(".Modal-Alert-Text").html(
                    IconInfo(
                        "<strong> ¡Error! </strong> no se ha realizado ningún cambio."
                    )
                );
                ShowORHideAlert(2);
                V_desc = false;
                V_Date = false;
            } else {
                ShowORHideAlert(1);
                id_person = Id; // Id registro
            }
        } else {
            var path = window.location.pathname;
            var segments = path.split("/");
            id_person = segments[segments.length - 1]; // Id persona
        }

        if (V_desc && V_Date) {
            result = {
                Date: $("#New-Data").val(),
                Description: $("#text_Description").val().trim(),
                Id_person: parseInt(id_person),
            };
        }
    }
    return result;
}

/*
    Funcion para mostrar la alerta de confirmacion de la accion que se acaba de realizar 
*/
function ShowInputsEdit(Ids, text) {
    const { Alerta, text_Alert, Show } = Ids;

    if ($(Alerta).hasClass("d-none")) {
        // Alerta
        $(Alerta).removeClass("d-none").hide().fadeIn(400);
    }

    if ($(Show).hasClass("d-none")) {
        // Boton e icono
        $(Show).removeClass("d-none").hide().fadeIn(400);
    }

    $(text_Alert).html(IconWarning(text));
}

/*
    Funcion que muestra una alerta con los errores del controlador
*/
function ShowSpanErrors(Container, span, text) {
    if ($(Container).hasClass("d-none")) {
        $(Container).removeClass("d-none").hide().fadeIn(400);
    }
    $(span).html(IconError(text));
}

/*
    Funcion que hace la peticion al controlador para hacer una insercion
*/
async function Request(Type, Data, Ids) {
    console.log(Data);
    console.log(Type);

    const URL = SwitchRountes(Type);
    let timerInterval;
    try {
        const response = await axios.post(
            "/patients/medical_record/" + URL,
            Data
        );

        $("#add-APP").modal("hide");
        $("#text_Description").val("");
        $("#New-Data").val("");
        ShowInputsEdit(
            Ids,
            " Cambio realizado da clic en <strong> Recargar </strong>."
        );
        ClicRefresh(".btn-refresh", "");
        timerInterval = AlertaSweerAlert(
            2500,
            "¡Éxito!",
            "Registro agregado con éxito",
            "success",
            2
        );
    } catch (error) {
        // ShowErrors;
        const { data } = error.response;
        console.log(data);

        ShowSpanErrors(
            ".Modal-Alert",
            ".Modal-Alert-Text",
            " </strong> ¡Error! </strong> al realizar la peticion."
        );

        await ShowErrors(
            "¡Error!",
            "No fue posible la edición de los datos",
            "error",
            data.errors
        );
    }
}

/*
    Funcion para completar la ruta al controlador 
*/
function SwitchRountes(Type) {
    console.log(Type);
    let Ruta;
    switch (Type) {
        case 1: {
            Ruta = "Add_Hospital";
            break;
        }
        case 2: {
            Ruta = "Add_Transfusion";
            break;
        }
        case 3: {
            Ruta = "Add_Surgery";
            break;
        }
        case 4: {
            Ruta = "Add_Trauma";
            break;
        }
        case 5: {
            Ruta = "Update_Hospital";
            break;
        }
        case 6: {
            Ruta = "Update_Transfusion";
            break;
        }
        case 7: {
            Ruta = "Update_Surgery";
            break;
        }
        case 8: {
            Ruta = "Update_Trauma";
            break;
        }
    }

    return Ruta;
}
