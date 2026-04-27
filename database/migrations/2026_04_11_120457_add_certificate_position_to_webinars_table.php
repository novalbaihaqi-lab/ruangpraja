<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->integer('cert_name_x')->default(421)->after('certificate_template_path');
            $table->integer('cert_name_y')->default(297)->after('cert_name_x');
            $table->integer('cert_name_size')->default(36)->after('cert_name_y');
            $table->string('cert_name_color')->default('000000')->after('cert_name_size');
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn(['cert_name_x', 'cert_name_y', 'cert_name_size', 'cert_name_color']);
        });
    }
};