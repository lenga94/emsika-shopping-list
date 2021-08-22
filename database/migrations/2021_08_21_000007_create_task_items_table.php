<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('task_items')) {
            Schema::create('task_items', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('task_id')->unsigned();
                $table->string('name');
                $table->string('description')->nullable();
                $table->enum('status', ['PENDING', 'DONE'])->default('PENDING');
                $table->timestamps();

                //foreign key constraints
                $table->foreign('task_id')->references('id')->on('tasks')
                    ->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_items');
    }
}
