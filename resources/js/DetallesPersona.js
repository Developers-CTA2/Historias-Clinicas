import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";

window.addEventListener("load", function () {
    // Jalamos el id del atributo
    window.id = $("#detalles-container").data("id");
    //const id = $("#detalles-container").data("id");

    /* verificar codogo en la URL */
    if (regexNumero.test(id)) {
        RequestDataPersona(id);
        cambiarNombramientos(id);
        borrarNombramiento(id);
        // EditarDatosP(id);
        EditarNombramientoP(id);
        EditarNombramientoS(id);
    } else {
        window.location.href = "/personal";
    }
});

/* Peticion al controlador para eliminar a un usuario */
async function RequestDataPersona(codigo) {
    console.log(codigo);
    const dataCheck = {
        id: codigo,
    };
    try {
        const response = await axios.post("/detalles", dataCheck);
        const { data } = response;
        const { status, Principal, Trabajo, datos } = data;
        console.log(data);
        disableLoading();
        if (status == 200) {
            $(".container").removeClass("d-none");
            disableLoading();

            // Mostrar datos personales
            templateShowData(datos);

            if (Principal.length === 0) {
                // Caso de que no tenga nombramiento
                $(".cont-principal").removeClass("d-none");

                $(".principal_titulo").text("Sin nombramiento");
            } else {
                // Si tiene al menos 1 mostrar contenedor
                $(".cont-principal").removeClass("d-none");
                $(".principal_titulo").text("Nombramiento principal");
                $(".nombramiento_principal").removeClass("d-none");
                nombramientoPrincipal(Principal);
            }

            // Si tiene  2 nombramientos mostrar el contenedor para el 2do
            if (Trabajo.length !== 0) {
                $(".segundo-nombramiento").removeClass("d-none");
                nombramientoDos(Trabajo);
                $(".editar-btn").hide();
                $(".button-eliminar").show();
                $(".button-change").show();
            } else {
                $(".button-eliminar").hide();
                $(".button-change").hide();
                $(".button-editt").removeClass("d-none");
            }
        } else if (status == 404) {
            $(".cont-error").removeClass("d-none");
        }
    } catch (error) {
        console.error("Ocurrió un error durante la búsqueda de código:", error);
        return false; // Manejar el error y retornar false
    }
}

/*
    Mostrar los datos personales en cada uno de los campos del contenedor de personas
*/
function templateShowData(data) {
    const {
        nombre,
        F_Ingre,
        F_Naci,
        codigo,
        grado,
        genero,
        estado,
        Correo,
        telefono,
        edad,
        antigüedad,
        name_emer,
    } = data;

    // Mostrar todos los datos
    $("#Person_Name").text(nombre);
    $("#Person_Date").text(F_Ingre);
    $("#Person_Birthday").text(F_Naci);
    $("#Person_Grade").text(grado);
    $("#Person_Code").text(codigo);
    $("#Person_Status").text(estado);
    $("#Person_sex").text(genero);
    $("#Person_Correo").text(Correo);
    $("#Person_Telf").text(telefono);
    $("#Person_edad").text(edad);
    $("#Person_antigüedad").text(antigüedad);
    $("#tel_emer").text(telefono);
    $("#name_emer").text(name_emer);

    ClicEditData(data);
}

/* Funcion para mostrar el modal con los datos de la persona */
function ClicEditData(data) {
    $("#botonEditar").off("click");
    $("#botonEditar").on("click", function () {
        activeLoading();
        console.log("Clic editar");
        const {
            nombre,
            F_Ingre,
            F_Naci,
            codigo,
            grado,
            genero,
            estado,
            Correo,
            telefono,
            edad,
            antigüedad,
            name_emer,
        } = data;

        $("#editCodigo").val(codigo);
        $("#editNombre").val(nombre);
        $("#editFechaNacimiento").val(F_Naci);
        $("#editFechaIngreso").val(F_Ingre);
        $("#editTelEmer").val(telefono);
        $("#editNombreEmer").val(name_emer);
        $("#editCorreo").val(Correo);
        $("#editEstado")
            .find("option")
            .filter(function () {
                return $(this).text() === estado;
            })
            .prop("selected", true);
        $("#editGenero")
            .find("option")
            .filter(function () {
                return $(this).text() === genero;
            })
            .prop("selected", true);
        $("#editGradoEstudio")
            .find("option")
            .filter(function () {
                return $(this).text() === grado;
            })
            .prop("selected", true);
        $("#modal_edad").text(edad);
        $("#modal_ant").text(antigüedad);

        listenEvents(codigo, F_Naci, F_Ingre);
        disableLoading();
        EditarDatosP(id);
    });
}

