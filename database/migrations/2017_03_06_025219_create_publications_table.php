f<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('message', 240)->nullable();
            $table->string('path_file', 150)->nullable();
            $table->string('type_file', 10);
            $table->integer('count_file');
            $table->integer('group_publication');
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
        Schema::dropIfExists('publications');
    }
}

