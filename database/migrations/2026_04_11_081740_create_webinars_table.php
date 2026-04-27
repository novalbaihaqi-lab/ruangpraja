<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('speaker');
            $table->dateTime('scheduled_at');
            $table->integer('quota')->nullable();
            $table->enum('status', ['upcoming', 'live', 'done'])->default('upcoming');
            $table->text('zoom_link')->nullable();
            $table->text('documentation_url')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('certificate_template_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};