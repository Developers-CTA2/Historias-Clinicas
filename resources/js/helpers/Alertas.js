import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";

import { messageWarningConsultation, messageErrorConsultation } from '../templates';


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

export const AlertSweetSuccess = (title, msg) => {
    Swal.fire({
        icon: "success",
        title: title,
        text: msg,
        confirmButtonText : 'Aceptar',
    }).then(() => {
        window.location.href = "/patients";
    });
};


export const AlertForWarningConsultation = (data) => {

    return new Promise((resolve, reject) => {
        Swal.fire({
            icon: "success",
            title: 'Precaución',
            html : messageWarningConsultation(data),
            confirmButtonText : 'Si estoy seguro',
            showCancelButton : true,
            cancelButtonText : 'Cancelar',
        }).then((confirme) => {
            if(confirme.isConfirmed){
                resolve(true);
            }
            else{
                reject(false);
            }
        })
    })

}

export const AlertErrorConsultation = (title, data) => {
    Swal.fire({
        icon: "error",
        title: title,
        html : messageErrorConsultation(data),
        confirmButtonText : 'Corregir',
    });

}

export const AlertErrorHistoryConsultation = (title, msg) => {
    Swal.fire({
        icon: "error",
        title: title,
        text: msg,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#047857'
    });
}