/* Funcion para calcular la edad y la antiguedad en caso de que en el  modal de editar se cambie alguno de estos 2 campos */
function listenEvents(code) {
    $("#editFechaNacimiento").on("change", function () {
        var newDate = $("#editFechaNacimiento").val();

        var edad = CalcularTiempos(newDate);
        $("#modal_edad").text(edad);
    });

    $("#editFechaIngreso").on("change", function () {
        var newDate = $("#editFechaIngreso").val();

        var antiguedad = CalcularTiempos(newDate);
        $("#modal_ant").text(antiguedad);
    });

    $("#editCodigo").on("change", function () {
        var newCode = $("#editCodigo").val();

        if (code == newCode) {
            console.log("No cambio el codigo");
        } else {
            var validar = validarCampo(newCode, regexCode, "#editCodigo");

            if (validar) {
                console.log("Si cambio habra que validarlo ");
                searchCode(newCode)
                    .then((resultado) => {
                        if (resultado) {
                            console.log("El código está disponible.");
                        } else {
                            mostrarerr("#editCodigo");
                            $("#Alerta_err").fadeIn().removeClass("d-none");
                            console.log("El código no esta disponible.");
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Ocurrió un error durante la búsqueda:",
                            error
                        );
                    });
            }
        }
    });
}

async function searchCode(code) {
    const dataCheck = {
        Codigo: code,
    };

    try {
        const response = await axios.post("/searchCode", dataCheck);
        const { data } = response;
        const { status } = data;
        disableLoading();
        if (status == true) {
            //esta disponible
            return true;
        } else {
            // ya hay algien con el codigo
            return false;
        }
    } catch (error) {
        console.error("Ocurrió un error durante la búsqueda de código:", error);
        return false; // Manejar el error y retornar false
    }
}

//EDITAR DATOS PERSONALES
/* Funcion para editar los datos personales, en el modal */
function EditarDatosP(id) {
    $("#confirm-edit").off("click");
    $("#confirm-edit").on("click", function () {
        console.log("Clic en editar " + id);
        // Obtener los valores de los campos del formulario
        var nombre = $("#editNombre").val().trim();
        var correo = $("#editCorreo").val().trim();
        var codigo = $("#editCodigo").val().trim();
        var fechaNacimiento = $("#editFechaNacimiento").val().trim();
        var genero = $("#editGenero").val().trim();
        var estado = $("#editEstado").val().trim();
        var telefono = $("#editTelEmer").val().trim();
        var name_e = $("#editNombreEmer").val().trim();
        var gradoEstudio = $("#editGradoEstudio").val().trim();
        var fechaIngreso = $("#editFechaIngreso").val().trim();

        /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
        let V_codigo = validarCampo(codigo, regexCode, "#editCodigo");
        let V_name = validarCampo(nombre, regexLetters, "#editNombre");
        let V_sex = validarCampo(genero, regexNumero, "#editGenero");
        let V_grade = validarCampo(
            gradoEstudio,
            regexNumero,
            "#editGradoEstudio"
        );
        let V_nacimiento = validarCampo(
            fechaNacimiento,
            regexFecha,
            "#editFechaNacimiento"
        );
        let V_ingreso = validarCampo(
            fechaIngreso,
            regexFecha,
            "#editFechaIngreso"
        );
        let V_correo = validarCampo(correo, regexCorreo, "#editCorreo");
        let V_tel = validarCampo(telefono, regexNumero, "#editTelefono");
        let V_nameE = validarCampo(name_e, regexLetters, "#editNombreEmer");
        let V_estado = validarCampo(estado, regexNumero, "#editEstado");

        //activeLoading();
        if (
            V_codigo &&
            V_name &&
            V_sex &&
            V_grade &&
            V_nacimiento &&
            V_ingreso &&
            V_correo &&
            V_tel &&
            V_nameE &&
            V_estado
        ) {
            console.log("Datos correctos proceder a guardar");
            const PersonalData = {
                nombre: nombre,
                correo: correo,
                Codigo: codigo,
                genero: genero,
                f_nacimiento: fechaNacimiento,
                f_ingreso: fechaIngreso,
                estudios: gradoEstudio,
                estado_id: estado,
                tel_emergencia: telefono,
                name_emergencia: name_e,
            };
            // console.log("veri", PersonalData);
            //editarPersonal(PersonalData, id);
            confirmarEdicion(PersonalData, id);
        }
    });
}

