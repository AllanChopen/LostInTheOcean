<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;

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
            $upload = cloudinary()->uploadApi()->upload($request->file('main_image')->getRealPath(), ['folder' => 'products']);
            $imageUrl = $upload['secure_url'] ?? $upload['url'] ?? null;
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
                if (str_contains($product->main_image_url, '/storage/')) {
                    $oldPath = ltrim(str_replace('/storage/', '', $product->main_image_url), '/');
                    Storage::disk('public')->delete($oldPath);
                } elseif (str_contains($product->main_image_url, 'cloudinary.com')) {
                    $publicId = $this->extractPublicIdFromCloudinaryUrl($product->main_image_url);
                    if ($publicId) {
                        try {
                            cloudinary()->uploadApi()->destroy($publicId);
                        } catch (Exception $e) {
                        }
                    }
                }
            }

            $upload = cloudinary()->uploadApi()->upload($request->file('main_image')->getRealPath(), ['folder' => 'products']);
            $product->main_image_url = $upload['secure_url'] ?? $upload['url'] ?? null;
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
            if (str_contains($product->main_image_url, '/storage/')) {
                $oldPath = ltrim(str_replace('/storage/', '', $product->main_image_url), '/');
                Storage::disk('public')->delete($oldPath);
            } elseif (str_contains($product->main_image_url, 'cloudinary.com')) {
                $publicId = $this->extractPublicIdFromCloudinaryUrl($product->main_image_url);
                if ($publicId) {
                    try {
                        cloudinary()->uploadApi()->destroy($publicId);
                    } catch (Exception $e) {
                    }
                }
            }
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

/**
 * Try to extract the Cloudinary public id from a delivered URL.
 */
private function extractPublicIdFromCloudinaryUrl(string $url): ?string
    {
        $parts = parse_url($url);
        if (! isset($parts['path'])) {
            return null;
        }

        $path = $parts['path'];
        foreach (['/image/upload/', '/video/upload/'] as $marker) {
            $pos = strpos($path, $marker);
            if ($pos !== false) {
                $public = substr($path, $pos + strlen($marker));
                $public = preg_replace('#^v[0-9]+/#', '', ltrim($public, '/'));
                $public = preg_replace('#\.[^/.]+$#', '', $public);
                return $public;
            }
        }

        return null;
    }
}