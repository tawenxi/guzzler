<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('payee');
            $table->string('payeeaccount');
            $table->string('payeebanker');
            $table->float('amount');
            $table->string('zhaiyao');
            $table->string('income_id')->nullable();
            $table->string('kemu')->nullable();
            $table->string('beizhu')->nullable();
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
        Schema::drop('costs');
    }
}
