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
        Schema::table('clientis', function (Blueprint $table) {
            $table->decimal('prezzo_orario', 8, 2)->default(0.00); // prezzo orario con due cifre decimali
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientis', function (Blueprint $table) {
            $table->dropColumn('prezzo_orario');
        });
    }
};
