<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receta médica</title>

    <style>
        
        @page {
            /* margin: 10px; */
            /* Quita los márgenes de todas las páginas */
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: 'poppins', sans-serif;
            width: 100%;
            letter-spacing: 0.7px;
            box-sizing: border-box;

        }

        main {
            margin-top: -10px;
            padding: 0px 25px;
            width: calc(100% - 50px);

        
            min-height: 300px;
            /* background-color: aqua; */
            margin-bottom: 10px;
        }


        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .logo-bg {
            position: absolute;
            right: 0px;
            top: 30%;
        }

        .name-patient {
            top: 70px;
            left: 110px;
        }

        .date {
            left: 82%;
            top: -25px;
        }

        .age {
            left: 82%;
            top: 5px;
        }

        .folio {
            left: 82%;
            top: 38px;
        }

        .text-custom {
            font-size: 1.1rem;
            font-weight: 300;
            /* color: #000; */
        }

        .text-normal {
            font-size: 1.1rem;
            font-weight: 300;
            /* color: #000; */
        }

        .dataDoctor{
            top: -20px;
            left: 18%;
            font-size: 1.1rem;
            text-align: center;
        }

        .dataDoctor p, main p{
            margin: 0;
            padding: 0;
        }

        .nameDoctor{
            font-size: 1.3rem;
            color: #2984CB;
        }

        .fw-bold{
            font-weight: 700;
        }
        .fw-medium{
            font-weight: 500;
        }

        .text-sm{
            font-size: 0.9rem;
        }

        footer{
            position: absolute;
            bottom: 0;
            width: 100%;
        }



        



    </style>

</head>


<body>

    <div class="relative">
        <header class="relative">
            <img src="{{ public_path('images/header-medical-prescription.png') }}" width="100%"
                alt="Encabezado receta médica">

            <div class="absolute dataDoctor">
                <p class="nameDoctor fw-bold">{{ $doctor->name }}</p>
                <p class="fw-bold">MÉDICO CIRUJANO Y PARTERO</p>
                <p class="text-sm">Universidad de Guadalajara</p>
                <p class="text-sm">Cédula profesional: <span>{{ $doctor->cedula ?? 'No tiene cédula' }}</span></p>
            </div>

            <p class="absolute text-custom name-patient">{{ $patient->nombre }}</p>
            <p class="absolute text-custom date">{{ $consultation->created_at->format('d/m/Y') }}</p>
            <p class="absolute text-custom age">{{ $patient->age ?? '0' }} años </p>
            <p class="absolute text-custom folio">{{ $consultation->id_folio }} </p>

        </header>

        <main>
            <img class="logo-bg" src="{{ public_path('images/logo-leon.png') }}" alt="Logo León UDG" width="250px">
            <p class="text-normal text-without-space">{!! $consultation->tratamiento !!}</p>
        </main>

        <footer>
            <img src="{{ public_path('images/footer-medical-prescription.png') }}" alt="Logo León UDG" width="100%">
        </footer>
    </div>



</body>

</html>
