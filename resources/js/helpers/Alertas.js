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

export const AlertSweetSuccess = (title, msg, url = '/patients') => {
    Swal.fire({
        icon: "success",
        title: title,
        text: msg,
        confirmButtonText: 'Aceptar',
    }).then(() => {
        window.location.href = url;
    });
};


export const AlertCancelConfirmation = (title, msg, url) => {
    Swal.fire({
        icon: "warning",
        title: title,
        text: msg,
        confirmButtonText: 'Si estoy seguro',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#afafaf',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

export const AlertConfirmationForm = (title, msg, callback) => {
    Swal.fire({
        icon: "warning",
        title: title,
        text: msg,
        confirmButtonText: 'Si estoy seguro',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((willConfirm) => {
        if (willConfirm.isConfirmed) {
            callback();
        }
    })

};


export const AlertForWarningConsultation = (data) => {

    return new Promise((resolve, reject) => {
        Swal.fire({
            icon: "success",
            title: 'Precaución',
            html: messageWarningConsultation(data),
            confirmButtonText: 'Si estoy seguro',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
        }).then((confirme) => {
            if (confirme.isConfirmed) {
                resolve(true);
            }
            else {
                reject(false);
            }
        })
    })

}

export const AlertErrorConsultation = (title, data) => {
    Swal.fire({
        icon: "error",
        title: title,
        html: messageErrorConsultation(data),
        confirmButtonText: 'Corregir',
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

export const AlertError = (title, msg, btnText = 'Aceptar') => {
    Swal.fire({
        icon: "error",
        title: title,
        text: msg,
        confirmButtonText: btnText,
        confirmButtonColor: '#047857'
    });
}

export const AlertErrorWithHTML = (title, msg) => {
    Swal.fire({
        icon: "error",
        title: title,
        html: msg,
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#047857'
    });
}
