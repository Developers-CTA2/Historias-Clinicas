import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import { regexCorreo, regexNumero, regexCode } from "../helpers/Regex.js";
import { activeLoading, disableLoading } from "../loading-screen.js";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import { getPerson } from '../helpers/request-get-person.js';
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { dragAndDropFile } from "../helpers/drag-and-drop-file.js";


let typePerson = 1;

const dataPersonWebService = {
    code: '',
    name: '',
    dependency: ''
}

let isCalledDragAndDrop = false;

$(document).ready(function () {
    ClicSearch();
});

/* Upload file */
function uploadFile(){
    !isCalledDragAndDrop && dragAndDropFile();

    isCalledDragAndDrop = true;
}

/* Funcion para buscar el codigo ingresado */
function ClicSearch() {
    $("#Search").off("click");
    $("#Search").click(function (e) {
        console.log("Buscar");
        let code = $("#code").val().trim();



        if (validarCampo(code, regexCode, "#code") && (code.length == 7 || code.length == 9)) {

            // Clear the data of the person
            dataPersonWebService.code = '';
            dataPersonWebService.name = '';
            dataPersonWebService.dependency = '';

            typePerson = code.length == 7 ? typePerson = 1 : typePerson = 2;

            getPerson({ code, type: typePerson }).then(({ data }) => {
                if (typePerson == 1) {
                    const { codigo, nombramiento, nombre } = data.worker;
                    dataPersonWebService.code = codigo;
                    dataPersonWebService.dependency = nombramiento;
                    dataPersonWebService.name = nombre;

                } else {
                    const { codigo, carrera, nombre } = data.student;
                    dataPersonWebService.code = codigo;
                    dataPersonWebService.dependency = carrera;
                    dataPersonWebService.name = nombre;
                }

                TemplateData(dataPersonWebService.name, dataPersonWebService.code, '');
                $(".cont-user-data").removeClass("d-none");
                $(".buttons-cont").addClass("d-none");
                uploadFile();
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
    
    
    $("#save-user").off("click");
    $("#save-user").on("click", function () {
        email = $("#Useremail").val().trim();
        let file = $('#upload-image')[0].files[0];
        let cedula = "";
        let V_cedula = true;
        let v_file = true;
        if (userType == 1) {
            cedula = $("#Usercedula").val().trim();

            V_cedula = validarCampo(cedula, regexNumero, "#Usercedula");
        } else {
            V_cedula = true;
        }
        let V_correo = validarCampo(email, regexCorreo, "#Useremail");
        let V_type = validarCampo(userType, regexNumero, "#Usertype");

        if(!file){
            v_file = false;
        }

        

        if (V_cedula && V_correo && V_type && v_file) {

            const formData = new FormData();
            formData.append('file', file);
            formData.append('name', name);
            formData.append('code', code);
            formData.append('email', email);
            formData.append('userType', userType);
            formData.append('cedula', cedula);
            RequestAdd(formData);
        } else {
            console.log(email);

            console.log(V_cedula, V_correo, V_type, v_file);
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
