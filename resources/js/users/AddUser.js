import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import { regexCorreo, regexNumero, regexCode } from "../helpers/Regex.js";
import { activeLoading, disableLoading } from "../loading-screen.js";
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
            SearchCode(dataSend);
        } else {
            console.log("Codigo invalido");
        }
    });
}

/* ADAPTAR ESTA FUNCION 
    Funcion para buscar el código    
*/
// function SearchCode(code) {
//     let status = 200;

//     if (status == 200) {
//         $(".cont-user-data").fadeIn(300).removeClass("d-none");
//         $(".buttons-cont").fadeOut(200).addClass("d-none");
//     } else {

//     }
// }

async function SearchCode(dataSend) {
    console.log(dataSend);
    activeLoading();
    axios
        .post("/End-Point-Persons", dataSend)
        .then((response) => {
            const { data } = response.data.data;
            const { respuesta } = response.data;
            console.log(respuesta);

            const { nombre_trabajador, codigo, correo } = data[0];
            console.log(data);

            console.log("Correcto");
            console.log(nombre_trabajador);

            TemplateData(nombre_trabajador, codigo, correo);
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
    //R-nombre
    $("#R-nombre").text(name);
    $("#R-code").text(code);
    $("#Useremail").val(email);
}
