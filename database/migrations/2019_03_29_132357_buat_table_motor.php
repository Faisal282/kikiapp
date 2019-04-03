<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableMotor extends Migration
{
    public function up()
    {
        Schema::create('motor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('brand');
            $table->string('tahun');
            $table->string('jenis');
            $table->string('asal');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('motor');
    }
}
