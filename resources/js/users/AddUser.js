import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import { regexCorreo, regexNumero, regexCode } from "../helpers/Regex.js";
import { activeLoading, disableLoading } from "../loading-screen.js";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

$(document).ready(function () {
    ClicSearch();
});

/* Funcion para buscar el codigo ingresado */
function ClicSearch() {
    $("#Search").off("click");
    $("#Search").click(function (e) {
        let code = $("#code").val().trim();
        let V_code = validarCampo(code, regexCode, "#code");
        if (V_code) {
            const dataSend = {
                code: code,
            };
            SearchCode(dataSend, code);
        } else {
            console.log("Codigo invalido");
        }
    });
}

async function SearchCode(dataSend, code) {
    console.log(dataSend);
    activeLoading();
    axios
        .post("/users/End-Point-Persons", dataSend)
        .then((response) => {
            const { data } = response.data.data;
            const { respuesta } = response.data;
            console.log(respuesta);
            let p_nombre;
            let p_codigo;
            let p_correo = "";
            if (code.length == 7) {
                const { nombre_trabajador, codigo, correo } = data[0];
                p_nombre = nombre_trabajador;
                p_codigo = codigo;
                p_correo = correo;
            } else {
                const { codigo_estudiante, nombre_estudiante } = data[0];
                p_nombre = nombre_estudiante;
                p_codigo = codigo_estudiante;
            }

            console.log(data);

            TemplateData(p_nombre, p_codigo, p_correo);
            $(".cont-user-data").fadeIn(300).removeClass("d-none");
            $(".buttons-cont").fadeOut(200).addClass("d-none");
        })
        .finally(() => {
            disableLoading();
        })
        .catch((error) => {
            console.log(error.response);
            const { status } = error.response;
            const { message } = error.response.data;
            //  const { data } = error.data;
            console.log(status);
            console.log(message);

            Swal.fire({
                title: "¡Error!",
                text: message,
                icon: "error",
            });

            $(".cont-user-data").addClass("d-none");
            $(".buttons-cont").removeClass("d-none");
        });
}

function TemplateData(name, code, email) {
    $("#R-nombre").text(name);
    $("#R-code").text(code);
    $("#Useremail").val(email);

    ValidateUserData(name, code, email);
}

function ValidateUserData(name, code, email) {
    $("#Usertype").on("change", function () {
        if ($("#save-user").hasClass("d-none")) {
            $("#save-user").fadeIn(500).removeClass("d-none");
        }
        let userType = parseInt($("#Usertype").val());
        console.log(userType);

        if (userType == 1) {
            if ($(".div-cedula").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".div-cedula").fadeIn(500).removeClass("d-none");
            }
        } else {
            if (!$(".div-cedula").hasClass("d-none")) {
                // Agregarle la propiedad si no la tiene
                $(".div-cedula").fadeOut(500).addClass("d-none");
            }
        }

        ClicNewUser(name, code, email, userType);
    });
}

function ClicNewUser(name, code, email, userType) {
    console.log("Esperar");
    $("#save-user").off("click");
    $("#save-user").on("click", function () {
        email = $("#Useremail").val().trim();
        let cedula = "";
        let V_cedula = true;
        if (userType == 1) {
            cedula = $("#Usercedula").val().trim();
          
            V_cedula = validarCampo(cedula, regexNumero, "#Usercedula");
        } else {
            V_cedula = true;
        }
        let V_correo = validarCampo(email, regexCorreo, "#Useremail");
        let V_type = validarCampo(userType, regexNumero, "#Usertype");

        if (V_cedula && V_correo && V_type) {
            const datos = {
                name: name,
                code: code,
                email: email,
                userType: userType,
                cedula: cedula,
            };
            RequestAdd(datos);
        } else {
            console.log(email);

            console.log(V_cedula, V_correo, V_type);
            console.log("Error ");
        }
    });
}

/* Peticion al controlador para cambiar la contraseña */
async function RequestAdd(Data) {
    console.log(Data);

    try {
        activeLoading();
        const response = await axios.post("/users/new-user", Data);
        console.log(response.data);
        const { data } = response;
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
        } else {
            timerInterval = AlertaSweerAlert(2500, "¡Error!", msg, "error", 0);
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}
