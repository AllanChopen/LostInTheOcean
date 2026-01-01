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
                <div style="font-family: Georgia, 'Times New Roman', serif; color:#d9caa7; letter-spacing:1px; font-size:16px; font-weight:600;">Nuevo en el blog</div>
              </td>
            </tr>
            <tr>
              <td style="padding:24px 28px;">
                <h2 style="margin:0 0 10px;font-size:20px;color:#f3efe6;font-family: Georgia, 'Times New Roman', serif;">{{ $post->title }}</h2>
                @if(!empty($post->banner_image_url))
                  <div style="margin:14px 0;text-align:center;"><img src="{{ $post->banner_image_url }}" alt="{{ $post->title }}" style="max-width:100%;height:auto;border-radius:6px;display:inline-block;border:1px solid rgba(255,255,255,0.03);"/></div>
                @endif
                <p style="margin:0 0 14px;color:#cfc9c2;line-height:1.6;">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 300) }}</p>

                <div style="margin:18px 0;text-align:center;">
                  <a href="{{ $url }}" style="display:inline-block;padding:10px 14px;background:#bfa46a;color:#0b0b0d;border-radius:6px;text-decoration:none;font-weight:700;">Leer artículo</a>
                </div>

                <p style="margin:0;color:#bfb8ad;font-size:13px;">Saludos,<br><strong>Lost In The Ocean</strong></p>
              </td>
            </tr>
            <tr>
              <td style="padding:14px 24px 26px;background:transparent;color:#9b9490;font-size:12px;text-align:center;border-top:1px solid rgba(255,255,255,0.02);">
                Si quieres dejar de recibir estos correos, puedes darte de baja <a href="{{ $unsubscribeUrl ?? route('unsubscribe') }}" style="color:#bfa46a;text-decoration:underline;font-weight:600;">aquí</a>.
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
