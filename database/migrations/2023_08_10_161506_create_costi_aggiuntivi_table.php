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
        Schema::create('costi_aggiuntivi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervento_id');
            $table->string('descrizione');
            $table->decimal('importo', 8, 2); // ad esempio 10000.99
            $table->timestamps();

            $table->foreign('intervento_id')
                ->references('id')
                ->on('interventis')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costi_aggiuntivi');
    }
};
