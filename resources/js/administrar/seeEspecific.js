//import {grid} from './helpers/PersonalGridTable'
import { Grid, html, h } from "gridjs";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import "gridjs/dist/theme/mermaid.css";

import { activeLoading, disableLoading } from "../loading-screen.js";
import {
    regexLetters,
    regexNumero,
} from "../helpers/Regex.js";

import { 
    className,
    translations,
} from '../helpers/gridJsConfiguration.js';

import { validarCampo, ShowOrHideAlert } from "../helpers/ValidateFuntions.js";
import { AlertConfirmationForm, AlertError, TimeAlert} from '../helpers/Alertas.js';

import {
    IconInfo,
    showErrorsAlert,
    IconError,
} from "../templates/AlertsTemplate.js";


$(function () {
    initialData();
    AddNewDisease();
});

async function initialData() {
    try {
        activeLoading();
        new Grid({
            columns: [
                {
                    id: "Tipo",
                    name: "Tipo",
                    hidden: true,
                },
                {
                    id: "Especifica",
                    name: "Especifica",
                    hidden: true,
                },
                {
                    id: "name",
                    name: "Enfermedad",

                    formatter: (_, row) =>
                        html(
                            `<div class="fw-bold">${row.cells[2].data}</div>
                                <div>${row.cells[3].data}</div>`
                        ),
                },
                {
                    id: "actions",
                    name: html('<p class="mb-0 text-center">Acciones</p>'),
                    formatter: (_, row) =>
                        html(
                            `<div class="d-flex justify-content-center">
                            <button class="btn-blue-sec fst-normal py-2 px-3 edit-disease" data-type="${row.cells[0].data}" data-n_type="${row.cells[3].data}" data-n_esp="${row.cells[2].data}" data-esp="${row.cells[1].data}" data-bs-toggle="modal" data-bs-target="#Details-diseasse">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                Editar
                             </div>`
                        ),
                    sort : false,
                },
            ],

            // Configuración del grid js
            pagination: {
                limit: 10,
                server: {
                    url: (prev, page, limit) =>
                        `${prev}&limit=${limit}&offset=${page * limit}`,
                },
            },
            search: {
                enabled: true,
                placeholder: "Buscar...",
                className: "form-control ",
                debounceTimeout: 1000,
                server: {
                    url: (prev, keyword) => `${prev}&search=${keyword}`,
                },
            },
            server: {
                url: "/admin/obt-specific-diseases?",
                then: (data) => {
                    console.log("Datos del servidor:", data);
                    // Mapear los datos según tu lógica

                    return data.results.map((results) => [
                        results.id_tipo_ahf,
                        results.id_especifica_ahf,
                        results.nombre,
                        results.tipo_ahf.nombre,
                    ]);
                },
                total: (data) => {
                    return data.count;
                },
                catchError: (error) => {
                    console.log(error);
                },
            },

            className: className,
            autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
            sort: {
                enabled: true,
                multiColumn: false,
                initialColumn: 0,
            },
            resizable: true,
            language: translations,
        }).render(document.getElementById("Tabla-Especific-Diseases"));
    } catch (error) {
        console.log(error);
    } finally {
        disableLoading();
    }
}

/* Funcion para agregar una nueva enfermedad especifica */
function AddNewDisease() {
    $("#Add_disease").off("click");
    $("#Add_disease").click(function (e) {
        const type = $("#S_type").val();
        const name = $("#New_nombre").val();

        console.log(name);
        let V_type = validarCampo(type, regexNumero, "#S_type");
        let V_name = validarCampo(name, regexLetters, "#New_nombre");
        if (name != "" && type != "") {
            if (V_name && V_type) {
                ShowOrHideAlert(1, ".Alerta_specific");
                // $("#Alerta_add").fadeOut(250).addClass("d-none"); /// Ocultar
                AlertConfirmationForm('¿Estás seguro de agregarla?', 'Asegurate que los datos sean correctos.', ()=> RequestAdd(name, type));
            }
        } else {
            // Mostrar
            console.log("fdfdfdfd");
            $(".Alerta_specific_text").html(
                IconInfo(
                    "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
                )
            );
            ShowOrHideAlert(2, ".Alerta_specific");
            // $(".Alerta_specific").fadeIn(250).removeClass("d-none");
        }
    });
}



