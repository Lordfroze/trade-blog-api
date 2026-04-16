<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;


class MessagesController extends Controller
{
    //menyimpan pesan
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message_content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        // jika validasi berhasil
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->message_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $message
        ]);
    }

    // menampilkan pesan
    public function show($id)
    {
        $message = Message::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil pesan',
            'data' => $message
        ]);
    }

    // menampilkan pesan berdasrkan id
    public function getMessages($user_id)
    {
        $messages = Message::where('receiver_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil pesan berdasrkan user',
            'data' => $messages
        ]);
    }

    // Menghapus pesan
    public function destroy($id)
    {
        Message::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
