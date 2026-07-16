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
        Schema::create('rewards', function (Blueprint $table) {

            $table->id();

            $table->string('code', 20)
                ->unique()
                ->comment('Kode Reward');

            $table->string('name')
                ->comment('Nama Reward');

            $table->enum('type', [
                'Uang',
                'Voucher',
                'Pulsa',
                'Sembako',
                'Barang',
                'Lainnya'
            ]);

            $table->integer('required_point')
                ->comment('Point yang dibutuhkan');

            $table->decimal('nominal', 12, 2)
                ->nullable()
                ->comment('Nominal jika berupa uang/voucher');

            $table->integer('stock')
                ->default(0);

            $table->string('image')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index('code');
            $table->index('type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};