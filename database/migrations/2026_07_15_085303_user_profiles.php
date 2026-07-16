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
        Schema::create('user_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('member_number')
                ->unique()
                ->comment('Nomor anggota bank sampah');

            $table->string('nik', 20)
                ->nullable()
                ->unique();

            $table->string('phone', 20)
                ->nullable();

            $table->enum('gender', [
                'Laki-laki',
                'Perempuan'
            ])->nullable();

            $table->date('birth_date')
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->string('photo')
                ->nullable();

            $table->enum('status', [
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();

            $table->index('member_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};