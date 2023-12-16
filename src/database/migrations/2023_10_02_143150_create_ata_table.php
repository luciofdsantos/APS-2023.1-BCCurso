<?php

use App\Models\Colegiado;
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
        Schema::create('ata', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('data');
            $table->string('descricao');

            $table->foreignIdFor(Colegiado::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ata');
    }
};
