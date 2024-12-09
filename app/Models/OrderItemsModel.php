<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemsModel extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    public function order(){
        return $this->belongsTo(OrdersModel::class , 'order_id' , 'id');
    }

    public function product(){
        return $this->belongsTo(ProductModel::class , 'product_id' , 'id');
    }
}
