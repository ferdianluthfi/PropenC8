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
            $table->bigInteger('projectValue'); //ToDo digunakan menjadi angka TERBILANG di kontrak
            $table->integer('estimatedTime');
            /**
             * 0 = Belum di approve
             * 1 = Diterima direksi
             * 2 = Menang lelang
             * 3 = Tolak direksi atau kalah lelang
             */
            $table->integer('approvalStatus')->default(0);
            $table->string('projectAddress');
<<<<<<< HEAD
            $table->boolean('isLPJExist')->default(false);
=======
            $table->boolean('isLPJExist')->defaut(false);
>>>>>>> 4cb3a86ab771332caf9d2076c1f202da89d7225d
            

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
