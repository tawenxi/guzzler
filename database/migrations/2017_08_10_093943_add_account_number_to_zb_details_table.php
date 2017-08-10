<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountNumberToZbDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zb_details', function (Blueprint $table) {
            $table->string('account_number')->nullable();
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
            $table->dropColumn('account_number');
        });
    }
}
//php artisan make:migration add_account_number_to_zb_details_table --table=zb_details
