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
            $table->text('description');
            $table->bigInteger('projectValue'); //ToDo digunakan menjadi angka TERBILANG di kontrak
            $table->integer('estimatedTime');
            
            $table->bigInteger('approvalStatus')->unsigned();
            $table->foreign('approvalStatus')
            ->references('id')
            ->on('codes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('projectAddress');
            $table->boolean('isLPJExist')->default(false);
            

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
