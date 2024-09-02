import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";
import { AlertCancelConfirmation } from "./helpers";

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("historialNutricionForm");
    const btnCancelConsultation = document.getElementById("cancelConsultation");
    const idPerson = document.getElementsByName('id_persona')[0].value;
    
    // console.log(idPerson[0].value);


    btnCancelConsultation.addEventListener('click',function(){
        AlertCancelConfirmation('¿Estás seguro?','Perderás toda la información que has ingresado.',`/patients/medical_record/${idPerson}`)
    });

    if (form) {
        form.addEventListener("submit", async function(event) {
            event.preventDefault();  // Evita el envío tradicional del formulario

            const formData = new FormData(form);
            const id_persona = formData.get("id_persona");
            const comidas_al_dia = formData.get("comidas_al_dia");
            const qien_prepara_comida = formData.get("qien_prepara_comida");
            const apetito = formData.get("apetito");
            const alimentos_no_preferidos = formData.get("alimentos_no_preferidos");
            const suplementos = formData.get("suplementos");
            const grasas_consumidas = formData.get("grasas_consumidas");
            const actividad = formData.get("actividad");
            const tipo_ejercicio = formData.get("tipo_ejercicio");
            const frecuencia_ejercicio = formData.get("frecuencia_ejercicio");
            const duracion_ejercicio = formData.get("duracion_ejercicio");

            if (!id_persona || !comidas_al_dia || !qien_prepara_comida || !apetito || !actividad || !tipo_ejercicio || !frecuencia_ejercicio || !duracion_ejercicio) {
                Swal.fire({
                    title: "¡Error!",
                    text: "Por favor, complete todos los campos requeridos.",
                    icon: "error",
                });
                return;  // Asegúrate de que no continúe con el procesamiento
            }

            const response = await Swal.fire({
                title: "¿Estás seguro de registrar el historial de nutrición?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007F73",
                cancelButtonColor: "#B04759",
                confirmButtonText: '<i class="fa-solid fa-save animated-icon px-1"></i> Guardar',
                cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
                reverseButtons: true,
            });

            if (response.isConfirmed) {
                try {
                    activeLoading();  // Muestra el loading

                    const  {data}  = await axios.post(form.action, {
                        id_persona,
                        comidas_al_dia,
                        qien_prepara_comida,
                        apetito,
                        alimentos_no_preferidos,
                        suplementos,
                        grasas_consumidas,
                        actividad,
                        tipo_ejercicio,
                        frecuencia_ejercicio,
                        duracion_ejercicio,
                    });

                    if (data.status === 'success') {
                        Swal.fire({
                            title: "¡Éxito!",
                            text: data.message,
                            icon: "success",
                    }).then(() => {
                            form.reset();  // Opcional: Limpiar el formulario
                            location.href = `/patients/nutrition/${data.idPersona}/consultation/new`;  // Redireccionar a la lista de pacientes
                        });
                    } else {
                        Swal.fire({
                            title: "¡Error!",
                            text: data.message,
                            icon: "error",
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        title: "¡Error!",
                        text: "Ocurrió un error al intentar registrar el historial de nutrición.",
                        icon: "error",
                    });
                } finally {
                    disableLoading();  // Oculta el loading, ya sea en caso de éxito o error
                }
            }
        });
    }
});
