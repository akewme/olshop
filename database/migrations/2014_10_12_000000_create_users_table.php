<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string("avatar")->nullable();
            $table->string("username",100)->unique();
            $table->string('email',150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // 1 Admin
            // 2 Penjual dan Pembeli
            $table->integer("role")->default(2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
