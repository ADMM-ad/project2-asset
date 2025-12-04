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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_asset');
            $table->string('nama_asset');
            $table->string('ketagori')->nullable();
            $table->string('sub_kategori')->nullable();
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tahun')->nullable();            
            $table->string('lokasi')->nullable();
            $table->string('penanggung')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('harga')->nullable();
            $table->unsignedBigInteger('nilai')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->timestamps();
     });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
