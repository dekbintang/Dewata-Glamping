<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Housekeeping extends Model
{
    protected $table = 'housekeeping';
    protected $primaryKey = 'housekeeping_id';

    protected $fillable = [
        'unit_id', 'user_id', 'status',
        'last_cleaned', 'notes',
    ];

    protected $casts = [
        'last_cleaned' => 'datetime',
    ];

    public function unit()
    {
        return $this->belongsTo(UnitGlamping::class, 'unit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
