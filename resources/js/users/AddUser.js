import { validarCampo, ocultarerr } from "../helpers/ValidateFuntions.js";
import { regexCorreo, regexNumero, regexCode } from "../helpers/Regex.js";

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
              SearchCode(code);
          } else {
              console.log("Codigo invalido")
          }
      });
}


/* ADAPTAR ESTA FUNCION 
    Funcion para buscar el código    
*/
function SearchCode(code) {
    let status = 200;

    if (status == 200) {
        $(".cont-user-data").fadeIn(300).removeClass("d-none");
        $(".buttons-cont").fadeOut(200).addClass("d-none");
    } else {
        
    }
}


