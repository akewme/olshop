<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("produk_id");
            $table->foreign('produk_id')
                    ->references('id')->on('produks')
                    ->onDelete('cascade');
            $table->string("img");
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
        Schema::dropIfExists('produk_imgs');
    }
}
