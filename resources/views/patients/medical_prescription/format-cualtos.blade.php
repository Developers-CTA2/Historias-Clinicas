<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receta médica</title>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        @page {
            margin: 0px; /* Quita los márgenes de todas las páginas */
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Poppins','sans-serif';
            width: 100%;
            letter-spacing: 0.7px;
            background-image: url("{{ public_path('images/medical-prescription.png') }}");
            background-repeat: no-repeat; 
            background-size: 100% 50%;
        }


        .container{
            width: 100%;
            height: 50%;
            position: relative;
        }

        .container .namePatient{
            top: 22%;
            left: 15%;
            font-size: 1.1rem;

        }

        .absolute{
            position: absolute;
        }

        .container .namePatient p{
            text-transform: capitalize;
        
        }


        .container .dataDoctor{
            top: 5%;
            left: 18%;
            font-size: 1.1rem;
            text-align: center;
        }

        .container .dataDoctor p {
            margin: 0;
            padding: 0;

        }

        .container .dateConsultation{
            left: 83%;
            top: 2.5%;
        }

        .container .age{
            left: 83%;
            top: 9%;5
        }

        .container .folio{
            left: 83%;
            top: 16%;
        }

        .container .details{
            top: 32%;
            left: 4%;
            width: 92%;
            height: 52%;
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



    </style>

</head>


<body>

    <div class="container">

        <div class="absolute dataDoctor">
            <p class="nameDoctor fw-bold">Yolanda Rosina González Rodríguez</p>
            <p class="fw-bold">MÉDICO CIRUJADO Y PARTERO</p>
            <p class="text-sm">Universidad de Guadalajara</p>
            <p class="text-sm">Cédula profesional: <span>38483483</span> / Estatal> PEJ 2938347</p>
        </div>

        {{-- Nombre del paciente --}}
        <div class="absolute namePatient">
            <p>{{ $patient->nombre }}</p>
        </div>

    
        {{-- Fecha de la consulta --}}
        <div class="absolute dateConsultation">
            <p>{{$patient->created_at->format('d/m/Y') }}</p>
        </div>

        {{-- Edad --}}
        <div class="absolute age">
            <p>{{$patient->age ?? '0' }} años </p>
        </div>

        {{-- Folio --}}
        <div class="absolute folio">
            <p>Hola</p>
        </div>
        
        
        {{-- Detalles de la consulta --}}
        <div class="absolute details">
            {!! $consultation->tratamiento !!}
        </div>

    </div>

    {{-- {{ $patient->nombre }}
    {{ $patient->created_at->locale('es')->isoFormat('LL') }}
    {{ $patient->age ?? 'Error al obtener la edad'}} --}}
    

</body>

</html>
