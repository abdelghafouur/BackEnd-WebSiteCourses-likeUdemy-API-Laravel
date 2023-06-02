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
        Schema::create('comptes', function (Blueprint $table) {
            // Define the table columns
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();;
            $table->string('tele');
            $table->date('date');
            $table->string('sexe');
            $table->string('adresse')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('image')->nullable();
            $table->string('about')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
