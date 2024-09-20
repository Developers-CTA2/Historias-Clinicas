import {
    IconInfo,
    IconWarning,
    ShowErrorsSweet,
    IconError,
    Confirm,
    ClicRefresh,
} from "../../templates";

import { validarCampo, regexDescription } from "../../helpers";

const ValuesAllergy = {
    select: {
        old: "",
        new: "",
    },
    description: {
        old: "",
        new: "",
    },
};

$(document).ready(function () {
    Select2Diseases();
    ListenEventDiseases();
    ListenEventAllergies();
    console.log("dffddfd");
});

/*
    Funcion para escuchar los eventos en el caso de estar editando una enfermedad
*/
function ListenEventDiseases() {
    CloseCollapse(".cerrar", "#Diseases_APP");
    let Ids = {
        btn: ".Save-changes",
        select: "#New_disease",
        description: "",
        Alerta: ".Diseases",
        text_Alert: ".Disease-Text",
    };

    $($(".add-Disease")).on("click", function () {
        $(".Old_disease").text("Selecciona una enfermedad");
        console.log("Add ");
        ClicButtonSave(1, "", Ids, "", ""); // 1 = Disease-store
    });
    ClicEdit(Ids);
    ClicDeleteData(3, "#Delete-Disease");
}

/*
    Funcion para escuchar los eventos en el caso de estar editando un registro de una alergia
*/
function ListenEventAllergies() {
    CloseCollapse(".cerrar", "#Allergies_APP");
    let Ids = {
        btn: ".save-Allergy",
        select: "#New_allergy",
        description: "#Description",
        Alerta: ".Allergies",
        text_Alert: ".Allergy-Text",
        Text_Collapse: ".Old_disease",
    };

    $($(".add-Allergy")).on("click", function () {
        $(".Old_allergy").text("Selecciona una alergia");
        $("#Allergies_APP").collapse("show");
        ClicButtonSave(4, "", Ids, "", ""); // 4 = Allergy-store
    });

    ClicEditAllergy(Ids);
}

/* Inicializar los selects para las ediciones de los datos */
function Select2Diseases() {
    $("#New_disease").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: "100%",
    });

    $("#New_allergy").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: "100%",
    });
}
/*
    Funcion que muestra en tiempo real lo que se seleccione en el select de las enfermedades
*/
function listenSelect2() {
    $("#New_disease").on("keyup", function () {
        $(".Old_disease").removeClass("text-muted");
        $(".Old_disease").text($("#New_disease option:selected").text()); // mostrar texto
    });
}
/* Mostrar en el collapse el dato seleccionado */
function ShowCollapseData(Cont, text) {
    $(Cont).text(text); // mostrar texto
    $(Cont).removeClass("text-muted").addClass("font-weight-normal"); // quitar estilos
}
/*
    Funcion para cerrar el Collapse de las enfermedades
*/
function CloseCollapse(btn, Idcont) {
    $(btn).on("click", function () {
        $(".Old_disease").text("Selecciona una enfermedad");
        $(Idcont).collapse("hide");
    });
}

