import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import { VerifyChanges, automaicScroll } from "../helpers/funcionValidate.js";
import { validarCampo } from "../../helpers/ValidateFuntions.js";
import {
    regexLetters,
    regexFecha,
    regexTelefono,
    regexNss,
    regexNumbersAndLetters,
    regexCp,
    regexNumeroEntero,
} from "../../helpers/Regex.js";
import { TimeAlert } from "../../helpers/Alertas.js";

import {
    IconInfo,
    IconWarning,
    HideAnimation,
} from "../../templates/AlertsTemplate.js";

$(document).ready(function () {
    console.log("Editar datos personales");
    EventEditPersonal();
    InitiliazeSelect();
    EventEditAPP();
});

/* Funcion para inicializar el select2 de estados */
function InitiliazeSelect() {
    $("#new_state").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: "100%",
    });
}

/* 
Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditPersonal() {
    $("#Edit-personal").on("change", function () {
        const isChecked = $("#Edit-personal").is(":checked");
        if (isChecked) {
            $(".P-data").html(IconInfo("Ahora estás en modo de edición."));
            $(".personal-data").removeClass("d-none").hide().fadeIn(400);
            $(".top-content").css("margin-top", "0", "!important");
            console.log($("#code").text());

            /* No pertenece a la UDG */
            let old = ObtainOldPersonalData();
            let oldDirection = ObtainOldDirectionData();
            console.log($("#code").text().trim());
            if ($("#code").text().trim() == "--") {
                ShowInputs(0, old, oldDirection);
            } else {
                ShowInputs(1, old, oldDirection);
            }

            $(".W-data").addClass("text-secondary"); // Poner en gris el dato antiguo
        } else {
            /* Cancelar edicion */
            $(".W-data").removeClass("text-secondary"); // quitar el gris
            // Ocultar
            HideAnimation(".personal-data");
            HideAnimation(".input-optional");
            HideAnimation(".input-show");

            console.log("Modo lectura");
        }
    });
    clicCancelPD();
}
/* 
    Funcion para mostrar los inputs que tienen ciertas clases 
    input-optional y input-show
*/
function ShowInputs(Type, Personal, Direction) {
    //  console.log(Personal);
    if (Type == 1) {
        $(".input-show").removeClass("d-none").hide().fadeIn(400);
    } else {
        /* Todos los inputs */
        $(".input-optional").removeClass("d-none").hide().fadeIn(400);
        $(".input-show").removeClass("d-none").hide().fadeIn(400);
        console.log("NO pertenece a la UDG");
    }
    EventSave(Personal, Direction);
}

/* 
    Funcion de cancelar edicion que ocultará todos los inputs de edicion
*/
function clicCancelPD() {
    $("#cancel_PD").off("click");
    $("#cancel_PD").on("click", function () {
        $("#Edit-personal").prop("checked", false);
        $(".W-data").removeClass("text-secondary"); // quitar el gris
        /* Cancelar edicion */
        HideAnimation(".personal-data");
        HideAnimation(".input-optional");
        HideAnimation(".input-show");
    });
}
/*
    Funcion para el evento de guardar cambios, donde elvaluará si hay cambios en los datos 
*/
function EventSave(Personal, Direction) {
    $("#savePD").off("click");
    $("#savePD").on("click", function () {
        let newData;
        if ($("#code").text().trim() != "--") {
            newData = ObtainNewPersonalData(0);
        } else {
            // si tiene codigo
            newData = ObtainNewPersonalData(1);
        }

        let newDirection = ObtainNewDirectionData();
        // Datos personales
        let personal = VerifyChanges(newData, Personal);
        let direction = VerifyChanges(newDirection, Direction);

        console.log(newDirection);
        console.log(Direction);

        // let edicion = 0;
        // No hay ningun cambio
        if (personal && direction) {
            console.log("nO HAY CAMBIOSSS");
            $(".P-data").html(
                IconWarning(
                    " <strong>Ooops! </strong> parece que no haz realizado ningun cambio."
                )
            );
            automaicScroll("#main-container");
        } else if (personal && !direction) {
            // cambio en direccion
            console.log("Cambio en direccion");
            validateObjets(2, Personal, newDirection);

            //edicion = 2;
        } else if (!personal && direction) {
            // cambio en personal
            console.log("Cambio en personal");
            validateObjets(1, newData, Direction);
            //  edicion = 1;
        } else {
            // Cambio en ambos
            console.log("Cambio en ambos");
            validateObjets(3, newData, newDirection);

            //edicion = 3;
        }
    });
}

