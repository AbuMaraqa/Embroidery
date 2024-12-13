<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbroideryRequestSubmitModel extends Model
{
    use HasFactory;

    protected $table = 'embroidery_request_submit';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
