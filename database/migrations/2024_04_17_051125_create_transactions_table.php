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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('court_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->date('tanggal');
            $table->time('starttime');
            $table->time('endtime');
            $table->integer('durasi');
            $table->integer('kostum');
            $table->integer('sepatu');
            $table->integer('total');
            $table->integer('paytotal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
