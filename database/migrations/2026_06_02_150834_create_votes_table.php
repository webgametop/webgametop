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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->morphs('votable', 'idx_votes_on_votable_type_and_votable_id');
            $table->string('type')->index('idx_votes_on_type');
            $table->string('created_via');
            $table->timestamps();
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->nullable()->after('id');
            $table->foreign('user_id', 'fk_votes_on_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
