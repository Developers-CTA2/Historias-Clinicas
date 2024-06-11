/*
    Script para gestioner los datos de la cuenta
     Cambiar cotraseña
*/
import { activeLoading, disableLoading } from "../loading-screen.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import { regexPassword } from "../helpers/Regex.js";
import { validarCampo } from "../helpers/ValidateFuntions.js";

$(function () {
    clicChangePass();
    CancelOption();
});

function clicChangePass() {
    $("#Change-pass").off("click");
    $("#Change-pass").on("click", function () {
        $("#cont-change").removeClass("d-none").hide().fadeIn(400);
        validatepass();
        $("#Change-pass").addClass("d-none");
    });
}

function CancelOption() {
    $("#cancel-pass").off("click");
    $("#cancel-pass").on("click", function () {
        $("#cont-change").fadeOut(400, function () {
            $(this).addClass("d-none");
            $("#Change-pass").removeClass("d-none");
            /* Campos vacios */ 
            $("#Pass").val("");
            $("#Confirm").val("");
            $("#New_Pass").val("");
        });
    });
}

function validatepass() {
    $("#verfify-pass").off("click");
    $("#verfify-pass").on("click", function () {
        let pass = $("#Pass").val().trim();
        let V_pass = validarCampo(pass, regexPassword, "#Pass");
        console.log(pass);
        if (V_pass) {
            requestVerifyPass(pass);
        }
    });
}

async function requestVerifyPass(pass) {
    const datos = {
        Pass: pass,
    };

    console.log(datos);
    try {
        //  activeLoading();
        const response = await axios.post("/profile/verify-password", datos);
        console.log(response.data);
        const { data } = response;
        const { status, msg, errors } = data;
        // disableLoading();
        if (status == 200) {
            $("#Alerta_err").fadeOut(250).addClass("d-none");
            $(".cont-pass-1").fadeOut(250).addClass("d-none");
            $(".cont-new-pass").removeClass("d-none");
            $("#save").removeClass("d-none");
            $("#verfify-pass")
                .attr("disabled", "disabled")
                .css("cursor", "no-drop");

            changepassword();
        } else {
            $("#Alerta_err").fadeIn(250).removeClass("d-none");
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}

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

                Confirm(pass);
            } else {
                $("#Alerta_pass").fadeIn(250).removeClass("d-none");

                //Alerta_pass
            }
        }
    });
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(datos) {
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
                //RequestEdit(datos);
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
