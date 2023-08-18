<?php

namespace Teamgrid\Project\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('teamgrid_project_projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Project details
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('project_manager_id')->nullable();
            $table->text('customer_name')->nullable();
            $table->text('project_manager_name')->nullable();
            $table->dateTime('due_date')->nullable();

            // Accounting and budget
            $table->enum('accounting', ['disabled', 'service_hourly_rate', 'person_hourly_rate', 'hourly_rate'])->nullable();
            $table->integer('hourly_rate_price')->nullable();
            $table->enum('budget', ['disabled', 'total_hours', 'total_fees', 'hours_per_month', 'fees_per_month'])->nullable();

            // Project status
            $table->boolean('is_done')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teamgrid_project_projects');
    }
}