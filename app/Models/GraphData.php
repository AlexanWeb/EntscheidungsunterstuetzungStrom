<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GraphData extends Model
{
    protected $fillable = [
        'date', 'price'
    ];

    public $timestamps = false;
}
