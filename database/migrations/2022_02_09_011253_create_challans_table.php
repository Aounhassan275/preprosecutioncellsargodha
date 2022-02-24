<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challans', function (Blueprint $table) {
            $table->id();
            $table->string('fir');
            $table->date('dated');
            $table->string('under_section');
            $table->string('police_station');
            $table->string('offence');
            $table->string('i_o_name');
            $table->boolean('i_o_contacted_to_complainant')->default(0)->nullable();
            $table->boolean('challan_prepare_within_14_days')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->string('road_no')->nullable();
            $table->string('accused_name')->nullable();
            $table->string('nature_of_challan')->nullable();
            $table->boolean('challan_interim_report_within_14_days')->default(0)->nullable();
            $table->boolean('file_send_after_3_days')->default(0)->nullable();
            $table->boolean('challan_receive_in_branch')->default(0)->nullable();
            $table->date('interim_sent_to_prosecution_department_date')->nullable();
            $table->date('objection_date')->nullable();
            $table->text('objection')->nullable();
            $table->string('prosecutor_name')->nullable();
            $table->date('challan_passed_date')->nullable();
            $table->boolean('challan_resubmitted_after_defect_removals')->default(0)->nullable();
            $table->date('date_of_receiving_challan_in_court')->nullable();
            $table->date('date_of_decision')->nullable();
            $table->text('decision')->nullable();
            $table->string('judge_name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('judge_id')->nullable();
            $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade');
            $table->unsignedBigInteger('fir_id')->nullable();
            $table->foreign('fir_id')->references('id')->on('f_i_r_s')->onDelete('cascade');
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
        Schema::dropIfExists('challans');
    }
}
