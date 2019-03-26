<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Database ini digunakan sebagai list of berkas kelengkapan lelang
         */
        Schema::create('requirements', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('kelengkapan_id')->unsigned();
            $table->foreign('kelengkapan_id')
            ->references('id')
            ->on('kelengkapan_lelangs')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->binary('requirement');

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
        Schema::dropIfExists('requirements');
    }
}
