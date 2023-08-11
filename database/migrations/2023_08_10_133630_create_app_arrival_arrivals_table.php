<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppArrivalArrivalsTable extends Migration
{
    public function up()
    {
        Schema::create('app_arrival_arrivals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('arrival');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_arrival_arrivals');
    }
}
