<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function generateInvoice()
    {
        $invoiceData = [
            'user_id' => $userId,
            'code' => $invoiceCode,
            'payment_due' => $paymentDue,
            'payment_date' => $paymentDate,
            'total_amount' => $amount,
            'payment_status' => $paymentStatus,
            'payment_token' => $paymentToken,
            'payment_url' => $paymentUrl,
            'user_name' => $userName,
            'user_phone' => $userPhone,
            'user_address' => $userAddress
        ];
        Invoice::create($invoiceData);
    }
}
