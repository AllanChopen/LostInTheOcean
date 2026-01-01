@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Crear Show</h1>

  {{-- removed back link on create view as requested --}}

  @if ($errors->any())
    <div style="padding:.5rem;border-radius:.35rem;background:#fff4f4;color:#7f1d1d;margin-bottom:.75rem;">
      <ul style="margin:0;padding-left:1.2rem;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data">
    @csrf
    <div style="display:flex;flex-direction:column;gap:.6rem;">
      <label>Título</label>
      <input type="text" name="title" value="{{ old('title') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>País</label>
      <input type="text" name="country" value="{{ old('country') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Ciudad</label>
      <input type="text" name="city" value="{{ old('city') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Venue</label>
      <input type="text" name="venue" value="{{ old('venue') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Dirección (opcional)</label>
      <input type="text" name="venue_address" value="{{ old('venue_address') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Fecha</label>
      <input type="date" name="date" value="{{ old('date') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Hora de inicio (opcional)</label>
      <input type="time" name="start_time" value="{{ old('start_time') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Descripción (opcional)</label>
      <textarea name="description" rows="4" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('description') }}</textarea>

      <label>Poster (imagen)</label>
      <input type="file" name="poster_image" accept="image/*" style="padding:.25rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Enlace Google Maps (opcional)</label>
      <input type="url" name="google_maps_link" value="{{ old('google_maps_link') }}" placeholder="https://maps.google.com/..." style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Estado</label>
      <select name="status" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">
        <option value="upcoming">upcoming</option>
        <option value="sold_out">sold_out</option>
        <option value="cancelled">cancelled</option>
        <option value="past">past</option>
      </select>

      <label>Precio base (opcional)</label>
      <input type="number" step="0.01" name="base_price" value="{{ old('base_price') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Moneda</label>
      <input type="text" name="currency" value="{{ old('currency', 'GTQ') }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);width:6rem;">

      <label><input type="checkbox" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}> Gratis</label>

      <div style="margin-top:.5rem"><button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Crear</button></div>
    </div>
  </form>
</main>
@endsection
