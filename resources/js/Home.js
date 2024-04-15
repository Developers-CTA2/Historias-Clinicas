import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
import { activeLoading, disableLoading } from "./loading-screen.js";

$(document).ready(function () {
    Contadores();
});

async function Contadores() {
    activeLoading();

    try {
        const response = await axios.get("contadores");
        const { data } = response;
        const { status, Counts } = data;

        console.log(response.data);

        if (status == 200) {
            console.log(Counts);

            const {
                PA,
                TA,
                PTC,
                Directivos,
                Operativos,
                Admin,
                Totales,
                Users,
            } = Counts[0];
            console.log(PA);

            disableLoading();
            animacionContador("#Total", Totales, 2000);
            animacionContador("#Administrativos", Admin, 2000);
            animacionContador("#Operativos", Operativos, 2000);
            animacionContador("#Directivos", Directivos, 2000);
            animacionContador("#PTC", PTC, 2000);
            animacionContador("#TA", TA, 2000);
            animacionContador("#PA", PA, 2000);
            animacionContador("#Users", Users, 2000);

            //$("#Total").text(Totales);
            details_card();
        }
    } catch (error) {
        disableLoading();

        Swal.fire({
            title: "¡Error!",
            text: "Algo salio mal, intentalo otra vez.",
            icon: "error",
        });
        console.log(error);
    }
}
/*
    Funcion de clic al icono de la card, segun la card va a hacer la consulta de los datos correspondientes
*/
function details_card() {
    $(".show-details").off("click");
    $(".show-details").on("click", function () {
        console.log("Clic detalles");
        var Tipocard = $(this).data("id");
        console.log("data-id de la card seleccionada:", Tipocard);
        automaicScroll(".card_details");
        data_details(parseInt(Tipocard));
    });
}

function animacionContador(campo, Contador, time) {
    // Actualiza el contador con una animación
    $({ Counter: 0 }).animate(
        {
            Counter: Contador,
        },
        {
            duration: time, // Duración de la animación en milisegundos (1 segundo en este ejemplo)
            step: function () {
                $(campo).text(" " + Math.ceil(this.Counter));
            },
        }
    );
}

async function data_details(caso) {
    //detailsPeople
    const dataCheck = {
        caso: caso,
    };
    try {
        const response = await axios.post("/detailsPeople", dataCheck);
        const { data } = response;
        console.log(data);
        const { status, Left } = data;
        console.log(Left);
        contentDataLeft(Left);
    } catch (error) {
        Swal.fire({
            title: "¡Error!",
            text: "Algo salio mal, intentalo otra vez.",
            icon: "error",
        });
        console.log(error);
    }
}


function contentDataLeft(data) {
    console.log("Contenedor " + data);
}