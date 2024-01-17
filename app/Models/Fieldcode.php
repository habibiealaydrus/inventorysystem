<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fieldcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_name',
        'field_code'
    ];
}
