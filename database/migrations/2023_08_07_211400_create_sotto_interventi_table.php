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
        Schema::create('sotto_interventos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interventi_id'); // Relazione con la tabella principale degli interventi
            $table->foreign('interventi_id')->references('id')->on('interventis')->onDelete('cascade');
            $table->date('data');
            $table->time('ora_inizio')->nullable();
            $table->time('ora_fine')->nullable();
            $table->text('descrizione')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sotto_interventos');
    }
};
