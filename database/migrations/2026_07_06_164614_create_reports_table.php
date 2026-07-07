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
    Schema::create('reports', function (Blueprint $table) {

        $table->id();
        $table->foreignId('waste_point_id')
            ->nullable()
            ->constrained('waste_points')
            ->nullOnDelete();
        $table->string('nama');
        $table->string('telepon', 20)->nullable();
        $table->string('rt', 5);
        $table->string('rw', 5);
        $table->text('lokasi');
        $table->decimal('latitude', 10, 8);
        $table->decimal('longitude', 11, 8);
        $table->text('deskripsi');
        $table->string('foto');
        $table->enum('status', [
            'Menunggu',
            'Diproses',
            'Selesai',
            'Ditolak'
        ])->default('Menunggu');
        $table->text('catatan_admin')->nullable();
        $table->foreignId('processed_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();
        $table->timestamp('processed_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};