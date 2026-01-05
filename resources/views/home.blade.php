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

  {{-- Merch section moved below biography --}}

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

  <!-- Products / Merch -->
  <section id="products" class="section products-section" aria-label="Productos" style="margin-top:1.5rem;">
    <div class="section-header">
      <h2 class="section-title">Merch / Productos</h2>
      <div class="divider"></div>
    </div>

    <div style="width:min(1100px,92%);margin-inline:auto;">
      @if(isset($products) && $products->count())
        <div class="products-carousel-wrap" style="position:relative;">
          <button id="products-prev" aria-label="Anterior productos" style="position:absolute;left:-8px;top:50%;transform:translateY(-50%);z-index:3;background:rgba(0,0,0,0.6);color:white;border:none;border-radius:999px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer">‹</button>
          <button id="products-next" aria-label="Siguiente productos" style="position:absolute;right:-8px;top:50%;transform:translateY(-50%);z-index:3;background:rgba(0,0,0,0.6);color:white;border:none;border-radius:999px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer">›</button>
          <div class="products-carousel" style="display:flex;gap:1rem;overflow:auto;padding:1rem 0;scroll-snap-type:x mandatory;scroll-behavior:smooth;">
            @foreach($products as $product)
              <article class="product-card" style="min-width:180px;max-width:220px;flex:0 0 auto;scroll-snap-align:start;border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);display:flex;flex-direction:column;padding:.6rem;">
                @if(!empty($product->main_image_url))
                  <div style="width:100%;aspect-ratio:1/1;overflow:hidden;border-radius:6px;margin-bottom:.5rem;background:#fff;display:flex;align-items:center;justify-content:center;">
                    <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                  </div>
                @else
                  <div style="width:100%;aspect-ratio:1/1;border-radius:6px;margin-bottom:.5rem;background:linear-gradient(90deg,var(--muted),#eee);"></div>
                @endif
                <div style="flex:1;display:flex;flex-direction:column;">
                  <strong style="font-size:1rem">{{ $product->name }}</strong>
                  <div style="color:var(--text-faint);font-size:.9rem;margin-top:.35rem">{{ $product->type }} &middot; {{ $product->price ? number_format($product->price,2) : '—' }}</div>
                  <div style="margin-top:auto;display:flex;justify-content:space-between;align-items:center;margin-top:.6rem;">
                    <a href="{{ route('store.show', $product) }}" class="btn" style="padding:.35rem .6rem">Ver</a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      @else
        <p style="color:var(--text-faint);">No hay productos aún.</p>
      @endif

      <div style="margin-top:1rem;display:flex;justify-content:center;">
        <a href="{{ route('store.index') }}" class="btn">Ver tienda completa</a>
      </div>
    </div>
  </section>

      <!-- Shows cards (moved above posts) -->
      <section id="shows" class="section shows-section" aria-label="Upcoming shows" style="margin-top:2rem;">
        <div class="section-header">
          <h2 class="section-title">Shows</h2>
          <div class="divider"></div>
        </div>

        <div style="width:min(1100px,92%);margin-inline:auto;">
          {{-- Grid layout removed — keeping carousel below as primary shows display. --}}
        </div>

          <div style="width:min(1100px,92%);margin-inline:auto;">
            <div class="shows-carousel-wrap" style="position:relative;">
              <button id="shows-prev" aria-label="Anterior shows" style="position:absolute;left:-8px;top:50%;transform:translateY(-50%);z-index:3;background:rgba(0,0,0,0.6);color:white;border:none;border-radius:999px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer">‹</button>
              <button id="shows-next" aria-label="Siguiente shows" style="position:absolute;right:-8px;top:50%;transform:translateY(-50%);z-index:3;background:rgba(0,0,0,0.6);color:white;border:none;border-radius:999px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer">›</button>
              <div class="shows-carousel" style="display:flex;gap:1rem;overflow:auto;padding:1rem 0;scroll-snap-type:x mandatory;scroll-behavior:smooth;">
                @if(isset($shows) && $shows->count())
                  @foreach($shows as $show)
                    <article class="post-card" style="min-width:260px;max-width:320px;flex:0 0 auto;scroll-snap-align:start;border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);display:flex;flex-direction:column;">
                      @if($show->poster_image)
                        <a href="{{ route('shows.show', $show) }}" style="display:block"><img src="{{ $show->poster_image }}" alt="{{ $show->title }}" style="width:100%;aspect-ratio:2/3;object-fit:cover;display:block;"></a>
                      @else
                        <div style="width:100%;aspect-ratio:2/3;background:linear-gradient(90deg,var(--muted),#eee);"></div>
                      @endif
                      <div style="padding:1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
                        <div>
                          <a href="{{ route('shows.show', $show) }}" style="color:var(--text);text-decoration:none;font-weight:600;font-size:1.05rem">{{ $show->title }}</a>
                          <p style="margin:.5rem 0 0;color:var(--text-faint);font-size:.95rem;line-height:1.2">
                            <div>{{ $show->venue }} — {{ $show->country }}, {{ $show->city }}</div>
                            <div>{{ $show->date->locale('es')->isoFormat('D MMM YYYY') }}@if($show->start_time) - {{ optional($show->start_time)->format('H:i') }}@endif</div>
                          </p>
                        </div>
                        <div style="margin-top:1rem;display:flex;justify-content:space-between;align-items:center;">
                          <small style="color:var(--text-faint);font-size:.85rem">{{ $show->status }}</small>
                          <a href="{{ route('shows.show', $show) }}" class="btn">Detalles</a>
                        </div>
                      </div>
                    </article>
                  @endforeach
                @else
                  <p class="about-text">No hay shows disponibles.</p>
                @endif
              </div>
            </div>
          </div>

          <div style="width:min(1100px,92%);margin-inline:auto;margin-top:.6rem;display:flex;justify-content:center;">
            <a href="{{ route('shows.index') }}" class="btn">Mostrar más shows</a>
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
          <p class="about-text">No hay noticias aún.</p>
        @endif
      </div>
    </div>
  </section>

