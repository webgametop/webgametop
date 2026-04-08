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
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->index('idx_developers_on_provider');
            $table->string('identity');
            $table->binary('dedup_hash', 32)->index('idx_developers_on_dedup_hash');
            $table->string('username',32)->unique('unq_developers_on_username');
            $table->string('nickname', 128);
            $table->timestamps();
        });

        Schema::table('developers', function (Blueprint $table) {
            $table->unique(['provider', 'identity'], 'unq_developers_on_provider_identity');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->bigInteger('developer_id', false, true)->after('id');

            $table->unique(['developer_id', 'identity'], 'unq_games_on_developer_id_and_identity');
            $table->foreign('developer_id', 'fk_games_on_developer_id')->references('id')->on('developers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('fk_games_on_developer_id');
        });

        Schema::dropIfExists('developers');
    }
};
