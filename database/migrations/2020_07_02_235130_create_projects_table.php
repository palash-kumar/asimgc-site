<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('type')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('endYear')->nullable();
            $table->string('endMonth')->nullable();
            $table->string('clientName')->nullable();
            $table->string('mainContractor')->nullable();
            $table->string('consultant')->nullable();
            $table->string('subContractor')->nullable();
            $table->string('com_id', 100)->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('projectStatus')->default(false);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('projects');
    }
}