/*
Funcion para editar los datos de una enfermedad 
*/
function ClicEdit(Ids) {
    const { btn, select, text_Alert, description, Alerta } = Ids;
    $(".edit-APP").off("click");
    $(".edit-APP").on("click", function () {
        var Id_reg = $(this).data("id_reg");
        var name = $(this).data("name");
        var Id_ahf = $(this).data("id_app");
        // Mostrar los datos anteriores
        $(".Old_disease").text(name);
        $(".Type-accion").text("Modificar enfermedad");
        // verificar que si haya cambios
        $(select).on("change", function () {
            //mostrar en tiempo real el dato
            ShowCollapseData(
                ".Old_disease",
                $("#New_disease option:selected").text()
            );
            if (!$(Alerta).hasClass("d-none")) {
                $(Alerta).addClass("d-none").hide().fadeOut(400);
            }
            console.log("Old " + Id_ahf + "New " + $(select).val());
            if (Id_ahf == $(select).val()) {
                // Todo igual regresar cambios
                $(".Old_disease")
                    .removeClass("font-weight-normal")
                    .addClass("text-muted");

                $(text_Alert).html(IconInfo(" No se realizó  ningun cambio."));
                if ($(Alerta).hasClass("d-none")) {
                    $(Alerta).removeClass("d-none").hide().fadeIn(400);
                }
            } else {
                if (!$(Alerta).hasClass("d-none")) {
                    $(Alerta).addClass("d-none");
                }
                ClicButtonSave(2, Id_reg, Ids, "", ""); // 2 = Disease-edit
            }
        });
        /* Dio clic sin hacer ningun cambio*/
        $(btn).off("click");
        $(btn).on("click", function () {
            if ($(select).val() == null) {
                $(text_Alert).html(IconInfo(" No se realizó  ningun cambio."));
                if ($(Alerta).hasClass("d-none")) {
                    $(Alerta).removeClass("d-none").hide().fadeIn(400);
                }
            } else {
                if (!$(Alerta).hasClass("d-none")) {
                    $(Alerta).addClass("d-none");
                }
            }
        });
    });
}
/*  Funcion que mustra los datos en el Collapse cuando se va a editar una alergia */
function ClicEditAllergy(Ids) {
    $(".Edit-Allergy").off("click");
    $(".Edit-Allergy").on("click", function () {
        var Id_reg = $(this).data("id_reg");
        var id_alergia = $(this).data("id_alergia");
        var name = $(this).data("name");
        var TextDescription = $(this).data("description").trim();

        // Mostrar los datos anteriores
        $(".Old_allergy").text(name);
        $(".Type-accion").text("Modificar alergia");
        $("#Description").text(TextDescription);

        ClicButtonSave(5, Id_reg, Ids, TextDescription, id_alergia); // 5 = Allergy-edit
    });
}

/*  
    Funcion para el evento de clic al boton de guardar que esta en el collapse 
    Valida el dato que se seleccione en el select y si esta correcto mandará a llamar a la funcion para hacer la peticion
    ya sea un Store o un Update 
*/
function ClicButtonSave(Type, Id_reg, Id_options, textdescr, Id_Old_alergia) {
    const { btn, select, Alerta, text_Alert, description } = Id_options;
    listenSelect2();
    console.log(select);

    ListenSelctAllergy(select);

    //$(".Save-changes").off("click");
    $(btn).on("click", function () {
        console.log();
        if (Type <= 3) {
            console.log(select, text_Alert, Alerta);
            // Diseases
            let opc = ClicValidateData(select, text_Alert, Alerta);
            console.log(opc);
            if (opc != 0) {
                Confirm(
                    "¿Estás seguro de realizar la acción?",
                    "El nuevo dato será parte del expediente.",
                    "warning"
                ).then((isConfirmed) => {
                    if (isConfirmed) {
                        Request(Type, Id_reg, opc, "");
                    }
                });
            }
        } else {
            // console.log(btn, select, Alerta, text_Alert, description, Type);

            ValuesAllergy.select.old = Id_Old_alergia;
            ValuesAllergy.description.old = textdescr;

            let opc;
            let V_description;
            ValuesAllergy.description.new = $("#Description").val().trim();

            let textDescription = $("#Description").val().trim();

            console.log("old " + Id_Old_alergia);

            if (Type == 4) {
                // Agregra un alergia Validar ambos datos
                opc = ClicValidateData(select, text_Alert, Alerta);
                V_description = validarCampo(
                    textDescription,
                    regexDescription,
                    description
                );
            } else {
                // Editar un registro existente

                //console.log("NEW " + NewAllergyId + "  Old " + Id_Old_alergia);

                

                if (
                    (ValuesAllergy.select.new == "" ||
                        ValuesAllergy.select.old == ValuesAllergy.select.new) &&
                    ValuesAllergy.description.old ==
                        ValuesAllergy.description.new
                ) {
                    console.log("NO ");
                    $(text_Alert).html(
                        IconInfo("No se realizó  ningun cambio.")
                    );
                    if ($(Alerta).hasClass("d-none")) {
                        $(Alerta).removeClass("d-none").hide().fadeIn(400);
                    }
                    opc = 0;
                } else {
                    console.log("Correcto")
                    V_description = validarCampo(
                        textDescription,
                        regexDescription,
                        description
                    );
                    opc = ValuesAllergy.select.new == "" ?  ValuesAllergy.select.old : ValuesAllergy.select.new;
                }
            }

            if (opc != 0 && V_description == true) {
                Confirm(
                    "¿Estás seguro de realizar la acción?",
                    "El nuevo dato será parte del expediente.",
                    "warning"
                ).then((isConfirmed) => {
                    if (isConfirmed) {
                        Request(Type, Id_reg, opc, textDescription);
                    }
                });
            }
        }
    });
}

