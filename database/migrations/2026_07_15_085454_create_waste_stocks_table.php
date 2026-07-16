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
        Schema::create('waste_stocks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->unique()
                ->constrained('waste_categories')
                ->cascadeOnDelete();

            $table->decimal('current_weight', 12, 2)
                ->default(0)
                ->comment('Total stok saat ini (Kg)');

            $table->timestamp('last_updated_at')
                ->nullable();

            $table->timestamps();

            $table->index('current_weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_stocks');
    }
};