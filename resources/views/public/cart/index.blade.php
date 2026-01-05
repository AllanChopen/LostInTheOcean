@extends('layouts.guest')

@section('content')
<section class="section cart-section" aria-label="Carrito">
  <div class="section-header">
    <h2 class="section-title">Tu carrito</h2>
    <div class="divider"></div>
  </div>

  <div style="width:min(900px,92%);margin-inline:auto;">
    @if(isset($items) && count($items))
      <table style="width:100%;border-collapse:collapse;">
        <thead>
          <tr style="text-align:left;border-bottom:1px solid rgba(0,0,0,0.06);">
            <th style="padding:.6rem">Producto</th>
            <th style="padding:.6rem">Variante</th>
            <th style="padding:.6rem">Precio</th>
            <th style="padding:.6rem">Cantidad</th>
            <th style="padding:.6rem">Subtotal</th>
            <th style="padding:.6rem"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $key => $it)
            <tr style="border-bottom:1px solid rgba(0,0,0,0.04);">
              <td style="padding:.6rem;vertical-align:top;">
                <strong>{{ $it['product'] ? $it['product']->name : '—' }}</strong>
                <div style="color:var(--text-faint);font-size:.9rem">{{ $it['product'] ? $it['product']->type : '' }}</div>
              </td>
              <td style="padding:.6rem;vertical-align:top;">{{ $it['variant'] ? $it['variant']->name : '—' }}</td>
              <td style="padding:.6rem;vertical-align:top;">Q {{ number_format($it['price'],2) }}</td>
              <td style="padding:.6rem;vertical-align:top;">
                <form method="POST" action="{{ route('cart.update') }}" style="display:flex;gap:.4rem;align-items:center;">
                  @csrf
                  <input type="hidden" name="key" value="{{ $key }}">
                  <input type="number" name="qty" value="{{ $it['qty'] }}" min="1" style="width:64px;padding:.25rem;border-radius:6px;border:1px solid rgba(0,0,0,0.06);">
                  <button type="submit" class="btn" style="padding:.35rem .6rem">OK</button>
                </form>
              </td>
              <td style="padding:.6rem;vertical-align:top;">Q {{ number_format(($it['price'] * $it['qty']),2) }}</td>
              <td style="padding:.6rem;vertical-align:top;">
                <form method="POST" action="{{ route('cart.remove') }}">
                  @csrf
                  <input type="hidden" name="key" value="{{ $key }}">
                  <button type="submit" class="btn" style="background:transparent;border:1px solid rgba(0,0,0,0.06);">Eliminar</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div style="margin-top:1rem;display:flex;justify-content:flex-end;gap:1rem;align-items:center;">
        <div style="text-align:right;font-size:1.1rem;"><strong>Total:</strong> Q {{ number_format($total,2) }}</div>
        <a href="{{ route('store.index') }}" class="btn" style="background:transparent;border:1px solid rgba(0,0,0,0.06);">Seguir comprando</a>
        <button class="btn">Proceder a pagar</button>
      </div>
    @else
      <p style="color:var(--text-faint)">Tu carrito está vacío.</p>
      <div style="margin-top:1rem"><a href="{{ route('store.index') }}" class="btn">Ir a la tienda</a></div>
    @endif
  </div>
</section>
@endsection
