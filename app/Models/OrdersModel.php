<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function order_items(){
        return $this->hasMany(OrderItemsModel::class , 'order_id' , 'id');
    }
}
