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
        Schema::create('waste_deposits', function (Blueprint $table) {

            $table->id();

            $table->string('invoice_number',30)
                ->unique()
                ->comment('Nomor transaksi');

            // Nasabah
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Admin/Petugas yang memvalidasi
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('deposit_date');

            $table->decimal('total_weight',10,2)
                ->default(0);

            $table->decimal('total_price',12,2)
                ->default(0);

            $table->integer('total_point')
                ->default(0);

            $table->enum('status',[
                'Menunggu',
                'Diterima',
                'Ditolak'
            ])->default('Menunggu');

            $table->text('note')
                ->nullable();

            $table->timestamp('validated_at')
                ->nullable();

            $table->timestamps();

            $table->index('invoice_number');
            $table->index('user_id');
            $table->index('admin_id');
            $table->index('status');
            $table->index('deposit_date');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_deposits');
    }
};