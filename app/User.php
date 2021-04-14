<?php

namespace App;

use App\Models\Hamlet;
use App\Models\Invoice;
use App\Models\GarbageCategory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'phone',
        'garbage_category_id',
        'garbage_can_location',
        'garbage_can_picture',
        'hamlet_id',
        'rt',
        'address',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the invoices for the users.
     */
    public function invoices()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the hamlet for the user.
     */
    public function hamlet()
    {
        return $this->hasOne(Hamlet::class,'id', 'hamlet_id');
    }

    /**
     * Get the garbage category for the user.
     */
    public function garbageCategory()
    {
        return $this->hasOne(GarbageCategory::class, 'id', 'garbage_category_id');
    }

    const INACTIVE = 'inactive';
    const ACTIVE = 'active';
}