/* Obtener los antiguos datos (Datos personales) */
function ObtainOldPersonalData() {
    let OldData = {
        name: $("#name").text().trim(),
        // code: $("#code").text().trim(),
        tel: $("#tel").text().trim(),
        gender: $("#gender").text().trim(),
        school: $("#escolaridad").text().trim(),
        birthday: $("#birthday").text().trim(),
        religion: $("#religion").text().trim(),
        ocupation: $("#ocupation").text().trim(),
        nss: $("#nss").text().trim(),
        name_e: $("#name_e").text().trim(),
        tel_e: $("#tel_e").text().trim(),
        parent_e: $("#parent_e").text().trim(),
    };

    return OldData;
}

/* Obtener los antiguos datos (Datos de la direccion) */
function ObtainOldDirectionData() {
    let num_int;
    if ($("#int").text().trim() == "--") {
        num_int = "";
    } else {
        num_int = $("#int").text().trim();
    }
    console.log(num_int);
    let OldDirection = {
        country: $("#country").text().trim(),
        state: $("#state").text().trim(),
        city: $("#city").text().trim(),
        colony: $("#colony").text().trim(),
        cp: $("#cp").text().trim(),
        street: $("#street").text().trim(),
        ext: $("#ext").text().trim(),
        int: num_int,
    };
    return OldDirection;
}

/* Obtener los nuevos datos (Datos de la direccion) */
function ObtainNewDirectionData() {
    let newDirecion = {
        country: $("#new_country").val().trim(),
        state: $("#new_state").val(),
        city: $("#new_city").val().trim(),
        colony: $("#new_colony").val().trim(),
        cp: $("#new_cp").val().trim(),
        street: $("#new_street").val().trim(),
        ext: $("#new_ext").val().trim(),
        int: $("#new_int").val().trim(),
    };
    return newDirecion;
}

/* Obtener los nuevos datos (Datos personales) */
function ObtainNewPersonalData() {
    let gender;
    /* Si tiene codigo el genero no puede cambiar */
    if ($("#code").text().trim() != "--") {
        gender = $("#gender").text().trim();
    } else {
        let aux = $("#new_gender").val();
        if (aux == 1) {
            gender = "Masculino";
        } else {
            gender = "Femenino";
        }
    }

    let Data = {
        name: $("#new_name").val().trim(),
        // code: $("#new_code").val().trim(),
        tel: $("#new_tel").val().trim(),
        gender: gender,
        school: $("#new_escolaridad").val(),
        birthday: $("#new_birthday").val().trim(),
        religion: $("#new_religion").val().trim(),
        ocupation: $("#new_ocupation").val().trim(),
        nss: $("#new_nss").val().trim(),
        name_e: $("#new_name_e").val().trim(),
        tel_e: $("#new_tel_e").val().trim(),
        parent_e: $("#new_parent_e").val().trim(),
    };
    return Data;
}
/*
    Funcion que válida cada uno de los datos que se ingresaron en los inputs
*/
function validateObjets(opc, personal, direction) {
    let PersonalData;
    let DirectionData;
    switch (opc) {
        case 1: {
            // Cambio en datos personales
            PersonalData = ValidatePersonalData(personal);
            if (PersonalData) {
                Confirm(personal, direction, opc);
                console.log("Datos Correctos");
            } else {
                $(".P-data").html(
                    IconInfo(
                        "<strong>Error! </strong> algunos datos son erróneos."
                    )
                );

                automaicScroll("#main-container");
            }
            break;
        }
        case 2: {
            // cambio de direccion
            DirectionData = ValidateDirectionData(direction);
            if (DirectionData) {
                Confirm(personal, direction, opc);

                console.log("Datos Correctos");
            } else {
                $(".P-data").html(
                    IconInfo(
                        "<strong>Error! </strong> algunos datos son erróneos."
                    )
                );
                automaicScroll("#main-container");
            }
            break;
        }
        case 3: {
            // Personales y Direccion
            PersonalData = ValidatePersonalData(personal);
            DirectionData = ValidateDirectionData(direction);
            if (DirectionData && PersonalData) {
                Confirm(personal, direction, opc);

                console.log("Datos Correctos");
            } else {
                $(".P-data").html(
                    IconInfo(
                        "<strong>Error! </strong> algunos datos son erróneos."
                    )
                );
                automaicScroll("#main-container");
            }
            break;
        }
    }
}

