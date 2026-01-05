@extends('layouts.app')

@section('content')
<main class="admin-panel" style="padding:3rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:2rem;margin-bottom:.5rem;">Bienvenido al Panel de Admin</h1>
  <div style="display:flex;gap:10px;align-items:center;margin-bottom:1rem;">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <x-primary-button style="background:var(--brand-accent);">Cerrar sesión</x-primary-button>
    </form>
    <a href="{{ url('/') }}" class="button-link" style="display:inline-block;padding:.6rem .9rem;background:transparent;color:var(--text);border:1px solid rgba(255,255,255,0.06);border-radius:.35rem;text-decoration:none;">Volver al sitio</a>
  </div>

  
  <div style="margin-top:1.5rem;">
    <a href="{{ route('admin.posts.index') }}" style="display:inline-block;padding:.6rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;text-decoration:none">Administrar posts</a>
    <a href="{{ route('admin.shows.index') }}" style="display:inline-block;padding:.6rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;text-decoration:none;margin-left:.6rem;">Administrar shows</a>
    <a href="{{ route('admin.products.index') }}" style="display:inline-block;padding:.6rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;text-decoration:none;margin-left:.6rem;">Administrar productos</a>
  </div>

  
  
</main>
@endsection
