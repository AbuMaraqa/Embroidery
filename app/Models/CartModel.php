<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = ['user_id', 'session_id', 'product_id', 'qty'];

    public function product()
    {
        return $this->belongsTo(ProductModel::class , 'product_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
