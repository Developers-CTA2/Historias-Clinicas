/*
    Script para cambiar la c9ontraseña de la sesion, en primer lugar se debe poner 
        la contraseña actual si no coincide no te dejará pasar al paso 2 que es agregar unas nueva 
            y confirmar esta misma. 
*/

//const axios = require('axios');

// Tu lógica con Axios aquí
//import axios from "axios";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";
import { TimeAlert } from "./helpers/Alertas.js";

$(document).ready(function () {
    disableLoading();
    newUser();
    validatePassword(); // validar la contraseña
});

/* Funcion para buscar el código del usuario que se pretende agregar, se necesita validar que este en la base de datos */
function newUser() {
    $("#SearchCode").off("click");
    $("#SearchCode").on("click", function () {
        // Obtenemos los datos
        var username = $("#user_name").val().trim();
        /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
        let nombre_u = validarCampo(username, regexCode, "#user_name");

        if (nombre_u) {
            RequestACodeVerify(username);
            // RequestAddUser(name, username, tipoUsuario);
        } else {
            console.log("Error en la validación");
        }
    });
}

/* Funcion para cerra el modal y resetear los inputs */
function closeModalAdd() {
    $(".close_modal").off("click");
    $(".close_modal").on("click", function () {
        console.log("Cerrarara ");
        $("#user_name").val("");
        $("#name").val(" ");

        $("#paso1").removeClass("d-none");
        $(".paso2").addClass("d-none");

        $("#alerta").addClass("d-none");
        $("#Add-User").modal("hide");
        $("#saveUser").show();
    });
}

/* Validar datos del formulario */
function SaveDataNewUser(username, name) {
    closeModalAdd();

    $("#saveUser").off("click");
    $("#saveUser").on("click", function () {
        var tipoUsuario = $("#tipo_user").val();

        if (tipoUsuario != "") {
            RequestAddUser(name, username, tipoUsuario);
        } else {
            console.log("Error en la validación");
        }
    });
}

function closeModalChange() {
    $(".btn-cerrar").off("click");
    $(".btn-cerrar").on("click", function () {
        $("#contrasena").val(""); // Limpiamos el input
        $("#alertMessage").addClass("d-none");
        $("#step-2").addClass("d-none"); // Ocultar en contenedoractual
        $("#step-1").show();
        //$("#changePass").modal("hide");
    });
}
/*Funcion para validar que la contraseña tenga una estructura valida */
function validatePassword() {
    closeModalChange();
    $("#confirmPass").off("click");
    $("#confirmPass").on("click", function (e) {
        e.preventDefault();
        var contrasena = $("#contrasena").val().trim(); // jalamos el dato

        let old_pass = validarCampo(contrasena, regexPassword, "#contrasena");

        if (old_pass) {
            requestVerifyPassword(contrasena);
        } else {
            console.log("Error en la validación");
        }
    });
}

function validateNewPassword() {
    $("#confirm").off("click");
    $("#confirm").on("click", function (e) {
        e.preventDefault();
        console.log("Confirmar pass");
        // Obtenemos los datos de los inputs
        var pass = $("#newpass").val().trim();
        var confirm = $("#confirmpass").val().trim();

        let pass1 = validarCampo(pass, regexPassword, "#newpass");
        let pass2 = validarCampo(confirm, regexPassword, "#confirmpass");
        console.log(pass);
        console.log(confirm);
        if (pass1 && pass2) {
            //     requestVerifyPassword(contrasena);
            if (pass == confirm) {
                console.log("Bien");
                requestChangePass(pass);
            } else {
                $("#alertMessage2")
                    .addClass("alert-danger")
                    .removeClass("d-none");
                $(".texto").text("Las contraseñas no coinciden.");
            }
        } else {
            console.log("Error en la validación");
        }
    });
}

/* Funcion para enviar los datos al controlador para agregar un nuevo usuario al sistema y asignarle su rol de una vez*/
async function RequestAddUser(nombre, codigo, tipo) {
    activeLoading();
    const datos = {
        nombre,
        codigo,
        tipo,
    };
    console.log(datos);
    try {
        const response = await axios.post("/agregar-usuario", datos);
        const { data } = response;
        const { status, msg } = data;
        disableLoading();
        if (status == 200) {
            $("#alerta").addClass("alert-success").removeClass("d-none");
            $(".texto").text(msg);
            $("#saveUser").hide();
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else if (status == 202) {
            $("#alerta").addClass("alert-danger").removeClass("d-none");
            $(".texto").text(msg);
        } else {
            $("#alerta").addClass("alert-danger").removeClass("d-none");
            $(".texto").text(msg);
        }
    } catch (error) {
        disableLoading;
        // Swal.fire({
        //     title: "¡Error!",
        //     text: "Algo salio mal, intentalo otra vez.",
        //     icon: "error",
        // });
        console.log(error);
    }
}
/* Funcion para verificar la contraseña ingresada con la contraseña actual */
async function requestVerifyPassword(pass) {
    activeLoading();
    const datos = {
        pass,
    };
    try {
        const response = await axios.post("/Verify-password", datos);
        const { data } = response;
        const { status, msg } = data;
        disableLoading();
        if (status == 200) {
            // Correcto paso 2
            $("#step-2").removeClass("d-none"); // Ocultar en contenedoractual
            $("#step-1").hide();
            $("#confirm").removeClass("d-none"); // Ocultar en contenedoractual
            validateNewPassword();
        } else if (status == 404) {
            //No coincide Mostrar error
            $("#alertMessage").addClass("alert-danger").removeClass("d-none");
            $(".texto").text(msg);
        }
    } catch (error) {
        disableLoading;
        // Swal.fire({
        //     title: "¡Error!",
        //     text: "Algo salio mal, intentalo otra vez.",
        //     icon: "error",
        // });
        console.log(error);
    }
}

/*
    Funcion para resetear la contraseña de la sesion 
*/
async function requestChangePass(password) {
    activeLoading();
    let timerInterval;
    const datos = {
        Password: password,
    };

    try {
        const response = await axios.post("/Change-password", datos);
        const { data } = response;
        const { status, msg } = data;
        disableLoading();
        if (status == 200) {
            console.log("Aqui");
            $("#saveUser").hide();

             timerInterval = TimeAlert(4000, "¡Éxito!", msg, "success", 1);
        } else if (status == 202) {
            $("#alertMessage2").addClass("alert-danger").removeClass("d-none");
            $(".texto").text(msg);
        } else {
            $("#alertMessage2").addClass("alert-danger").removeClass("d-none");
            $(".texto").text(msg);
        }
    } catch (error) {
        disableLoading;
        console.log(error);
    }
}

/* Funcion  para verificar que el codigo si este en la base de datos*/
async function RequestACodeVerify(code) {
    activeLoading();
    const datos = {
        code,
    };

    try {
        const response = await axios.post("/verificar-codigo", datos);
        const { data } = response;
        const { status, msg } = data;
        console.log(data.code);
        disableLoading();
        let timerInterval;
        if (status == 200) {
            $("#paso1").addClass("d-none");
            $("#code_U").text(data.code);
            $("#name").text(msg);
            $(".paso2").removeClass("d-none");
            SaveDataNewUser(data.code, msg);
        } else if (status == 202) {
            // El usuario ya existe 
            Swal.fire({
                title: "¡Error!",
                text: msg,
                icon: "error",
                confirmButtonText: "Cerrar",
            });
        }
    } catch (error) {
        disableLoading;
        timerInterval = TimeAlert(
            3000,
            "¡Error!",
            "Algo salio mal, intentalo otra vez.",
            "error",
            0
        );

        console.log(error);
    }
}
