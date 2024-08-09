import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import axios from 'axios';
import { activeLoading, disableLoading } from "./loading-screen.js";

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("nutricionalForm");

    if (form) {
        form.addEventListener("submit", async function(event) {
            event.preventDefault();  // Evita el envío tradicional del formulario

            const formData = new FormData(form);
            const id_persona = formData.get("id_persona");
            const vasos_agua = formData.get("vasos_agua");
            const motivo_consulta = formData.get("motivo_consulta");
            const toma_medicamentos = formData.get("toma_medicamentos");
            const diagnostico = formData.get("diagnostico");
            const peso_actual = formData.get("peso_actual");
            const peso_habitual = formData.get("peso_habitual");
            const estatura = formData.get("estatura");
            const circunferencia_cintura = formData.get("circunferencia_cintura");
            const circunferencia_cadera = formData.get("circunferencia_cadera");

            // Verificar si todos los campos requeridos están completos
            if (!id_persona || !vasos_agua || !motivo_consulta || !toma_medicamentos || !peso_actual || !peso_habitual || !estatura || !circunferencia_cintura || !circunferencia_cadera) {
                Swal.fire({
                    title: "¡Error!",
                    text: "Por favor, complete todos los campos requeridos.",
                    icon: "error",
                });
                return;  // Asegúrate de que no continúe con el procesamiento
            }

            const response = await Swal.fire({
                title: "¿Estás seguro de registrar la consulta nutricional?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007F73",
                cancelButtonColor: "#B04759",
                confirmButtonText: '<i class="fa-solid fa-save animated-icon px-1"></i> Guardar',
                cancelButtonText: '<i class="fa-solid fa-times"></i> Cancelar',
            });

            if (response.isConfirmed) {
                try {
                    activeLoading();  // Muestra el loading

                    const { data } = await axios.post(form.action, {
                        id_persona,
                        vasos_agua,
                        motivo_consulta,
                        toma_medicamentos,
                        diagnostico,
                        peso_actual,
                        peso_habitual,
                        estatura,
                        circunferencia_cintura,
                        circunferencia_cadera,
                    });

                    if (data.status === 'success') {
                        Swal.fire({
                            title: "¡Éxito!",
                            text: data.message,
                            icon: "success",
                        }).then(() => {
                            form.reset();  // Opcional: Limpiar el formulario
                        });
                    } else {
                        Swal.fire({
                            title: "¡Error!",
                            text: data.message,
                            icon: "error",
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Ocurrió un error al intentar registrar la consulta nutricional.",
                        icon: "error",
                    });
                } finally {
                    disableLoading();  // Oculta el loading, ya sea en caso de éxito o error
                }
            }
        });
    }
});