function ListenSelctAllergy(select) {
    $(select).off("change");
    $(select).on("change", function () {
        ValuesAllergy.select.new = $(this).val();
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
    Funcion para borrar una enfermedad del expediente de la persona 
*/
function ClicDeleteData(Type, btn) {
    $(document).on("click", btn, function () {
        var Id_reg = $(this).data("id_reg");
        console.log(Id_reg);

        if (Id_reg != "") {
            Confirm(
                "¿Estás seguro de realizar la acción?",
                "El dato será eliminado del expediente.",
                "warning"
            ).then((isConfirmed) => {
                if (isConfirmed) {
                    Request(Type, Id_reg, "", "");
                    console.log("Borrar");
                }
            });
        }
    });
}
/*
    Funcion para mostrar la alerta de confirmacion de la accion que se acaba de realizar 
*/
function ShowConfirmation(Container, span, text) {
    if ($(Container).hasClass("d-none")) {
        $(Container).removeClass("d-none").hide().fadeIn(400);
    }
    $(span).html(IconWarning(text));
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
async function Request(Type, Id_reg, Id, Description) {
    console.log(Type);
    var path = window.location.pathname;
    var segments = path.split("/");
    var id_person = segments[segments.length - 1];

    const Data = {
        Id_person: parseInt(id_person),
        Id_reg: parseInt(Id_reg),
        Id: parseInt(Id),
        Description: Description,
    };
    console.log(Data);

    const data = SwitchRountes(Type);
    const { Route, IdContainer, span, collapse, btn } = data;
    console.log(data);
    try {
        const response = await axios.post(
            "/patients/medical_record/" + Route,
            Data
        );
        $(collapse).collapse("hide"); // Cerrar collapse
        ShowConfirmation(
            IdContainer,
            span,
            " Cambio realizado da clic en <strong> Recargar </strong>."
        );

        ClicRefresh(".btn-refresh", btn);
        $("#btn-refresh-page").removeClass("d-none");
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

        await ShowErrorsSweet(
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
            btn: ".icon-refresh-Diseases",
        };
    } else if (Type == 2) {
        result = {
            Route: "Update_Disease",
            IdContainer: ".Diseases",
            span: ".Disease-Text",
            collapse: "#Diseases_APP",
            btn: ".icon-refresh-Diseases",
        };
    } else if (Type == 3) {
        result = {
            Route: "Delete_Disease",
            IdContainer: ".Diseases",
            span: ".Disease-Text",
            collapse: "#Diseases_APP",
            btn: ".icon-refresh-Diseases",
        };
    } else if (Type == 4) {
        /// Alergias
        result = {
            Route: "Add_Allergy",
            IdContainer: ".Allergies",
            span: ".Allergy-Text",
            collapse: "#Allergies_APP",
            btn: ".icon-refresh-Allergy",
        };
    } else if (Type == 5) {
        result = {
            Route: "Update_Allergy",
            IdContainer: ".Allergies",
            span: ".Allergy-Text",
            collapse: "#Allergies_APP",
            btn: ".icon-refresh-Allergy",
        };
    }
    return result;
}
