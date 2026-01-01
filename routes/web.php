<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\PostController;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $posts = Post::latest()->take(3)->get();
    return view('home', compact('posts'));
});

// Public posts index (paginated)
Route::get('/posts', function () {
    $posts = Post::latest()->paginate(10);
    return view('posts.index', compact('posts'));
})->name('posts.index');

// Public post show route
Route::get('/posts/{post}', function (App\Models\Post $post) {
    return view('posts.show', compact('post'));
})->name('posts.show');

// Dashboard removed: use admin panel instead

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin panel (protected)
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.panel');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard route removed to avoid duplicate /admin registration.
    // Use the top-level named route `admin.panel` for the admin landing page.

    Route::resource('posts', PostController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
});

// Contact form submission
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Temporary DB test route (remove after debugging)
Route::get('/db-test', function () {
    try {
        $res = DB::select('select 1 as ok');
        return response()->json($res);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

require __DIR__.'/auth.php';

// Temporary debug route: visit /debug-banner/{id} to see the raw <img> tag for a post's banner
Route::get('/debug-banner/{id}', function ($id) {
    $post = \App\Models\Post::find($id);
    if (! $post) {
        abort(404);
    }

    $url = $post->banner_image_url ?? '';
    return response("<html><body style=\"padding:1rem;font-family:system-ui,Arial\"><h2>Post #{$post->id} - " . e($post->title) . "</h2>" . ($url ? "<div><img src='" . e($url) . "' style='max-width:100%;height:auto;border:1px solid #ddd;border-radius:6px' /></div>" : "<div style='color:#666'>No banner set</div>") . "</body></html>", 200, ['Content-Type' => 'text/html']);
});

// Serve banner files through Laravel for environments where the webserver
// does not expose the public/storage symlink. This only serves files from
// storage/app/public/banners and is intentionally narrow in scope.
Route::get('/storage/banners/{filename}', function ($filename) {
    $path = storage_path('app/public/banners/' . $filename);
    if (! file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
