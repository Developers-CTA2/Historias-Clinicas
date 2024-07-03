<!DOCTYPE html>
<html>
<head>
    <title>Detalles de tu cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        .header {
            background-color: #06285c;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        h1 {
            color: #265f80;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Consultorio-CUAltos</h1>
        </div>
        <h2>Detalles de tu cita</h2>
        <p>Hola {{ $nombre }},</p>
        <p>Gracias por agendar tu cita con nosotros. A continuación, encontrarás los detalles de tu cita:</p>

        <div class="details">
            <h3>Información de la Cita</h3>
            <p><strong>Nombre:</strong> {{ $nombre }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($hora)->format('H:i') }}</p>
            <p><strong>Tipo de Profesional:</strong> {{ $tipo_profesional }}</p>
            <p><strong>Motivo:</strong> {{ $motivo }}</p>
        </div>

        <div class="details">
            <h3>Información de Contacto</h3>
            <p><strong>Teléfono:</strong> {{ $telefono }}</p>
            @if($email)
            <p><strong>Correo Electrónico:</strong> {{ $email }}</p>
            @endif
        </div>

        <p>Por favor, asegúrate de llegar 10 minutos antes de tu cita para realizar cualquier trámite necesario.</p>
        <p>Si necesitas reprogramar o cancelar tu cita, contáctanos con al menos 24 horas de antelación.</p>

        <div class="footer">
            <p>Gracias por confiar en nosotros.</p>
            <p><strong>Consultorio CUALTOS</strong></p>
            <p>Dirección: Av. Rafael Casillas Aceves No. 1200, 47620 Tepatitlán de Morelos, Jal.</p>
            <p>Teléfono: (378) 78 280 33</p>
            <p>Correo Electrónico: consultorioCualtos@udg.com</p>
        </div>
    </div>
</body>

</html>