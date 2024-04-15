import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

/* Alerta que desaparece después de un intervalo de tiempo */
export function AlertaSweerAlert(Time, Title, msg, icono, type) {
    let timerInterval;
    Swal.fire({
        title: Title,
        html: `
        <div id="msgContainer">
            ${msg}
        </div>
    `,

        icon: icono,
        timer: Time,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        },
        willClose: () => {
            clearInterval(timerInterval);
        },
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            if (type == 1) {
                window.location.reload();
            }
        }
    });

    return timerInterval;
}
