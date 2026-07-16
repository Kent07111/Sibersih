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
        Schema::create('point_histories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('wallet_id')
                ->constrained('user_wallets')
                ->cascadeOnDelete();

            $table->foreignId('deposit_id')
                ->nullable()
                ->constrained('waste_deposits')
                ->nullOnDelete();

            $table->foreignId('redemption_id')
                ->nullable()
                ->constrained('reward_redemptions')
                ->nullOnDelete();

            $table->enum('type', [
                'Masuk',
                'Keluar',
                'Penyesuaian'
            ]);

            $table->integer('point');

            $table->integer('balance_before');

            $table->integer('balance_after');

            $table->string('description')->nullable();

            $table->timestamps();

            $table->index('wallet_id');
            $table->index('deposit_id');
            $table->index('redemption_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_histories');
    }
};
