//import {grid} from './helpers/PersonalGridTable'
import { Grid, html, h } from "gridjs";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import "gridjs/dist/theme/mermaid.css";

import { activeLoading, disableLoading } from "../loading-screen.js";
 
import {
    regexLetters,

} from "../helpers/Regex.js";

import { 
    className,
    translations,
} from '../helpers/gridJsConfiguration.js';

import { validarCampo, ShowOrHideAlert } from "../helpers/ValidateFuntions.js";
import { AlertConfirmationForm, TimeAlert} from '../helpers/Alertas.js';

import {
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
                    id: "name",
                    name: "Tipo de enfermedad",

                    formatter: (_, row) =>
                        html(
                            `
                                <div>${row.cells[1].data}</div>`
                        ),
                },
                {
                    id: "actions",
                    name: html('<p class="mb-0 text-center">Acciones</p>'),
                    formatter: (_, row) =>
                        html(
                            `<div class="d-flex justify-content-center">
                            <button class="btn-blue-sec fst-normal py-2 px-3 edit-disease" data-id="${row.cells[0].data}" data-name="${row.cells[1].data}" data-bs-toggle="modal" data-bs-target="#Edit-diseasse">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                Editar
                             </div>`
                        ),
                    sort : false
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
                url: "/admin/obt-diseases?",
                then: (data) => {
                    console.log("Datos del servidor:", data);
                    // Mapear los datos según tu lógica

                    return data.results.map((results) => [
                        results.id_tipo_ahf,
                        results.nombre,
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
            resizable: false,
            language: translations,
        }).render(document.getElementById("Tabla-Diseases"));
    } catch (error) {
        console.log(error);
    } finally {
        disableLoading();
    }
}

/* Funcion para cuando se le de clic al boton de editar enfermedad */
$(document).on("click", ".edit-disease", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    $("#E_nombre").val(name);
    /* Clic al boton */
   // $("#E_disease").off("click");
    $("#E_disease").click(function (e) {
        ValitadeData(id, name);
    });
});
/*
    Funcion para el evento de clic al boton de agregar una nueva enfermedad 
*/
function AddNewDisease() {
    $("#Add_disease").off("click");
    $("#Add_disease").click(function (e) {
        const name = $("#New_nombre").val().trim();

        let V_name = validarCampo(name, regexLetters, "#New_nombre");
        if (name != "") {
            if (V_name) {
                  ShowOrHideAlert(1, ".Alerta_disease");
               // $("#Alerta_add").fadeOut(250).addClass("d-none");
               AlertConfirmationForm("¿Estás seguro de agregar una nueva enfermedad?", "Asegurate que los datos sean correctos.", ()=> RequestAdd(name));
                // RequestAdd(name);
            }
        } else {
            $(".Alerta_disease_text").html(
                IconError(
                    "<strong> ¡Oops! </strong> No se ha realizado ningún cambio."
                )
            );
            ShowOrHideAlert(2, ".Alerta_disease");
             
        }
    });
}

/* Funcion para validar que los datos sean correctos */
function ValitadeData(id, name) {
    var new_name = $("#E_nombre").val().trim();
    /* Verifcamos si hay cambios */
    if (new_name != name) {
        $("#Alerta_err").fadeOut(250).addClass("d-none");

        let V_name = validarCampo(new_name, regexLetters, "#E_nombre");
        if (V_name) {
            Confirm(id, new_name);
        }
    } else {
         $(".Alerta_edit_disease_text").html(
             IconError(
                 "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
             )
         );
         ShowOrHideAlert(2, ".Alerta_edit_disease");
       // $("#Alerta_err").fadeIn(250).removeClass("d-none");
    }
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(id, new_name) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            text: "Asegurate que los datos sean correctos.",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                RequestEdit(id, new_name);
                console.log("Editar");
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

/*
    Funcion que hace la petición para edicion del nombre de la enfermedad
*/
async function RequestEdit(id, name) {
    const Data = {
        Id: id,
        Name: name,
    };

    try {
        const response = await axios.post("/admin/edit-diseases", Data);
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
            showErrorsAlert(errors, ".Error_edit_disease", ".errorList");
        }

        console.log(error);
    }
}
/*
    Funcion para hacer la peticion al controlador para agregar un nuevo registro al sistema
*/
async function RequestAdd(name) {
    activeLoading();
    const Data = {
        Name: name,
    };

    try {
        const response = await axios.post("/admin/add-diseases", Data);
        console.log(response.data);
        const { data } = response;
        const { status, msg, errors } = data;
        disableLoading();
        let timerInterval;

        timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
         disableLoading();
        const { type, msg, errors } = error.response.data;

        if (type == 1) {
            let timerInterval;

            timerInterval = TimeAlert(2500, "¡Error!", msg, "error", 0);
        } else {
            console.log(errors);
            showErrorsAlert(errors, ".Error_disease", ".errorList");
        }

        console.log(error);
    }
}

