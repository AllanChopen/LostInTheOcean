<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.panel', compact('posts'));
    }
}
