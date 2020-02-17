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
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('payment_method_id')->unsigned()->default(0);
            $table->integer('transporter_id')->default(0);
            $table->integer('tag_id')->default(0);
            $table->integer('reservation_id')->default(0);
            $table->string('location_from');
            $table->string('location_to');
            $table->date('date');
            $table->time('time');
            $table->timestamp('due_date');
            $table->timestamps();
        });

        Schema::table('invoices',function (Blueprint $table){
            $table->foreign('status_id')->on('statuses')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices',function (Blueprint $table){
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('invoices');
    }
}
