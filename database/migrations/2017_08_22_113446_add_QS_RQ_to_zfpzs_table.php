<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQSRQToZfpzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zfpzs', function (Blueprint $table) {
            $table->string('QS_RQ')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zfpzs', function (Blueprint $table) {
            $table->dropColumn('QS_RQ');
        });
    }
}
