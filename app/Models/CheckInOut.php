<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
    protected $table = 'check_in_outs';
    protected $primaryKey = 'check_id';

    protected $fillable = [
        'reservation_id', 'user_id',
        'check_in_time', 'check_out_time', 'notes',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
