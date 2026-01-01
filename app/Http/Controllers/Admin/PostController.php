<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.Posts', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'banner' => 'nullable|image',
        ]);

        $bannerUrl = null;
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('banners', 'public');
            $bannerUrl = Storage::url($path);
            $bannerUrl = str_replace(["\r", "\n"], '', trim($bannerUrl));
        }

        Post::create([
            'title' => $data['title'],
            'content' => $data['content'] ?? null,
            'banner_image_url' => $bannerUrl,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'banner' => 'nullable|image',
        ]);

        if ($request->hasFile('banner')) {
            // delete previous banner if exists
            if (! empty($post->banner_image_url)) {
                $oldPath = ltrim(str_replace('/storage/', '', $post->banner_image_url), '/');
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('banner')->store('banners', 'public');
            $post->banner_image_url = str_replace(["\r", "\n"], '', trim(Storage::url($path)));
        }

        $post->title = $data['title'];
        $post->content = $data['content'] ?? null;
        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        if (! empty($post->banner_image_url)) {
            $oldPath = ltrim(str_replace('/storage/', '', $post->banner_image_url), '/');
            Storage::disk('public')->delete($oldPath);
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }
}
