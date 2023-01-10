<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Works', function (Blueprint $table) {
            $table->string('namaPerusahaan');
            $table->string('posisiPekerjaan');
            $table->string('kateogriPekerjaan');
            $table->string('lokasiPekerjaan');
            $table->string('deskripsiPekerjaan');
            $table->date('create_at');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Works', function (Blueprint $table) {
            //
        });
    }
};
