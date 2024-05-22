//import {grid} from './helpers/PersonalGridTable'
import { Grid, html, h } from "gridjs";
import { activeLoading, disableLoading } from "./loading-screen.js";
import traducciones from "./helpers/translate-gridjs.js";

import "gridjs/dist/theme/mermaid.css";

$(function () {
 
    initialData();

    async function initialData() {
        try {
            activeLoading();
            new Grid({
                columns: [
                    {
                        id: "id",
                        name: "id",
                        hidden: true,
                    },
                    {
                        /* Columna donde se muestra el icono del tipo de usuario */
                        id: "role_name",
                        name: "Rol",
                        formatter: (_, row) => {
                            const status = row.cells[1].data;
                         
                            if (status === 1) {
                                return h("div", {
                                    className:
                                        "d-flex justify-content-center align-items-center avatar avatar-Doctor p-0",
                                });
                            } else if (status === 2) {
                                return h("div", {
                                    className:
                                        "d-flex justify-content-center align-items-center avatar avatar-Pasante-m",
                                });
                            } else {
                                return h("div", {
                                    className:
                                        "d-flex justify-content-center align-items-center avatar avatar-Nutricion",
                                });
                            }
                        },
                        sort: false,
                    },
                    {
                        id: "name",
                        name: "Nombre",

                        formatter: (_, row) =>
                            html(
                                `<div class="fw-bold">${row.cells[3].data}</div>
                                <div>${row.cells[2].data}</div>`
                            ),
                    },
                    {
                        id: "role_name",
                        name: "Rol",
                        hidden: true,
                    },
                    {
                        id: "user_name",
                        name: "Código",
                    },

                    {
                        id: "estado",
                        name: html('<p class="mb-0 text-center">Estado</p>'),
                        formatter: (cell, row) => {
                            const status = row.cells[5].data;
                            let statusHtml = null;
                            if (status === "Activo") {
                                statusHtml = h(
                                    "span",
                                    {
                                        className: "badge bg-success",
                                    },
                                    " Activo "
                                );
                            } else {
                                statusHtml = h(
                                    "span",
                                    {
                                        className: "badge bg-warning text-dark",
                                    },
                                    " Inactivo "
                                );
                            }

                            return h(
                                "div",
                                {
                                    className:
                                        "d-flex justify-content-center align-items-center",
                                },
                                statusHtml
                            );
                        },
                        sort: false,
                    },
                    {
                        id: "actions",
                        name: html('<p class="text-center">Opciones</p>'),
                        formatter: (_, row) =>
                            html(
                                `<div class="d-flex justify-content-center gap-2">
                                    <a href="/user-details/${row.cells[0].data}" class="btn-blue fst-normal tooltip-container" type="button"> Detalles <span class="tooltip-text">Ver detalles del usuario</span></a>
                    
                                    <button data-id="${row.cells[0].data}" class="btn-red fst-normal tooltip-container" type="button">Inhabilitar<span class="tooltip-text">Quitar acceso</span>  </button>
                                 </div>`
                            ),
                        resizable: true,
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
                    className: "form-control border-danger",
                    server: {
                        url: (prev, keyword) => `${prev}&search=${keyword}`,
                    },
                },
                server: {
                    url: "/obt-usuarios?",
                    then: (data) => {
                        console.log("Datos del servidor:", data);
                        // Mapear los datos según tu lógica
                        return data.results.map((user) => [
                            user.id,
                            user.role_id,
                            user.role_name, // Nombre del rol
                            user.name, // Nombre del usuario
                            user.user_name, // Nombre de usuario
                            user.estado,
                        ]);
                    },
                    total: (data) => {
                        console.log("Total de datos:", data.count);
                        return data.count;
                    },
                },

                className: {
                    th: "thead-color text-black",
                    search: "d-flex justify-content-center justify-content-lg-end w-100",
                    
                },
                autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
                sort: false,
                resizable: true,
                language: traducciones,
            }).render(document.getElementById("Tabla-Usuarios"));
        } catch (error) {
            console.log(error);
        } finally {
           disableLoading();
        }
    }
});
