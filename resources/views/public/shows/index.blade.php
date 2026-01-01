@extends('layouts.guest')

@section('content')
<main style="padding:2rem;max-width:1100px;margin:0 auto;">
  <div class="section-header" style="margin-bottom:1rem;">
    <h2 class="section-title">Shows</h2>
    <div class="divider"></div>
  </div>

  @if(isset($shows) && $shows->count())
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
      @foreach($shows as $show)
        <article style="border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);display:flex;flex-direction:column;">
          @if(!empty($show->poster_image))
            <a href="{{ route('shows.show', $show) }}"><img src="{{ $show->poster_image }}" alt="{{ $show->title }}" style="width:100%;aspect-ratio:2/3;object-fit:cover;display:block;"></a>
          @else
            <div style="width:100%;aspect-ratio:2/3;background:linear-gradient(90deg,var(--muted),#eee);"></div>
          @endif
          <div style="padding:1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
            <div>
              <a href="{{ route('shows.show', $show) }}" style="color:var(--text);text-decoration:none;font-weight:600;font-size:1.05rem">{{ $show->title }}</a>
              <div style="color:var(--text-faint);font-size:.95rem;margin-top:.4rem">{{ $show->venue }} — {{ $show->city }}, {{ $show->country }}</div>
              <div style="color:var(--text-faint);font-size:.9rem;margin-top:.25rem">{{ $show->date->locale('es')->isoFormat('D MMM YYYY') }}@if($show->start_time) - {{ optional($show->start_time)->format('H:i') }}@endif</div>
            </div>
            <div style="margin-top:1rem;display:flex;justify-content:space-between;align-items:center;">
              <small style="color:var(--text-faint);font-size:.85rem">{{ $show->status }}</small>
              <a href="{{ route('shows.show', $show) }}" class="btn">Detalles</a>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <div style="margin-top:1rem">{{ $shows->links() }}</div>
  @else
    <p>No hay shows.</p>
  @endif
</main>
@endsection
