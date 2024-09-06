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
        Schema::create('module_menus', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('kode_modul');
            $table->string('kode_key');
            $table->string('nama_modul');
            $table->string('kode_grup');
            $table->string('nama_grup');
            $table->string('url');
            $table->boolean('level1')->default(false);
            $table->boolean('level2')->default(false);
            $table->boolean('level3')->default(false);
            $table->boolean('level4')->default(false);
            $table->boolean('level5')->default(false);
            $table->boolean('level6')->default(false);
            $table->boolean('level7')->default(false);
            $table->boolean('level8')->default(false);
            $table->boolean('level9')->default(false);
            $table->string('textlevel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_menus');
    }
};
