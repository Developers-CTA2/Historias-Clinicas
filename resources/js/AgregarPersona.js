import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";

window.addEventListener("load", function () {
    disableLoading(); /// ya que se cargue todo quitar el loadin

    FormPersonalData();

    // FormDataJob();
    // disableLoading();
});

/*
    Validar datos personales
*/
async function FormPersonalData() {
    $("#personal-data").off("click");
    $("#personal-data").on("click", function () {
        // Obtenemos los datos
        var codigo = $("#codigo").val().trim();
        var sex = $("#sex").val();
        var name = $("#name_P").val().trim();
        var nacimiento = $("#fecha_nacimiento").val().trim();
        var ingreso = $("#fecha_ingreso").val().trim();
        var grade = $("#grade").val();
        var correo = $("#correo").val().trim();

        var tel = $("#tel").val().trim();
        var nombre_emer = $("#Emer_name").val().trim();

        /* Validamos los campos con su respectiva expresión regular y mandamos en id del campo por si hay error */
        let V_codigo = validarCampo(codigo, regexCode, "#codigo");
        let V_name = validarCampo(name, regexLetters, "#name_P");
        let V_sex = validarCampo(sex, regexNumero, "#sex");
        let V_grade = validarCampo(grade, regexNumero, "#grade");
        let V_nacimiento = validarCampo(
            nacimiento,
            regexFecha,
            "#fecha_nacimiento"
        );
        let V_ingreso = validarCampo(ingreso, regexFecha, "#fecha_ingreso");
        let V_correo = validarCampo(correo, regexCorreo, "#correo");
        
        let V_tel = false;
        if (tel != "") {
            V_tel = validarCampo(tel, regexNumero, "#tel");
        } else {
            ocultarerr("#tel");
            V_tel = true;
        }
        let N_emer = false;
        if (nombre_emer != "") {
            N_emer = validarCampo(nombre_emer, regexLetters, "#Emer_name");
        } else {
            ocultarerr("#Emer_name");
            N_emer = true;
        }

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
            N_emer
        ) {
            let PersonalData = {
                Codigo: codigo,
                Genero: sex,
                nombre: name,
                f_nacimiento: nacimiento,
                f_ingreso: ingreso,
                estudios: grade,
                correo: correo,
                telefono: tel,
                nombre_e: nombre_emer,
            };
            // Buscar que el codigo no se repita
            SearchCode(codigo, PersonalData);
        }
    });
}
 /* Funcion para buscar si el codigo esta disponible */
async function SearchCode(codigo, PersonalData) {
    console.log("Entra " + codigo);
    const dataCheck = {
        Codigo: codigo,
    };
    activeLoading();
    try {

        const response = await axios.post("/searchCode", dataCheck);
        const { data } = response;
        const { status } = data;
        disableLoading();
        if (status == true) {
            automaicScroll(".job-data");
            $(".job-data").fadeIn(700).removeClass("d-none");

            console.log("Codigo si esta disponible");
          Nombramiento(PersonalData);
        } else {
            Swal.fire({
                title: "¡Error!",
                text: "El código ya esta asociado a otra persona.",
                icon: "error",
            });
            FormPersonalData();
        }
    } catch (error) {
        console.error("Ocurrió un error durante la búsqueda de código:", error);
        return false; // Manejar el error y retornar false
    }
}

/*
    Validar los datos del formulario del los datos del nombramiento
*/
function Nombramiento(PersonalData) {
    console.log("Nombramiento: " + PersonalData);
    $("#nombramientos").on("change", function () {
        // Habilitar todos los inputs una vez que se selecciona un nombramiento
        $(".form-disabled").removeAttr("disabled");
        let TipoHoras = 0;

        const id_Nombramiento = $(this).val();
        let Distincion;
        var originalSelect = $("#hours");
        originalSelect.hide();

        if (id_Nombramiento > 3 && id_Nombramiento < 7) {
            if ($(".opc").hasClass("d-none")) {
                $(".opc").removeClass("d-none");
            }

             $("#hours").val("");
             $("#shift").val("");
             $("#hor_oficial").val("");
             $("#contrato").val("");
             $("#horas_actual").val("");
             $("#hor_actual").val("");
             $("#horas_oficial").val("");


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
            // Ocultar campos obligatorio que se llena automaticamente
            $(".opc").addClass("d-none");
            console.log("Es directivo ");
            Distincion = 0;

            // Llenar doatos automaticos
            $("#hours").val(6);
            $("#shift").val(5);
            $("#hor_oficial").val(3);
            $("#hor_actual").val("No aplica");
            $("#horas_actual").val("No aplica");
            $("#horas_oficial").val("No aplica");

            $("#contrato").val(1);

            // Marcar campos faltantes
            $("#fecha_termino").addClass("border border-success");
            $("#dep").addClass("border border-success");
            $("#categorias").addClass("border border-success");
        } else {
            if ($(".opc").hasClass("d-none")) {
                $(".opc").removeClass("d-none");
            }

            $("#hours_text").remove(); //  Eliminar input tipo text
            originalSelect.show(); // Mostrar select

            console.log("No es directivo");
            /* Valores por defecto  */
            $("#hours").val("");
            $("#shift").val("");
            $("#hor_oficial").val("");
            $("#contrato").val("");
            $("#horas_actual").val("");
            $("#hor_actual").val("");
            $("#horas_oficial").val("");

 

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
function FormDataJob(PersonalData, TipoHoras) {
    console.log("Form data : " + PersonalData);

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
        var horas_actual = $("#horas_actual").val();
        var horas_oficial = $("#horas_oficial").val();

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

        let V_horarioA = false;
        if (horas_oficial != "No aplica") {
            V_horarioA = validarCampo(
                horario_actual,
                regexLetrasHorario,
                "#hor_actual"
            );
        }

        let v_H_Actual = false;
        if (horas_actual != "No aplica") {
            v_H_Actual = validarCampo(
                horas_actual,
                regexHorario,
                "#horas_actual"
            );
        }
        let v_H_Oficial = false;

        if (horas_oficial != "No aplica") {
            v_H_Oficial = validarCampo(
                horas_oficial,
                regexHorario,
                "#horas_oficial"
            );
        }

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
            v_H_Actual && v_H_Oficial
        ) {
            let JobData = {
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
                H_ofi: horas_oficial,
                H_actual: horario_actual,
            };

            // Realizar el envío del formulario si la validación es exitosa
            console.log("Todos los datos están correctos");
            console.log(PersonalData);
            AgregarPersonal(PersonalData, JobData);
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
        console.log(response.data);

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

            FormDataJob(PersonalData, TipoHoras);
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

async function AgregarPersonal(Personal, Job) {
    activeLoading();
    console.log("entra");
    console.log(Personal);
    console.log(Job);
    const datos = {
        Personal,
        Job,
    };
    console.log(datos);

    try {
        const response = await axios.post("/guardar-Personal", datos);
        const { data } = response;
        const { status, msg } = data;

        console.log(response.data);
        disableLoading();

        if (status == 200) {
            disableLoading;
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
            disableLoading;
            Swal.fire({
                title: "¡Error!",
                text: msg,
                icon: "error",
            });
        }
    } catch (error) {
        disableLoading;
        // Swal.fire({
        //     title: "¡Error!",
        //     text: "Algo salio mal, intentalo otra vez.",
        //     icon: "error",
        // });
        console.log(error);
    }
}
