<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupcodessub extends Model
{
    use HasFactory;
    protected $fillable = [
        'groupcodesub_name',
        'groupcodesub_code'
    ];
}
