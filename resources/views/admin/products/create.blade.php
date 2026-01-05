@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Crear producto</h1>

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

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div style="display:flex;flex-direction:column;gap:.6rem;max-width:640px;">
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
</main>
@endsection
