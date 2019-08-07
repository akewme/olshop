<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->unsignedBigInteger("penjual_id");
            $table->foreign('penjual_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            // Opsi Pembayaran -> Tunai / COD / Transfer Bank / GOPAY / Dana / OVO
            $table->string("pembayaran");
            $table->string("bukti_pembayaran")->nullable();
            $table->string("pengiriman");
            $table->integer("ongkir");
            $table->integer("total_harga");
            $table->string("status");
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
        Schema::dropIfExists('transaksis');
    }
}
