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
        Schema::create('reward_redemptions', function (Blueprint $table) {

            $table->id();

            $table->string('redemption_number',30)
                ->unique()
                ->comment('Nomor penukaran');

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('reward_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->integer('used_point');

            $table->enum('status',[
                'Menunggu',
                'Disetujui',
                'Ditolak',
                'Selesai'
            ])->default('Menunggu');

            $table->timestamp('redeemed_at')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();

            $table->text('note')
                ->nullable();

            $table->timestamps();

            $table->index('redemption_number');
            $table->index('user_id');
            $table->index('reward_id');
            $table->index('admin_id');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_redemptions');
    }
};