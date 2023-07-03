<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regnumbers', function (Blueprint $table) {
            $table->id();
            $table->string('reg')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('version');
            $table->string('body');
            $table->string('doors');
            $table->string('seats');
            $table->string('reg_date');
            $table->string('reg_date_ie');
            $table->string('sale_date');
            $table->string('previous_reg');
            $table->string('engine_cc');
            $table->string('colour');
            $table->string('fuel');
            $table->string('transmission');
            $table->string('year_of_manufacture');
            $table->string('tax_class');
            $table->string('tax_expiry_date');
            $table->string('NCT_expiry_date');
            $table->string('nct_pass_date');
            $table->string('no_of_owners');
            $table->string('chassis_no');
            $table->string('engine_no');
            $table->string('co2_emissions');
            $table->string('crwExpDate');
            $table->string('vehicle_category');
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
        Schema::dropIfExists('regnumbers');
    }
};
