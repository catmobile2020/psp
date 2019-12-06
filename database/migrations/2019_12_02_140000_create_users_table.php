<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->nullable();
            $table->string('national_id')->nullable();
            $table->integer('age')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('diagnosis')->nullable();
            $table->tinyInteger('type')->nullable(); // 1=>patient 2=>pharmacy  3=>lab  4=>doctor  5=>hospital   6=>eye center
            $table->string('serial_number')->nullable();
            $table->string('specialty')->nullable();
            $table->string('preferred_distributor')->nullable();
            $table->string('password');
            $table->unsignedInteger('doctor_id')->nullable();

            $table->unsignedInteger('governorate_id')->nullable();
            $table->foreign('governorate_id')->references('id')->on('governorates');

            $table->unsignedInteger('call_center_id')->nullable();
            $table->foreign('call_center_id')->references('id')->on('call_centers');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
