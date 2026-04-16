<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // import validator
use App\Models\Comment;
use Tymon\JWTAuth\Facades\JWTAuth; // import JWTAuth



class CommentsController extends Controller
{
    // Simpan komentar baru
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate(); // mengambil data user yang login berdasarkan token

        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'content' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        // Simpan komentar baru ke dalam database
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $comment
        ]);
    }

    // menghapus komentar
    public function destroy($id)
    {
        Comment::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }
}
