<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8" />
  <title>Lost In The Ocean - Official Site</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Official site for Lost In The Ocean. New music, tour dates, blog, merch, and contact." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&family=Unica+One&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('styles.css') }}" />
  <script defer src="{{ asset('script.js') }}"></script>
  <style>
    /* Make header fixed and keep it visually separate from page content */
    .site-header { position: fixed; left: 0; top: 0; width: 100%; z-index: 1200; }
    /* Ensure mobile nav toggle still sits above content */
    .nav-toggle { z-index: 1300; }
    /* Space for the fixed header so content isn't covered */
    .page-content { padding-top: var(--header-height, 92px); }
  </style>
</head>
<body>
  <!-- Mobile Nav Toggle -->
  <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>

  @include('partials.header')

  <div class="page-content">
    @yield('content')
  </div>

  @include('partials.footer')
</body>
</html>