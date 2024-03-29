<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->text('comment')->nullable();
            $table->boolean('has_free')->default(false);
            $table->string('confirmation_code')->nullable();
            $table->boolean('activated')->default(true);
            $table->unsignedInteger('batch_id')->nullable();
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->unsignedInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
