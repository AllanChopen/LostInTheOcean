<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    protected function cartKey(): string
    {
        return 'cart.items';
    }

    public function index(Request $request)
    {
        $items = $request->session()->get($this->cartKey(), []);

        // load product and variant info
        foreach ($items as $key => $it) {
            $product = Product::find($it['product_id']);
            $variant = isset($it['variant_id']) ? ProductVariant::find($it['variant_id']) : null;
            $items[$key]['product'] = $product;
            $items[$key]['variant'] = $variant;
        }

        $total = 0;
        foreach ($items as $it) {
            $price = $it['price'] ?? 0;
            $qty = $it['qty'] ?? 1;
            $total += $price * $qty;
        }

        return view('public.cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'variant_id' => 'nullable|integer|exists:product_variants,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $product = Product::find($data['product_id']);
        if (! $product) {
            return Redirect::back()->with('error', 'Producto no encontrado.');
        }

        $qty = $data['qty'] ?? 1;
        $variant = null;
        $extra = 0;
        if (! empty($data['variant_id'])) {
            $variant = ProductVariant::find($data['variant_id']);
            if ($variant) $extra = $variant->extra_price ?? 0;
        }

        $unitPrice = ($product->price ?? 0) + ($extra ?? 0);

        $items = $request->session()->get($this->cartKey(), []);

        // key by product:variant
        $key = $product->id . ':' . ($variant->id ?? '0');

        if (isset($items[$key])) {
            $items[$key]['qty'] += $qty;
        } else {
            $items[$key] = [
                'product_id' => $product->id,
                'variant_id' => $variant->id ?? null,
                'qty' => $qty,
                'price' => $unitPrice,
            ];
        }

        $request->session()->put($this->cartKey(), $items);

        // compute total item count
        $count = 0;
        foreach ($items as $it) {
            $count += $it['qty'] ?? 0;
        }

        // if this is an AJAX/JSON request, return JSON with the new count
        if ($request->wantsJson() || $request->acceptsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito.',
                'count' => $count,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        $items = $request->session()->get($this->cartKey(), []);
        if (isset($items[$data['key']])) {
            $items[$data['key']]['qty'] = $data['qty'];
            $request->session()->put($this->cartKey(), $items);
        }

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string',
        ]);

        $items = $request->session()->get($this->cartKey(), []);
        if (isset($items[$data['key']])) {
            unset($items[$data['key']]);
            $request->session()->put($this->cartKey(), $items);
        }

        return redirect()->route('cart.index')->with('success', 'Artículo eliminado.');
    }
}