async function confirmarEdicion(PersonalData, id) {
    try {
        const result = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#B04759",
            confirmButtonColor: "#007F73",
            confirmButtonText:
                '<i class="fa-solid fa-pen animated-icon px-1"></i> Editar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        });

        if (result.isConfirmed) {
            await editarPersonal(PersonalData, id);
        }
    } catch (error) {
        // Manejo de errores
        console.error(error);
    }
}

async function editarPersonal(Personal, id) {
    const datos = {
        Personal,
    };
    console.log("EDICION DE LOS DATOS ")
    console.log(datos)
    try {
        const response = await axios.put("/editar-datos/" + id, datos);
        const { data } = response;
        const { status, msg } = data;
        console.log(response.data);
        disableLoading(); // Corregir llamada a la función disableLoading
        if (status == 200) {
            // Modificar la verificación del estado de la respuesta
            Swal.fire({
                title: "¡Éxito!",
                text: msg,
                icon: "success",
                didClose: () => {
                    location.reload();
                },
            });
        } else {
            Swal.fire({
                title: "¡Error al editar los datos!",
                text: msg,
                icon: "error",
            });
        }
    } catch (error) {
        console.error(error);
        disableLoading(); // Corregir llamada a la función disableLoading
        Swal.fire({
            title: "¡Error!",
            text: "Algo salió mal, inténtalo nuevamente.",
            icon: "error",
        });
    }
}

$(document).ready(function () {
    $("#botonEditar").on("click", function () {
        var idPersona = $("#detalles-container").data("id");
        RequestDataPersona(idPersona);
    });
});

/*
    Mostrar los datos del nombramiento principal
*/
function nombramientoPrincipal(Principal) {
    const {
        Nombramiento,
        categoria,
        distincion_ad,
        fecha_termino,
        horario_actual,
        horario_oficial,
        horas_trabajo,
        tipo_contrato,
        area_distincion,
        turno,
        Estado,
    } = Principal[0];
    $("#P_nombra").text(Nombramiento);
    $("#P_dist").text(distincion_ad);
    $("#P_area").text(area_distincion);
    $("#P_actual").text(horario_actual);
    $("#P_oficial").text(horario_oficial);
    $("#P_horas").text(horas_trabajo);
    $("#P_turno").text(turno);
    $("#P_contrato").text(tipo_contrato);
    $("#P_termino").text(fecha_termino);
    $("#P_cate").text(categoria);
    $("#P_estado").text(Estado);

    $("#editAreaDistincion").val(area_distincion);
    $("#editFechaT").val(fecha_termino);
    $("#editNombramiento")
        .find("option")
        .filter(function () {
            return $(this).text() === Nombramiento;
        })
        .prop("selected", true);
    $("#editDistadicional")
        .find("option")
        .filter(function () {
            return $(this).text() === distincion_ad;
        })
        .prop("selected", true);
    $("#editHrstrabajo")
        .find("option")
        .filter(function () {
            return $(this).text() === horas_trabajo;
        })
        .prop("selected", true);
    $("#editTurno")
        .find("option")
        .filter(function () {
            return $(this).text() === turno;
        })
        .prop("selected", true);
    $("#editContrato")
        .find("option")
        .filter(function () {
            return $(this).text() === tipo_contrato;
        })
        .prop("selected", true);
    $("#editCategoria")
        .find("option")
        .filter(function () {
            return $(this).text() === categoria;
        })
        .prop("selected", true);

    $("#editHrsOficial")
        .find("option")
        .filter(function () {
            return $(this).text() === horario_oficial;
        })
        .prop("selected", true);
    $("#editHrsActual")
        .find("option")
        .filter(function () {
            return $(this).text() === horario_actual;
        })
        .prop("selected", true);
    $("#editEstados")
        .find("option")
        .filter(function () {
            return $(this).text() === Estado;
        })
        .prop("selected", true);

    if (Nombramiento.trim() === "Profesor de Asignatura") {
        var inputElement =
            '<div class="form-group pt-2" id="editHrstrabajoContainer">' +
            '<label for="editHrstrabajo">Horas de trabajo:</label>' +
            '<input type="text" class="form-control" id="editHrstrabajo">' +
            "</div>";

        // Reemplazar el contenido del contenedor con el nuevo input y label
        $("#editHrstrabajoContainer").replaceWith(inputElement);
        $("#editHrstrabajo").val(horas_trabajo);
    }
}

