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
        Schema::create('game_votes', function (Blueprint $table) {
            $table->id();
            $table->date('voted_at');
            $table->string('created_via');
        });

        Schema::table('game_votes', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->after('id');
            $table->foreign('user_id', 'fk_game_votes_on_user_id')->references('id')->on('users');

            $table->bigInteger('game_id', false, true)->after('user_id');
            $table->foreign('game_id', 'fk_game_votes_on_game_id')->references('id')->on('games');

            // для запроса "голоса по игре за день"
            $table->index(['game_id', 'voted_at'], 'idx_game_votes_on_game_id_and_voted_at');
            // для проверки уникальности голоса пользователя в день
            // для запроса "история голосования пользователя"
            $table->unique(['user_id', 'voted_at'], 'unq_game_votes_on_user_id_and_game_id_and_voted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_votes');
    }
};
