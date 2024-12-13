<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbroideryRequestModel extends Model
{
    use HasFactory;

    protected $table = 'embroidery_request';

    public function user(){
        return $this->belongsTo(User::class , 'user_id' ,'id');
    }

    public function embroider(){
        return $this->belongsTo(User::class , 'accept_embroider' , 'id');
    }
}