/*
    Mostrar los datos del segundo nombramiento
*/
function nombramientoDos(Trabajo) {
    const {
        Nombramiento,
        categoria,
        distincion_ad,
        fecha_termino,
        horario_actual,
        horario_oficial,
        horas_trabajo,
        tipo_contrato,
        area_distincion,
        turno,
        Estado,
    } = Trabajo[0];
    $("#S_nombra").text(Nombramiento);
    $("#S_dist").text(distincion_ad);
    $("#S_area").text(area_distincion);
    $("#S_actual").text(horario_actual);
    $("#S_oficial").text(horario_oficial);
    $("#S_horas").text(horas_trabajo);
    $("#S_turno").text(turno);
    $("#S_contrato").text(tipo_contrato);
    $("#S_termino").text(fecha_termino);
    $("#S_cate").text(categoria);
    $("#S_estado").text(Estado);

    $("#editAreaDistincionS").val(area_distincion);
    $("#editFechaTS").val(fecha_termino);
    $("#editNombramientoS")
        .find("option")
        .filter(function () {
            return $(this).text() === Nombramiento;
        })
        .prop("selected", true);
    $("#editDistadicionalS")
        .find("option")
        .filter(function () {
            return $(this).text() === distincion_ad;
        })
        .prop("selected", true);
    $("#editHrsOficialS")
        .find("option")
        .filter(function () {
            return $(this).text() === horario_oficial;
        })
        .prop("selected", true);
    $("#editHrsActualS")
        .find("option")
        .filter(function () {
            return $(this).text() === horario_actual;
        })
        .prop("selected", true);
    $("#editHrstrabajoS")
        .find("option")
        .filter(function () {
            return $(this).text() === horas_trabajo;
        })
        .prop("selected", true);
    $("#editTurnoS")
        .find("option")
        .filter(function () {
            return $(this).text() === turno;
        })
        .prop("selected", true);
    $("#editContratoS")
        .find("option")
        .filter(function () {
            return $(this).text() === tipo_contrato;
        })
        .prop("selected", true);
    $("#editCategoriaS")
        .find("option")
        .filter(function () {
            return $(this).text() === categoria;
        })
        .prop("selected", true);
    $("#editEstadoS")
        .find("option")
        .filter(function () {
            return $(this).text() === Estado;
        })
        .prop("selected", true);

    if (Nombramiento.trim() === "Profesor de Asignatura") {
        var inputElement =
            '<div class="form-group pt-2" id="editHrstrabajoSContainer">' +
            '<label for="editHrstrabajoS">Horas de trabajo:</label>' +
            '<input type="text" class="form-control" id="editHrstrabajoS">' +
            "</div>";

        // Reemplazar el contenido del contenedor con el nuevo input y label
        $("#editHrstrabajoSContainer").replaceWith(inputElement);
        $("#editHrstrabajoS").val(horas_trabajo);
    }
}

//////////////////////////////////////////////////////////////////
//BORRAR NOMBRAMIENTOS
function borrarNombramiento(id) {
    $(".button-eliminar").off("click");
    $(".button-eliminar").on("click", function () {
        var botonPresionado = $(this).data("boton-presionado");

        // Mostrar un mensaje de confirmación con SweetAlert2
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#007F73",
            cancelButtonColor: "#B04759",
            confirmButtonText: '<i class="fa-solid fa-trash"></i> Borrar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación
                $.ajax({
                    url: "/detalles/" + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        boton_presionado: botonPresionado,
                    },
                    success: function (response) {
                        var msg = response.message; // Obtener el mensaje del servidor
                        Swal.fire({
                            title: "¡Éxito!",
                            text: msg,
                            icon: "success",
                            didClose: () => {
                                location.reload(); // Recargar la página después de editar
                            },
                        });
                    },
                    error: function (xhr, status, error) {
                        var msg =
                            "Ha ocurrido un error al intentar cambiar el tipo de nombramiento.";
                        Swal.fire({
                            title: "¡Error!",
                            text: msg,
                            icon: "error",
                        });
                    },
                });
            }
        });
    });
}

