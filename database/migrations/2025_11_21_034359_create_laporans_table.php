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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('developer_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('title', 255);
            $table->text('deskripsi');
            $table->enum('tipe', ['Bug', 'Feature', 'Support']);
            $table->enum('prioritas', ['Low', 'Medium', 'High', 'Critical'])->nullable();
            $table->enum('status', ['Pending', 'Working', 'Done', 'Rejected'])->default('Pending');
            $table->date('deadline')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
