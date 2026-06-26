<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'order_id', 'item_name', 'price',
        'quantity', 'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(FnbOrder::class, 'order_id');
    }
}
