<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_tags', function (Blueprint $table) {
            $table->bigInteger('payment_method_id')->unsigned();
            $table->integer('tag_id')->unsigned();
        });

        Schema::table('payment_method_tags',function (Blueprint $table){
            $table->foreign('payment_method_id')->on('payment_methods')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_method_tags',function (Blueprint $table){
            $table->dropForeign(['payment_method_id']);
        });
        Schema::dropIfExists('payment_method_tags');
    }
}
