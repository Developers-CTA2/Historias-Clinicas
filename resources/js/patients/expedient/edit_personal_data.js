import { VerifyChanges, automaicScroll } from "../helpers/funcionValidate.js";
import { validarCampo } from "../../helpers/ValidateFuntions.js";
import {
    regexNumero,
    regexLetters,
    regexFecha,
    regexTelefono,
    regexNss,
    regexNumbersAndLetters,
    regexCp,
    regexNumeroEntero,
} from "../../helpers/Regex.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert } from "../../helpers/Alertas.js";

$(document).ready(function () {
    console.log("Editar datos personales");
    EventEditPersonal();
});

/* 
Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditPersonal() {
    $("#Edit-personal").on("change", function () {
        const isChecked = $("#Edit-personal").is(":checked");
        if (isChecked) {
            $(".text-alert").html(
                '<svg class="pe-2" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><circle cx="24" cy="24" r="21" fill="#2196F3" /><path fill="#fff" d="M22 22h4v11h-4z" /><circle cx="24" cy="16.5" r="2.5" fill="#fff" /></svg> Ahora estás en modo de edición.'
            );
            $(".personal-data").removeClass("d-none").hide().fadeIn(400);
            $(".top-content").css("margin-top", "0", "!important");
            console.log($("#code").text());

            /* No pertenece a la UDG */
            let old = ObtainOldPersonalData();
            let oldDirection = ObtainOldDirectionData();
            if ($("#code").text().trim() == "--") {
                ShowInputs(0, old, oldDirection);
            } else {
                ShowInputs(1, old, oldDirection);
            }
            console.log("Modo edicion");
        } else {
            /* Cancelar edicion */
            CoverContents();

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
    console.log(Personal);
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

/* Funcion para ocultar los conetenedores em caso de cancelar la edicion */
function CoverContents() {
    $(".personal-data")
        .addClass("animate__fadeOutUp")
        .fadeOut(400, function () {
            $(this).addClass("d-none").removeClass("animate__fadeOutUp");
        });

    $(".input-optional")
        .addClass("animate__fadeOutUp")
        .fadeOut(400, function () {
            $(this).addClass("d-none").removeClass("animate__fadeOutUp");
        });

    $(".input-show")
        .addClass("animate__fadeOutUp")
        .fadeOut(400, function () {
            $(this).addClass("d-none").removeClass("animate__fadeOutUp");
        });
}
/* 
    Funcion de cancelar edicion que ocultará todos los inputs de edicion
*/
function clicCancelPD() {
    $("#cancel_PD").off("click");
    $("#cancel_PD").on("click", function () {
        $("#Edit-personal").prop("checked", false);

        /* Cancelar edicion */
        CoverContents();
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

        console.log(personal);
        console.log(direction);

        let edicion = 0;
        // No hay ningun cambio
        if (personal && direction) {
            $(".text-alert").html(
                '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m14.839 5.668l-12.66 21.93c-.51.89.13 2.01 1.16 2.01h25.32c1.03 0 1.67-1.11 1.16-2.01l-12.66-21.93c-.52-.89-1.8-.89-2.32 0"/><path fill="#000" d="M14.599 21.498a1.4 1.4 0 1 0 2.8-.01v-9.16c0-.77-.62-1.4-1.4-1.4c-.77 0-1.4.62-1.4 1.4zm2.8 3.98a1.4 1.4 0 1 1-2.8 0a1.4 1.4 0 0 1 2.8 0"/></g></svg> <strong>Ooops! </strong> parece que no haz realizado ningun cambio.'
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

        console.log(newData);
        console.log(Personal);

        console.log(newDirection);
        console.log(Direction);
    });
}

/* Obtener los antiguos datos (Datos personales) */
function ObtainOldPersonalData() {
    let OldData = {
        name: $("#name").text().trim(),
        // code: $("#code").text().trim(),
        tel: $("#tel").text().trim(),
        gender: $("#gender").text().trim(),
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
    if ($("#int").val().trim() == "--") {
        num_int = "";
    } else {
        num_int = $("#int").val().trim();
    }
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
        state: $("#new_state").val().trim(),
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
        if(aux == 1){gender = 'Masculino'}else{gender = 'Femenino'}
    }

    let Data = {
        name: $("#new_name").val().trim(),
        // code: $("#new_code").val().trim(),
        tel: $("#new_tel").val().trim(),
        gender: gender,
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
                $(".text-alert").html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 512 512"><path fill="#FF473E" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg> <strong>Error! </strong> Error, algunos datos son erróneos.'
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
                $(".text-alert").html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 512 512"><path fill="#FF473E" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg> <strong>Error! </strong> Error, algunos datos son erróneos.'
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
                $(".text-alert").html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 512 512"><path fill="#FF473E" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg> <strong>Error! </strong> Error, algunos datos son erróneos.'
                );
                automaicScroll("#main-container");
            }
            break;
        }
    }
}

function ValidatePersonalData(personal) {
    console.log(personal.gender);
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
        V_parent_e
    ) {
        console.log("Datos Correctos");
        return true;
    } else {
        console.log("Error en la validacion");
        return false;
    }
}

function ValidateDirectionData(direction) {
    let V_country = validarCampo(
        direction.country,
        regexLetters,
        "#new_country"
    );
    let V_state = validarCampo(direction.state, regexLetters, "#new_state");
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
            "/patients/expediente/Upadate_Personal_Data",
            Data
        );
        console.log(response.data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;

        timerInterval = AlertaSweerAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        timerInterval = AlertaSweerAlert(
            2500,
            "¡Error!",
            "Algo salio mal, intentalo más tarde",
            "error",
            0
        );
        console.log(error);
    }
}