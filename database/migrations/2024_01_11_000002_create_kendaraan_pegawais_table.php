<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kendaraan_pegawais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_jenis_kendaraan');
            $table->string('nama_pemilik');
            $table->string('plat_nomor')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('id_jenis_kendaraan')
                  ->references('id')
                  ->on('jenis_kendaraans')
                  ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraan_pegawais');
    }
};
