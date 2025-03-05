<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('id_master_fuel');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('id_master_fuel')
                ->references('uuid')
                ->on('master_fuels')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuels');
    }
};
