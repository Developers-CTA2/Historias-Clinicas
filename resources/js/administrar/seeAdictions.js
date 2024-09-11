import { Grid, html, h } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import { activeLoading, disableLoading } from "../loading-screen.js";

import {
    ShowOrHideAlert,
    className,
    translations,
    validarCampo,
    TimeAlert,
    regexLetters,
} from "../helpers";
import { showErrorsAlert, IconError } from "../templates";

$(function () {
    initialData();
    AddNewAddiction();
    closeModal();
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
                },
                {
                    id: "actions",
                    name: html('<p class="mb-0 text-center">Acciones</p>'),
                    formatter: (_, row) =>
                        html(
                            `<div class="d-flex justify-content-center">
                            <button class="btn-sec fst-normal py-2 px-3 edit-addicton" data-id="${row.cells[0].data}" data-name="${row.cells[1].data}" data-bs-toggle="modal" data-bs-target="#Edit-addiction">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                        </svg>
                                Editar
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
                debounceTimeout: 1000,
                server: {
                    url: (prev, keyword) => `${prev}&search=${keyword}`,
                },
            },
            server: {
                url: "/admin/obt-addictions?",
                then: (data) => {
                    console.log("Datos del servidor:", data);
                    // Mapear los datos según tu lógica

                    return data.results.map((results) => [
                        results.id,
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
            resizable: true,
            language: translations,
        }).render(document.getElementById("Tabla-Addictions"));
    } catch (error) {
        console.log(error);
    } finally {
        disableLoading();
    }
}

function closeModal() {
    $(".cerrar-btn").off("click");
    $(".cerrar-btn").click(function (e) {
        // Ocultar mabas alertas
        ShowOrHideAlert(1, ".Error_edit_addiction");
        ShowOrHideAlert(1, ".Alerta_edit_addiction");
    });
}

/* Funcion para cuando se le de clic al boton de editar toxicomania */
$(document).on("click", ".edit-addicton", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    $("#A_nombre").val(name);
    /* Clic al boton editar */
    // $("#E_addiction").off("click");
    $("#E_addiction").click(function (e) {
        ValitadeData(id, name);
    });
});

/* Funcion para validar el dato cuando se agrega una nueva toxicomania al sistema */
function AddNewAddiction() {
    $("#Add_addiction").off("click");
    $("#Add_addiction").click(function (e) {
        const name = $("#New_nombre").val().trim();

        console.log(name);
        let V_name = validarCampo(name, regexLetters, "#New_nombre");
        if (name != "") {
            if (V_name) {
                ShowOrHideAlert(1, ".Alerta_addiction");

                RequestAdd(name);
            }
        } else {
            $(".Alerta_addiction_text").html(
                IconError(
                    "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
                )
            );
            ShowOrHideAlert(2, ".Alerta_addiction");
        }
    });
}

/* Funcion para validar que los datos sean correctos */
function ValitadeData(id, name) {
    var new_name = $("#A_nombre").val().trim();
    /* Verifcamos si hay cambios */
    if (new_name != name) {
        ShowOrHideAlert(1, ".Alerta_edit_addiction");

        let V_name = validarCampo(new_name, regexLetters, "#E_nombre");
        if (V_name) {
            Confirm(id, new_name);
        }
    } else {
        // $("#Alerta_err").fadeIn(250).removeClass("d-none");
        $(".Alerta_edit_addiction_text").html(
            IconError(
                "<strong> ¡Oooops! </strong> No se ha realizado ningún cambio."
            )
        );
        ShowOrHideAlert(2, ".Alerta_edit_addiction");
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
            }
        });
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

/*
    Funcion que hace la petición para edicion del nombre de la toxicomania
*/
async function RequestEdit(id, name) {
    const Data = {
        Id: id,
        Name: name,
    };

    try {
        const response = await axios.post("/admin/edit-addictions", Data);
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

            timerInterval = TimeAlert(2500, "¡Error!", msg, "error", 0);
        } else {
            console.log(errors);
            showErrorsAlert(errors, ".Error_edit_addiction", ".errorList");
        }

        console.log(error);
    }
}

/* Funcion para llamar al controlador y agregar una nueva alergia */
async function RequestAdd(name) {
    activeLoading();
    const Data = {
        Name: name,
    };

    try {
        const response = await axios.post("/admin/add-addiction", Data);
        console.log(response.data);
        const { data } = response;
        const { status, msg, errors } = data;
        let timerInterval;
        disableLoading();

        timerInterval = TimeAlert(2500, "¡Éxito!", msg, "success", 1);
    } catch (error) {
        disableLoading();
        const { type, msg, errors } = error.response.data;

        if (type == 1) {
            let timerInterval;

            timerInterval = TimeAlert(2500, "¡Error!", msg, "error", 0);
        } else {
            console.log(errors);
            showErrorsAlert(errors, ".Error_addiction", ".errorList");
            console.log(error);
        }
    }
}
