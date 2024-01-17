<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventorycode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_inventory',
        'details',
        'inventory_code',
    ];
}
