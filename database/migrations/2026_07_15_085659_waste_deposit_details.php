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
        Schema::create('waste_deposit_details', function (Blueprint $table) {

            $table->id();

            $table->foreignId('deposit_id')
                ->constrained('waste_deposits')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('waste_categories')
                ->restrictOnDelete();

            // Menyimpan nama kategori saat transaksi
            $table->string('category_name');

            $table->decimal('weight',10,2)
                ->comment('Berat (Kg)');

            // Harga saat transaksi
            $table->decimal('price_per_kg',12,2);

            // Point saat transaksi
            $table->integer('point_per_kg');

            $table->decimal('subtotal_price',12,2);

            $table->integer('subtotal_point');

            $table->timestamps();

            $table->index('deposit_id');
            $table->index('category_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_deposit_details');
    }
};
