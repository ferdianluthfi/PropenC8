<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listPhoto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path', 100);
            $table->string('ext', 100);

            $table->bigInteger('kemajuan_id')->unsigned();
            $table->foreign('kemajuan_id')
            ->references('id')
            ->on('kemajuan_proyeks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('listPhoto');
    }
}
