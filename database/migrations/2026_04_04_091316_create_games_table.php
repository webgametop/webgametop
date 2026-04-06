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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('identity');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->unique(['provider', 'identity'], 'unq_games_on_provider_and_identity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
