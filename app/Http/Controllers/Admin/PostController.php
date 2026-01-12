<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Exception;

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
            try {
                $upload = cloudinary()->uploadApi()->upload($request->file('banner')->getRealPath(), ['folder' => 'banners']);
                $bannerUrl = $upload['secure_url'] ?? $upload['url'] ?? null;
            } catch (Exception $e) {
                $bannerUrl = null;
            }
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
            if (! empty($post->banner_image_url)) {
                if (str_contains($post->banner_image_url, '/storage/')) {
                    $oldPath = ltrim(str_replace('/storage/', '', $post->banner_image_url), '/');
                    Storage::disk('public')->delete($oldPath);
                } elseif (str_contains($post->banner_image_url, 'cloudinary.com')) {
                    $publicId = null;
                    $parts = parse_url($post->banner_image_url);
                    if (isset($parts['path'])) {
                        $path = $parts['path'];
                        $pos = strpos($path, '/image/upload/');
                        if ($pos === false) {
                            $pos = strpos($path, '/video/upload/');
                        }
                        if ($pos !== false) {
                            $public = substr($path, $pos + strlen('/image/upload/'));
                            $public = preg_replace('#^v[0-9]+/#', '', ltrim($public, '/'));
                            $public = preg_replace('#\.[^/.]+$#', '', $public);
                            $publicId = $public;
                        }
                    }

                    if ($publicId) {
                        try {
                            cloudinary()->uploadApi()->destroy($publicId);
                        } catch (Exception $e) {
                        }
                    }
                }
            }

            try {
                $upload = cloudinary()->uploadApi()->upload($request->file('banner')->getRealPath(), ['folder' => 'banners']);
                $post->banner_image_url = $upload['secure_url'] ?? $upload['url'] ?? null;
            } catch (Exception $e) {
            }
        }

        $post->title = $data['title'];
        $post->content = $data['content'] ?? null;
        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        if (! empty($post->banner_image_url)) {
            if (str_contains($post->banner_image_url, '/storage/')) {
                $oldPath = ltrim(str_replace('/storage/', '', $post->banner_image_url), '/');
                Storage::disk('public')->delete($oldPath);
            } elseif (str_contains($post->banner_image_url, 'cloudinary.com')) {
                $publicId = null;
                $parts = parse_url($post->banner_image_url);
                if (isset($parts['path'])) {
                    $path = $parts['path'];
                    $pos = strpos($path, '/image/upload/');
                    if ($pos === false) {
                        $pos = strpos($path, '/video/upload/');
                    }
                    if ($pos !== false) {
                        $public = substr($path, $pos + strlen('/image/upload/'));
                        $public = preg_replace('#^v[0-9]+/#', '', ltrim($public, '/'));
                        $public = preg_replace('#\.[^/.]+$#', '', $public);
                        $publicId = $public;
                    }
                }

                if ($publicId) {
                    try {
                        cloudinary()->uploadApi()->destroy($publicId);
                    } catch (Exception $e) {
                    }
                }
            }
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }
}
