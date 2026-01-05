<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.Products', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'type' => 'required|in:clothing,accessory,other',
            'main_image' => 'nullable|image',
            'is_active' => 'sometimes|boolean',
        ]);

        $imageUrl = null;
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $imageUrl = str_replace(["\r", "\n"], '', trim(Storage::url($path)));
        }

        $product = Product::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'] ?? null,
            'type' => $data['type'],
            'main_image_url' => $imageUrl,
            'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : true,
        ]);

        return redirect()->route('admin.products.edit', $product)->with('success', 'Producto creado. Ahora puedes agregar variantes.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'type' => 'required|in:clothing,accessory,other',
            'main_image' => 'nullable|image',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('main_image')) {
            if (! empty($product->main_image_url)) {
                $oldPath = ltrim(str_replace('/storage/', '', $product->main_image_url), '/');
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('main_image')->store('products', 'public');
            $product->main_image_url = str_replace(["\r", "\n"], '', trim(Storage::url($path)));
        }

        $product->name = $data['name'];
        $product->slug = $data['slug'];
        $product->description = $data['description'] ?? null;
        $product->price = $data['price'] ?? null;
        $product->type = $data['type'];
        $product->is_active = isset($data['is_active']) ? (bool) $data['is_active'] : true;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        if (! empty($product->main_image_url)) {
            $oldPath = ltrim(str_replace('/storage/', '', $product->main_image_url), '/');
            Storage::disk('public')->delete($oldPath);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado.');
    }

    /**
     * Store a new variant for the given product.
     */
    public function storeVariant(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'extra_price' => 'nullable|numeric',
            'is_active' => 'sometimes|boolean',
        ]);

        $product->variants()->create([
            'name' => $data['name'],
            'extra_price' => $data['extra_price'] ?? null,
            'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : true,
        ]);

        return redirect()->route('admin.products.edit', $product)->with('success', 'Variante agregada.');
    }

    /**
     * Remove a variant from a product.
     */
    public function destroyVariant(Product $product, ProductVariant $variant)
    {
        if ($variant->product_id !== $product->id) {
            abort(404);
        }

        $variant->delete();
        return redirect()->route('admin.products.edit', $product)->with('success', 'Variante eliminada.');
    }
}
