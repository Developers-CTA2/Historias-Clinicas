import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";

// Llama a RequestDataPersona una vez que se cargue la página
window.addEventListener("load", function () { 
    var id = $("#detalles-container").data("id");
    disableLoading();
    RequestDataPersona(id);
});

/*
    Validar datos personales
*/
function RequestDataPersona(codigo) {
    $.ajax({

        url: '/detalles',  // Ruta a tu controlador para manejar la solicitud de detalles
        type: "POST",
        dataType: "json",
        data: {
        id: codigo,
            _token: $('meta[name="csrf-token"]').attr("content"), // token
        },
        success: function (response) {
            const { status, msg, data} = response;
            console.log(response);
            if (status == 200) {
                disableLoading();
                FormPersonalData(data) 
            }
        },
        error: function (error) {
            console.log(error);

        },
    });
}

function FormPersonalData(data) {
    $("#insertarS").off("click");
    $("#insertarS").on("click", function () {
        const { genero } = data;
        const generoMap = {
            masculino: 1,
            femenino: 2,
        };
        const generoId = generoMap[genero.toLowerCase()] || null;
        const PersonalData = {
            Genero: generoId, 
        };
    Nombramiento(PersonalData);
    }   
)};

/*
    Validar los datos del formulario del los datos del nombramiento
*/
function Nombramiento(PersonalData) {
    $("#nombramientos").off("change").on("change", function () {
        // Habilitar todos los inputs una vez que se selecciona un nombramiento
        $(".form-disabled").removeAttr("disabled");
        let TipoHoras = 0;

        const id_Nombramiento = $(this).val();
        let Distincion;
        var originalSelect = $("#hours");
        originalSelect.hide();
        if (id_Nombramiento > 3 && id_Nombramiento < 7) {
            if (id_Nombramiento == 6) {
                // Profesor de asignatura Horario con punto decimal
                // Ocultar el select original

                // Eliminar el nuevo select si existe
                $("#hours_select").remove();

                // Crear un nuevo input de tipo text
                var newInput = $("<input>", {
                    type: "text",
                    id: "hours_text",
                    name: "hours",
                    class: "form-control form-disabled",
                    placeholder: "10.30",
                });

                // Insertar el nuevo input después del select oculto
                originalSelect.after(newInput);

                TipoHoras = 1;
            } else {
                // Ocultar el input de tipo texto si existe
                $("#hours_text").hide();

                // Eliminar el nuevo input si existe
                $("#hours_text").remove();

                // Mostrar el select original
                originalSelect.show();
            }

            Distincion = 1;
        } else if (id_Nombramiento == 3) {
            $("#hours_text").remove(); //  Eliminar input tipo text
            originalSelect.show(); // Mostrar select

            console.log("Es directivo ");
            Distincion = 0;

            // Llenar doatos automaticos
            $("#hours").val(6);
            $("#shift").val(5);
            $("#hor_oficial").val(3);
            $("#hor_actual").val(3);
            $("#contrato").val(1);

            // Marcar campos faltantes
            $("#fecha_termino").addClass("border border-success");
            $("#dep").addClass("border border-success");
            $("#categorias").addClass("border border-success");
        } else {
            $("#hours_text").remove(); //  Eliminar input tipo text
            originalSelect.show(); // Mostrar select

            console.log("No es directivo");
            /* Valores por defecto  */
            $("#hours").val("");
            $("#shift").val("");
            $("#hor_oficial").val("");
            $("#hor_actual").val("");
            $("#contrato").val("");

            // Quitar bordes
            $("#fecha_termino").removeClass("border border-success");
            $("#categorias").removeClass("border border-success");
            $("#dep").removeClass("border border-success");
            Distincion = 0;
        } 

        buscar_distincion(
            PersonalData,
            id_Nombramiento,
            Distincion,
            PersonalData.Genero,
            TipoHoras
        );
    });
}