/*
    Funcion que valida con las expresiones regulares los datos personales 
*/
function ValidatePersonalData(personal) {
    console.log(personal.school);
    let V_name = validarCampo(personal.name, regexLetters, "#new_name");
    let V_gender = validarCampo(personal.gender, regexLetters, "#new_gender");
    let V_tel = validarCampo(personal.tel, regexTelefono, "#new_tel");
    let V_birthday = validarCampo(
        personal.birthday,
        regexFecha,
        "#new_birthday"
    );
    let V_ocupation = validarCampo(
        personal.ocupation,
        regexLetters,
        "#new_ocupation"
    );
    let V_nss = validarCampo(personal.nss, regexNss, "#new_nss");
    let V_religion = validarCampo(
        personal.religion,
        regexLetters,
        "#new_religion"
    );
    let V_name_e = validarCampo(personal.name_e, regexLetters, "#new_name_e");
    let V_tel_e = validarCampo(personal.tel_e, regexTelefono, "#new_tel_e");
    let V_parent_e = validarCampo(
        personal.parent_e,
        regexLetters,
        "#new_parent_e"
    );

    let V_school = validarCampo(
        personal.school,
        regexNumeroEntero,
        "#new_escolaridad"
    );

    if (
        V_birthday &&
        V_gender &&
        V_name &&
        V_name &&
        V_nss &&
        V_ocupation &&
        V_religion &&
        V_tel &&
        V_name_e &&
        V_tel_e &&
        V_parent_e &&
        V_school
    ) {
        console.log("Datos Correctos");
        return true;
    } else {
        console.log("Error en la validacion");
        return false;
    }
}

/*
    Funcion que valida con expresiones regulares los datos que corresponden al domicilio de la persona
*/
function ValidateDirectionData(direction) {
    let V_country = validarCampo(
        direction.country,
        regexLetters,
        "#new_country"
    );
    let V_state = validarCampo(
        direction.state,
        regexNumeroEntero,
        "#new_state"
    );
    let V_city = validarCampo(direction.city, regexLetters, "#new_city");
    let V_colony = validarCampo(direction.colony, regexLetters, "#new_colony");
    let V_cp = validarCampo(direction.cp, regexCp, "#new_cp");
    let V_street = validarCampo(direction.street, regexLetters, "#new_street");
    let V_ext = validarCampo(direction.ext, regexNumeroEntero, "#new_ext");
    let V_int = true;
    if (direction.int != "") {
        V_int = validarCampo(direction.int, regexNumbersAndLetters, "#new_int");
    }

    if (
        V_country &&
        V_state &&
        V_city &&
        V_colony &&
        V_cp &&
        V_street &&
        V_ext &&
        V_int
    ) {
        return true;
    } else {
        return false;
    }
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(Personal, Direction, Type) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            text: "Asegurate que los datos sean correctos.",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                RequestUpdate(Personal, Direction, Type);
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

/*
    Funcion que llama al controlador para hacer el update de los datos del paciente
*/
async function RequestUpdate(Personal, Direction, Type) {
    var path = window.location.pathname;
    var segments = path.split("/");
    var id = segments[segments.length - 1];

    console.log("Editar los datos ");
    const Data = {
        Personal: Personal,
        Direction: Direction,
        Type: parseInt(Type),
        Id: parseInt(id),
        Id_dom: parseInt($("#id_dom").text().trim()),
    };
    console.log(Data);
    let timerInterval;
    try {
        const response = await axios.post(
            "/patients/medical_record/Update_Personal_Data",
            Data
        );
        console.log(response.data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;

        timerInterval = TimeAlert(
            2500,
            "¡Éxito!",
            "Datos actualizados correctamente.",
            "success",
            1
        );
    } catch (error) {
        timerInterval = TimeAlert(
            2500,
            "¡Error!",
            "Algo salio mal, intentalo más tarde",
            "error",
            0
        );
        console.log(error);
    }
}

/*
    HABILITAR LA EDICION DE APP
    Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAPP() {
    $("#Edit-APP").on("change", function () {
        const isChecked = $("#Edit-APP").is(":checked");
        if (isChecked) {
            var path = window.location.pathname;
            var segments = path.split("/");
            var id = segments[segments.length - 1];
            window.location.href = "/patients/medical_record/APP/" + id;
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
