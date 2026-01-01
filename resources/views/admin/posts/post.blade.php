@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Administración de Posts</h1>

  <div style="margin-bottom:1rem">
    <a href="{{ route('admin.panel') }}" style="display:inline-block;padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none;text-decoration:none">Regresar al panel</a>
  </div>

  @if (session('success'))
    <div style="padding:.5rem;border-radius:.35rem;background:#e6ffed;color:#064e3b;margin-bottom:.75rem;">{{ session('success') }}</div>
  @endif

  <div style="display:flex;gap:1rem;align-items:flex-start;">
    <section style="flex:1;min-width:320px;">
      <h2 style="margin-top:0;margin-bottom:.6rem;">Crear nuevo post</h2>
      @if ($errors->any())
        <div style="padding:.5rem;border-radius:.35rem;background:#fff4f4;color:#7f1d1d;margin-bottom:.75rem;">
          <ul style="margin:0;padding-left:1.2rem;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:flex;flex-direction:column;gap:.6rem;">
          <label>Título</label>
          <input type="text" name="title" value="{{ old('title') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

          <label>Cuerpo</label>
          <textarea name="content" rows="6" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('content') }}</textarea>

          <label>Banner (imagen)</label>
          <input type="file" name="banner" accept="image/*">

          <div style="margin-top:.5rem"><button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Publicar</button></div>
        </div>
      </form>
    </section>

    <section style="flex:1.2;min-width:360px;">
      <h2 style="margin-top:0;margin-bottom:.6rem;">Listado</h2>
      @if (isset($posts) && $posts->count())
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
          @foreach ($posts as $post)
            <li style="padding:.75rem;border-radius:.4rem;background:rgba(255,255,255,0.02);display:flex;justify-content:space-between;align-items:center;">
              <div style="display:flex;gap:.75rem;align-items:center;max-width:60%;">
                @if (!empty($post->banner_image_url))
                  <img src="{{ $post->banner_image_url }}" alt="" style="width:96px;height:60px;border-radius:.25rem;object-fit:cover;">
                @endif
                <div>
                  <strong>{{ $post->title }}</strong>
                  <div style="color:var(--text-faint);font-size:.9rem">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</div>
                </div>
              </div>
              <div style="display:flex;gap:.5rem;align-items:center">
                <a href="{{ route('admin.posts.edit', $post) }}" style="padding:.4rem .6rem;border-radius:.3rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Editar</a>
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="margin:0">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="background:transparent;border:1px solid rgba(0,0,0,0.08);padding:.4rem .6rem;border-radius:.3rem;color:inherit">Eliminar</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
        <div style="margin-top:.75rem">{{ $posts->links() }}</div>
      @else
        <p style="color:var(--text-faint);margin:0">No hay posts aún.</p>
      @endif
    </section>
  </div>
</main>
@endsection
