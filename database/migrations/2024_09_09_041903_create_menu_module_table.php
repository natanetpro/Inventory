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
        Schema::create('menu_modul', function (Blueprint $table) {
            $table->id();
            $table->string('key', 15)->nullable();
            $table->string('parent', 15)->nullable();
            $table->string('kode_modul', 15);
            $table->string('kode_key', 15)->nullable();
            $table->string('nama_modul', 100)->nullable();
            $table->string('kode_grup', 100)->nullable();
            $table->string('nama_grup', 100)->nullable();
            $table->string('nama_url', 100)->default('#');
            $table->boolean('level1')->default(0);
            $table->boolean('level2')->default(0);
            $table->boolean('level3')->default(0);
            $table->boolean('level4')->default(0);
            $table->boolean('level5')->default(0);
            $table->boolean('level6')->default(0);
            $table->boolean('level7')->default(0);
            $table->boolean('level8')->default(0);
            $table->boolean('level9')->default(0);
            $table->string('textlevel', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_menu');
    }
};
