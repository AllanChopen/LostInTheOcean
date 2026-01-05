@extends('layouts.guest')

@section('content')
<section class="section products-section" aria-label="Tienda">
  <div class="section-header">
    <h2 class="section-title">Tienda</h2>
    <div class="divider"></div>
  </div>

  <div style="width:min(1100px,92%);margin-inline:auto;">
    @if(isset($products) && $products->count())
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem;">
                @foreach($products as $product)
          <article style="border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);padding:10px;display:flex;flex-direction:column;align-items:stretch;">
            @if(!empty($product->main_image_url))
              <div style="width:100%;aspect-ratio:1/1;overflow:hidden;border-radius:6px;margin-bottom:.6rem;background:#fff;display:flex;align-items:center;justify-content:center;">
                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;display:block;">
              </div>
            @endif
            <div style="flex:1;display:flex;flex-direction:column;">
              <strong style="font-size:1rem">{{ $product->name }}</strong>
              <div style="color:var(--text-faint);font-size:.95rem;margin-top:.35rem">{{ $product->type }} &middot; {{ $product->price ? number_format($product->price,2) : '—' }}</div>
              <div style="margin-top:auto;display:flex;justify-content:space-between;align-items:center;margin-top:.6rem;">
                <a href="{{ route('store.show', $product) }}" class="btn" style="padding:.35rem .6rem">Ver</a>
                <span style="color:var(--text-faint);font-size:.95rem">{{ $product->is_active ? 'Activo' : 'Inactivo' }}</span>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="margin-top:1rem">{{ $products->links() }}</div>
    @else
      <p style="color:var(--text-faint);">No hay productos disponibles.</p>
    @endif
  </div>
</section>
@endsection
