import { Grid, h, html } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { disableLoading } from "../loading-screen.js";
import { IconsWithLabelTemplate } from '../templates/seePatientsTemplate.js';
import { className, translations } from '../helpers/gridJsConfiguration.js';


$(function () {
    disableLoading();

    const table = document.getElementById("Tabla-Personal")

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

            },
            {
                id: "nombre",
                name: "Nombre completo",

            },
            {
                id: "sexo",
                name: "Género",

            },
            {
                name: "Última consulta",
                id: "consulta",
                formatter: (_, row) => {

                    const container = h('div', {}, [
                        IconsWithLabelTemplate('doctor', row.cells[4].data, 'Consultorio médico'),
                        IconsWithLabelTemplate('nutritionist', row.cells[5].data, 'Consultorio de nutrición'),
                    ]
                    );

                    return container;

                }
            },
            {
                id: "actions",
                name: html('<p class="mb-0 text-center">Acciones</p>'),
                formatter: (_, row) => {

                    const btn = h('div', {
                        className: 'd-flex justify-content-center'
                    }, [
                        h('a', {
                            className: 'btn btn-primary expediente',
                            href: `/patients/medical_record/${row.cells[0].data}`
                        }, 'Expediente')
                    ])

                    return btn;
                }


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
            url: "/patients/obt-pacientes?",
            then: (data) => {
                return data.results.map((person) => [
                    person.id,
                    person.codigo ?? 'Sin código',
                    person.nombre,
                    person.sexo,
                    person.consultorio,
                    person.nutricion,
                ]);
            },
            total: (data) => data.count,
        },

        className: className,
        autoWidth: true, /// Se ajusta cada columna de un tamaño automatico
        fixedHeader: true,
        language: translations,
    }).render(table);
    
});
