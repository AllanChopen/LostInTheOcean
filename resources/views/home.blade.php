@extends('layouts.guest')

@section('content')
  <!-- Hero -->
  <section class="hero hero-band" id="hero" aria-label="Hero section">
    <img class="hero-img-mobile" src="/assets/band-hero.jpg" alt="Lost In The Ocean" aria-hidden="true">
    <div class="hero-inner">
      <h1 class="hero-title">
        <span class="line accent">Lost In The Ocean</span>
      </h1>
      <p class="hero-subtitle">Desde Ciudad de Guatemala.</p>
    </div>
    <div class="hero-overlay-gradient" aria-hidden="true"></div>
  </section>

  <!-- About -->
  <section id="about" class="section about-section" aria-label="About Lost In The Ocean">
    <div class="section-header">
      <h2 class="section-title">Biografia</h2>
      <div class="divider"></div>
    </div>

    <div class="about-grid">
      <div class="about-copy">
        <h3 class="about-title">Lost In The Ocean</h3>
        <p class="about-text">
          Fundada en la ciudad de Guatemala, Lost in the
Ocean es una banda inspirada en la agresividad de los
sonidos distorsionados combinada con la belleza de
melodías nostálgicas y letras intencionadas que
buscan retar el oído del público guatemalteco.
        </p>
        <p class="about-text">
Desde su concepción en 2025, el objetivo principal
del proyecto ha sido expandir las barreas entre los
géneros musicales, con un catálogo de influencias que
abarca desde el “Punk” y el “Emo” hasta estilos mas
actuales como el “Metalcore” y el “Post-hardcore”.
        </p>
        <p class="about-text">
            Pese a su reciente inicio, la banda ya cuenta con mas de 10
presentaciones, incluyendo en la interfer, logro que les abrió puertas en la
escena y marcó la dirección a seguir, ahora enfocada
en crear material propio.
        </p>
      </div>

      <div class="about-members">
        <h4 class="about-members-title">Miembros</h4>
        <ul class="member-list">
          <li>Moisés Axpuaca — Vocalista, guitarrista de apoyo</li>
          <li>Allan Chopen — Guitarrista</li>
          <li>Daniel Sabán — Guitarrista, voces de apoyo</li>
          <li>Jósse Zetina — Bajista, voces de apoyo</li>
          <li>Fernando Trigueros — Baterista, voces de apoyo</li>
        </ul>
      </div>

  </section>

<section id="contact" class="section contact-section" aria-label="Contact Lost In The Ocean">
  <div class="section-header">
    <h2 class="section-title">Contacto</h2>
    <div class="divider"></div>
  </div>

  <div style="width:min(1100px,92%);margin-inline:auto;">
    <div class="contact-grid">
      <div class="contact-copy">
        <h3 class="about-title">Escribenos</h3>
        <p class="about-text">Si tienes preguntas, propuestas o quieres contratar a la banda, envíanos un mensaje y te responderemos pronto. También puedes seguirnos en nuestras redes para novedades y conciertos.</p>
        <ul style="list-style:none;margin-top:1rem;padding:0;display:flex;gap:0.8rem;flex-wrap:wrap;">
          <li style="display:flex;align-items:center;gap:.5rem;color:var(--text-faint);">
            <img src="/assets/icons/mail.svg" alt="email" style="width:18px;height:18px;opacity:.9;margin-right:6px"> litobandaoficial@gmail.com
          </li>
          <li style="display:flex;align-items:center;gap:.5rem;color:var(--text-faint);">
            <img src="/assets/icons/instagram.svg" alt="ig" style="width:18px;height:18px;opacity:.9;margin-right:6px"> @lito.band
          </li>
        </ul>
      </div>

      <aside class="contact-panel">
        <form class="contact-form" id="contact-form" method="POST" action="/contact">
          @csrf
          <div class="field-row">
            <input name="name" class="field" type="text" placeholder="Tu nombre" required />
            <input name="email" class="field" type="email" placeholder="Tu correo" required />
          </div>
          <div class="field-row">
            <input name="phone" class="field" type="tel" placeholder="Teléfono (opcional)" />
          </div>
          <div class="field-row">
            <textarea name="message" class="field" placeholder="Tu mensaje" rows="6" required></textarea>
          </div>

          <div class="form-actions">
            <div class="form-message"></div>
            <button type="submit" class="btn">Enviar</button>
          </div>
        </form>
      </aside>
    </div>
  </div>
</section>

@endsection