<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerPlant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'marginal_cost', 'user_id','created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
