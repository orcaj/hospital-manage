<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id', 100);
            $table->string('service_ids', 100);
            $table->string('due_date', 100);
            $table->string('appointment_date', 100);
            $table->float('sub_total');
            $table->float('total_discount');
            $table->float('invoice_total');
            $table->float('total_paid');
            $table->float('total_due');
            $table->string('payment_terms', 200)->nullable();
            $table->string('client_notes', 200)->nullable();
            $table->string('received_payment');
            $table->string('payment_type', 200)->nullable();
            $table->string('show_client_notes');
            $table->string('show_payment_terms');
            $table->string('is_sent');
            $table->string('civil_id', 190);
            $table->string('status', 190)->default('published');
            $table->date('status_date')->nullable();
            $table->string('discount_percents', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
