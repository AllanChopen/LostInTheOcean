@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Editar producto</h1>

  <div style="margin-bottom:1rem">
    <a href="{{ route('admin.products.index') }}" style="display:inline-block;padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none;text-decoration:none">Regresar al listado</a>
  </div>

  @if ($errors->any())
    <div style="padding:.5rem;border-radius:.35rem;background:#fff4f4;color:#7f1d1d;margin-bottom:.75rem;">
      <ul style="margin:0;padding-left:1.2rem;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display:flex;flex-direction:column;gap:.6rem;max-width:640px;">
      <label>Nombre</label>
      <input type="text" name="name" value="{{ old('name', $product->name) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Slug</label>
      <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Descripción</label>
      <textarea name="description" rows="4" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('description', $product->description) }}</textarea>

      <label>Precio</label>
      <input type="text" name="price" value="{{ old('price', $product->price) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Tipo</label>
      <select name="type" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">
        <option value="clothing" {{ old('type', $product->type)=='clothing' ? 'selected' : ''}}>Clothing</option>
        <option value="accessory" {{ old('type', $product->type)=='accessory' ? 'selected' : ''}}>Accessory</option>
        <option value="other" {{ old('type', $product->type)=='other' ? 'selected' : ''}}>Other</option>
      </select>

      <label>Imagen principal (subir para reemplazar)</label>
      <input type="file" name="main_image" accept="image/*">

      @if (!empty($product->main_image_url))
        @php $imgPath = public_path(ltrim($product->main_image_url, '/')); @endphp
        @if (file_exists($imgPath))
          <div style="margin-top:.25rem"><img src="data:{{ mime_content_type($imgPath) }};base64,{{ base64_encode(file_get_contents($imgPath)) }}" alt="" style="max-width:180px;border-radius:.25rem;object-fit:cover"></div>
        @else
          <div style="margin-top:.25rem"><img src="{{ asset($product->main_image_url) }}" alt="" style="max-width:180px;border-radius:.25rem;object-fit:cover"></div>
        @endif
      @endif

      <label style="display:flex;align-items:center;gap:.5rem;"><input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}> Activo</label>

      <div style="margin-top:.5rem"><button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Guardar cambios</button></div>
    </div>
  </form>
  
  <section style="margin-top:1.25rem;max-width:720px;">
    <h2 style="margin-bottom:.6rem">Variantes</h2>

    @if (session('success'))
      <div style="padding:.5rem;border-radius:.35rem;background:#e6ffed;color:#064e3b;margin-bottom:.75rem;">{{ session('success') }}</div>
    @endif

    @if ($product->variants && $product->variants->count())
      <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.5rem;">
        @foreach ($product->variants as $variant)
          <li style="padding:.6rem;border-radius:.35rem;background:rgba(255,255,255,0.02);display:flex;justify-content:space-between;align-items:center;">
            <div>
              <strong>{{ $variant->name }}</strong>
              <div style="color:var(--text-faint);font-size:.9rem">{{ $variant->extra_price ? number_format($variant->extra_price,2) : '—' }} &middot; {{ $variant->is_active ? 'Activo' : 'Inactivo' }}</div>
            </div>
            <div style="display:flex;gap:.5rem;align-items:center">
              <form method="POST" action="{{ route('admin.products.variants.destroy', [$product, $variant]) }}" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:transparent;border:1px solid rgba(0,0,0,0.08);padding:.4rem .6rem;border-radius:.3rem;color:inherit">Eliminar</button>
              </form>
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <p style="color:var(--text-faint);margin:0 0 .75rem 0">No hay variantes aún.</p>
    @endif

    <div style="margin-top:.75rem;padding:.75rem;border-radius:.35rem;background:rgba(255,255,255,0.02);">
      <h3 style="margin:0 0 .5rem 0">Agregar variante</h3>
      <form method="POST" action="{{ route('admin.products.variants.store', $product) }}">
        @csrf
        <div style="display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;">
          <input name="name" placeholder="Nombre (S, M, L, Red...)" style="padding:.45rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);min-width:180px">
          <input name="extra_price" placeholder="Precio extra" style="padding:.45rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);width:120px">
          <label style="display:flex;align-items:center;gap:.4rem;margin-right:.5rem;"><input type="checkbox" name="is_active" value="1" checked> Activo</label>
          <button type="submit" style="padding:.45rem .7rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Agregar</button>
        </div>
      </form>
    </div>
  </section>
</main>
@endsection
