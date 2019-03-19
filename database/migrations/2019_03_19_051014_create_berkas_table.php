<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   /**
         *  List of Berkas dari kontrak
         */
        Schema::create('listBerkas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('berkas');

            $table->bigInteger('kontrak_id')->unsigned();
            $table->foreign('kontrak_id')
            ->references('id')
            ->on('kontraks')
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
        Schema::dropIfExists('listBerkas');
    }
}
