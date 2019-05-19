<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontraks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('approvalStatus'); //ToDo bikin kode buat approval status mau apa
            // status  = 1 : menunggu persetujuan
            //         = 2 : Disetujui
            //         = 3 : Ditolak
            $table->string('title', 100);
            $table->string('filename', 100);
            $table->string('path', 100);
            $table->string('ext', 100);
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')
            ->references('id')
            ->on('proyeks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('flag_active');

            /**
             * 
             * Pengguna disini adalah NAMA KLIEN Yang bertanggung jawab atas proyek ini -> penanggung jawab
             *  
             * 
             */
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
        Schema::dropIfExists('kontraks');
    }
}