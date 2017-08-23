<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projects_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('label');
            $table->enum('depth',[0,1,2,3,4]);
            $table->timestamps();

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('project_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_items');
    }
}
