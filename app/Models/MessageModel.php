<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;

    protected $table = 'message';

    protected $guarded = [];

    public function sender_name()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function receiver_name()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}
