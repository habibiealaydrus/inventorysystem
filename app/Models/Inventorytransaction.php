<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventorytransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'type_asset',
        'name_inventory',
        'code_inventory',
        'type_inventory',
        'quantity_type',
        'quantity',
        'photo_product',
        'photo_recieve',
        'type_transaction'

    ];
}