//////////////////////////////////////////////////////////
//CAMBIAR NOMBRAMIENTO A PRINCIPAL O SECUNDARIO
function cambiarNombramientos(id) {
    $(".button-change").off("click");
    $(".button-change").on("click", function () {
        Swal.fire({
            title: "¿Estás seguro de cambiar el nombramiento?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#007F73",
            cancelButtonColor: "#B04759",
            confirmButtonText: '<i class="fa-solid fa-right-left"></i> Cambiar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/detalles/" + id,
                    type: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: {
                        principal: 1, // Establecer la columna principal a 1
                    },
                    success: function (response) {
                        var msg = response.message; // Obtener el mensaje del servidor
                        Swal.fire({
                            title: "¡Éxito!",
                            text: msg,
                            icon: "success",
                            didClose: () => {
                                location.reload(); // Recargar la página después de editar
                            },
                        });
                    },
                    error: function (xhr, status, error) {
                        var msg =
                            "Ha ocurrido un error al intentar cambiar el tipo de nombramiento.";
                        Swal.fire({
                            title: "¡Error!",
                            text: msg,
                            icon: "error",
                        });
                    },
                });
            }
        });
    });
}

////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
//EDITAR NOMBRAMIENTO PRIMARIO

// Función para obtener las categorías
$(document).ready(function () {
    // Almacenar la opción seleccionada actualmente en una variable global
    var categoriaSeleccionada = null;

    // Función para obtener y mostrar las categorías
    async function obtenerYMostrarCategorias(idPersona, idNombramiento, cate) {
        var genero = $("#editGenero").val().trim();
        const datos = { genero, idNombramiento };
        try {
            const response = await axios.post(
                "/obtener-categorias/" + idPersona,
                datos
            );
            const { data } = response;
            const { status, Categorias } = data;

            if (status === 200) {
                console.log("Entra");
                // Limpiar el select de categorías
                $("#editCategoria").empty();
                // Agregar las nuevas opciones de categorías
                Categorias.forEach((categoria) => {
                    $("#editCategoria").append(
                        `<option value="${categoria.id}">${categoria.nombre}</option>`
                    );
                });
                $("#editCategoria").val(cate);

                // Restaurar la categoría seleccionada si existe
                if (categoriaSeleccionada !== null) {
                    $("#editCategoria").append(
                        `<option value="${categoriaSeleccionada.id}" selected>${categoriaSeleccionada.nombre}</option>`
                    );
                }
            } else {
                // Realizar acciones en caso de algún otro estado de respuesta
            }
        } catch (error) {
            disableLoading();
            console.log(error);
            // Manejar el error, mostrar mensajes de error, etc.
        }
    }

    // Evento click en el botón de editar
    $("#botonEditarP").on("click", function () {
        var idPersona = $("#detalles-container").data("id");
        RequestDataPersona(idPersona);
        var idNombramiento = $("#editNombramiento").val();
        var idcate = $("#editCategoria").val();
        if (
            idNombramiento === "4" ||
            idNombramiento === "5" ||
            idNombramiento === "6"
        ) {
            // Mostrar el elemento campo-distincion
            $(".campo-distincionP").removeClass("d-none");
        } else {
            // Ocultar el elemento campo-distincion
            $(".campo-distincionP").addClass("d-none");
        }
        obtenerYMostrarCategorias(idPersona, idNombramiento, idcate);
    });

    // Evento change en el select de nombramientos
    $("#editNombramiento").on("change", function () {
        var nuevoIdNombramiento = $(this).val();
        var idPersona = $("#detalles-container").data("id");
        if (
            nuevoIdNombramiento === "4" ||
            nuevoIdNombramiento === "5" ||
            nuevoIdNombramiento === "6"
        ) {
            // Mostrar el elemento campo-distincion
            $(".campo-distincionP").removeClass("d-none");
        } else {
            // Ocultar el elemento campo-distincion
            $(".campo-distincionP").addClass("d-none");
            $("#editDistadicional").val("");
        }
        if (nuevoIdNombramiento === "6") {
            var inputElement =
                '<div class="form-group pt-2" id="editHrstrabajoContainer">' +
                '<label for="editHrstrabajo">Horas de trabajo:</label>' +
                '<input type="text" class="form-control" id="editHrstrabajo">' +
                "</div>";

            // Reemplazar el contenido del contenedor con el nuevo input y label
            $("#editHrstrabajoContainer").replaceWith(inputElement);
        }

        obtenerYMostrarCategorias(idPersona, nuevoIdNombramiento);
    });
});

