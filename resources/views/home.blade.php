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

  <!-- Posts carousel -->
  <section id="posts" class="section posts-section" aria-label="Latest posts">
    <div class="section-header">
      <h2 class="section-title">Blog</h2>
      <div class="divider"></div>
    </div>

    <div style="width:min(1100px,92%);margin-inline:auto;">
      <div class="posts-carousel-wrap" style="position:relative;">
        <button id="posts-prev" aria-label="Anterior" style="position:absolute;left:-8px;top:50%;transform:translateY(-50%);z-index:3;background:rgba(0,0,0,0.6);color:white;border:none;border-radius:999px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer">‹</button>
        <div class="posts-carousel" style="display:flex;gap:1rem;overflow:auto;padding:1rem 0;scroll-snap-type:x mandatory;scroll-behavior:smooth;">
        @if(isset($posts) && $posts->count())
          @foreach($posts as $post)
            <article class="post-card" style="min-width:260px;max-width:320px;flex:0 0 auto;scroll-snap-align:start;border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);display:flex;flex-direction:column;">
              @if($post->banner_image_url)
                <a href="{{ route('posts.show', $post) }}" style="display:block"><img src="{{ $post->banner_image_url }}" alt="{{ $post->title }}" style="width:100%;height:160px;object-fit:cover;display:block;"></a>
              @else
                <div style="width:100%;height:160px;background:linear-gradient(90deg,var(--muted),#eee);"></div>
              @endif
              <div style="padding:1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
                <div>
                  <a href="{{ route('posts.show', $post) }}" style="color:var(--text);text-decoration:none;font-weight:600;font-size:1.05rem">{{ $post->title }}</a>
                  <p style="margin:.5rem 0 0;color:var(--text-faint);font-size:.95rem">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}</p>
                </div>
                <div style="margin-top:1rem;display:flex;justify-content:space-between;align-items:center;">
                  <small style="color:var(--text-faint);font-size:.85rem">{{ optional($post->published_at ?? $post->created_at)->format('d M Y') }}</small>
                  <a href="{{ route('posts.show', $post) }}" class="btn">Leer</a>
                </div>
              </div>
            </article>
          @endforeach
        @else
          <p class="about-text">No hay información disponible.</p>
        @endif
      </div>
    </div>
  </section>

    <div style="width:min(1100px,92%);margin-inline:auto;margin-top:.6rem;display:flex;justify-content:center;">
    <a href="{{ route('posts.index') }}" class="btn">Mostrar más</a>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      var container = document.querySelector('.posts-carousel');
      var prev = document.getElementById('posts-prev');
      var next = document.getElementById('posts-next');
      // create next button if missing (server-side rendering compatibility)
      if(!next){
        next = document.createElement('button');
        next.id = 'posts-next';
        next.setAttribute('aria-label','Siguiente');
        next.style.position = 'absolute';
        next.style.right = '-8px';
        next.style.top = '50%';
        next.style.transform = 'translateY(-50%)';
        next.style.zIndex = 3;
        next.style.background = 'rgba(0,0,0,0.6)';
        next.style.color = 'white';
        next.style.border = 'none';
        next.style.borderRadius = '999px';
        next.style.width = '36px';
        next.style.height = '36px';
        next.style.display = 'flex';
        next.style.alignItems = 'center';
        next.style.justifyContent = 'center';
        next.style.cursor = 'pointer';
        next.textContent = '›';
        var wrap = document.querySelector('.posts-carousel-wrap');
        if(wrap) wrap.appendChild(next);
      }

      if(!container) return;

      function scrollAmount(){
        var card = container.querySelector('.post-card');
        if(card) return card.offsetWidth + parseInt(getComputedStyle(card).marginRight || 16);
        return Math.round(container.clientWidth * 0.8);
      }

      function updateButtons(){
        prev.disabled = container.scrollLeft <= 0;
        next.disabled = container.scrollLeft + container.clientWidth >= container.scrollWidth - 1;
        prev.style.opacity = prev.disabled ? '0.4' : '1';
        next.style.opacity = next.disabled ? '0.4' : '1';
      }

      prev.addEventListener('click', function(){
        container.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
        setTimeout(updateButtons, 350);
      });
      next.addEventListener('click', function(){
        container.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
        setTimeout(updateButtons, 350);
      });

      container.addEventListener('scroll', updateButtons);
      updateButtons();
    });
  </script>
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