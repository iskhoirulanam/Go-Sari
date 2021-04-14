<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'month',
        'payment_due',
        'payment_date',
        'total_amount',
        'payment_status',
        'payment_token',
        'payment_url',
        'user_name',
        'user_phone',
        'user_email',
    ];

    const UNPAID = 'unpaid';
    const PENDING = 'pending';
    const PAID = 'paid';

    /**
     * Get the user that owns the invoice.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function generateCode($userId)
    {
        $prefix = 'INV' . $userId . '-';
        $idCode = $prefix .strtoupper(Str::random(4)). Carbon::now()->format('YmdHis');
        
        $lastInvoice = self::select([DB::raw('MAX(invoices.code) AS last_code')])
            ->where('code', 'like', $idCode . '%')->first();       
        
        $lastInvoiceCode = !empty($lastInvoice) ? $lastInvoice['last_code'] : null;
        

        $invoiceCode = $idCode . '01';
        if ($invoiceCode) {
            $lastInvoiceNumber = str_replace($idCode, '', $lastInvoiceCode);
            $nextInvoiceNumber = sprintf('%02d', (int)$lastInvoiceNumber + 1);
            
            $invoiceCode = $idCode . $nextInvoiceNumber;
        }
        // dd($invoiceCode);

        return $invoiceCode;
    }

}
