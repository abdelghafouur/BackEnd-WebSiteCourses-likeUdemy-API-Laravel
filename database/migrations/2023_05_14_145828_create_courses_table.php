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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 8, 2);
            $table->string('duration');
            $table->date('date')->nullable();
            $table->text('image')->nullable();
            $table->string('certificate')->default('yes');
            $table->string('language')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('lessons')->nullable();
            $table->text('linkIntro')->nullable();
            $table->unsignedBigInteger('compte_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('courses');
    }
};