function EditarNombramientoP(id) {
    $(".confirm-reportP").off("click");
    $(".confirm-reportP").on("click", function () {
        var band = 0;
        // Obtener los valores
        var nombramiento = $("#editNombramiento").val();
        var id_categoria = $("#editCategoria").val();
        var area_distincion = $("#editAreaDistincion").val();
        var distincion_adicional = $("#editDistadicional").val();
        var horario_oficial = $("#editHrsOficial").val();
        var horario_actual = $("#editHrsActual").val();
        var turno = $("#editTurno").val();
        var tipo_contrato = $("#editContrato").val();
        var fecha_termino = $("#editFechaT").val();
        var estado = $("#editEstados").val();
        var horas_trabajo = $("#editHrstrabajo").val();

        //Validar los datos
        let V_nombramiento = validarCampo(
            nombramiento,
            regexNumero,
            "#nombramientos"
        );
        let V_categoria = validarCampo(
            id_categoria,
            regexNumero,
            "#categorias"
        );
        let V_estado = validarCampo(estado, regexNumero, "#editEstado");
        //let V_distincion = validarCampo(distincion_adicional,regexNumero,"#Distincion_Adicional");
        let V_area = validarCampo(area_distincion, regexLetters, "#dep");
        let V_horarioOf = validarCampo(
            horario_oficial,
            regexNumero,
            "#hor_oficial"
        );
        let V_horarioA = validarCampo(
            horario_actual,
            regexNumero,
            "#hor_actual"
        );
        let V_horasT = validarCampo(horas_trabajo, regexDecimal, "#hours");
        let V_turno = validarCampo(turno, regexNumero, "#shift");
        let V_tipo = validarCampo(tipo_contrato, regexNumero, "#contrato");

        // Si el contrato es temporal
        if (tipo_contrato == 1) {
            let V_fechaT = validarCampo(
                fecha_termino,
                regexFecha,
                "#fecha_termino"
            );
            console.log("Entra");
            if (!V_fechaT) {
                console.log("Error en Fecha ");
                band = 1;
            } else {
                $("#fecha_termino").removeClass("border border-error");
                band = 0;
            } // No puede estar vacio
        }

        if (
            band == 0 &&
            V_nombramiento &&
            V_categoria &&
            V_area &&
            V_horarioOf &&
            V_tipo &&
            V_turno &&
            V_horasT &&
            V_horarioA &&
            V_estado
        ) {
            var horasM;
            if (["1", "2", "3", "4", "5", "6"].includes(horas_trabajo)) {
                const HorasMap = {
                    1: "20",
                    2: "24",
                    3: "36",
                    4: "40",
                    5: "48",
                    6: "0",
                };
                // Mapear el valor seleccionado al valor correspondiente en tu mapeo de horas
                horasM = HorasMap[horas_trabajo];
            } else {
                // Si no está en los valores permitidos, solo asigna el valor actual de horas_trabajo
                horasM = horas_trabajo;
            }

            const Job = {
                Nombramiento: nombramiento,
                Categoria: id_categoria,
                Adicional: distincion_adicional,
                Adscripcion: area_distincion,
                Actual: horario_actual,
                Oficial: horario_oficial,
                Horas: horasM,
                Turno: turno,
                Contrato: tipo_contrato,
                Vencimiento: fecha_termino,
                Estado: estado,
            };

            // Realizar el envío del formulario si la validación es exitosa
            console.log("Todos los datos están correctos");
            editarNombramientoP(Job, id);
        } else {
            console.log("Error en la validación");
            console.log(band);
        }
    });
}

