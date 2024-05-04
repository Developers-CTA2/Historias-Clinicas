//import {grid} from './helpers/PersonalGridTable'
import { Grid, html } from "gridjs";
import axios from "axios";
import { activeLoading, disableLoading } from "./loading-screen.js";
import traducciones from "./helpers/translate-gridjs.js";

import "gridjs/dist/theme/mermaid.css";

$(function () {
    disableLoading();
    initialData();

    async function initialData() {
        try {
            activeLoading();
            new Grid({
                columns: [
                    {
                        id: "id",
                        name: "Código",
                        hidden: true,
                    },
                    {
                        id: "person",
                        name: "",
                        resizable: true,
                        formatter: (_, row) =>
                            html(`<i class="fa-solid fa-circle-user person-icon"></i>`),
                        width: "90px",
                    },
                    {
                        id: "name",
                        name: "Nombre",
                        resizable: true,
                        formatter: (_, row) =>
                            html(`<div>${row.cells[1].data}</div><div>${row.cells[2].data}</div>`),
                    },
                    {
                        id: "user_name",
                        name: "Usuario",
                        resizable: true,
                    },
                    {
                        id: "role_name",
                        name: "Rol",
                        hidden: true,
                    },
                    {
                        id: "state",
                        name: "Estado",
                        resizable: true,
                        formatter: () => "Activo",
                    },
                    {
                        id: "actions",
                        name: html('<p class="mb-0 text-center"></p>'),
                        formatter: (_, row) =>
                            html(
                                `<div class="d-flex justify-content-center">
                        <a href="/detalles/${row.cells[0].data}" class="btn btn-primary detalles">Detalles</a>
                        <button class="btn btn-danger eliminar" data-id="${row.cells[0].data}">Eliminar</button>
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
                            user.name, // Nombre del usuario
                            user.role_name, // Nombre del rol
                            user.user_name, // Nombre de usuario
                        ]);
                    },
                    total: (data) => {
                        console.log("Total de datos:", data.count);
                        return data.count;
                    },
                },

                className: {
                    th: "thead-color text-black",
                    search: "d-flex justify-content-center justify-content-lg-end w-100 py-2",
                },
                autoWidth: true,  /// Se ajusta cada columna de un tamaño automatico
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