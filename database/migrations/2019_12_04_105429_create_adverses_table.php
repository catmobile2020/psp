<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdversesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_type')->nullable();
            $table->text('patient_initials')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('reaction_onset_date')->nullable();
            $table->text('suspected_novartis_drug')->nullable();
            $table->string('dose')->nullable();
            $table->text('indication')->nullable();
            $table->text('reaction_description')->nullable();
            $table->boolean('is_serious')->nullable();
            $table->boolean('is_drug_related')->nullable();
            $table->string('concomitant_medications')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('treating_physician')->nullable();
            $table->string('reporter_name')->nullable();
            $table->date('Date')->nullable();
            $table->unsignedInteger('call_center_id')->nullable();
            $table->foreign('call_center_id')->references('id')->on('call_centers')->onDelete('cascade');
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
        Schema::dropIfExists('adverses');
    }
}
