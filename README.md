# Lost In The Ocean — Sitio oficial (Laravel 12)
Sitio web oficial de la banda Lost In The Ocean (Ciudad de Guatemala). El proyecto está construido sobre Laravel 12 y Blade, con diseño responsivo, enfoque en accesibilidad y una experiencia ligera sin dependencias de frontend pesadas.

---

## Resumen
- Landing page con secciones de hero, biografía y miembros.
- Blog con listados y detalle de publicaciones.
- Módulo de shows con carrusel en la portada y páginas públicas para listado y detalle.
- Formulario de contacto que envía correo al inbox configurado.
- Suscripción a canal de noticias (newsletter) con alta/baja y UX no invasiva (popup en primera visita).
- Panel administrativo protegido para gestionar posts y shows.
- Activos estáticos servidos desde `public/` y vistas Blade con layout invitado.

---

## Tecnologías principales
- PHP 8.2
- Laravel 12 (MVC, Blade, Routing, Validation, Mail)
- Blade Templates y CSS propio (cargado desde `public/styles.css`)
- JavaScript ligero para UX (carruseles y suscripción)
- Configuración opcional de Vite/Tailwind

---

## Arquitectura y estructura

### Backend (Laravel)
- Controladores:
  - `App\Http\Controllers\ContactController`: valida el formulario y envía correos.
  - `App\Http\Controllers\SubscriberController`: alta/baja y verificación de suscripciones (con endpoints para AJAX y URL firmada de baja).
  - `App\Http\Controllers\AdminController`: acceso al panel admin (protegido).
  - `App\Http\Controllers\Admin\PostController`: CRUD de publicaciones (admin).
  - `App\Http\Controllers\ShowController`: gestión de shows (admin).
- Modelos:
  - `App\Models\Post`: publicaciones del blog. Atributos usados en vistas: `title`, `content`, `banner_image_url`, `published_at`/`created_at`.
  - `App\Models\Show`: eventos. Atributos usados: `title`, `venue`, `country`, `city`, `date`, `start_time`, `status`, `poster_image`.

### Ruteo
- Página principal:
  - `GET /` — Muestra portada con hero, biografía, carrusel de shows (ordenando futuros primero) y carrusel de posts recientes.
- Blog público:
  - `GET /posts` — Listado paginado.
  - `GET /posts/{post}` — Detalle.
- Shows públicos:
  - `GET /shows` — Listado paginado (futuros primero, luego pasados).
  - `GET /shows/{show}` — Detalle.
- Contacto:
  - `POST /contact` — Envía correo con los datos del formulario.
- Suscripción:
  - `POST /subscribe` — Alta (y baja vía modal/JS, con soporte JSON).
  - `GET /unsubscribe` — Baja mediante URL firmada.
  - `GET /subscribe/check` — Verificación de estado (AJAX).
- Panel admin (protegido por autenticación):
  - `GET /admin` — Landing del panel.
  - `admin/posts` — Recurso (excepto `show`) para posts.
  - `admin/shows` — Recurso completo para shows.
- Utilidades de entrega de archivos (cuando no hay symlink a `public/storage`):
  - `GET /storage/banners/{filename}` — Sirve banners desde `storage/app/public/banners`.
  - `GET /storage/posters/{filename}` — Sirve posters desde `storage/app/public/posters`.

### Vistas y layout
- Layout invitado:
  - `resources/views/layouts/guest.blade.php` — Estructura base, carga `public/styles.css` y `public/script.js`.
- Parciales:
  - `resources/views/partials/header.blade.php` — Logo, navegación, enlaces a redes y acceso al panel/admin login.
  - `resources/views/partials/footer.blade.php` — Información de contacto y redes; año dinámico.
- Portada:
  - `resources/views/home.blade.php` — Secciones de hero, biografía/miembros, carrusel de shows, carrusel de posts, contacto y suscripción (incluye scripts para UX).
- Blog:
  - `resources/views/posts/index.blade.php` y `resources/views/posts/show.blade.php` (referenciadas por rutas).
- Shows:
  - `resources/views/public/shows/index.blade.php` y `resources/views/public/shows/show.blade.php` (referenciadas por rutas).
- Correo:
  - `resources/views/emails/contact.blade.php` — Plantilla del correo enviado desde el formulario.

---

## Experiencia de usuario (UX)
- Carruseles de posts y shows con botones prev/next dinámicos y scroll suave.
- Suscripción:
  - Popup no invasivo en primera visita, persistencia con `localStorage` para no mostrar repetidamente.
  - Formularios con feedback inmediato (pendiente/éxito/error) y validación legible para el usuario.
- Navegación clara en `header`, con anclas: Home, About, Blog, Shows y Contacto.
- Footer con accesos directos a redes: Instagram, Facebook, TikTok, Email.

---

## Correo y suscripción
- Formulario de contacto:
  - Validación server-side (`name`, `email`, `phone` opcional, `message`).
  - Envía usando `App\Mail\ContactMail` y la vista `emails.contact`.
  - El correo actual de destino está configurado en `ContactController`.
- Newsletter:
  - Alta con `POST /subscribe` (soporte para JSON/AJAX).
  - Baja mediante modal y endpoint dedicado; también existe una ruta de baja con URL firmada.
  - Endpoint de verificación (`GET /subscribe/check`) para experiencias dinámicas.

---

## Accesibilidad y rendimiento
- Uso de roles y atributos ARIA en modales, carruseles y secciones.
- Imágenes con `alt` y elementos semánticos para estructura.
- Paginación en listados públicos (posts/shows) para control de carga.
- Entrega de archivos desde rutas específicas cuando el servidor no expone `public/storage`.

---

## Activos y recursos
- `public/assets/` contiene imágenes (logo, íconos y recursos).
- `public/styles.css` y `public/script.js` como punto de entrada de estilos y JS.
- Configuración opcional de Vite/Tailwind disponible (`vite.config.js`, `tailwind.config.js`) si se decide integrar un pipeline de assets.

---

## Licencia
Este proyecto se distribuye bajo licencia MIT.

---

## Créditos y contacto
- Banda: Lost In The Ocean (Ciudad de Guatemala)
- Instagram: `@LOSTINTHEOCEANBAND`
- TikTok: `@lito.band`
- Facebook: `Lost In The Ocean Band`
- Email: `litobandaoficial@gmail.com`

Si te interesa el proyecto o colaborar, ¡gracias por visitar este showcase!
