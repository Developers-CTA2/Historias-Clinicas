import { VerifyChanges, automaicScroll } from "../helpers/funcionValidate.js";
import { validarCampo } from "../../helpers/ValidateFuntions.js";
import {
    RegexPositiveNumer,
    regexAnio,
    regexLetters,
    regexFecha,
    regexDescription,
} from "../../helpers/Regex.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert } from "../../helpers/Alertas.js";
import {
    IconInfo,
    HideAnimation,
    IconWarning,
    ShowErrors,
    IconError,
} from "../../templates/ExpedientTemplate.js";

$(document).ready(function () {
    console.log("Editar datos GYO");
    EventEditGyo();
});

/* 
Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditGyo() {
    $("#Edit-Gyo").on("change", function () {
        const isChecked = $("#Edit-Gyo").is(":checked");
        if (isChecked) {

            ShowORHideAlert(2);
            $(".Gyo-Text").html(IconInfo("Ahora estás en modo de edición."));
            let OldData = ObtainOldData();
            ShowORHideAlert(2, OldData);
            console.log(OldData);

            $(".Old-Data").addClass("text-secondary"); // Poner en gris el dato antiguo
        } else {
            /* Cancelar edicion */

            ShowORHideAlert(1, "");
            console.log("Modo lectura");
        }
    });
    ClicCancelGyo();
}

/*
    Funcion para mostrar u ocultar la alerta de edicion
*/
function ShowORHideAlert(Type, OldData) {
    if (Type == 1) {
        // Ocultar alerta
        if (!$(".Gyo").hasClass("d-none")) {
            HideAnimation(".Gyo");
        }
        // Ocultar Inputs
        if (!$(".input-Gyo").hasClass("d-none")) {
            HideAnimation(".input-Gyo");
        }
    } else {
        //mostrar alerta
        if ($(".Gyo").hasClass("d-none")) {
            $(".Gyo").removeClass("d-none").hide().fadeIn(400);
        }
        //mostrar inputs

        if ($(".input-Gyo").hasClass("d-none")) {
            $(".input-Gyo").removeClass("d-none").hide().fadeIn(400);
        }
        ClicSaveGyo(OldData);
    }
}

/* 
    Funcion de cancelar edicion que ocultará todos los inputs de edicion
*/
function ClicCancelGyo() {
    $("#cancel_Gyo").off("click");
    $("#cancel_Gyo").on("click", function () {
        $("#Edit-Gyo").prop("checked", false);
        $(".W-data").removeClass("text-secondary"); // quitar el gris
        ShowORHideAlert(1, "");
    });
}

/*
    Funcion para el evento de guardar cambios, donde elvaluará si hay cambios en los datos 
*/
function ClicSaveGyo(OldData) {
    $("#Save_Gyo").off("click");
    $("#Save_Gyo").on("click", function () {
        console.log("Clic guardar");
        let NewData = ObtainNewData();
        console.log("Nuevos");
        console.log(NewData);
        /* Verificar si hay cambios en los datos */
        let changes = VerifyChanges(NewData, OldData);
        if (changes) {
            // No hay cambios
            $(".Gyo-Text").html(
                IconWarning(
                    "<strong>Ooops! </strong> parece que no haz realizado ningun cambio."
                )
            );
            automaicScroll("#Cont_APP");
        } else {
            // Si hay cambios validar los nuevos datos
            console.log("Si hay cambios");
            let Datos = ValidatePersonalData(NewData);
            console.log(Datos);

            if (Datos) {
                ShowConfirm(NewData); // Datos correctos
            }
        }
    });
}

/* Obtener los antiguos datos GYO */
function ObtainOldData() {
    let OldData = {
        menarca: $("#menarca").text().trim(),
        menstruacion: $("#last_m").text().trim(),
        gest: $("#s_gest").text().trim(),
        ciclos: $("#ciclos").text().trim(),
        dias_1: $("#dias_1").text().trim(),
        dias_2: $("#dias_2").text().trim(),
        last_c: $("#last_c").text().trim(),
        mast: $("#mast").text().trim(),
        met: $("#met").text().trim(),
        inicio: $("#inicio").text().trim(),
        parejas: $("#parejas").text().trim(),
        gestas: $("#gestas").text().trim(),
        partos: $("#partos").text().trim(),
        cesareas: $("#cesareas").text().trim(),
        abortos: $("#abortos").text().trim(),
    };

    return OldData;
}

