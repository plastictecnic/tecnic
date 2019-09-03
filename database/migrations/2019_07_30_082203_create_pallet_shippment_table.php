<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletShippmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pallet_shippment', function (Blueprint $table) {
            $table->bigInteger('pallet_id')->unsigned();
            $table->bigInteger('shippment_id')->unsigned();
            $table->timestamps();

            $table->foreign('pallet_id')->references('id')->on('pallets')->onDelete('cascade');
            $table->foreign('shippment_id')->references('id')->on('shippments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pallet_shippment');
    }
}
