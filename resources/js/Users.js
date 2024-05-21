import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import {AlertaSweerAlert} from "./helpers/Alertas.js";

import { activeLoading, disableLoading } from "./loading-screen.js";

$(document).ready(function () {
    disableLoading();

    buscarUsuario(); // buscar
    resetPass(); // clic en card de resetear contraseña
    confirmDelete();
    confirmEdit();
});

/* Buscar mediante ajax coincidencias en la barra de busqueda */
function buscarUsuario() {
    $("#search").on("keyup", function () {
        // lo que se escribe en la barra de búsqueda
        var searchTerm = $(this).val().toLowerCase(); // obtener valor
        var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados

        $(".user-card").each(function () {
            // Selecciona los elementos de la clase user-card y comienza un bucle (each) que recorre cada una de las tarjetas.
            var userName = $(this).find(".card-header h5").text().toLowerCase();
            var dependencyName = $(this) // busca en user_name o dependencia
                .find(".card-body h6")
                .text()
                .toLowerCase();

            if (
                userName.indexOf(searchTerm) !== -1 ||
                dependencyName.indexOf(searchTerm) !== -1
            ) {
                $(this).show(); // muestra las tarjetas que coinciden con la búsqueda
                resultadosEncontrados = true; // Se encontraron resultados
            } else {
                $(this).hide(); // oculta las tarjetas que no coinciden
            }
        });

        // Comprueba si no se encontraron resultados y muestra un mensaje en consecuencia
        if (!resultadosEncontrados) {
            $("#no-results-message").show(); // Muestra el mensaje "No hay resultados"
        } else {
            $("#no-results-message").hide(); // Oculta el mensaje "No hay resultados"
        }
    });
}

/*  Clic en resetear contraseña de algun usuario */
function resetPass() {
    $(".confirmReset").off("click");
    $(".confirmReset").click(function (e) {
        const nombreUsuario = $(this).data("id"); // jalamos el nombre de usuario
        $("#confirmationModal").modal("show"); // mostrar modal de confirmacion

        confirmarModal(nombreUsuario); // mandar nombre de usuario
    });
}

/*  Clic en resetear contraseña de algun usuario */
function confirmDelete() {
    $(".confirmDelet").off("click");
    $(".confirmDelet").click(function (e) {
        const nombreUsuario = $(this).data("id"); // jalamos el nombre de usuario
        $("#confirmDelete").modal("show"); // mostrar modal de confirmacion

        confirmarModalDelete(nombreUsuario);
    });
}

/*  Clic en editar los datos de un usuario */
function confirmEdit() {
    $(".confirmEdit").off("click");
    $(".confirmEdit").click(function (e) {
        const IdUsuario = $(this).data("id");
        const username = $(this).data("username");
        const name = $(this).data("name");
        const role = $(this).data("role");

        $("#EditData").modal("show"); // mostrar modal para editar los datos del usuario

        // Mostrar los valores
        $("#user_nameE").val(username);
        $("#nameE").val(name);
        $(`input[name='Tipo_UsuarioE'][value='${role}']`).prop("checked", true);

        saveEdit(IdUsuario);
        //console.log(IdUsuario, username, name, role);
    });
}

/*  Clic en boton de confirmar en el modal, donde de manda el username al ajax para resetearlo */
function confirmarModal(usuario) {
    $("#boton-confirm").off("click");
    $("#boton-confirm").click(function () {
        $("#confirmationModal").modal("hide"); // mostrar modal de confirmacion
        requestResetPass(usuario);
    });
}

/*  Clic en boton de confirmar en el modal, donde de manda el username al ajax para resetearlo */
function confirmarModalDelete(usuario) {
    $("#boton-delete").off("click");
    $("#boton-delete").click(function () {
        $("#confirmDelete").modal("hide"); // mostrar modal de confirmacion
        requestDelete(usuario);
    });
}

function saveEdit(Id) {
    $("#guardar-edit").off("click");
    $("#guardar-edit").click(function (e) {
        console.log("Editar datos ");

        // Jalamos los nuevos datos
        var Code = $("#user_nameE").val().trim();
        var Name = $("#nameE").val().trim();
        var tipoUsuario = $('input[name="Tipo_UsuarioE"]:checked').val();

        let ValCode = validarCampo(Code, regexCode, "#user_nameE");
        let ValName = validarCampo(Name, regexLetters, "#nameE");

        /* Validamos los datos */
        if (ValCode && ValName) {
            requestEdit(Id, Code, Name, tipoUsuario);
        }
    });
}

