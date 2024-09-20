import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "../loading-screen.js";
import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import {
    regexCorreo,
    regexNumero,
    TimeAlert,
    regexCedula,
    ShowOrHideAlert,
} from "../helpers";
import { showErrorsAlert, IconError } from "../templates/AlertsTemplate.js";

/*
    Script para la gestion de los usuarios, donde de puede hacer un update de los datos
*/
$(document).ready(function () {
    console.log("Users");
    listenSelect();
    ClicEditUser();
    closeModal();
});

function listenSelect() {
    console.log("select");
    $("#user-type").on("change", function () {
        const userType = $(this).val();
        console.log(userType);
        
        if (userType === "1") { // Doctor Obliga cedula
         console.log("Quitar disabled");
    
            $("#m-cedula").prop("disabled", false); // Habilitar el campo
        } else {
            console.log("Agregar disabled");
           
            $("#m-cedula").prop("disabled", true); // Deshabilitar el campo
        }
    });
}


/* Funcion para el evento de clic el boton de editar */
function ClicEditUser() {
    $("#EditUser").off("click");
    $("#EditUser").click(function (e) {
        ValidateData();
    });
}

function closeModal() {
    $(".cerrar-btn").off("click");
    $(".cerrar-btn").click(function (e) {
        // Ocultar ambas alertas
        ShowOrHideAlert(1, ".Alerta_user");
    });
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(datos) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            text: "Revisa que los datos sean correctos",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, editar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                RequestEdit(datos);
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

/* Funcion para validar los datos ingresados en el modal de edición */
function ValidateData() {
    var email = $("#m-email").val().trim();
    var cedula = $("#m-cedula").val().trim();
    var type = $("#user-type").val();
    var status = $("#m-estado").val();

    let V_email = validarCampo(email, regexCorreo, "#m-email");
    let V_type = validarCampo(type, regexNumero, "#user-type");
    let V_status = validarCampo(status, regexNumero, "#m-estado");
    console.log(cedula);

    let V_cedula = true;
    if (type == 1) {  // es admin 
       if (type == 1) {
           if (cedula !== "") { // validar cedula 
               V_cedula = validarCampo(cedula, regexCedula, "#m-cedula");
           } else {  // forzar el false
               V_cedula = validarCampo("", regexCedula, "#m-cedula");
           }
       }
    } else {
        // No tiene cedula 
        V_cedula = true;
        ocultarerr("#m-cedula");
    }

    let old_cedula = $("#Cedula").text();
    if (old_cedula == "--") {
        old_cedula = "";
    }
    let old_status = $("#User_Status").text();
    if (old_status == "Activo") {
        old_status = 1;
    } else {
        old_status = 2;
    }

    let old_rol = $("#User_Role").text();
    if (old_rol == "Administrador") {
        old_rol = 1;
    } else if (old_rol == "Prestador de medicina") {
        old_rol = 2;
    } else {
        old_rol = 3;
    }

    console.log($("#User_Role").text());
    console.log(email, cedula, type, status);
    console.log($("#email").text(), old_cedula, old_rol, old_status);

    /* No hay cambios */
    if (
        email == $("#email").text() &&
        cedula == old_cedula &&
        status == old_status &&
        type == old_rol
    ) {
        // $("#Alerta_err").fadeIn(250).removeClass("d-none");
        $(".Alerta_user_text").html(
            IconError(
                "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
            )
        );
        ShowOrHideAlert(2, ".Alerta_user");
        //$("#Alerta_err").fadeIn(250).removeClass("d-none");
    } else {
        if (V_cedula && V_email && V_type && V_status) {
            ShowOrHideAlert(1, ".Alerta_user");
            window.id = $("#detalles-container").data("id");

            const datos = {
                Id: id,
                Cedula: cedula,
                Email: email,
                Status: status,
                Type: type,
            };
            Confirm(datos);
        }
    }
}

/* Peticion al controlador para cambiar la contraseña */
async function RequestEdit(Data) {
    try {
        const response = await axios.post("/users/edit-user", Data);
        console.log(response.data);
        const { data } = response;
        const { status, msg } = data;
        let timerInterval;
        disableLoading();

        timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        const { type, msg, errors } = error.response.data;

        if (type == 1) {
            let timerInterval;

            timerInterval = TimeAlert(2500, "¡Error!", msg, "error", 1);
        } else {
            console.log(errors);
            showErrorsAlert(errors, ".errorAlert", ".errorList");
        }

        console.log(error);
    }
}
