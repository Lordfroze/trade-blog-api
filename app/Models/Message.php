<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    // memilih kolom yang bisa diisi dari table messages pada database
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message_content'
    ];
}
