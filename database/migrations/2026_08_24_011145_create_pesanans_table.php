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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total_harga')->unsigned();
            $table->enum('tipe', ['cod', 'transfer']);
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('kuantitas')->unsigned();
            $table->enum('status', ['Menunggu Pembayaran','Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->foreignId('user_id',)->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id',)->constrained('produks')->onDelete('cascade');
            $table->foreignId('alamat_id',)->constrained('alamats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
