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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel clients
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        
        $table->string('title');
        $table->decimal('budget', 15, 2)->default(0);
        $table->date('deadline')->nullable();
        $table->string('status')->default('pending'); // pending, ongoing, completed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