/* Obtener los nuevos datos GYO */
function ObtainNewData() {
    let NewData = {
        menarca: $("#new_menarca").val().trim(),
        menstruacion: $("#new_last_m").val().trim(),
        gest: $("#new_s_gest").val().trim(),
        ciclos: $("#new_ciclos").val(),
        dias_1: $("#new_dias_1").val().trim(),
        dias_2: $("#new_dias_2").val().trim(),
        last_c: $("#new_last_c").val().trim(),
        mast: $("#new_mast").val().trim(),
        met: $("#new_met").val().trim(),
        inicio: $("#new_inicio").val().trim(),
        parejas: $("#new_parejas").val().trim(),
        gestas: $("#new_gestas").val().trim(),
        partos: $("#new_partos").val().trim(),
        cesareas: $("#new_cesareas").val().trim(),
        abortos: $("#new_abortos").val().trim(),
    };

    return NewData;
}

/*
    Funcion que valida con las expresiones regulares los datos 
*/
function ValidatePersonalData(data) {
    let V_menstruacion;
    let V_last_c;
    let V_mast;
    let V_menarca = validarCampo(
        data.menarca,
        RegexPositiveNumer,
        "#new_menarca"
    );
    V_menstruacion = validarCampo(data.menstruacion, regexFecha, "#new_last_m");
    let V_s_gest = validarCampo(data.gest, RegexPositiveNumer, "#new_s_gest");
    let V_ciclos = validarCampo(data.ciclos, regexLetters, "#new_ciclos");
    let V_dias_1 = validarCampo(data.dias_1, RegexPositiveNumer, "#new_dias_1");
    let V_dias_2 = validarCampo(data.dias_2, RegexPositiveNumer, "#new_dias_2");
    V_last_c = validarCampo(data.last_c, regexAnio, "#new_last_c");
    V_mast = validarCampo(data.mast, regexAnio, "#new_mast");
    let V_met = validarCampo(data.met, regexDescription, "#new_met");
    let V_inicio = validarCampo(data.inicio, RegexPositiveNumer, "#new_inicio");
    let V_parejas = validarCampo(
        data.parejas,
        RegexPositiveNumer,
        "#new_parejas"
    );
    let V_gestas = validarCampo(data.gestas, RegexPositiveNumer, "#new_gestas");
    let V_partos = validarCampo(data.partos, RegexPositiveNumer, "#new_partos");
    let V_cesareas = validarCampo(
        data.cesareas,
        RegexPositiveNumer,
        "#new_cesareas"
    );
    let V_abortos = validarCampo(
        data.abortos,
        RegexPositiveNumer,
        "#new_abortos"
    );

    let Fecha = $("#actualDate").text().trim();
    console.log(Fecha);
    console.log(data.menstruacion);
    let anios = Fecha.split("-")[0];
    console.log(anios);
    // console.log("Fecha" + data.last_c);
    if (data.menstruacion > Fecha) {
        console.log("Error fecha");
        V_menstruacion = validarCampo("", regexFecha, "#new_last_m");
    }

    if (data.last_c > anios) {
        console.log("Error fecha");
        V_last_c = validarCampo("", regexAnio, "#new_last_c");
    }
    if (data.mast > anios) {
        console.log("Error fecha");
        V_mast = validarCampo("", regexAnio, "#new_mast");
    }

    if (
        V_menarca &&
        V_menstruacion &&
        V_s_gest &&
        V_ciclos &&
        V_dias_1 &&
        V_dias_2 &&
        V_last_c &&
        V_mast &&
        V_met &&
        V_inicio &&
        V_parejas &&
        V_gestas &&
        V_partos &&
        V_abortos &&
        V_cesareas
    ) {
        HideAnimation(".Gyo");
        console.log("Datos Correctos");
        return true;
    } else {
        $(".Gyo-Text").html(
            IconInfo("<strong>¡Error! </strong> algunos datos son erróneos.")
        );

        return false;
    }
}

/* Funcion para confimar que los datos seran editados  */
async function ShowConfirm(Data) {
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
                RequestUpdate(Data);
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
async function RequestUpdate(Datos) {
    var path = window.location.pathname;
    var segments = path.split("/");
    var id = segments[segments.length - 1];
    let id_Reg = $("#idRegister").text();
    console.log("Editar los datos ");

    const Data = {
        Data: Datos,
        Id_persona: parseInt(id),
        Id_reg: parseInt(id_Reg),
    };

    console.log(Data);
    let timerInterval;
    try {
        const response = await axios.post(
            "/patients/medical_record/Update_Gyo",
            Data
        );
        console.log(response.data);
        const { data } = response;
        const { title, msg } = data;

        timerInterval = AlertaSweerAlert(2500, title, msg, "success", 1);
    } catch (error) {
        const { type, msg, errors } = error.response.data;

        ShowORHideAlert(2);
        $(".Gyo-Text").html(
            IconError(
                "<strong>Ooops! </strong> algo salio mal, intentalo más tarde."
            )
        );

        await ShowErrors(
            "¡Error!",
            "No fue posible la edición de los datos",
            "error",
            errors
        );
        console.log(error);
    }
}
