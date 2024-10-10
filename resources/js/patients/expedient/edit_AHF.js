import { validarCampo, regexNumero } from "../../helpers";
import {
    IconInfo,
    IconWarning,
    ShowErrorsSweet,
    IconError,
} from "../../templates/AlertsTemplate.js";
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

$(document).ready(function () {
    
    InitiliazeSelect1();
    EventEditAHF();
});

/* Inicializar el selct de las enfermedades */
function InitiliazeSelect1() {
    $("#New_disease").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--base",
        dropdownCssClass: "select2--base",
        width: "100%",
    });
}
/*
    HABILITAR LA EDICION DE AHF
    Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAHF() {
    $("#Edit-AHF").on("change", function () {
        const isChecked = $("#Edit-AHF").is(":checked");
        if (isChecked) {
            IconInfo();

            $(".alert-AHF").html(IconInfo("Ahora estás en modo de edición."));
            $(".AHF-data").removeClass("d-none").hide().fadeIn(400);

            ClicEdit();
            ClicAdd();
            DeleteAHF();
        } else {
            /* Cancelar edicion */
            $(".AHF-data")
                .addClass("animate__fadeOutUp")
                .fadeOut(400, function () {
                    $(this)
                        .addClass("d-none")
                        .removeClass("animate__fadeOutUp");
                });
            $("#Diseases").collapse("hide");
        }
    });
}

/*
Funcion para el clic al boton de borrar una enfermedad
*/
function DeleteAHF() {
    $(".Del-AHF").off("click");
    $(".Del-AHF").on("click", function () {
        let id_reg = $(this).data("ahf");
        console.log("AHF: " + id_reg);
        Confirm(
            "¿Estás seguro eliminar la enfermedad?",
            "Se borrará la enfermedad del expediente.",
            1,
            id_reg,
            ""
        );
    });
}

/* Clic en editar una enfermedad, muestra el collapse con los datos del registro a editar y mustra las opciones de las enfermedades disponibles */
function ClicEdit() {
    CloseCollapse();
    $(".edit-AHF").off("click");
    $(".edit-AHF").on("click", function () {
        var Id = $(this).data("id_reg");
        var name = $(this).data("name");
        var Id_ahf = $(this).data("id_ahf");
        console.log("id  " + Id + " name " + name + " esp" + Id_ahf);

        // Mostrar los datos
        $(".Old_disease").text(name);
        $(".Type-accion").text("Modificar enfermedad");

        // verificar que si haya cambios
        $("#New_disease").on("change", function () {
            $(".Old_disease").text($("#New_disease option:selected").text()); // mostrar texto
            $(".Old_disease")
                .removeClass("text-muted")
                .addClass("font-weight-normal");
            console.log("NEW " + $("#New_disease").val() + " OLD " + Id_ahf);

            if (Id_ahf == $("#New_disease").val()) {
                console.log("Igual ");
              
                // Todo igual 
                $(".Old_disease")
                    .removeClass("font-weight-normal")
                    .addClass("text-muted");
                // Alerta de no hay cambios
                $(".alert-AHF").html(IconWarning(" No se realizó  ningun cambio."));
            } else {
                console.log("Cambio ");
                $(".alert-AHF").html(IconWarning( " Cambio detectado da clic en <strong> Guardar </strong>." ));
                ClicSaveChanges(Id, $("#New_disease").val(), 2); // Type es para saber si es edit o add
            }
        });
        /* Clic a guardar sin haber modoficado nada */
        $(".Save-changes").off("click");
        $(".Save-changes").on("click", function () {
            $(".alert-AHF").html(
                IconWarning(
                    "<strong> ¡Error! </strong> No se realizó  ningun cambio."
                )
            );
        });
    });
}

/*
 Funcion para agregar un anueva enfermedad heredofamiliar al paciente
*/
function ClicAdd() {
    $(".add-Disease").off("click");
    $(".add-Disease").on("click", function () {
        var path = window.location.pathname;
        var segments = path.split("/");
        var id = segments[segments.length - 1];

        /* Esperar un camio y mostrarlo en la pantalla */
        $("#New_disease").on("change", function () {
            $(".Old_disease").text($("#New_disease option:selected").text()); // mostrar texto
            $(".Old_disease")
                .removeClass("text-muted")
                .addClass("font-weight-normal");
            ClicSaveChanges(id, "", 3);
            console.log("Add collapse");
        });

         $(".Save-changes").off("click");
         $(".Save-changes").on("click", function () {
             $(".alert-AHF").html(
                 IconWarning(
                     "<strong> ¡Error! </strong> No se realizó  ningun cambio."
                 )
             );
         });
    });
}

