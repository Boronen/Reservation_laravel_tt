<?php

use App\Models\flight;
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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('airline_id')->constrained('airlines');
            $table->integer('limit');
            $table->timestamps();
        });
            flight::create([
            'date'=>"2002-11-21",
            'airline_id'=>"1",
            'limit'=>111
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
