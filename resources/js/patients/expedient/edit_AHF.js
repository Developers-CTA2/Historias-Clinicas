import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

$(document).ready(function () {
    console.log("Editar AHF");
    EventEditAHF();
    DeleteAHF();
});
/*
Funcion para el switch de editar datos, donde si se activa miostrará todos los inputs para editar los datos
*/
function EventEditAHF() {
    $("#Edit-AHF").on("change", function () {
        const isChecked = $("#Edit-AHF").is(":checked");
        if (isChecked) {
            // Mostrar opcion de edicion
            $(".alert-AHF").html(
                '<svg class="pe-2" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48"><circle cx="24" cy="24" r="21" fill="#2196F3" /><path fill="#fff" d="M22 22h4v11h-4z" /><circle cx="24" cy="16.5" r="2.5" fill="#fff" /></svg> Ahora estás en modo de edición.'
            );
            $(".AHF-data").removeClass("d-none").hide().fadeIn(400);
        } else {
            /* Cancelar edicion */

            // CoverContents();
            $(".AHF-data")
                .addClass("animate__fadeOutUp")
                .fadeOut(400, function () {
                    $(this)
                        .addClass("d-none")
                        .removeClass("animate__fadeOutUp");
                });
        }
    });
}

/*
Funcionpara el clic al boton de borrarr una enfermedad
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

/* Funcion para confimar que los datos seran editados  */
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
        Id_reg: parseInt(id_reg),
        Id_ahf: parseInt(Id_ahf),
        Type: parseInt(Type),
    };
    try {
        const response = await axios.post(
            "/patients/expediente/Update_ahf_Data",
            Data
        );

        console.log(response.data);
        const { data } = response;
        ShowIcon(id_reg);       // Mostrar icono de warning 
        ClicRefresh();          // habilitar el recargar la pagina
    } catch (error) {
         $(".alert-AHF").html(
             '<svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><path fill="#FF473E" d="m330.443 256l136.765-136.765c14.058-14.058 14.058-36.85 0-50.908l-23.535-23.535c-14.058-14.058-36.85-14.058-50.908 0L256 181.557L119.235 44.792c-14.058-14.058-36.85-14.058-50.908 0L44.792 68.327c-14.058 14.058-14.058 36.85 0 50.908L181.557 256L44.792 392.765c-14.058 14.058-14.058 36.85 0 50.908l23.535 23.535c14.058 14.058 36.85 14.058 50.908 0L256 330.443l136.765 136.765c14.058 14.058 36.85 14.058 50.908 0l23.535-23.535c14.058-14.058 14.058-36.85 0-50.908z"/></svg> <strong> ¡Error! </strong> Algo salio mal, intentalo más tarde.'
         );
        console.log(error);
    }
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
            '<button class="btn-refresh btn_warning pe-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64"> <path fill="#ffdd15" d="M63.37 53.52C53.982 36.37 44.59 19.22 35.2 2.07a3.687 3.687 0 0 0-6.522 0C19.289 19.22 9.892 36.37.508 53.52c-1.453 2.649.399 6.083 3.258 6.083h56.35c1.584 0 2.648-.853 3.203-2.01c.698-1.102.885-2.565.055-4.075" /> <path fill="#1f2e35" d="m28.917 34.477l-.889-13.262c-.166-2.583-.246-4.439-.246-5.565c0-1.534.4-2.727 1.202-3.588c.805-.856 1.863-1.286 3.175-1.286c1.583 0 2.646.551 3.178 1.646c.537 1.102.809 2.684.809 4.751c0 1.215-.066 2.453-.198 3.708l-1.19 13.649c-.129 1.626-.404 2.872-.827 3.739c-.426.871-1.128 1.301-2.109 1.301c-.992 0-1.69-.419-2.072-1.257c-.393-.841-.668-2.12-.833-3.836m3.072 18.217c-1.125 0-2.106-.362-2.947-1.093c-.841-.728-1.26-1.748-1.26-3.058c0-1.143.4-2.12 1.202-2.921c.805-.806 1.786-1.206 2.951-1.206s2.153.4 2.977 1.206c.815.801 1.234 1.778 1.234 2.921c0 1.29-.419 2.308-1.246 3.044a4.245 4.245 0 0 1-2.911 1.107" /></svg> </button>  Recarga la página para ver los cambios.'
        );
        // solo si teien la clase
        if ($(".AHF-data").hasClass("d-none")) {
            $(".AHF-data").removeClass("d-none").hide().fadeIn(400);
        }
    });
}

/* Funcion para recargar la pagina y ver los cambios refeljados ya en la vista */
function ClicRefresh() {
    console.log("clic refresh");
    $(".btn-refresh").removeClass("d-none");
    $(".btn-refresh").off("click");
    $(".btn-refresh").on("click", function () {
        console.log("Refrescar pagina ");
        window.location.reload();
    });
}
