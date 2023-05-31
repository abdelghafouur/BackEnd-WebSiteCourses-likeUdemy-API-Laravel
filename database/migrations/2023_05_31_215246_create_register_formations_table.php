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
        Schema::create('register_formations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formation_id')->nullable();
            $table->unsignedBigInteger('compte_id')->nullable();
            $table->text('certificate')->nullable();
            $table->date('date');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('formation_id')
                ->references('id')
                ->on('formations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('compte_id')
                ->references('id')
                ->on('comptes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_formations');
    }
};
