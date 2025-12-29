# Lost In The Ocean — Sitio oficial (Laravel 12)

Sitio web oficial de la banda Lost In The Ocean (Ciudad de Guatemala), construido con Laravel 12. Incluye página principal con biografía y miembros, sección de contacto con formulario que envía correos, y una plantilla base con cabecera y pie de página.

## Contenido

- [Características](#características)
- [Tecnologías](#tecnologías)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Requisitos previos](#requisitos-previos)
- [Configuración y arranque](#configuración-y-arranque)
- [Modo desarrollo](#modo-desarrollo)
- [Uso con Docker Compose](#uso-con-docker-compose)
- [Rutas y endpoints](#rutas-y-endpoints)
- [Variables de entorno de correo](#variables-de-entorno-de-correo)
- [Personalización](#personalización)
- [Pruebas](#pruebas)
- [Despliegue](#despliegue)
- [Licencia](#licencia)

---

## Características

- Landing page con secciones:
  - Hero con imagen y título “Lost In The Ocean”.
  - Biografía y lista de miembros.
  - Contacto con formulario y datos de redes.
- Formulario de contacto que envía un correo al inbox configurado.
- Plantillas Blade con layout base y parciales de `header` y `footer`.
- Assets estáticos (CSS/JS/imagenes) servidos desde `public/`.

## Tecnologías

- PHP 8.2
- Laravel 12
- Blade Templates
- Vite (para assets de front-end)
- Node/NPM (para scripts front-end)

## Estructura del proyecto

- `routes/web.php`: Rutas del sitio (raíz y envío de contacto).
- `app/Http/Controllers/ContactController.php`: Lógica para validar y enviar correo del formulario.
- `app/Mail/ContactMail.php`: Mailable que usa la vista `emails.contact`.
- `resources/views/layouts/app.blade.php`: Layout HTML principal.
- `resources/views/home.blade.php`: Página principal (hero, biografía, contacto).
- `resources/views/partials/{header,footer,contact-form}.blade.php`: Fragmentos reutilizables.
- `resources/views/emails/contact.blade.php`: Plantilla del correo de contacto.
- `public/`: Archivos estáticos (CSS, JS, imágenes). Ejemplos usados: `/assets/band-hero.jpg` y `/assets/icons/*.svg`.
- `composer.json`: Dependencias y scripts de Composer (setup, dev, test).
- `vite.config.js`: Configuración de Vite.
- `.env.example`: Ejemplo de variables de entorno.

## Requisitos previos

- PHP 8.2+
- Composer
- Node.js 18+ y npm
- Configuración SMTP válida para enviar correos (ver sección de [Variables de entorno de correo](#variables-de-entorno-de-correo))

## Configuración y arranque

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/AllanChopen/LostInTheOcean.git
   cd LostInTheOcean
   ```

2. Instalar dependencias de PHP:
   ```bash
   composer install
   ```

3. Copiar archivo de entorno y generar key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configurar variables de correo en `.env` (ver más abajo).

5. Instalar dependencias front-end:
   ```bash
   npm install
   ```

6. Construir assets para producción (opcional en entornos de dev):
   ```bash
   npm run build
   ```

También puedes usar el script integrado que automatiza la mayoría de pasos:
```bash
composer run setup
```

## Modo desarrollo

Puedes levantar el servidor y los procesos de desarrollo con Composer o manualmente:

- Usando script de Composer (incluye servidor, colas, logs y Vite):
  ```bash
  composer run dev
  ```
- Manualmente:
  ```bash
  php artisan serve
  npm run dev
  ```

Luego visita:
```
http://127.0.0.1:8000
```

## Uso con Docker Compose

El proyecto incluye `compose.yaml`. Un flujo típico:

```bash
cp .env.example .env
# Ajusta variables en .env según tus servicios (APP_URL, MAIL_*, etc.)
docker compose up -d
```

Asegúrate de que el contenedor de la app tenga PHP 8.2 y que el servicio de correo esté correctamente configurado o accesible desde el contenedor.

## Rutas y endpoints

- `GET /` — Renderiza la vista `home` con las secciones del sitio.

- `POST /contact` — Envía el formulario de contacto.
  - Payload esperado:
    ```json
    {
      "name": "Tu nombre",
      "email": "tu@correo.com",
      "phone": "Opcional",
      "message": "Tu mensaje"
    }
    ```
  - Respuestas:
    - HTML: redirige de regreso con `session('success')`.
    - JSON (si el request incluye `Accept: application/json`): 
      ```json
      { "message": "Mensaje enviado correctamente. ¡Gracias por contactarnos!" }
      ```

Ejemplo con `curl` (respuesta JSON):
```bash
curl -X POST http://127.0.0.1:8000/contact \
  -H "Accept: application/json" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "name=Juan Perez&email=juan@example.com&phone=555-1234&message=Hola, me interesa la banda"
```

## Variables de entorno de correo

En `.env`, ajusta estas variables para enviar emails:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.tu-proveedor.com
MAIL_PORT=587
MAIL_USERNAME=tu_usuario
MAIL_PASSWORD=tu_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=notificaciones@tudominio.com
MAIL_FROM_NAME="Lost In The Ocean"
```

El destinatario actual del formulario está definido en:
```
app/Http/Controllers/ContactController.php
```
Línea relevante:
```php
Mail::to('allanchopen@gmail.com')->send(new ContactMail($data));
```
Cámbialo si necesitas enviar a otra dirección (por ejemplo, a un alias del management).

## Personalización

- Títulos, textos y biografía: edita `resources/views/home.blade.php`.
- Miembros: lista en la sección “Miembros” dentro de la misma vista.
- Encabezado y pie: `resources/views/partials/header.blade.php` y `resources/views/partials/footer.blade.php`.
- Estilos y scripts: referenciados desde el layout:
  ```blade
  <link rel="stylesheet" href="{{ asset('styles.css') }}" />
  <script defer src="{{ asset('script.js') }}"></script>
  ```
  Coloca tus archivos en `public/styles.css` y `public/script.js` o ajusta el layout para usar `@vite` si prefieres la integración estándar de Vite con Laravel.

- Imágenes e íconos: coloca tus recursos en `public/assets/` y ajusta las rutas en las vistas.

## Pruebas

Ejecuta la suite de pruebas:
```bash
composer test
```

También puedes usar:
```bash
php artisan test
```

## Despliegue

- Asegúrate de configurar correctamente `.env` en tu servidor (especialmente `APP_ENV`, `APP_KEY`, `APP_URL`, `MAIL_*`).
- Compila assets:
  ```bash
  npm run build
  ```
- Sirve el proyecto con tu web server (Nginx/Apache) apuntando a `public/`.
- Configura permisos de `storage/` y `bootstrap/cache`.

## Licencia

Este proyecto se distribuye bajo licencia **MIT**.
