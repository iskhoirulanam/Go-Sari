<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GarbageCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
