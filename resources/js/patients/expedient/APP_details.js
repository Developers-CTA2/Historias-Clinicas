import {
    IconInfo,
    IconWarning,
    ShowErrors,
    IconError,
    Confirm,
} from "../../templates/ExpedientTemplate.js";
import { validarCampo, regexNumero } from "../../helpers";

$(document).ready(function () {
    console.log("Editar APP");
    InitiliazeSelect1();
    CloseCollapse();
    ClicSaveDisease(1, ""); // 1 = Disease-store
    EventEditDisease();
});

/* Inicializar el selct de las enfermedades */
function InitiliazeSelect1() {
    $("#New_disease").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: "100%",
    });
}
/*
    Funcion para cerrar el Collapse de las enfermedades
*/
function CloseCollapse() {
    $(".cerrar").on("click", function () {
        $("#Diseases_APP").collapse("hide");
    });
}

/* Funcion para Agregar una enfermedad */
function EventEditDisease() {
    $(".edit-APP").off("click");
    $(".edit-APP").on("click", function () {
        var Id_reg = $(this).data("id_reg");
        var name = $(this).data("name");
        var Id_ahf = $(this).data("id_app");

        // Mostrar los datos anteriores
        $(".Old_disease").text(name);
        $(".Type-accion").text("Modificar enfermedad");

        // verificar que si haya cambios
        $("#New_disease").on("change", function () {
            //moostrar en tiempo real el dato
            ShowCollapseData(
                ".Old_disease",
                $("#New_disease option:selected").text()
            );

            if (Id_ahf == $("#New_disease").val()) {
                // Todo igual regresar cambios
                $(".Old_disease")
                    .removeClass("font-weight-normal")
                    .addClass("text-muted");

                $(".Disease-Text").html(
                    IconInfo(" No se realizó  ningun cambio.")
                );
            } else {
                ClicSaveDisease(2, Id_reg); // 2 = Disease-edit
            }
        });
    });
}

/* Mostrar en el collapse el dato seleccionado */
function ShowCollapseData(Cont, text) {
    $(Cont).text(text); // mostrar texto
    $(Cont).removeClass("text-muted").addClass("font-weight-normal"); // quitar estilos
}

/*  
    Funcion para validar el dato que se seleccione en el select y si esta correcto mandará a llamar a la funcion para hacer la peticion
    ya sea un Store o un Update 
*/
function ClicSaveDisease(Type, Id_reg) {
    listenSelect2();

    $(".Save-changes").off("click");
    $(".Save-changes").on("click", function () {
        let opc = ClicValidateData(
            "#New_disease",
            ".Disease-Text",
            ".Diseases"
        );
        if (opc != 0) {
            Confirm(
                "¿Estás seguro sde realizar la acción?",
                "El nuevo dato será parte del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    RequestAdd(Type, Id_reg, opc, "");
                }
            });
        }
        console.log(opc);
    });
}

function listenSelect2() {
    $("#New_disease").on("change", function () {
        $(".Old_disease").removeClass("text-muted");
        $(".Old_disease").text($("#New_disease option:selected").text()); // mostrar texto
    });
}

/*
    Validar que haya algo en el select al dar clic al guardar
*/
function ClicValidateData(Id, Span, Container) {
    if ($(Id).val() == "" || $(Id).val() == null) {
        console.log("Nooo hay dato");
        $(Span).html(IconInfo("No se realizó  ningun cambio."));

        if ($(Container).hasClass("d-none")) {
            $(Container).removeClass("d-none").hide().fadeIn(400);
        }
        return 0;
    } else {
        return $(Id).val();
    }
}

/*
    Funcion que hace la peticion al controlador para hacer una insercion
*/
async function RequestAdd(Type, Id_reg, Id, Descrption) {
    console.log(Type);
    var path = window.location.pathname;
    var segments = path.split("/");
    var id_person = segments[segments.length - 1];

    const Data = {
        Id_person: parseInt(id_person),
        Id_reg: parseInt(Id_reg),
        Id: parseInt(Id),
        Descrption: Descrption,
    };

    try {
        const data = SwitchRountes(Type);
        const { Route, IdContainer, span, collapse } = data;
        console.log(data);

        // Peticion
        const response = await axios.post(
            "/patients/medical_record/" + Route,
            Data
        );

        console.log(response);

        $(collapse).collapse("hide"); // Cerrar collapse

        ShowConfirmation(
            IdContainer,
            span,
            " Recarga la página para ver los cambios."
        );

        ClicRefresh();
    } catch (error) {
        // ShowErrors;
        console.log(error);
        const { errors } = error.response.data;
        console.log(IdContainer);
        console.log(span);
        ShowSpanErrors(
            IdContainer,
            span,
            " </strong> ¡Error! </strong> al realizar la peticion."
        );

        await ShowErrors(
            "¡Error!",
            "No fue posible la edición de los datos",
            "error",
            errors
        );
    }
}

/*
    Funcion para completar la ruta al controlador 
*/
function SwitchRountes(Type) {
    let result = {};
    if (Type == 1) {
        result = {
            Route: "Add_Disease",
            IdContainer: ".Diseases",
            span: ".Disease-Text",
            collapse: "#Diseases_APP",
        };
    } else if (Type == 2) {
        result = {
            Route: "Update_Disease",
            IdContainer: ".Diseases",
            span: ".Disease-Text",
            collapse: "#Diseases_APP",
        };
    }
    return result;
}
/* Funcion para recargar la pagina y ver los cambios refeljados ya en la vista */
function ClicRefresh() {
    $(".icon-refresh").removeClass("d-none");

    $(".btn-refresh").off("click");
    $(".btn-refresh").on("click", function () {
        console.log("Refrescar pagina ");
        window.location.reload();
    });
}

function ShowConfirmation(Container, span, text) {
    if ($(Container).hasClass("d-none")) {
        $(Container).removeClass("d-none").hide().fadeIn(400);
    }
    $(span).html(IconWarning(text));
}

function ShowSpanErrors(Container, span, text) {
    console.log("Errpsasa");
    if ($(Container).hasClass("d-none")) {
        $(Container).removeClass("d-none").hide().fadeIn(400);
    }
    $(span).html(IconError(text));
}

// function ShowErrors(Type) {
//     if (Type == 1) {
//         if ($("#Diseases").hasClass("d-none")) {
//             $("#Diseases").removeClass("d-none").hide().fadeIn(400);
//         }
//         $(".Disease-Text").html(
//             IconWarning(" Recarga la página para ver los cambios.")
//         );
//     } else {
//     }
// }
