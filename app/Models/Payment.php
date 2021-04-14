<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'amount',
        'method',
        'token',
        'payload',
        'payment_type',
        'va_number',
        'vendor_name',
        'biller_code',
        'bill_key'
    ];

    /**
     * Get the invoices for the payments.
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
    
    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function initPaymentGateway()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public const PAYMENT_CHANNELS = [
        'credit_card', 
        'bca_klikbca', 
        'bca_klikpay', 
        'bri_epay', 
        'bca_va', 
        'bni_va', 
        'bri_va', 
        'gopay', 
        'indomaret',
        'shopeepay'
    ];
    public const EXPIRY_DURATION = 3;
    public const EXPIRY_UNIT = 'days';
}
