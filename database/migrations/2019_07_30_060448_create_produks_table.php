<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->string("nama");
            $table->string("slug");
            $table->string("img");
            $table->integer("harga");
            $table->longText("deskripsi");
            $table->integer("stok");
            $table->integer("berat"); // per KILO
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
        Schema::dropIfExists('produks');
    }
}
