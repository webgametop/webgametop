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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->morphs('favoriteable', 'idx_favorites_on_favoriteable_type_and_favoriteable_id');
            $table->timestamps();
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->nullable()->after('id');
            $table->foreign('user_id', 'fk_favorites_on_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
