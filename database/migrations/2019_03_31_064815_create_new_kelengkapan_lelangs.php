<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewKelengkapanLelangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelengkapan_lelangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('mime', 255);
            $table->bigInteger('size')->unsigned();
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')
            ->references('id')
            ->on('proyeks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE kelengkapan_lelangs ADD file LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelengkapan_lelangs');
    }
}
