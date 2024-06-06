//import {grid} from './helpers/PersonalGridTable'
import { Grid, html, h } from "gridjs";
import { activeLoading, disableLoading } from "../loading-screen.js";
import traducciones from "../helpers/translate-gridjs.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { AlertaSweerAlert } from "../helpers/Alertas.js";
import "gridjs/dist/theme/mermaid.css";

import { validarCampo } from "../helpers/ValidateFuntions.js";
import { regexLetters, regexNumero } from "../helpers/Regex.js";

$(function () {
    initialData();
    AddNewAllergy();
});

async function initialData() {
    try {
        activeLoading();
        new Grid({
            columns: [
                {
                    id: "Tipo",
                    name: "id",
                    hidden: true,
                },
                {
                    id: "name",
                    name: "Nombre",

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
                            <button class="btn-sec fst-normal tooltip-container py-1 px-2 edit-allergy" data-id="${row.cells[0].data}" data-name="${row.cells[1].data}" data-bs-toggle="modal" data-bs-target="#Edit-allergy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                Editar
                                <span class="tooltip-text">Editar datos.</span></button>
                             </div>`
                        ),
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
                server: {
                    url: (prev, keyword) => `${prev}&search=${keyword}`,
                },
            },
            server: {
                url: "/admin/obt-allergies?",
                then: (data) => {
                    console.log("Datos del servidor:", data);
                    // Mapear los datos según tu lógica

                    return data.results.map((results) => [
                        results.id_alergia,
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

            className: {
                th: "thead-color text-black",
                search: "d-flex justify-content-center justify-content-lg-end w-100 py-2",
            },
            autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
            sort: {
                enabled: true,
                multiColumn: false,
                initialColumn: 0,
            },
            resizable: true,
            language: traducciones,
        }).render(document.getElementById("Tabla-Especific-Allergies"));
    } catch (error) {
        console.log(error);
    } finally {
        disableLoading();
    }
}

/* Funcion para cuando se le de clic al boton de editar enfermedad */
$(document).on("click", ".edit-allergy", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    $("#A_nombre").val(name);
    /* Clic al boton */
    $("#E_allergy").off("click");
    $("#E_allergy").click(function (e) {
        ValitadeData(id, name);
    });
});

/* Funcion para validar el dato cuando se agrega una neuva alergia al sistema */
function AddNewAllergy() {
    $("#Add_allergy").off("click");
    $("#Add_allergy").click(function (e) {
        const name = $("#New_nombre").val().trim();

        console.log(name);
        let V_name = validarCampo(name, regexLetters, "#New_nombre");
        if (name != "") {
            if (V_name) {
                $("#Alerta_add").fadeOut(250).addClass("d-none");
                RequestAdd(name);
            }
        } else {
            console.log("fdfdfdfd");
            $("#Alerta_add").fadeIn(250).removeClass("d-none");
        }
    });
}

/* Funcion para validar que los datos sean correctos */
function ValitadeData(id, name) {
    var new_name = $("#A_nombre").val().trim();
    /* Verifcamos si hay cambios */
    if (new_name != name) {
        $("#Alerta_err").fadeOut(250).addClass("d-none");

        let V_name = validarCampo(new_name, regexLetters, "#E_nombre");
        if (V_name) {
            Confirm(id, new_name);
        }
    } else {
        $("#Alerta_err").fadeIn(250).removeClass("d-none");
    }
}

/* Funcion para confimar que los datos seran editados  */
async function Confirm(id, new_name) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            text: "Asegurate que los datos sean correctos..",
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
        const response = await axios.post("/admin/edit-allergies", Data);
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
        } else if (status == 202) {
            showErrors(errors);
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}

/* Funcion para llamar al controlador y agregar una nueva alergia */ 
async function RequestAdd(name) {
    const Data = {
        Name: name,
    };

    try {
        const response = await axios.post("/admin/add-allergy", Data);
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
        } else if (status == 202) {
              timerInterval = AlertaSweerAlert(
                  2500,
                  "¡Error!",
                  msg,
                  "error",
                  0
              );
        } else {
            showErrors(errors);
        }
    } catch (error) {
        disableLoading();
        console.log("Error");
        console.log(error);
    }
}
 

/* Funcion que muestra los errores que manda el comtrolador*/
function showErrors(errors) {
    if (errors) {
        const errorList = $("#errorList");
        errorList.empty(); // Limpiar la lista de errores existente
        $.each(errors, function (key, value) {
            // Agregar cada mensaje de error como un elemento de lista a la lista de errores
            $.each(value, function (index, errorMessage) {
                errorList.append($("<li>").text(errorMessage));
            });
        });
        // Mostrar la alerta de error
        $("#errorAlert").show();
    }
}