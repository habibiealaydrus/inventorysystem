<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'groupcode_name',
        'groupcode_code'
    ];
}
