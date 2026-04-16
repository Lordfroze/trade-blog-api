<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    // mengambil semua data
    public function index()
    {
        $posts = Post::get(); // mengambil semua data dari model Post

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
}