/*
    Funcion para mostrar el icono del warning cuando se hace la edicion de algun dato
*/
function ShowIcon(id_Icon) {
    console.log(id_Icon);
    $(".icon-container").each(function () {
        var iconId = $(this).data("icon");
        console.log(iconId);
        if (iconId == id_Icon) {
            // Solo si tiene la clase
            if ($(".icon-container").hasClass("d-none")) {
                $(this).removeClass("d-none");
            }
        }

        $(".alert-AHF").html(
            IconWarning( " Cambio realizado da clic en <strong> Recargar </strong>." ));

        // solo si teien la clase
        if ($(".AHF-data").hasClass("d-none")) {
            $(".AHF-data").removeClass("d-none").hide().fadeIn(400);
        }
    });
}

/* Funcion para recargar la pagina y ver los cambios refeljados ya en la vista */
function ClicRefresh() {
    $(".btn-refresh").removeClass("d-none");
    $(".btn-refresh").off("click");
    $(".btn-refresh").on("click", function () {
        console.log("Refrescar pagina ");
        window.location.reload();
    });
}

/*
    Funcion para cerrar el Collapse desde el boron de cerlrar
*/
function CloseCollapse() {
    $(".cerrar").on("click", function () {
        $("#Diseases").collapse("hide");
    });
}

/*
    Boton de guardar cambios en el collapse 
*/
function ClicSaveChanges(Id, Id_ahf, Type) {
    $(".Save-changes").off("click");
    $(".Save-changes").on("click", function () {
        let Title;
        let Text;
        if (Type == 3) {
            // en este caso Id es Id de la persona
            Id_ahf = parseInt($("#New_disease").val());
            let V_enf = validarCampo(Id_ahf, regexNumero, "#New_disease");
            if (V_enf) {
                Title = "¿Estás seguro agregar la nueva enfermedad?";
                Text = "La enfermedad se anexará al expediente.";
            }
        } else {
            Title = "¿Estás seguro de modificar la enfermedad?";
            Text = "Se reemplazarán los datos en el expediente.";
        }

        Confirm(Title, Text, Type, Id, Id_ahf);

        console.log("Clic guaradar  con los datos:  " + Id + " Y " + Id_ahf);
    });
}

/* Funcion para confimar que los datos seran editados/Borrados/Agregados  */
function Confirm(Title, Text, Type, id_reg, Id_ahf) {
    Swal.fire({
        title: Title,
        text: Text,
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            RequestUpdate(id_reg, Type, Id_ahf);
        }
    });
}
/* 
    Funcion que hace la consulta al controlador para la edicion o eliminacion del registro
*/
async function RequestUpdate(id_reg, Type, Id_ahf) {
    const Data = {
        Id_reg: parseInt(id_reg), //parseInt(id_reg)
        Id_ahf: parseInt(Id_ahf), //parseInt(Id_ahf)
        Id_person: parseInt(id_reg),
    };
    console.log(Data);
    try {
        let response = "";
        if (Type == 1) {
            //Delete
            response = await axios.post(
                "/patients/medical_record/Delete_Ahf",
                Data
            );
        } else if (Type == 2) {
            // Update
            response = await axios.post(
                "/patients/medical_record/Update_Ahf",
                Data
            );
        } else {
            // Store
            response = await axios.post(
                "/patients/medical_record/Store_Ahf",
                Data
            );
        }

        console.log(response.data);
        const { data } = response;
        $("#Diseases").collapse("hide");

        $(".alert-AHF").html(
            IconWarning(
                " Cambio realizado da clic en <strong> Recargar </strong>."
            )
        );
        ShowIcon(id_reg); // Mostrar icono de warning
        ClicRefresh(); // habilitar el recargar la pagina
        InitiliazeSelect1();
    } catch (error) {
        const { status, data } = error.response;
        console.log(error);

        if (status == 422) {
            await ShowErrorsSweet(
                "¡Error!",
                "Se detectarón algunos errores al realizar la petición",
                "error",
                data.errors
            );
        } else {
            $(".alert-AHF").html(IconError(data.msg));
        }
    }
}
