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
        Schema::create('fattures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('intervento_id');
            $table->date('data_fattura');
            $table->decimal('totale', 8, 2);
            $table->string('stato')->default('In attesa di pagamento');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientis');
            $table->foreign('intervento_id')->references('id')->on('interventis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fattures');
    }
};