<!-- First-visit subscribe popup (non-invasive) -->
<div id="subscribe-popup-modal" role="dialog" aria-modal="true" aria-hidden="true" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);align-items:center;justify-content:center;z-index:10000;padding:20px;">
  <div style="max-width:520px;width:100%;background:linear-gradient(180deg,#0f1113,#0b0b0d);color:#e6e6e6;border-radius:10px;padding:20px;box-shadow:0 12px 40px rgba(2,6,23,0.7);border:1px solid rgba(255,255,255,0.03);">
    <button id="subscribe-popup-close" aria-label="Cerrar" style="float:right;background:none;border:none;color:#bfb8ad;font-size:18px;">✕</button>
    <h3 style="margin-top:0;font-family:Georgia, 'Times New Roman', serif;color:#f3efe6">Únete al canal de noticias</h3>
    <p style="color:#cfc9c2;margin:6px 0 12px;">Recibe noticias, shows y lanzamientos exclusivos. Sin spam — puedes darte de baja en cualquier momento.</p>
    <form id="subscribe-popup-form" style="display:flex;gap:.5rem;align-items:center;">
      <input name="email" type="email" placeholder="Tu correo" required style="flex:1;padding:10px;border-radius:6px;border:1px solid rgba(255,255,255,0.06);background:transparent;color:inherit;" />
      <button type="submit" class="btn" style="padding:10px 12px;">Suscribirme</button>
    </form>
    <div id="subscribe-popup-message" style="margin-top:10px;min-height:1.4rem;color:#bfb8ad;font-size:13px;"></div>
  </div>
