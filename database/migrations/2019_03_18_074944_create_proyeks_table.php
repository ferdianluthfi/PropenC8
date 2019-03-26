<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('description');
            $table->integer('projectValue');
            $table->string('estimatedTime');
            $table->integer('approvalStatus')->default(0);
            $table->string('projectAddress');
            $table->boolean('isLPJExist');
            

            $table->bigInteger('pengguna_id')->unsigned();
            $table->foreign('pengguna_id')
            ->references('id')
            ->on('penggunas')
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
        Schema::dropIfExists('proyeks');
    }
}
