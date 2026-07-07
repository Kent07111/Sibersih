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
Schema::create('educations', function (Blueprint $table) {

    $table->id();

    $table->string('judul');

    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->enum('kategori',[
        'Organik',
        'Anorganik',
        'B3',
        'Minyak Jelantah',
        'Eco Enzyme',
        'Kompos',
        'Lainnya'
    ]);

    $table->string('thumbnail')->nullable();

    $table->longText('isi');

    $table->string('video_url')->nullable();

    $table->string('pdf')->nullable();

    $table->enum('status',[
        'Draft',
        'Publish'
    ])->default('Draft');

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
        Schema::dropIfExists('education');
    }
};