<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSKRToZbDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zb_details', function (Blueprint $table) {
            $table->string('SKR')->nullable();
            $table->string('SKZH')->nullable();
            $table->string('SKRKHYH')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zb_details', function (Blueprint $table) {
            $table->dropColumn('SKR');
            $table->dropColumn('SKZH');
            $table->dropColumn('SKRKHYH');
        });
    }
}
