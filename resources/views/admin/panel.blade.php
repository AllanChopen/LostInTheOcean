@extends('layouts.app')

@section('content')
<main class="admin-panel" style="padding:3rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:2rem;margin-bottom:.5rem;">Bienvenido al Panel de Admin</h1>
  <p style="color:var(--text-faint);margin-bottom:1.5rem;">Esta es una página separada para administración.</p>

  <div style="background:rgba(255,255,255,0.03);padding:1.5rem;border-radius:.5rem;">
    <h2 style="margin-top:0;margin-bottom:.5rem;">Estado</h2>
    <p style="margin:0;color:var(--text-faint);">Panel operativo.</p>
  </div>
  
  <p style="margin-top:1.25rem;">
    <a href="{{ url('/') }}" class="button-link" style="display:inline-block;padding:.6rem .9rem;background:var(--brand-accent);color:#fff;border-radius:.35rem;text-decoration:none;">Volver al sitio</a>
  </p>
</main>
@endsection
