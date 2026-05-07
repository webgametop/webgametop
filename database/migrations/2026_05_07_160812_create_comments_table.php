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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->morphs('target', 'idx_comments_on_target_type_and_target_id');
            $table->text('body');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('parent_id', false, true)->nullable()->after('id');
            $table->foreign('parent_id', 'fk_comments_on_parent_id')->references('id')->on('comments');

            $table->bigInteger('user_id', false, true)->nullable()->after('target_id');
            $table->foreign('user_id', 'fk_comments_on_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
