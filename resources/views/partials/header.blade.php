<header class="site-header">
    <a href="{{ url('/') }}" class="logo">
    <span class="logo-mark" aria-hidden="true">
      <img src="/assets/LOGO.png" alt="Lost In The Ocean logo" />
    </span>
    <span class="logo-text">Lost In The Ocean</span>
  </a>
  <nav class="site-nav" aria-label="Main Navigation">
    <ul>
      <li><a href="#hero">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#posts">Blog</a></li>
      <li><a href="#contact">Contacto</a></li>
<li class="admin-login">
  @auth
    @if (Route::has('admin.panel'))
      <a href="{{ route('admin.panel') }}">Panel</a>
    @else
      <a href="{{ url('/admin') }}">Panel</a>
    @endif
  @else
    <a href="{{ route('login') }}">Iniciar sesión</a>
  @endauth
</li>
    </ul>
    <div class="nav-social">
      <a href="https://www.instagram.com/lostintheoceanband?igsh=MXNtNmw5dTBxYXAzaw==" aria-label="Instagram" class="ico instagram" title="Instagram">
        <img src="/assets/icons/instagram.svg" alt="Instagram" />
      </a>
      <a href="https://www.facebook.com/share/1BdnL57VVb/" aria-label="Facebook" class="ico facebook" title="Facebook">
        <img src="/assets/icons/facebook.svg" alt="Facebook" />
      </a>
      <a href="https://www.tiktok.com/@lito.band?_r=1&_t=ZM-92aabB4b7CG" aria-label="TikTok" class="ico tiktok" title="TikTok">
        <img src="/assets/icons/tiktok.svg" alt="TikTok" />
      </a>
      <a href="mailto:litobandaoficial@gmail.com" aria-label="Email" class="ico mail" title="Email">
        <img src="/assets/icons/mail.svg" alt="Email" />
      </a>
    </div>
  </nav>
  <button class="nav-toggle" aria-expanded="false" aria-label="Toggle navigation">
    <span></span>
    <span></span>
    <span></span>
  </button>
  
</header>