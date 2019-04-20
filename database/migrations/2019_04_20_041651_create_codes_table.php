<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->integer('id');
            $table->string('description');
            $table->string('fase');
        });
        DB::table('codes')->insert(
            ['id'=>0, 'description' => 'Menunggu persetujuan direksi','fase' => 'Pralelang']
        );
        DB::table('codes')->insert(
            ['id'=>1,'description' => 'Menunggu kelengkapan lelang','fase' => 'Pralelang']
        );
        DB::table('codes')->insert(
            ['id'=>2,'description' => 'Menunggu hasil lelang','fase' => 'Lelang']
        );
        DB::table('codes')->insert(
            ['id'=>3,'description' => 'Menunggu kontrak kerja','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['id'=>4,'description' => 'Menunggu persetujuan kontrak kerja','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['id'=>5,'description' => 'Menunggu penugasan PM','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['id'=>6,'description' => 'Sedang dikerjakan','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['id'=>7,'description' => 'Proyek selesai','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['id'=>8,'description' => 'Proyek tidak dilanjutkan','fase' => 'Pascalelang']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
