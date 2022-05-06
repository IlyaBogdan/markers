<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('markers', function (Blueprint $table){
            $table->increments('id');
            $table->string('mobile', 15)->nullable(false)->unique();
            $table->string('description', 255)->nullable(false);
            $table->double('x')->nullable(false);
            $table->double('y')->nullable(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('markers');
    }
};
