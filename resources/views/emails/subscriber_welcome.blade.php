<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
  </head>
  <body style="margin:0;padding:0;background:#070709;font-family:Georgia, 'Times New Roman', serif;color:#e6e6e6;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" style="padding:36px 16px;">
          <table role="presentation" cellpadding="0" cellspacing="0" style="max-width:640px;width:100%;background:#0f1113;border-radius:10px;overflow:hidden;box-shadow:0 14px 40px rgba(2,6,23,0.6);border:1px solid rgba(255,255,255,0.03);">
            <tr>
              <td style="padding:28px 24px;text-align:center;background:linear-gradient(180deg,#0b0b0d 0%,#2b1b26 100%);">
                <img src="{{ asset('assets/LOGO.png') }}" alt="Lost In The Ocean" style="height:56px;width:auto;display:block;margin:0 auto 12px;filter:grayscale(30%) brightness(1.05);" />
                <div style="font-family: Georgia, 'Times New Roman', serif; color:#d9caa7; letter-spacing:1px; font-size:18px; font-weight:600;">Lost In The Ocean — Noticias</div>
              </td>
            </tr>
            <tr>
              <td style="padding:28px 28px 20px;">
                <h2 style="margin:0 0 10px;font-size:22px;color:#f3efe6;font-family: Georgia, 'Times New Roman', serif;">Bienvenido a la lista</h2>
                <p style="margin:0 0 14px;color:#cfc9c2;line-height:1.6;">Gracias por suscribirte a <strong>Lost In The Ocean</strong>. Aquí recibirás noticias selectas, fechas de shows y lanzamientos exclusivos.</p>

                <div style="margin:18px 0;text-align:center;">
                  <a href="{{ url('/') }}" style="display:inline-block;padding:10px 16px;background:#bfa46a;color:#0b0b0d;border-radius:6px;text-decoration:none;font-weight:700;letter-spacing:0.6px;">Ir al sitio</a>
                </div>

                <p style="margin:0;color:#bfb8ad;font-size:13px;">Con aprecio,<br><strong>Lost In The Ocean</strong></p>
              </td>
            </tr>
            <tr>
              <td style="padding:14px 24px 26px;background:transparent;color:#9b9490;font-size:12px;text-align:center;border-top:1px solid rgba(255,255,255,0.02);">
                Recibirás notificaciones de shows y lanzamientos. Si deseas darte de baja, <a href="{{ $unsubscribeUrl }}" style="color:#bfa46a;text-decoration:underline;font-weight:600;">haz click aquí</a>.
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
