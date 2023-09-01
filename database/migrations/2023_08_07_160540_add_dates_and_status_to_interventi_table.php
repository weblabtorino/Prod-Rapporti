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
        Schema::table('interventis', function (Blueprint $table) {
            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->enum('stato', ['programmato', 'in_corso', 'completato', 'cancellato'])->default('programmato');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventis', function (Blueprint $table) {
            $table->dropColumn('data_inizio');
            $table->dropColumn('data_fine');
            $table->dropColumn('stato');
        });
    }
};
