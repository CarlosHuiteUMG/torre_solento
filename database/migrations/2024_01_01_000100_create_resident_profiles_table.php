<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resident_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('dpi');
            $table->string('apartment_number');
            $table->string('floor');
            $table->enum('resident_type', ['propietario', 'inquilino']);
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resident_profiles');
    }
};