/* Funcion que obtiene losa datos del formulario y los valida */
function FormDataJob(TipoHoras) {
    $("#confirm-register").off("click");
    $("#confirm-register").on("click", function () {
        var band = 0;
        // Obtener los valores
        var nombramiento = $("#nombramientos").val();
        var id_categoria = $("#categorias").val();
        var area_distincion = $("#dep").val();
        var distincion_adicional = $("#Distincion_Adicional").val();
        var horario_oficial = $("#hor_oficial").val();
        var horario_actual = $("#hor_actual").val();
        var turno = $("#shift").val();
        var tipo_contrato = $("#contrato").val();
        var fecha_termino = $("#fecha_termino").val();
        var TipoHorasInt = parseInt(TipoHoras);

        if (TipoHorasInt == 1) {
            var horas_trabajo = $("#hours_text").val();
        } else {
            var horas_trabajo = $("#hours").val();
        }
        console.log(horas_trabajo);
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
        let V_fechaT = validarCampo(fecha_termino, regexFecha, "#fecha_termino");

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
            V_fechaT
        ) {
            const JobData = {
                Nombramiento: nombramiento,
                Categoria: id_categoria,
                Adicional: distincion_adicional,
                Adscripcion: area_distincion,
                Actual: horario_actual,
                Oficial: horario_oficial,
                Horas: horas_trabajo,
                Turno: turno,
                Contrato: tipo_contrato,
                Vencimiento: fecha_termino,
                TipoHoras: TipoHoras,
            };
            // Realizar el envío del formulario si la validación es exitosa
            console.log("Todos los datos están correctos");
            AgregarPersonal(JobData);
        } else {
            console.log("Error en la validación");
            console.log(band);
        }
    });
}

// Funcion que busca las distinciones segun el nombramiento
async function buscar_distincion(
    PersonalData,
    id_Nombramiento,
    distincion,
    Genero,
    TipoHoras
) {
    activeLoading();
    const dataCheck = {
        Id: id_Nombramiento,
        Dist: distincion,
        Genero: Genero,
    };
    try {
        const response = await axios.post("/distincion-adicional", dataCheck); 
        const { data } = response;
        const { Adicional, Categorias, status } = data;

        if (status == 200) {
            disableLoading();

            pantillaCategorias(Categorias);
            // Mostrar distincion adicional
            if (Adicional.length !== 0) {
                $(".campo-distincion").removeClass("d-none");
                pantillaDistinciones(Adicional);
            } else {
                if (!$(".campo-distincion").hasClass("d-none")) {
                    // Agregarle la propiedad si no la tiene
                    $(".campo-distincion").addClass("d-none");
                }
            }

            FormDataJob(TipoHoras);
        } else {
            disableLoading();

            Swal.fire({
                title: "¡Error!",
                text: "Hubo un error al cargar los datos, intentalo otra vez.",
                icon: "error",
            });
        }
    } catch (error) {
        Swal.fire({
            title: "¡Error!",
            text: "Algo salio mal, intentalo otra vez.",
            icon: "error",
        });
        console.log(error);
    }
}


/*
    Plantilla para mostrar las distinciones que tiene dicho nombramiento
*/
function pantillaDistinciones(data) {
    $("#Distincion_Adicional").empty();
    var optionDefault = $("<option>")
        .val("")
        .text("Selecciona una opción")
        .prop("disabled", true)
        .prop("selected", true);
    $("#Distincion_Adicional").append(optionDefault);
    data.forEach(function (distincion) {
        var option = $("<option>")
            .val(distincion.distincion_adicional.id)
            .text(distincion.distincion_adicional.nombre);
        $("#Distincion_Adicional").append(option);
    });
    var ninguna = $("<option>")
        .val("")
        .text("Ninguna")
        .prop("disabled", false)
        .prop("selected", false);
    $("#Distincion_Adicional").append(ninguna);
}

/*
    Plantilla para mostrar las categorias correspondientes a el nombramiento seleccionado
*/
function pantillaCategorias(Categorias) {
    console.log(Categorias);

    $("#categorias").empty();
    var optionDefault = $("<option>")
        .val("")
        .text("Selecciona una opción")
        .prop("disabled", true)
        .prop("selected", true);

    $("#categorias").append(optionDefault);
    Categorias.forEach(function (Categoria) {
        var option = $("<option>").val(Categoria.id).text(Categoria.nombre);
        $("#categorias").append(option);
    });
}

async function AgregarPersonal(Job) {
    console.log("datosssss",Job);
    var id = $("#detalles-container").data("id");
    activeLoading();
    console.log("entra");
    console.log(Job);
    const datos = {
        Job,
    };
    console.log(datos);
    try {
        const response = await axios.post("/Nombra-Secu/" + id, datos);
        const { data } = response;
        const { status, msg } = data;

        console.log(response.data);
        disableLoading();

        if (status == 200) {
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
            Swal.fire({
                title: "¡Error!",
                text: msg,
                icon: "error",
            });
        }
    } catch (error) {
        console.error(error);
        disableLoading();
        Swal.fire({
            title: "¡Error!",
            text: "Algo salió mal, inténtalo nuevamente.",
            icon: "error",
        });
    }
}

