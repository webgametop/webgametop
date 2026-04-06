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
            $table->string('identity');
            $table->string('username',32)->unique('unq_developers_on_username');
            $table->string('nickname', 128);
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->bigInteger('developer_id')->unsigned()->nullable()->after('id');

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
            $table->dropColumn('developer_id');
        });

        Schema::dropIfExists('developers');
    }
};
