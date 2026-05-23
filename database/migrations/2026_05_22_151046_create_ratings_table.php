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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->morphs('rateable', 'idx_ratings_on_rateable_type_and_rateable_id');
            $table->smallInteger('rate');
            $table->timestamps();
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->nullable()->after('id');
            $table->foreign('user_id', 'fk_ratings_on_user_id')->references('id')->on('users');

            $table->unique(['user_id', 'rateable_type', 'rateable_id'], 'unq_ratings_on_user_id_and_rateable_type_and_rateable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