/* Peticion al controlador para cambiar la contraseña */
async function requestResetPass(Username) {
    activeLoading();

    const datos = {
        Name: Username,
    };
    console.log(datos);

    try {
        const response = await axios.post("/reset-password", datos);
        const { data } = response;
        const { status, msg } = data;
         let timerInterval;
        disableLoading();
        if (status == 200) {
           
            //Alerta de confirmacion
           
            timerInterval = AlertaSweerAlert(
                2000,
                "¡Éxito!",
                msg,
                "success",
                0
            ); 
            // showModalWithMessage("¡Éxito!", msg, 4000);
        } else {
          
           timerInterval = AlertaSweerAlert("¡Error!", msg, "error", 0);
        }
    } catch (error) {
        disableLoading();
        //Alerta de confirmacion
       
        timerInterval = AlertaSweerAlert(
            3000,
            "¡Error!",
            "Algo salio mal, intentalo otra vez.",
            "error",
            0
        );

        console.log(error);
    }
}

/* Peticion al controlador para eliminar a un usuario */
async function requestDelete(Username) {

 activeLoading();

    const datos = {
        Codigo: Username,
    };
    console.log(datos);

    try {
        const response = await axios.post("/eliminar-usuario", datos);
        const { data } = response;
        const { status, msg } = data;
         let timerInterval;
        disableLoading();
        if (status == 200) {
           
            //Alerta de confirmacion
            timerInterval = AlertaSweerAlert(
                2000,
                "¡Éxito!",
                msg,
                "success",
                0
            ); 
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
          
           timerInterval = AlertaSweerAlert("¡Error!", msg, "error", 0);
        }
    } catch (error) {
        disableLoading();
        //Alerta de confirmacion
       
        timerInterval = AlertaSweerAlert(
            3000,
            "¡Error!",
            "Algo salio mal, intentalo otra vez.",
            "error",
            0
        );

        console.log(error);
    }





function requestEdit(id_usuario, Code, Nombre_Usuario, Rol_usuario) {
    console.log(id_usuario, Rol_usuario);
    $.ajax({
        type: "POST",
        url: "editar-usuario", // Ruta desde la vista Blade
        data: {
            Id: id_usuario,
            Username: Code,
            Name: Nombre_Usuario,
            Rol: Rol_usuario,
            _token: $('meta[name="csrf-token"]').attr("content"), // token
        },
        success: function (response) {
            const { status, msg } = response;
            console.log(response);
            if (status == 200) {
                $("#EditData").modal("hide"); // Ocultar el modal de confirmacion
                //Alerta de confirmacion
                let timerInterval;
                timerInterval = AlertaSweerAlert(
                    2000,
                    "¡Éxito!",
                    msg,
                    "success",
                    0
                );
                //showModalWithMessage("¡Éxito!", msg, 4000);
            } else {
                $("#EditData").modal("hide"); // Ocultar el modal de confirmacion
                //showModalWithMessage("¡Error!", msg, 4000);
                //Alerta de confirmacion
                let timerInterval;
                timerInterval = AlertaSweerAlert(
                    2000,
                    "¡Error!",
                    msg,
                    "Error",
                    0
                );
            }
        },
        error: function () {
            //Alerta de confirmacion
            let timerInterval;
            timerInterval = AlertaSweerAlert(
                3000,
                "¡Error!",
                "Hubo un error en el sistema, por favor intenta más tarde.",
                "Error",
                0
            );
        },
    });
}

/* Modal para mostrar exito o error */
function showModalWithMessage(estado, texto, time) {
    // Cambia el texto del modal con el mensaje recibido
    $("#title").text(estado);
    $("#texto-info").text(texto);
    // Muestra el modal
    $("#InfoModal").modal("show");

    // Cerrar el modal después de 3 segundos y recargar la página
    setTimeout(function () {
        location.reload(); // Esto recargará la página
    }, time);
}