</div>

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

 

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      var container = document.querySelector('.shows-carousel');
      var prev = document.getElementById('shows-prev');
      var next = document.getElementById('shows-next');
      // create next button if missing (server-side rendering compatibility)
      if(!next){
        next = document.createElement('button');
        next.id = 'shows-next';
        next.setAttribute('aria-label','Siguiente shows');
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
        var wrap = document.querySelector('.shows-carousel-wrap');
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
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      var container = document.querySelector('.products-carousel');
      var prev = document.getElementById('products-prev');
      var next = document.getElementById('products-next');
      if(!next){
        next = document.createElement('button');
        next.id = 'products-next';
        next.setAttribute('aria-label','Siguiente productos');
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
        var wrap = document.querySelector('.products-carousel-wrap');
        if(wrap) wrap.appendChild(next);
      }

      if(!container) return;

      function scrollAmount(){
        var card = container.querySelector('.product-card');
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
            <img src="/assets/icons/instagram.svg" alt="ig" style="width:18px;height:18px;opacity:.9;margin-right:6px"> @LOSTINTHEOCEANDBAND
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

<!-- Newsletter subscribe -->
<section id="subscribe" class="section subscribe-section" aria-label="Suscribete al canal de noticias">
  <div class="section-header">
    <h2 class="section-title">Canal de noticias</h2>
    <div class="divider"></div>
  </div>

    <div style="width:min(1100px,92%);margin-inline:auto;display:flex;justify-content:center;">
    <aside class="contact-panel" style="max-width:520px;width:100%;">
      @if(session('success'))
        <div style="padding:0.75rem;background: #e6ffed;border:1px solid #d1f5d8;border-radius:6px;margin-bottom:1rem;color:#084c2e">{{ session('success') }}</div>
      @endif
      @if(isset($errors) && $errors->has('email'))
        <div style="padding:0.75rem;background:#fff1f0;border:1px solid #ffd6d6;border-radius:6px;margin-bottom:1rem;color:#7a0b0b">{{ $errors->first('email') }}</div>
      @endif

      <form class="contact-form" method="POST" action="{{ route('subscribe') }}">
        @csrf

        <div class="field-row">
          <input name="email" class="field" type="email" placeholder="Tu correo" required />
        </div>

        <!-- checkbox removed: unsubscribe handled via modal -->

        <div class="form-actions">
          <div class="form-message"></div>
          <button type="submit" class="btn">Suscribirme</button>
        </div>
      </form>

      <p style="margin-top:.6rem;color:var(--text-faint);font-size:.9rem">Recibirás noticias, shows y lanzamientos vía email. Puedes darte de baja en cualquier momento, <a href="#" id="open-unsubscribe-modal">haz click aquí</a>.</p>

      <!-- Unsubscribe modal -->
      <div id="unsubscribe-modal" role="dialog" aria-modal="true" aria-hidden="true" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;z-index:9999;">
        <div style="background:var(--bg);padding:1rem 1.25rem;border-radius:8px;max-width:420px;width:92%;box-shadow:0 8px 30px rgba(0,0,0,0.25);">
          <button id="unsubscribe-close" aria-label="Cerrar" style="float:right;background:none;border:none;font-size:1.1rem;">✕</button>
          <h3 style="margin-top:0">Darse de baja</h3>
          <p style="color:var(--text-faint);margin-top:.25rem">Introduce el correo que quieres desuscribir y pulsa "Darme de baja".</p>
          <div id="unsubscribe-message" style="min-height:1.6rem;margin-top:.5rem"></div>
          <form id="unsubscribe-form" style="margin-top:.5rem"> 
            <input type="email" name="email" placeholder="Tu correo" required class="field" style="width:100%;margin-bottom:.5rem;" />
            <div style="display:flex;gap:.5rem;justify-content:flex-end;align-items:center;">
              <button type="submit" class="btn">Darme de baja</button>
              <button type="button" id="unsubscribe-cancel" class="btn" style="background:transparent;border:1px solid rgba(0,0,0,0.06);">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </aside>
  </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var form = document.querySelector('form.contact-form[action$="/subscribe"]');
  if (!form) return;
  var emailInput = form.querySelector('input[name="email"]');
  var submitBtn = form.querySelector('button[type="submit"]');
  if (!emailInput || !submitBtn) return;
  // Keep button always 'Suscribirme' (no dynamic toggle)
  submitBtn.textContent = 'Suscribirme';
  
  // AJAX submit: subscribe/unsubscribe without full page reload
  var messageEl = form.querySelector('.form-message');
  form.addEventListener('submit', function(e){
    e.preventDefault();
    if (!submitBtn) return;
    submitBtn.disabled = true;
    var originalText = submitBtn.textContent;
    submitBtn.textContent = 'Procesando...';

    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';

    var fd = new FormData(form);

    if (messageEl) {
      messageEl.textContent = 'Procesando...';
      messageEl.className = 'form-message pending';
    }

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrf
      },
      body: fd,
      credentials: 'same-origin'
    }).then(function(res){
      return res.json().then(function(json){
        if (!res.ok) throw json;
        return json;
      });
    }).then(function(json){
      var msg = json.message || 'Operación completada';
      if (messageEl) {
        messageEl.textContent = msg;
        messageEl.className = 'form-message success';
      } else {
        alert(msg);
      }
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
      try {
        localStorage.setItem('seen_subscribe_popup_v1', '1');
        var popup = document.getElementById('subscribe-popup-modal'); if(popup) popup.style.display = 'none';
      } catch (e) {}
    }).catch(function(err){
      function humanizeServerError(e){
        if (!e) return 'Ha ocurrido un error. Intenta de nuevo.';
        // Validation errors object from Laravel
        if (e.errors && e.errors.email && e.errors.email.length) {
          var raw = e.errors.email[0];
          raw = raw.toString();
          if (/valid email|validación|validar|must be a valid email/i.test(raw)) return 'Introduce una dirección de correo válida.';
          if (/unique|already been taken|ya ha sido registrado|ya está en uso/i.test(raw)) return 'Este correo ya está registrado.';
          if (/required|es requerido|is required/i.test(raw)) return 'El correo es obligatorio.';
          return raw;
        }

        // Generic message
        if (e.message) {
          var m = e.message.toString();
          if (/Too many attempts|Too many requests|rate limit/i.test(m)) return 'Has enviado demasiadas solicitudes. Intenta más tarde.';
          return m;
        }

        return 'Ha ocurrido un error. Intenta de nuevo.';
      }

      var errMsg = humanizeServerError(err);

      if (messageEl) {
        messageEl.textContent = errMsg;
        messageEl.className = 'form-message error';
      } else {
        alert(errMsg);
      }

      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    });
  });

  // Unsubscribe modal logic
  var modal = document.getElementById('unsubscribe-modal');
  var openLink = document.getElementById('open-unsubscribe-modal');
  var closeBtn = document.getElementById('unsubscribe-close');
  var cancelBtn = document.getElementById('unsubscribe-cancel');
  var unsubForm = document.getElementById('unsubscribe-form');
  var unsubMsg = document.getElementById('unsubscribe-message');

  function showModal(){ if(!modal) return; modal.style.display = 'flex'; modal.setAttribute('aria-hidden','false'); }
  function hideModal(){ if(!modal) return; modal.style.display = 'none'; modal.setAttribute('aria-hidden','true'); unsubMsg.textContent = ''; unsubForm.reset(); }

  if(openLink) openLink.addEventListener('click', function(e){ e.preventDefault(); showModal(); });
  if(closeBtn) closeBtn.addEventListener('click', function(){ hideModal(); });
  if(cancelBtn) cancelBtn.addEventListener('click', function(){ hideModal(); });

  if(unsubForm){
    unsubForm.addEventListener('submit', function(e){
      e.preventDefault();
      var input = unsubForm.querySelector('input[name="email"]');
      if(!input) return;
      var email = input.value.trim();
      if(!email){ unsubMsg.textContent = 'Introduce un correo válido.'; unsubMsg.style.color = 'var(--danger)'; return; }

      unsubMsg.textContent = 'Procesando...'; unsubMsg.style.color = '';
      var csrfMeta = document.querySelector('meta[name="csrf-token"]');
      var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
      var fd = new FormData(); fd.append('email', email); fd.append('unsubscribe', '1');

      fetch('{{ route('subscribe') }}', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf },
        body: fd,
        credentials: 'same-origin'
      }).then(function(res){
        var ct = res.headers.get('content-type') || '';
        if (ct.indexOf('application/json') !== -1) {
          return res.json().then(function(json){ if(!res.ok) throw json; return json; });
        }
        return res.text().then(function(text){ if(!res.ok) throw { message: text }; return { message: text }; });
      })
      .then(function(json){
        unsubMsg.textContent = json.message || 'Te has dado de baja.';
        unsubMsg.style.color = 'green';
        // Do not auto-close the modal; user will close it manually
      })
      .catch(function(err){ var text = 'Ha ocurrido un error. Intenta de nuevo.'; if(err && err.errors && err.errors.email) text = err.errors.email[0]; if(err && err.message) text = err.message; unsubMsg.textContent = text; unsubMsg.style.color = 'var(--danger)'; });
    });
  }

  // First-visit subscribe popup logic
  (function(){
    var key = 'seen_subscribe_popup_v1';
    try {
      if (localStorage.getItem(key)) return; // already seen
    } catch (e) {}

    var popup = document.getElementById('subscribe-popup-modal');
    var close = document.getElementById('subscribe-popup-close');
    var formPopup = document.getElementById('subscribe-popup-form');
    var msgEl = document.getElementById('subscribe-popup-message');

    function showPopup(){ if(!popup) return; popup.style.display = 'flex'; popup.setAttribute('aria-hidden','false'); }
    function hidePopup(){ if(!popup) return; popup.style.display = 'none'; popup.setAttribute('aria-hidden','true'); }

    // show after a short delay to be non-invasive
    setTimeout(showPopup, 1400);

    if (close) close.addEventListener('click', function(){ try{ localStorage.setItem(key,'1'); }catch(e){} hidePopup(); });

    if (!formPopup) return;
    formPopup.addEventListener('submit', function(e){
      e.preventDefault();
      var input = formPopup.querySelector('input[name="email"]');
      if(!input) return;
      var email = input.value.trim();
      if(!email){ msgEl.textContent = 'Introduce un correo válido.'; msgEl.style.color = '#ffb3b3'; return; }

      msgEl.textContent = 'Procesando...'; msgEl.style.color = '';
      var csrfMeta = document.querySelector('meta[name="csrf-token"]');
      var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
      var fd = new FormData(); fd.append('email', email);

      fetch('{{ route('subscribe') }}', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf },
        body: fd,
        credentials: 'same-origin'
      }).then(function(res){
        return res.json().then(function(json){ if(!res.ok) throw json; return json; });
      }).then(function(json){
        msgEl.textContent = json.message || 'Gracias por suscribirte.'; msgEl.style.color = '#bfa46a';
        try{ localStorage.setItem(key,'1'); }catch(e){}
        setTimeout(hidePopup, 800);
      }).catch(function(err){
        var text = 'Ha ocurrido un error. Intenta de nuevo.'; if(err && err.errors && err.errors.email) text = err.errors.email[0]; if(err && err.message) text = err.message; msgEl.textContent = text; msgEl.style.color = '#ffb3b3';
      });
    });
  })();
});
</script>

@endsection