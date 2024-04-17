<?php

use App\Models\Court; // class models
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_type_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->integer('harga');
            $table->timestamps();
        });

        // insert data ke database
        Court::insert([
            ['court_type_id' => 1, 'nama' => 'Indoor', 'harga' => 300000],
            ['court_type_id' => 2, 'nama' => 'Indoor', 'harga' => 250000],
            ['court_type_id' => 3, 'nama' => 'Indoor', 'harga' => 200000],
            ['court_type_id' => 1, 'nama' => 'Outdoor', 'harga' => 250000],
            ['court_type_id' => 2, 'nama' => 'Outdoor', 'harga' => 200000],
            ['court_type_id' => 3, 'nama' => 'Outdoor', 'harga' => 150000],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
