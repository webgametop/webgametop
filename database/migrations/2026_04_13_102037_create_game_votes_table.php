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
            $table->date('vote_dt');
            $table->string('name_ca')->nullable();
        });

        Schema::table('game_votes', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->after('id');
            $table->foreign('user_id', 'fk_game_votes_on_user_id')->references('id')->on('users');

            $table->bigInteger('game_id', false, true)->after('user_id');
            $table->foreign('game_id', 'fk_game_votes_on_game_id')->references('id')->on('games');

            // для запроса "голоса по игре за день"
            $table->index(['game_id', 'vote_dt'], 'idx_game_votes_on_game_id_and_vote_dt');
            // для запроса "история голосования пользователя"
            $table->index(['user_id', 'vote_dt'], 'idx_game_votes_on_user_id_and_vote_dt');

            // для проверки уникальности голоса пользователя в день
            $table->unique(['user_id', 'vote_dt'], 'unq_game_votes_on_user_id_and_game_id_and_vote_dt');
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
