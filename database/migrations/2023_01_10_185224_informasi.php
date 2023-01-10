<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Informations', function (Blueprint $table) {
            $table->string('website');
            $table->string('tautan');
            $table->string('kategori');
            $table->string('subKategori');
            $table->string('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Informations', function (Blueprint $table) {
            //
        });
    }
};