async function editarNombramientoP(Job, id) {
    console.log("entra editar");
    console.log(Job);
    const datos = {
        Job,
    };
    try {
        const response = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#007F73",
            cancelButtonColor: "#B04759",
            confirmButtonText:
                '<i class="fa-solid fa-pen animated-icon px-1"></i> Editar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        });

        if (response.isConfirmed) {
            activeLoading();
            const responseAxios = await axios.put("/editar-NP/" + id, datos);
            const { data } = responseAxios;
            const { status, msg } = data;
            disableLoading();
            if (responseAxios.status == 200) {
                disableLoading(); // Desactivar carga
                console.log("Entra");

                Swal.fire({
                    title: "¡Éxito!",
                    text: msg,
                    icon: "success",
                    didClose: () => {
                        location.reload();
                    },
                });
            } else {
                disableLoading(); // Desactivar carga
                Swal.fire({
                    title: "¡Error al editar los datos!",
                    text: msg,
                    icon: "error",
                });
            }
        } else {
            disableLoading(); // Desactivar carga si se cancela
        }
    } catch (error) {
        disableLoading(); // Desactivar carga si hay un error
        console.log(error);
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////
//EDITAR EL NOMBRAMIENTO SECUNDARIO

// Función para obtener las categorías
$(document).ready(function () {
    // Almacenar la opción seleccionada actualmente en una variable global
    var categoriaSeleccionada = null;

    // Función para obtener y mostrar las categorías
    async function obtenerYMostrarCategoriaS(idPersona, idNombramiento, cate) {
        var genero = $("#editGenero").val().trim();
        const datos = { genero, idNombramiento };
        try {
            const response = await axios.post(
                "/obtener-categorias/" + idPersona,
                datos
            );
            const { data } = response;
            const { status, Categorias } = data;

            if (status === 200) {
                console.log("Entra");
                // Limpiar el select de categorías
                $("#editCategoriaS").empty();
                // Agregar las nuevas opciones de categorías
                Categorias.forEach((categoria) => {
                    $("#editCategoriaS").append(
                        `<option value="${categoria.id}">${categoria.nombre}</option>`
                    );
                });
                $("#editCategoriaS").val(cate);

                // Restaurar la categoría seleccionada si existe
                if (categoriaSeleccionada !== null) {
                    $("#editCategoriaS").append(
                        `<option value="${categoriaSeleccionada.id}" selected>${categoriaSeleccionada.nombre}</option>`
                    );
                }
            } else {
                // Realizar acciones en caso de algún otro estado de respuesta
            }
        } catch (error) {
            disableLoading();
            console.log(error);
            // Manejar el error, mostrar mensajes de error, etc.
        }
    }

    // Evento click en el botón de editar
    $("#botonEditarS").on("click", function () {
        var idPersona = $("#detalles-container").data("id");
        RequestDataPersona(idPersona);
        var idNombramiento = $("#editNombramientoS").val();
        var idcate = $("#editCategoriaS").val();

        if (
            idNombramiento === "4" ||
            idNombramiento === "5" ||
            idNombramiento === "6"
        ) {
            // Mostrar el elemento campo-distincion
            $(".campo-distincionS").removeClass("d-none");
        } else {
            // Ocultar el elemento campo-distincion
            $(".campo-distincionS").addClass("d-none");
        }
        obtenerYMostrarCategoriaS(idPersona, idNombramiento, idcate);
    });

    // Evento change en el select de nombramientos
    $("#editNombramientoS").on("change", function () {
        var nuevoIdNombramiento = $(this).val();
        var idPersona = $("#detalles-container").data("id");
        if (
            nuevoIdNombramiento === "4" ||
            nuevoIdNombramiento === "5" ||
            nuevoIdNombramiento === "6"
        ) {
            // Mostrar el elemento campo-distincion
            $(".campo-distincionS").removeClass("d-none");
        } else {
            // Ocultar el elemento campo-distincion
            $(".campo-distincionS").addClass("d-none");
            $("#editDistadicionalS").val("");
        }
        if (nuevoIdNombramiento === "6") {
            var inputElement =
                '<div class="form-group pt-2" id="editHrstrabajoSContainer">' +
                '<label for="editHrstrabajoS">Horas de trabajo:</label>' +
                '<input type="text" class="form-control" id="editHrstrabajoS">' +
                "</div>";

            // Reemplazar el contenido del contenedor con el nuevo input y label
            $("#editHrstrabajoSContainer").replaceWith(inputElement);
        }
        obtenerYMostrarCategoriaS(idPersona, nuevoIdNombramiento);
    });
});

function EditarNombramientoS(id) {
    $(".confirm-reportS").off("click");
    $(".confirm-reportS").on("click", function () {
        var band = 0;
        // Obtener los valores
        var nombramiento = $("#editNombramientoS").val().trim();
        var id_categoria = $("#editCategoriaS").val();
        var area_distincion = $("#editAreaDistincionS").val().trim();
        var distincion_adicional = $("#editDistadicionalS").val().trim();
        var horario_oficial = $("#editHrsOficialS").val().trim();
        var horario_actual = $("#editHrsActualS").val().trim();
        var turno = $("#editTurnoS").val().trim();
        var tipo_contrato = $("#editContratoS").val().trim();
        var fecha_termino = $("#editFechaTS").val().trim();
        var estado = $("#editEstadoS").val().trim();
        var horas_trabajo = $("#editHrstrabajoS").val();

        //Validar los datos
        let V_nombramiento = validarCampo(
            nombramiento,
            regexNumero,
            "#nombramientos"
        );
        let V_categoria = validarCampo(
            id_categoria,
            regexNumero,
            "#categorias"
        );
        let V_estado = validarCampo(estado, regexNumero, "#editEstado");
        //let V_distincion = validarCampo(distincion_adicional,regexNumero,"#Distincion_Adicional");
        let V_area = validarCampo(area_distincion, regexLetters, "#dep");
        let V_horarioOf = validarCampo(
            horario_oficial,
            regexNumero,
            "#hor_oficial"
        );
        let V_horarioA = validarCampo(
            horario_actual,
            regexNumero,
            "#hor_actual"
        );
        let V_horasT = validarCampo(horas_trabajo, regexDecimal, "#hours");
        let V_turno = validarCampo(turno, regexNumero, "#shift");
        let V_tipo = validarCampo(tipo_contrato, regexNumero, "#contrato");

        // Si el contrato es temporal
        if (tipo_contrato == 1) {
            let V_fechaT = validarCampo(
                fecha_termino,
                regexFecha,
                "#fecha_termino"
            );
            console.log("Entra");
            if (!V_fechaT) {
                console.log("Error en Fecha ");
                band = 1;
            } else {
                $("#fecha_termino").removeClass("border border-error");
                band = 0;
            } // No puede estar vacio
        }

        if (
            band == 0 &&
            V_nombramiento &&
            V_categoria &&
            V_area &&
            V_horarioOf &&
            V_tipo &&
            V_turno &&
            V_horasT &&
            V_horarioA &&
            V_estado
        ) {
            var horasM;
            if (["1", "2", "3", "4", "5", "6"].includes(horas_trabajo)) {
                const HorasMap = {
                    1: "20",
                    2: "24",
                    3: "36",
                    4: "40",
                    5: "48",
                    6: "0",
                };
                // Mapear el valor seleccionado al valor correspondiente en tu mapeo de horas
                horasM = HorasMap[horas_trabajo];
            } else {
                // Si no está en los valores permitidos, solo asigna el valor actual de horas_trabajo
                horasM = horas_trabajo;
            }

            const Job = {
                Nombramiento: nombramiento,
                Categoria: id_categoria,
                Adicional: distincion_adicional,
                Adscripcion: area_distincion,
                Actual: horario_actual,
                Oficial: horario_oficial,
                Horas: horasM,
                Turno: turno,
                Contrato: tipo_contrato,
                Vencimiento: fecha_termino,
                Estado: estado,
            };

            // Realizar el envío del formulario si la validación es exitosa
            console.log("Todos los datos están correctos");
            editarNombramientoS(Job, id);
        } else {
            console.log("Error en la validación");
            console.log(band);
        }
    });
}

async function editarNombramientoS(Job, id) {
    console.log("entra editar");
    console.log(Job);
    const datos = {
        Job,
    };
    try {
        const response = await Swal.fire({
            title: "¿Estás seguro de editar los datos?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#007F73",
            cancelButtonColor: "#B04759",
            confirmButtonText:
                '<i class="fa-solid fa-pen animated-icon px-1"></i> Editar',
            cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
        });

        if (response.isConfirmed) {
            activeLoading();
            const responseAxios = await axios.put("/editar-NS/" + id, datos);
            const { data } = responseAxios;
            const { status, msg } = data;
            disableLoading();
            if (responseAxios.status == 200) {
                disableLoading(); // Desactivar carga
                console.log("Entra");

                Swal.fire({
                    title: "¡Éxito!",
                    text: msg,
                    icon: "success",
                    didClose: () => {
                        location.reload();
                    },
                });
            } else {
                disableLoading(); // Desactivar carga
                Swal.fire({
                    title: "¡Error al editar los datos!",
                    text: msg,
                    icon: "error",
                });
            }
        } else {
            disableLoading(); // Desactivar carga si se cancela
        }
    } catch (error) {
        disableLoading(); // Desactivar carga si hay un error
        console.log(error);
    }
}

$(document).ready(function () {
    // Agregar un controlador de eventos clic al botón "Cancelar"
    $("#cancelReport").on("click", function () {
        // Recargar la página actual
        location.reload();
    });
});
