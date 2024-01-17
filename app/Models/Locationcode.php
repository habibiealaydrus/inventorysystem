<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locationcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_location',
        'details_location',
        'location_code',
    ];
}
