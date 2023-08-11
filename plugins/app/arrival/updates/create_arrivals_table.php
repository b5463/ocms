<?php

namespace App\Arrival\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateArrivalsTable extends Migration
{
    public function up()
    {
        Schema::create('app_arrival_arrivals', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Set the database engine
            $table->increments('id'); // Auto-incrementing primary key
            $table->string('name'); // String column for "name"
            $table->timestamp('arrival'); // Timestamp column for "arrival"
            $table->integer('user_id')->nullable(); // Nullable integer column for "user_id"
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_arrival_arrivals'); // Drop the table if it exists
    }
}