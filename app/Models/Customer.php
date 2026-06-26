<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name', 'email', 'phone', 'alamat',
        'total_visits', 'customer_segment', 'preferences',
    ];

    protected $casts = [
        'preferences' => 'array',
    ];

    /**
     * Accessor: $customer->segment
     */
    public function getSegmentAttribute(): string
    {
        return ucfirst($this->customer_segment ?? 'Reguler');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customer_id');
    }

    public function notes()
    {
        return $this->hasMany(CustomerNote::class, 'customer_id');
    }

    /**
     * Auto-update segment berdasarkan total_visits
     */
    public function updateSegment(): void
    {
        if ($this->total_visits >= 5) {
            $this->customer_segment = 'vip';
        } elseif ($this->total_visits >= 2) {
            $this->customer_segment = 'returning';
        } else {
            $this->customer_segment = 'new';
        }
        $this->save();
    }
}
