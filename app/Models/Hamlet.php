<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hamlet_name'

    ];

    /**
     * Get the user that owns the hamlet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
