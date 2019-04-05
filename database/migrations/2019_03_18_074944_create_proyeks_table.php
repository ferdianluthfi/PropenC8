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
<<<<<<< HEAD
            $table->integer('projectValue'); //ToDo digunakan menjadi angka TERBILANG di kontrak
            $table->integer('estimatedTime');
            $table->integer('approvalStatus')->defaut(0);
=======
            $table->bigInteger('projectValue'); //ToDo digunakan menjadi angka TERBILANG di kontrak
            $table->integer('estimatedTime');
            /**
             * 0 = Belum di approve
             * 1 = Diterima direksi
             * 2 = Menang lelang
             * 3 = Tolak direksi atau kalah lelang
             */
            $table->integer('approvalStatus')->default(0);
>>>>>>> f7cb0484295cde5b6c8ee233a2652382fbb7eaab
            $table->string('projectAddress');
            $table->boolean('isLPJExist')->defaut(false);
            

            $table->bigInteger('pengguna_id')->unsigned();
            $table->foreign('pengguna_id')
            ->references('id')
            ->on('users')
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
