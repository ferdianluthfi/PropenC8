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
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('fase');
        });
        DB::table('codes')->insert(
            ['description' => 'Menunggu persetujuan direksi','fase' => 'Pralelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Menunggu kelengkapan lelang','fase' => 'Pralelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Menunggu hasil lelang','fase' => 'Lelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Menunggu kontrak kerja','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Menunggu persetujuan kontrak kerja','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Menunggu penugasan PM','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Sedang dikerjakan','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Proyek selesai','fase' => 'Pascalelang']
        );
        DB::table('codes')->insert(
            ['description' => 'Proyek tidak dilanjutkan','fase' => 'Pascalelang']
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
