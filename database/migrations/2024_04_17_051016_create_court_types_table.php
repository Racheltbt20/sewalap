<?php

use App\Models\CourtType; // class model
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
        Schema::create('court_types', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        // insert data, tak perlu seeder
        CourtType::insert([
            ['nama' => 'Reguler'],
            ['nama' => 'Matras'],
            ['nama' => 'Rumput']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_types');
    }
};
