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
            $table->foreignId('developer_id')->constrained('users');
            $table->string('title', 255);
            $table->text('deskripsi');
            $table->enum('tipe', ['Bug', 'Feature', 'Support']);
            $table->enum('prioritas', ['Low', 'Medium', 'High', 'Critical']);
            $table->enum('status', ['Pending', 'Working', 'Done', 'Closed', 'Rejected']);
            $table->date('deadline');
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
