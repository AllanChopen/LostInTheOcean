@extends('layouts.app')

@section('content')
<main style="padding:2rem;max-width:900px;margin:0 auto;">
  <h1 style="font-size:1.6rem;margin-bottom:1rem;">{{ $show->title }}</h1>

  <div style="color:var(--text-faint);margin-bottom:1rem">{{ $show->city }}, {{ $show->country }} — {{ $show->date->format('Y-m-d') }} {{ optional($show->start_time)->format('H:i') }}</div>

  @if (!empty($show->poster_image))
    <div style="margin-bottom:1rem"><img src="{{ $show->poster_image }}" alt="" style="max-width:100%;height:auto;border-radius:.35rem"></div>
  @endif

  <div style="line-height:1.5">{!! nl2br(e($show->description)) !!}</div>

  @if (!empty($show->google_maps_link))
    <div style="margin-top:1rem">
      <a href="{{ $show->google_maps_link }}" target="_blank" rel="noopener noreferrer" style="padding:.5rem .9rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Ver en Google Maps</a>
    </div>
  @endif

  <div style="margin-top:1rem">
    <a href="{{ route('admin.shows.index') }}" style="padding:.5rem .9rem;border-radius:.35rem;border:1px solid rgba(0,0,0,0.08);text-decoration:none;color:inherit">Volver</a>
  </div>
</main>
@endsection
