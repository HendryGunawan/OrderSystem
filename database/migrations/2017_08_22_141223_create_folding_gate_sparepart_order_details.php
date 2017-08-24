<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldingGateSparepartOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folding_gate_sparepart_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folding_gate_sparepart_order_id');
            $table->integer('folding_gate_sparepart_id');
            $table->string('price');
            $table->string('qty');
            $table->string('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
