<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo mensaje de contacto</title>
</head>

<body style="margin:0; padding:0; background:#000000; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#000000;">
    <tr>
        <td align="center" style="padding:40px 20px;">

            <!-- Container -->
            <table width="600" cellpadding="0" cellspacing="0" style="background:#0b0b0b; border-radius:14px; overflow:hidden; box-shadow:0 0 40px rgba(0,0,0,0.8);">

                <!-- Header -->
                <tr>
                    <td style="padding:28px; text-align:center; background:#0b0b0b; color:#ffffff;">
                        <h1 style="margin:0; font-size:22px; letter-spacing:1px;">
                            LOST IN THE OCEAN
                        </h1>
                        <p style="margin:8px 0 0; font-size:12px; color:#9ca3af;">
                            Nuevo mensaje desde el formulario de contacto
                        </p>
                    </td>
                </tr>

                <!-- Divider -->
                <tr>
                    <td style="height:1px; background:#1f2933;"></td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:28px; color:#e5e7eb; font-size:15px; line-height:1.6;">

                        <p style="margin:0 0 10px;">
                            <strong style="color:#ffffff;">Nombre:</strong><br>
                            <span style="color:#d1d5db;">{{ $data['name'] }}</span>
                        </p>

                        <p style="margin:0 0 10px;">
                            <strong style="color:#ffffff;">Correo:</strong><br>
                            <span style="color:#d1d5db;">{{ $data['email'] }}</span>
                        </p>

                        <p style="margin:0 0 20px;">
                            <strong style="color:#ffffff;">Teléfono:</strong><br>
                            <span style="color:#d1d5db;">{{ $data['phone'] }}</span>
                        </p>

                        <div style="height:1px; background:#1f2933; margin:24px 0;"></div>

                        <p style="margin:0 0 8px; font-weight:bold; color:#ffffff;">
                            Mensaje:
                        </p>

                        <p style="margin:0; white-space:pre-line; color:#d1d5db;">
                            {{ $data['message'] }}
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding:18px; text-align:center; background:#0b0b0b; color:#6b7280; font-size:11px;">
                        © {{ date('Y') }} Lost In The Ocean · Formulario de contacto
                    </td>
                </tr>

            </table>
            <!-- End container -->

        </td>
    </tr>
</table>

</body>
</html>

