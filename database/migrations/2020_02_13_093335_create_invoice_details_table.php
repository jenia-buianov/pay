<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned();
            $table->bigInteger('another_phone_type_id')->unsigned()->default(0);
            $table->string('client_location');
            $table->string('client_state');
            $table->string('client_address');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('another_phone')->nullable();
        });

        Schema::table('invoice_details',function (Blueprint $table){
            $table->foreign('invoice_id')->on('invoices')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_details',function (Blueprint $table){
            $table->dropForeign(['invoice_id']);
        });
        Schema::dropIfExists('invoice_details');
    }
}
