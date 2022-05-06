<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('users', function (Blueprint $table){
            $table->increments('id');
            $table->string('login', 255)->nullable(false)->unique();
            $table->string('password', 100)->nullable(false);
            $table->string('remember_token', 100)->nullable(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};
