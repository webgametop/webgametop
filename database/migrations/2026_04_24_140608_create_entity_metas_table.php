<?php

declare(strict_types=1);

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
        Schema::create('entity_meta', function (Blueprint $table) {
            $table->id();
            $table->morphs('entity', 'idx_meta_on_entity_type_and_entity_id');
            $table->string('key');
            $table->longText('value');
            $table->timestamps();
        });

        Schema::table('entity_meta', function (Blueprint $table) {
            $table->index('key', 'idx_meta_on_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_meta');
    }
};
