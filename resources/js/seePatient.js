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
                        id: "codigo",
                        name: "Código",
                        resizable: true, 
                                    

                    },
                    {
                        id: "nombre",
                        name: "Nombre",
                        resizable: true, 
                        
                    },
                    {
                        id: "sexo",
                        name: "Genero",
                        resizable: true, 
                    },
                    {
                        id: "consulta",
                        name: "Última consulta",
                        resizable: true, 
                    },
                    {
                        id: "actions",
                        name: html('<p class="mb-0 text-center">Acciones</p>'),
                        formatter: (_, row) =>
                            html(
                                `<div class="d-flex justify-content-center"><a href="/expediente/${row.cells[0].data}" class="btn btn-primary expediente">Expediente</a> </div>`
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
                    url: "/obt-pacientes?",
                    then: (data) => {
                        console.log("Datos del servidor:", data);
                        //Mapear los datos según tu lógica
                        return data.results.map((person) => [
                            person.id,
                            person.codigo,
                            person.nombre,
                            person.sexo,
                            person.consulta,
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
            }).render(document.getElementById("Tabla-Personal"));
        } catch (error) {
            console.log(error);
        } finally {
            disableLoading();
        }

    }
   
});

