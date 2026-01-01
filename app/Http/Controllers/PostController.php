<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|max:2048', // 2MB
            'status' => 'required|in:draft,published',
        ]);

        $bannerImageUrl = null;

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('posts', 'public');
            $bannerImageUrl = '/storage/' . $path;
        }

        $post = Post::create([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'banner_image_url' => $bannerImageUrl,
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published'
                ? now()
                : null,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201);
    }
}
