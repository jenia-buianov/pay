<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned();
            $table->integer('currency_type_id')->default(0);
            $table->integer('offer_type_id')->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->decimal('amount',12,4);
        });

        Schema::table('passengers',function (Blueprint $table){
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
        Schema::table('passengers',function (Blueprint $table){
            $table->dropForeign(['invoice_id']);
        });
        Schema::dropIfExists('passengers');
    }
}
