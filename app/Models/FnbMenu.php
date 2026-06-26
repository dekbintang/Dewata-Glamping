<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnbMenu extends Model
{
    protected $table = 'fnb_menu';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_name', 'category', 'price',
        'is_available', 'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];
}
