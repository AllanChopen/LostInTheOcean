@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:800px;margin:0 auto;">
  <h1 style="margin-bottom:1rem">Editar post</h1>

  @if ($errors->any())
    <div style="padding:.5rem;background:#fff4f4;color:#7f1d1d;border-radius:.35rem;margin-bottom:1rem;">
      <ul style="margin:0;padding-left:1.2rem;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display:flex;flex-direction:column;gap:.6rem;">
      <label>Título</label>
      <input type="text" name="title" value="{{ old('title', $post->title) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Cuerpo</label>
      <textarea name="content" rows="8" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('content', $post->content) }}</textarea>

      <label>Banner (imagen) - dejar en blanco para mantener la actual</label>
      @if (!empty($post->banner_image_url))
        <div style="margin-bottom:.5rem;"><img src="{{ $post->banner_image_url }}" alt="banner" style="max-width:260px;max-height:120px;object-fit:cover;border-radius:.25rem;"/></div>
      @endif
      <input type="file" name="banner" accept="image/*">

      <div style="display:flex;gap:.5rem;margin-top:.6rem;">
        <button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Actualizar</button>
        <a href="{{ route('admin.posts.index') }}" style="padding:.5rem .9rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Cancelar</a>
      </div>
    </div>
  </form>
</main>
@endsection
