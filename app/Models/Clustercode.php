<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clustercode extends Model
{
    use HasFactory;
    protected $fillable = [
        'cluster_code',
        'cluster_name'
    ];
}
