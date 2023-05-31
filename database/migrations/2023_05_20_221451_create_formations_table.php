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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 8, 2);
            $table->string('duration');
            $table->date('date')->nullable();
            $table->text('image')->nullable();
            $table->string('time')->nullable();
            $table->string('location')->nullable();
            $table->integer('capacity')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
