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
        Schema::create('waste_prices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained('waste_categories')
                ->cascadeOnDelete();

            $table->decimal('price_per_kg', 12, 2)
                ->comment('Harga beli per kilogram');

            $table->integer('point_per_kg')
                ->comment('Point yang diperoleh per kilogram');

            $table->date('effective_date')
                ->comment('Tanggal mulai berlaku');

            $table->date('expired_date')
                ->nullable()
                ->comment('Tanggal berakhir');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index('category_id');
            $table->index('effective_date');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_prices');
    }
};
