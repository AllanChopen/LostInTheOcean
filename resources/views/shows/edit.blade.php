@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">Editar Show</h1>

  <div style="margin-bottom:1rem">
    <a href="{{ route('admin.shows.index') }}" style="display:inline-block;padding:.5rem .9rem;background:transparent;color:inherit;border:1px solid rgba(0,0,0,0.08);border-radius:.35rem;text-decoration:none;">Volver a la lista</a>
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

  <form method="POST" action="{{ route('admin.shows.update', $show) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div style="display:flex;flex-direction:column;gap:.6rem;">
      <label>Título</label>
      <input type="text" name="title" value="{{ old('title', $show->title) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>País</label>
      <input type="text" name="country" value="{{ old('country', $show->country) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Ciudad</label>
      <input type="text" name="city" value="{{ old('city', $show->city) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Venue</label>
      <input type="text" name="venue" value="{{ old('venue', $show->venue) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Dirección (opcional)</label>
      <input type="text" name="venue_address" value="{{ old('venue_address', $show->venue_address) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Fecha</label>
      <input type="date" name="date" value="{{ old('date', $show->date->format('Y-m-d')) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Hora de inicio (opcional)</label>
      <input type="time" name="start_time" value="{{ old('start_time', optional($show->start_time)->format('H:i')) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Descripción (opcional)</label>
      <textarea name="description" rows="4" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">{{ old('description', $show->description) }}</textarea>

      <label>Poster (imagen)</label>
      @if (!empty($show->poster_image))
        <div style="margin-bottom:.5rem"><img src="{{ $show->poster_image }}" alt="poster" style="max-width:200px;height:auto;border-radius:.25rem;object-fit:cover;"></div>
      @endif
      <input type="file" name="poster_image" accept="image/*" style="padding:.25rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Enlace Google Maps (opcional)</label>
      <input type="url" name="google_maps_link" value="{{ old('google_maps_link', $show->google_maps_link) }}" placeholder="https://maps.google.com/..." style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Estado</label>
      <select name="status" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">
        <option value="upcoming" {{ $show->status === 'upcoming' ? 'selected' : '' }}>upcoming</option>
        <option value="sold_out" {{ $show->status === 'sold_out' ? 'selected' : '' }}>sold_out</option>
        <option value="cancelled" {{ $show->status === 'cancelled' ? 'selected' : '' }}>cancelled</option>
        <option value="past" {{ $show->status === 'past' ? 'selected' : '' }}>past</option>
      </select>

      <label>Precio base (opcional)</label>
      <input type="number" step="0.01" name="base_price" value="{{ old('base_price', $show->base_price) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);">

      <label>Moneda</label>
      <input type="text" name="currency" value="{{ old('currency', $show->currency) }}" style="padding:.5rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);width:6rem;">

      <label><input type="checkbox" name="is_free" value="1" {{ $show->is_free ? 'checked' : '' }}> Gratis</label>

      <div style="margin-top:.5rem"><button type="submit" style="padding:.5rem .9rem;background:var(--brand-accent);color:white;border-radius:.35rem;border:none">Guardar</button></div>
    </div>
  </form>
</main>
@endsection
