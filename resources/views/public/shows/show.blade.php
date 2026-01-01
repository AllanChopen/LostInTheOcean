@extends('layouts.guest')

@section('content')
  <main class="post-page">
    @if(!empty($show->poster_image))
      <div class="post-banner show-banner">
        <img src="{{ $show->poster_image }}" alt="{{ $show->title }}">
      </div>
    @endif

    <h1 class="post-title">{{ $show->title }}</h1>

    <div class="post-meta" style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1rem;color:var(--text-faint);">
      <div>Fecha: {{ $show->date->locale('es')->isoFormat('D MMM YYYY') }}</div>
      @if($show->start_time)
        <div>Hora: {{ optional($show->start_time)->format('H:i') }}</div>
      @endif
      <div>Lugar: {{ $show->venue }} — {{ $show->city }}, {{ $show->country }}</div>
      @if($show->venue_address)
        <div>Dirección: {{ $show->venue_address }}</div>
      @endif
      <div>
        Precio:
        @if($show->is_free)
          Gratis
        @elseif($show->base_price)
          {{ number_format($show->base_price, 2, '.', ',') }} {{ $show->currency }}
        @else
          Precio por confirmar
        @endif
      </div>
      <div>Estado: {{ ucfirst($show->status) }}</div>
    </div>

    <article class="post-content">
      {!! nl2br(e($show->description)) !!}
    </article>

    <div style="margin-top:1rem;display:flex;gap:.6rem;flex-wrap:wrap;">
      @if (!empty($show->google_maps_link))
        <a href="{{ $show->google_maps_link }}" target="_blank" rel="noopener noreferrer" class="btn">Ver en Google Maps</a>
      @endif
      <a href="{{ route('shows.index') }}" class="btn">Ver más shows</a>
    </div>
  </main>
@endsection
