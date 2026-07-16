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
        Schema::create('user_wallets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('point')
                ->default(0)
                ->comment('Total point yang dimiliki');

            $table->decimal('balance', 15, 2)
                ->default(0)
                ->comment('Saldo uang hasil penukaran');

            $table->timestamp('last_transaction_at')
                ->nullable();

            $table->timestamps();

            $table->index('point');
            $table->index('balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallets');
    }
};
