<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator; // import validator

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

    // menyimpan data
    // function store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        // check validator jika gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // jika validator sukses
        $post = Post::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
            'image_url' => $request->image_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat post',
            'data' => $post
        ], 201);
    }
}
