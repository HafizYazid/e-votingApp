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
        Schema::create('candidate', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kandidat')->primary();
            $table->string('ketua')->nullable(false);
            $table->string('wakil')->nullable(false);
            $table->string('visi')->nullable(false);
            $table->string('misi')->nullable(false);
            $table->unsignedBigInteger('suara')->default(0);
            $table->string('foto')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate');
    }
};
