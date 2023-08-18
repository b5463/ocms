<?php

namespace Teamgrid\TimeEntry\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTimeEntriesTable extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamgrid_timeentry_time_entries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // User and Task IDs for relationships
            $table->integer('user_id');
            $table->integer('task_id');

            // User name and time tracking details
            $table->text('user_name')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            
            // Total time spent and completion status
            $table->string('total_time')->nullable();
            $table->boolean('is_done')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teamgrid_timeentry_time_entries');
    }
}