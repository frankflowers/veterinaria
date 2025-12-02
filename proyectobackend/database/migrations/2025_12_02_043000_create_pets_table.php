<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('pets', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('species'); // perro, gato, etc.
        $table->string('breed')->nullable(); // raza
        $table->date('birth_date')->nullable();
        $table->text('medical_history')->nullable();
        $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        $table->boolean('active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
