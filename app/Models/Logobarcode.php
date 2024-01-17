<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logobarcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_logo',
        'details_logo',
        'file_name'
    ];
}
