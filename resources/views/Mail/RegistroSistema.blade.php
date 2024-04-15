<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td style="background-color: #186D95; color: #ffffff; border-radius: 8px 8px 0 0; padding: 10px; text-align: center;">
                <h1 style="margin: 0;">SIP-CUAltos</h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px;">
                <h3 style="color: #333333;">Estimado usuario,</h3>
                <p>Te damos la bienvenida a nuestro sistema. Tu registro ha sido exitoso.</p>
                <p>A continuación, te proporcionamos los detalles de tu cuenta:</p>
                <ul>
                    <li><strong>Usuario:</strong> {{ $username }}</li>
                    <li><strong>Contraseña por defecto:</strong> Cu@ltos2024</li>
                </ul>
                <p>Para garantizar la seguridad de tu cuenta, te recomendamos que cambies tu contraseña por una nueva tan pronto como sea posible.</p>
                <p>Gracias por unirte a nuestro sistema.</p>
                <p>Saludos cordiales,<br>SIP-CUAltos</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; font-size: 12px;">
            <hr style="border-top: 2px solid #186D95;">
                <h5 style="text-align: center;">Aviso de Privacidad</h5>

                <p style="text-align: justify;">En SIP-CUAltos, respetamos y protegemos la privacidad de nuestros usuarios. A continuación, te informamos sobre nuestras prácticas de privacidad:</p>
                <p style="text-align: justify;">Recopilamos información personal cuando te registras en nuestro sistema, incluyendo tu nombre, dirección de correo electrónico y otra información relevante.</p>
                <p style="text-align: justify;">La información que recopilamos se utiliza para proporcionarte acceso a nuestros servicios y para comunicarnos contigo sobre tu cuenta.</p>
                <p style="text-align: justify;">No compartimos tu información personal con terceros sin tu consentimiento previo, excepto en los casos en que sea necesario para proporcionarte nuestros servicios.</p>
                <p style="text-align: justify;">Tomamos medidas de seguridad para proteger tu información personal contra pérdida, uso indebido y acceso no autorizado.</p>
            </td>
        </tr>
    </table>

</body>
</html>
