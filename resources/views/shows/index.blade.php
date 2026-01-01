@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Administración de Shows</h1>

  <div style="margin-bottom:1rem">
    <a href="{{ route('admin.panel') }}" style="display:inline-block;padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none;text-decoration:none">Regresar al panel</a>
    <a href="{{ route('admin.shows.create') }}" style="display:inline-block;padding:.5rem .9rem;margin-left:.6rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Crear show</a>
  </div>

  @if (session('success'))
    <div style="padding:.5rem;border-radius:.35rem;background:#e6ffed;color:#064e3b;margin-bottom:.75rem;">{{ session('success') }}</div>
  @endif

  <section>
    <h2 style="margin-top:0;margin-bottom:.6rem;">Listado de shows</h2>
    @if (isset($shows) && $shows->count())
      <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
        @foreach ($shows as $show)
          <li style="padding:.75rem;border-radius:.4rem;background:rgba(255,255,255,0.02);display:flex;justify-content:space-between;align-items:center;">
            <div style="display:flex;gap:.75rem;align-items:center;max-width:60%;">
              @if (!empty($show->poster_image))
                <img src="{{ $show->poster_image }}" alt="" style="width:72px;height:108px;border-radius:.25rem;object-fit:cover;">
              @endif
              <div>
                <strong>{{ $show->title }}</strong>
                <div style="color:var(--text-faint);font-size:.9rem">{{ $show->city }}, {{ $show->country }} — {{ $show->date->format('Y-m-d') }}</div>
              </div>
            </div>
            <div style="display:flex;gap:.5rem;align-items:center">
              <a href="{{ route('admin.shows.edit', $show) }}" style="padding:.4rem .6rem;border-radius:.3rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Editar</a>
              <form method="POST" action="{{ route('admin.shows.destroy', $show) }}" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:transparent;border:1px solid rgba(0,0,0,0.08);padding:.4rem .6rem;border-radius:.3rem;color:inherit">Eliminar</button>
              </form>
            </div>
          </li>
        @endforeach
      </ul>
      <div style="margin-top:.75rem">{{ $shows->links() }}</div>
    @else
      <p style="color:var(--text-faint);margin:0">No hay shows aún.</p>
    @endif
  </section>
</main>
@endsection