/* Funcion para cuando se le de clic al boton de editar enfermedad */
$(document).on("click", ".edit-disease", function () {
    const type = $(this).data("type");
    const n_type = $(this).data("n_type");
    const esp = $(this).data("esp");
    const n_esp = $(this).data("n_esp");

    // Asigna los valores a los elementos correspondientes
    $("#E_nombre").val(n_esp);
    $("#Type").text(n_type);
    /* Evento doble clic */
    $(".Cont-edit").on("dblclick", function () {
        if ($(".Edit-datos-input").hasClass("d-none")) {
            $(".Edit-datos-input").fadeIn(300).removeClass("d-none");
        } else {
            $(".Edit-datos-input").fadeOut(300).addClass("d-none");
        }
    });
    ClicSaveChanges(type, n_type, n_esp, esp);
});

function ClicSaveChanges(Id_Type, n_type, n_esp, Id_esp) {
    // $("#E_disease").off("click");
    $("#E_disease").click(function (e) {
        ValitadeData(Id_Type, n_type, n_esp, Id_esp);
    });
}

/* Funcion para validar que los datos sean correctos */
function ValitadeData(Id_Type, n_type, n_esp, Id_esp) {
    console.log("Antiguos ");
    console.log(Id_Type);
    console.log(n_esp);

    var Name_e = $("#E_nombre").val().trim();
    var Name_Type = $("#E_type").val();
    let V_tipo = true;
    if (!Name_Type == 0) {
        validarCampo(Name_Type, regexNumero, "#E_type");
    } else {
        V_tipo = true;
    }
    let V_esp = validarCampo(Name_e, regexLetters, "#E_nombre");

    console.log("Nuevos ");
    console.log(Name_Type);
    console.log(Name_e);
    console.log(V_esp, V_tipo);

    /* Verificamos que si haya cambios */
    if ((Id_Type == Name_Type || Name_Type == 0) && n_esp == Name_e) {
        console.log("No hay cambios");
        $(".Alerta_edit_specific_text").html(
            IconError(
                "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
            )
        );
        ShowOrHideAlert(2, ".Alerta_edit_specific");
        // $("#Alerta_err").fadeIn(250).removeClass("d-none");
    } else {
        ShowOrHideAlert(1, ".Alerta_edit_specific");

        //$("#Alerta_err").fadeOut(250).addClass("d-none");

        if (V_esp && V_tipo) {
            if (Name_Type == 0) {
                Name_Type = Id_Type;
            }
            Confirm(Name_Type, Id_esp, Name_e);
        }
    }
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(Id_Type, Id_esp, Name_e) {
    AlertConfirmationForm('¿Estás seguro de editar los datos?', 'Asegurate que los datos sean correctos.', ()=> RequestEdit(Id_Type, Id_esp, Name_e));

}
/*
    Funcion para hacer la peticion al controlador y editar una enfermedad especifica
*/
async function RequestEdit(Id_Tipo, Id_Esp, Name) {
    const Data = {
        Tipo: Id_Tipo,
        Esp: Id_Esp,
        Name: Name,
    };

    console.log(Data);
    try {
        const response = await axios.post(
            "/admin/edit-specific-diseases",
            Data
        );
        console.log(response.data);
        const { data } = response;
        const { msg } = data;
        let timerInterval;
        disableLoading();

        timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        const { type, msg, errors } = error.response.data;
        
        console.log(error.response.data);

        if(errors){
            showErrorsAlert(errors, ".Error_Specific", ".errorList");
            return;
        }

        AlertError('¡Error!', msg);
    }
}

/*
    Funcion que hace la petion ala controlador para agregar un nuevo registro de una efermedad especifica
*/
async function RequestAdd(name, type) {
    const Data = {
        Type: type,
        Name: name,
    };

    try {
        const response = await axios.post("/admin/add-specific-diseases", Data);
        console.log(response.data);
        const { data } = response;
        const { msg } = data;
        let timerInterval;
        disableLoading();

        timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        const { type, msg, errors } = error.response.data;
        
        console.log(error.response.data);

        if(errors){
            showErrorsAlert(errors, ".Error_Specific", ".errorList");
            return;
        }

        AlertError('¡Error!', msg);
        
    }
}
