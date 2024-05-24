import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import { activeLoading, disableLoading } from "../loading-screen.js";
import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import { regexCorreo, regexNumero } from "../helpers/Regex.js";

$(document).ready(function () {
    console.log("Users")
    //EditUser
    ClicEditUser();
});

function ClicEditUser() {
    $("#EditUser").off("click");
    $("#EditUser").click(function (e) {
        ValidateData()
        //Confirm();
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
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                RequestEdit(datos)
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

/* Funcion para validar los datos ingresados en el modal de edición */ 
function ValidateData() {
    // Jalamos los nuevos datos
    //let V_email = validarCampo($("#email").val().trim(), regexCorreo, "#email");

    var email = $("#m-email").val().trim();
    var cedula = $("#m-cedula").val().trim();
    var type = $("#user-type").val();
    var status = $("#m-estado").val();

    let V_email = validarCampo(email, regexCorreo, "#m-email");
    let V_type = validarCampo(type, regexNumero, "#user-type");
    let v_status = validarCampo(status, regexNumero, "#m-estado");
    console.log(cedula)
    let V_cedula = true;
    if (cedula !== "") {
        V_cedula = validarCampo(cedula, regexNumero, "#m-cedula");
    } else {
        V_cedula = true;
        ocultarerr("#m-cedula")
    }
    console.log(V_cedula)

    if (V_cedula, V_email, V_type, v_status) {
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

/* Peticion al controlador para cambiar la contraseña */
async function RequestEdit(Data) {
    console.log(Data);
    
    try {
        activeLoading();
        const response = await axios.post("/edit-user", Data);
        console.log(response.data)
        const { data } = response
        const { status, msg, errors } = data;
        let timerInterval;
        disableLoading();
       
        if (status == 200) {
           
            timerInterval = AlertaSweerAlert(
                2500,
                "¡Éxito!",
                msg,
                "success",
                1
            );

        } else if(status == 202){
             showErrors(errors);
        }
    } catch (error) {
        disableLoading();
        console.log("Error")
        console.log(error)
    }
}


function showErrors(errors){
    if (errors) {
        const errorList = $('#errorList');
        errorList.empty(); // Limpiar la lista de errores existente
        $.each(errors, function (key, value) {
            // Agregar cada mensaje de error como un elemento de lista a la lista de errores
            $.each(value, function (index, errorMessage) {
                errorList.append($('<li>').text(errorMessage));
            });
        });
        // Mostrar la alerta de error
        $('#errorAlert').show();
    }
}













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
}




 
 