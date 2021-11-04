<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->float('0_500gm')->after('state');
            $table->float('501_1000gm')->after('0_500gm');
            $table->float('1001_2000gm')->after('501_1000gm');
            $table->float('2001_5000gm')->after('1001_2000gm');
            $table->float('above_5000gm')->after('2001_5000gm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            //
        });
    }
}
