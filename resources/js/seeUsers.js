//import {grid} from './helpers/PersonalGridTable'
import { Grid, html } from "gridjs";
import axios from "axios";
import { activeLoading, disableLoading } from "./loading-screen.js";
import traducciones from "./helpers/translate-gridjs.js";

import "gridjs/dist/theme/mermaid.css";
import { data } from "jquery";

$(function(){
    disableLoading();
    initialData();

    async function initialData(){
        try{

            activeLoading();

            new Grid({
                columns: [
                    /*{
                        id: "id",
                        name: "id",
                        hidden: true,
                    },*/
                    {
                        id: "nombre",
                        name: "Nombre",
                        resizable: true,
                    },
                    {
                        id: "codigo",
                        name: "Codigo",
                        resizable: true
                    },
                ],
                //Configuracion del Grid js
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
                    url: "/dt-usuarios",
                    then: (data) => {
                        console.log("Datos del servidor: ", data);
                        return data.results.map((user) => [
                            //user.id, 
                            user.codigo,
                            user.nombre
                        ]);
                    },
                    //total: (data) => {
                    //console.log("Total de datos:", data.count);
                    //return data.count;
                //},
                },
                autoWidth: true,  /// Se ajusta cada columna de un tamaño automatico
                sort: false, 
                resizable: true,
                language: traducciones,
            }).render(document.getElementById("Tabla-Usuarios"));

        }catch(error){
            console.log(error);
        }finally{
            disableLoading();
        }
    }
})
