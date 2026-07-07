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
Schema::create('waste_points', function (Blueprint $table) {

    $table->id();

    $table->string('kode')->unique();

    $table->string('nama');

    $table->enum('jenis',[
        'Organik',
        'Anorganik',
        'B3',
        'TPS',
        'Lainnya'
    ]);

    $table->text('alamat');

    $table->decimal('latitude',10,8);

    $table->decimal('longitude',11,8);

    $table->text('deskripsi')->nullable();

    $table->string('foto')->nullable();

    $table->enum('status',[
        'Aktif',
        'Tidak Aktif'
    ])->default('Aktif');

    $table->foreignId('created_by')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_points');
    }
};
