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
            $table->string('projectName');
            $table->string('companyName');
            $table->date('startDate');
            $table->date('endDate');
            $table->text('description');
            $table->integer('projectValue'); //ToDo digunakan menjadi angka TERBILANG di kontrak
            $table->string('estimatedTime');
            $table->integer('approvalStatus');
            $table->string('projectAddress');
            $table->boolean('isLPJExist')->defaut(false);
            

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
