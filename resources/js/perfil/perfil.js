/*
    Script para gestionar los datos de la cuenta
     Cambiar cotraseña
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import { AlertaSweerAlert } from "../helpers/Alertas.js";
import { regexPassword } from "../helpers/Regex.js";
import { validarCampo } from "../helpers/ValidateFuntions.js";

import {
    IconInfo,
    IconWarning,
    ShowErrors,
    IconError,
    ClicRefresh,
} from "../templates/ExpedientTemplate.js";

$(function () {
    clicChangePass();
    CancelOption();
});
/*
    Clic para cambiar contraseña
*/
function clicChangePass() {
    $("#Change-pass").off("click");
    $("#Change-pass").on("click", function () {
        ShowOrHide(1);
        validatepass();
    });
}
/*
    Clic cancelar cambio de contraseña
*/
function CancelOption() {
    $("#cancel-pass").off("click");
    $("#cancel-pass").on("click", function () {
        $("#cont-change").fadeOut(300, function () {
            $(this).addClass("d-none");
            $("#Change-pass").removeClass("d-none");
        });
        ShowOrHide(3);
    });
}
/*
    Clic Verificar contraseña actual
*/
function validatepass() {
    $("#Verify-pass").off("click");
    $("#Verify-pass").on("click", function () {
        let pass = $("#Pass").val().trim();
        let V_pass = validarCampo(pass, regexPassword, "#Pass");
        console.log(pass);
        if (V_pass) {
            requestVerifyPass(pass);
        }
    });
}

/*
    Request verificar contraseña ingresada con contreseña actual
*/
async function requestVerifyPass(pass) {
    activeLoading();
    const datos = {
        Pass: pass,
    };
    console.log(datos);
    try {
        const response = await axios.post("/profile/verify-password", datos);
        console.log(response.data);
        const { data } = response;
        const { status, msg, errors } = data;
        disableLoading();
        // contraseña correcta
        if (status == 200) {
            ShowOrHide(2); // mostrar paso 2
            $("#verifify-pass")
                .attr("disabled", "disabled")
                .css("cursor", "no-drop");

            changepassword();
        } else {
            // Contraseña incorrecta
            $(".step1-text").html(
                IconError(
                    " <strong> ¡Error! </strong> la contraseña es incorrecta."
                )
            );
            if ($(".step1-Alert").hasClass("d-none")) {
                $(".step1-Alert").removeClass("d-none").hide().fadeIn(400);
            }
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}
/*
    Mostrar y ocultar los pasos segun el Type que recibe la funcion
*/
function ShowOrHide(Type) {
    if (Type == 1) {
        // Mostrar contenedor de contraseña
        $("#Change-pass").addClass("d-none"); // Ocultar boton
        if ($("#cont-change").hasClass("d-none")) {
            $("#cont-change").removeClass("d-none").hide().fadeIn(400);
        }
    }
    if (Type == 2) {
        // Mostrar paso 2 y ocultar paso 1
        //  Ocultar paso 1
        if (!$(".step1").hasClass("d-none")) {
            $(".step1").addClass("d-none");
        }
        //mostrar paso 2
        if ($(".step2").hasClass("d-none")) {
            $(".step2").removeClass("d-none").hide().fadeIn(400);
        }
        $("#save").removeClass("d-none"); // Mostrar boton
    } else {
        if ($(".step1").hasClass("d-none")) {
            $(".step1").removeClass("d-none").hide().fadeIn(400);
        }
        //ocultar paso 2
        if (!$(".step2").hasClass("d-none")) {
            $(".step2").addClass("d-none");
        }
        $("#Pass").val("");
        $("#Confirm").val("");
        $("#New_Pass").val("");
    }
}

/*
 Funcion para hacer la peticion al controlador y cambiar la contraseña 
*/
function changepassword() {
    $("#save").off("click");
    $("#save").on("click", function () {
        let pass = $("#New_Pass").val().trim();
        let confirm = $("#Confirm").val().trim();
        let V_pass = validarCampo(pass, regexPassword, "#New_Pass");
        let V_confirm = validarCampo(confirm, regexPassword, "#Confirm");
        console.log(pass);
        if (V_pass && V_confirm) {
            if (pass == confirm) {
                $("#Alerta_pass").fadeOut(250).addClass("d-none");

                ShowConfirm(pass);
            } else {
                // No coincide
                $(".step2-text").html(
                    IconError(
                        " <strong> ¡Error! </strong> las contraseñas no coinciden."
                    )
                );
                if ($(".2-Alert").hasClass("d-none")) {
                    $(".2-Alert").removeClass("d-none").hide().fadeIn(400);
                }
            }
        } else {
            // Estructura No valida
            console.log("eSTRUCTURA invalida");
            $(".step2-text").html(
                IconInfo(" <strong> ¡Error! </strong> Contraseña inválida.")
            );
            if ($(".step2-Alert").hasClass("d-none")) {
                $(".step2-Alert").removeClass("d-none").hide().fadeIn(400);
            }
        }
    });
}

/* Funcion para confimar que los datos seran editados  */
async function ShowConfirm(datos) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro cambiar la contraseña?",
            text: "Ahora iniciarás sesión con la nueva contraseña.",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                RequesrChangePass(datos);
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

async function RequesrChangePass(pass) {
    const datos = {
        Pass: pass,
    };
    console.log(datos);
    try {
        // activeLoading();
        const response = await axios.post("/profile/change-password", datos);
        console.log(response.data);
        const { data } = response;
        const { status, msg, errors } = data;
        let timerInterval;
        // disableLoading();
        if (status == 200) {
            timerInterval = AlertaSweerAlert(
                2500,
                "¡Éxito!",
                msg,
                "success",
                1
            );
        } else {
            timerInterval = AlertaSweerAlert(2500, "¡Error!", msg, "error", 0);
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}
