<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateKelengkapanLelangsTable extends Migration
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
            $table->integer('flag_active')->default(1);
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
        Schema::dropIfExists('kelengkapan_lelangs');
    }
}