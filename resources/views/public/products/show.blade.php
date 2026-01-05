@extends('layouts.guest')

@section('content')
<section class="section product-detail" aria-label="Producto">
  <style>
    .product-detail-grid{width:min(1100px,92%);margin-inline:auto;display:grid;grid-template-columns:1fr 320px;gap:1rem;align-items:start}
    .product-detail-grid .product-image img{width:100%;height:auto;display:block;object-fit:cover}
    .variant-label{display:flex;justify-content:space-between;align-items:center;padding:.4rem;border-radius:6px;border:1px solid rgba(0,0,0,0.04);}
    @media (max-width:720px){
      .product-detail-grid{grid-template-columns:1fr;padding:0 12px}
      .product-detail-grid aside{order:2}
      .product-detail-grid > div{order:1}
      .variant-label{flex-direction:row;gap:.5rem}
      .product-detail-grid .product-image img{max-height:50vh;object-fit:cover}
    }
  </style>
  <div class="section-header">
    <h2 class="section-title">{{ $product->name }}</h2>
    <div class="divider"></div>
  </div>

  <div class="product-detail-grid">
    <div>
      @if(!empty($product->main_image_url))
        <div class="product-image" style="width:100%;border-radius:8px;overflow:hidden;margin-bottom:1rem;">
          <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->name }}">
        </div>
      @endif

      <div style="padding:.6rem;background:var(--card-bg);border-radius:8px;">
        <h3 style="margin-top:0">Descripción</h3>
        <p style="color:var(--text-faint);">{!! nl2br(e($product->description ?? 'No hay descripción.')) !!}</p>
      </div>
    </div>

    <aside style="position:relative;">
      <div style="padding:1rem;border-radius:8px;background:var(--card-bg);border:1px solid rgba(0,0,0,0.06);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem;">
          <strong style="font-size:1.1rem">{{ $product->name }}</strong>
          <div style="color:var(--text-faint);">{{ $product->type }}</div>
        </div>

        <div style="font-size:1.25rem;margin-bottom:.5rem">Q {{ $product->price ? number_format($product->price,2) : '—' }}</div>

        @if($product->variants && $product->variants->count())
          <form method="POST" action="{{ route('cart.add') }}" id="variant-form">
            @csrf
            <div style="display:flex;flex-direction:column;gap:.5rem;">
              <label style="font-weight:600">Seleccionar variante</label>
                @foreach($product->variants as $variant)
                  <label class="variant-label">
                    <span>{{ $variant->name }}</span>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                      <small style="color:var(--text-faint);">{{ $variant->extra_price ? '+ Q'.number_format($variant->extra_price,2) : '—' }}</small>
                      <input type="radio" name="variant_id" value="{{ $variant->id }}" data-extra="{{ $variant->extra_price ?? 0 }}" {{ $loop->first ? 'checked' : '' }}>
                    </div>
                  </label>
                @endforeach
            </div>

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label style="display:block;margin-top:.75rem">Cantidad
              <input type="number" name="qty" id="qty-input" value="1" min="1" style="width:70px;margin-left:.5rem;padding:.3rem;border:1px solid rgba(0,0,0,0.06);border-radius:6px">
            </label>
            <div style="margin-top:1rem;display:flex;gap:.5rem;align-items:center;justify-content:space-between;flex-wrap:wrap;">
              <div style="font-weight:700">Total: <span id="final-price">Q {{ $product->price ? number_format($product->price,2) : '0.00' }}</span></div>
              <div style="display:flex;gap:.5rem;align-items:center">
                <button type="submit" class="btn">Agregar al carrito</button>
                <a href="{{ route('store.index') }}" class="btn" style="background:transparent;border:1px solid rgba(0,0,0,0.06);">Ver más productos</a>
              </div>
            </div>
          </form>
          <div id="add-success" role="status" aria-live="polite" style="display:none;margin-top:.5rem;padding:.6rem;border-radius:6px;background:rgba(16,185,129,0.08);color:var(--text);border:1px solid rgba(16,185,129,0.12)"></div>
        @else
          <div style="margin-top:.5rem;color:var(--text-faint);">Sin variantes</div>
        @endif

      </div>
    </aside>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    var base = parseFloat('{{ $product->price ?? 0 }}') || 0;
    var radios = document.querySelectorAll('input[name="variant_id"]');
    var final = document.getElementById('final-price');
    var qtyInput = document.getElementById('qty-input');
    var successEl = document.getElementById('add-success');
    function update(){
      var extra = 0;
      radios.forEach(function(r){ if(r.checked) extra = parseFloat(r.dataset.extra) || 0; });
      var qty = 1;
      if (qtyInput) qty = parseInt(qtyInput.value) || 1;
      final.textContent = 'Q ' + ((base + extra) * qty).toFixed(2);
    }
    radios.forEach(function(r){ r.addEventListener('change', update); });
    if (qtyInput) qtyInput.addEventListener('change', update);
    update();

    // AJAX add-to-cart
    var form = document.getElementById('variant-form');
    if (form) {
      form.addEventListener('submit', function(e){
        e.preventDefault();
        var fd = new FormData(form);
        fetch(form.action, {
          method: 'POST',
          body: fd,
          credentials: 'same-origin',
          headers: {
            'Accept': 'application/json'
          }
        }).then(function(res){
          var ct = res.headers.get('content-type') || '';
          if (ct.indexOf('application/json') !== -1) {
            return res.json().then(function(data){
              if (data && data.success) {
                if (successEl) {
                  successEl.textContent = data.message || 'Añadido al carrito.';
                  successEl.style.display = 'block';
                  setTimeout(function(){ successEl.style.display = 'none'; }, 3000);
                }
                // update header cart count if present
                var badge = document.getElementById('cart-count');
                if (badge && typeof data.count !== 'undefined') {
                  badge.textContent = data.count;
                }
              }
            });
          } else {
            // fallback: non-JSON (likely redirect) – go to cart page
            window.location = '{{ route('cart.index') }}';
          }
        }).catch(function(){
          window.location = '{{ route('cart.index') }}';
        });
      });
    }
  });
</script>
@endsection
