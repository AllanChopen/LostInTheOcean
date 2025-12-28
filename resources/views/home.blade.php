@extends('layouts.app')

@section('content')
  <!-- Hero -->
  <section class="hero hero-band" id="hero" aria-label="Hero section">
    <div class="hero-inner">
      <h1 class="hero-title">
        <span class="line accent">Lost In The Ocean</span>
      </h1>
      <p class="hero-subtitle">Desde Ciudad de Guatemala.</p>
      <a href="#about" class="btn primary hero-cta">Conócenos</a>
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

      <div class="about-photo">
        <img src="/assets/about-band.jpg" alt="Lost In The Ocean band portrait" loading="lazy" />
      </div>
    </div>
  </section>

@endsection