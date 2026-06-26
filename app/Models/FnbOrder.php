<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnbOrder extends Model
{
    protected $table = 'fnb_orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'reservation_id', 'order_date',
        'total_amount', 'status',
    ];

    protected $casts = [
        'order_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * Recalculate total from order details
     */
    public function recalculateTotal(): void
    {
        $this->total_amount = $this->details()->sum('subtotal');
        $this->save();
    }
}
