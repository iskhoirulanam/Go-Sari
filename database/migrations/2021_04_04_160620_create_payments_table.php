<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('number')->unique();
            $table->decimal('amount', 16,2);
            $table->string('method');
            $table->string('token')->nullable();
            $table->json('payload')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('va_number')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('biller_code')->nullable();
            $table->string('bill_key')->nullable();
            $table->timestamps();
            
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->index('number');
            $table->index('method');
            $table->index('token');
            $table->index('payment_type');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
