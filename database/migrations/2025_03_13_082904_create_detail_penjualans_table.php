<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjualans');
            $table->unsignedBigInteger('id_produks');
            $table->decimal('harga_jual');
            $table->integer('qty');
            $table->decimal('sub_total');
            $table->timestamps();

            $table->foreign('id_penjualans')->references('id')->on('penjualans')->onDelete('cascade');
            $table->foreign('id_produks')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
