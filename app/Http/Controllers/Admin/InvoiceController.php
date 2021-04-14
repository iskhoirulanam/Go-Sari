<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function _getCurrentMonth()
    {
        $return = Carbon::now()->format('F Y');
    }
    
    public function index()
    {
        $invoices = Invoice::all();
        $currentMonth = $this->_getCurrentMonth();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create($id)
    {
        $member = User::find($id);
        $currentMonth = $this->_getCurrentMonth();
        
        return view('admin.invoices.create-invoice', compact('currentMonth', 'member'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $userId = $request->user_id;
        // dd($userId);

        Invoice::updateOrCreate(
            [
                'user_id' => $userId,
                'month' => $request->month,
                ],[
                'code' => Invoice::generateCode($userId),
                'payment_due' => $request->payment_due,
                'payment_status' => Invoice::UNPAID,
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'user_email' => $request->user_email,
                'total_amount' => $request->total_amount
            ]
        );

        // Create data for payments
        $invoice = Invoice::where('user_id', $userId)->where('month', $request->month)->first();

        // dd($invoice->payment_token);
        $token = $this->_generatePaymentToken($invoice);
        
        return redirect('admin/members');
    }
    
    private function _generatePaymentToken($invoice)
    {
        Payment::initPaymentGateway();
        
        $customerDetails = [
            'first_name' => $invoice->user_name,
            'last_name' => '',
            'phone' => $invoice->user_phone,
            'email' => $invoice->user_email,
        ];

        $params = [
            'enabled_payments' => Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id'=> $invoice->code,
                'gross_amount' => $invoice->total_amount,
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                // 'start_time' => date('Y-m-d H:i:s T', $invoice->payment_due),
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => Payment::EXPIRY_UNIT,
                'duration' => Payment::EXPIRY_DURATION,
            ]
        ];
        // dd($params);
        
        // Get Snap Payment Page URL
        $paymentUrl = \Midtrans\Snap::createTransaction($params);
        // dd($paymentUrl);

        if ($paymentUrl->token) {
            $invoice->payment_token = $paymentUrl->token;
            $invoice->payment_url = $paymentUrl->redirect_url;
            $invoice->save();
        }
    }
}
