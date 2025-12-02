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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pet_id')->constrained()->onDelete('cascade');
        $table->foreignId('veterinarian_id')->constrained('users')->onDelete('cascade');
        $table->dateTime('appointment_date');
        $table->string('reason'); // motivo de la consulta
        $table->text('diagnosis')->nullable();
        $table->text('treatment')->nullable();
        $table->enum('status', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
