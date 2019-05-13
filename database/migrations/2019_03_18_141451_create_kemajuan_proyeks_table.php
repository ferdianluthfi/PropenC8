<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateKemajuanProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Schema untuk menyimpan semua kemajuan proyek
         */
        Schema::create('kemajuan_proyeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->date('reportDate');
            /**
             * 1=Gaji
             * 2=Belanja
             * 3=Administrasi
             */
            $table->integer('tipeKemajuan');
            $table->bigInteger('value');
            $table->bigInteger('pekerjaan_id')->unsigned();
            $table->foreign('pekerjaan_id')
            ->references('id')
            ->on('jenis_pekerjaan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->bigInteger('pelaksanaan_id')->unsigned();
            $table->foreign('pelaksanaan_id')
            ->references('id')
            ->on('pelaksanaans')
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
        Schema::dropIfExists('kemajuan_proyeks');
    }
}