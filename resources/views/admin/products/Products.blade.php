@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Administración de Productos</h1>

  <div style="margin-bottom:1rem">
    <a href="{{ route('admin.panel') }}" style="display:inline-block;padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none;text-decoration:none">Regresar al panel</a>
  </div>

  @if (session('success'))
    <div style="padding:.5rem;border-radius:.35rem;background:#e6ffed;color:#064e3b;margin-bottom:.75rem;">{{ session('success') }}</div>
  @endif

  <div style="display:flex;gap:1rem;align-items:flex-start;">
    <section style="flex:1;min-width:320px;">
      <h2 style="margin-top:0;margin-bottom:.6rem;">Crear nuevo producto</h2>
      @if ($errors->any())
        <div style="padding:.5rem;border-radius:.35rem;background:#fff4f4;color:#7f1d1d;margin-bottom:.75rem;">
          <ul style="margin:0;padding-left:1.2rem;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:flex;flex-direction:column;gap:.6rem;">
          <label>Nombre</label>
          <input type="text" name="name" value="{{ old('name') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

          <label>Slug</label>
          <input type="text" name="slug" value="{{ old('slug') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

          <label>Descripción</label>
          <textarea name="description" rows="4" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('description') }}</textarea>

          <label>Precio</label>
          <input type="text" name="price" value="{{ old('price') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

          <label>Tipo</label>
          <select name="type" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">
            <option value="clothing" {{ old('type')=='clothing' ? 'selected' : ''}}>Clothing</option>
            <option value="accessory" {{ old('type')=='accessory' ? 'selected' : ''}}>Accessory</option>
            <option value="other" {{ old('type')=='other' ? 'selected' : ''}}>Other</option>
          </select>

          <label>Imagen principal</label>
          <input type="file" name="main_image" accept="image/*">

          <label style="display:flex;align-items:center;gap:.5rem;"><input type="checkbox" name="is_active" value="1" checked> Activo</label>

          <div style="margin-top:.5rem"><button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Crear producto</button></div>
        </div>
      </form>
    </section>

    <section style="flex:1.2;min-width:360px;">
      <h2 style="margin-top:0;margin-bottom:.6rem;">Listado</h2>
      @if (isset($products) && $products->count())
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.6rem;">
          @foreach ($products as $product)
            <li style="padding:.75rem;border-radius:.4rem;background:rgba(255,255,255,0.02);display:flex;justify-content:space-between;align-items:center;">
              <div style="display:flex;gap:.75rem;align-items:center;max-width:60%;">
                @if (!empty($product->main_image_url))
                  @php
                    $imgPath = public_path(ltrim($product->main_image_url, '/'));
                  @endphp
                  @if (file_exists($imgPath))
                    <img src="data:{{ mime_content_type($imgPath) }};base64,{{ base64_encode(file_get_contents($imgPath)) }}" alt="" style="width:96px;height:60px;border-radius:.25rem;object-fit:cover;">
                  @else
                    <img src="{{ asset($product->main_image_url) }}" alt="" style="width:96px;height:60px;border-radius:.25rem;object-fit:cover;">
                  @endif
                @endif
                <div>
                  <strong>{{ $product->name }}</strong>
                  <div style="color:var(--text-faint);font-size:.9rem">{{ $product->type }} &middot; {{ $product->price ? number_format($product->price,2) : '—' }}</div>
                </div>
              </div>
              <div style="display:flex;gap:.5rem;align-items:center">
                <a href="{{ route('admin.products.edit', $product) }}" style="padding:.4rem .6rem;border-radius:.3rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Editar</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="margin:0">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="background:transparent;border:1px solid rgba(0,0,0,0.08);padding:.4rem .6rem;border-radius:.3rem;color:inherit">Eliminar</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
        <div style="margin-top:.75rem">{{ $products->links() }}</div>
      @else
        <p style="color:var(--text-faint);margin:0">No hay productos aún.</p>
      @endif
    </section>
  </div>
</main>
@endsection
