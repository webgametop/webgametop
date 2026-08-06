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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->morphs('reportable', 'idx_reports_on_reportable_type_and_reportable_id');
            $table->string('reason');
            $table->text('message');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->nullable()->after('id');
            $table->foreign('user_id', 'fk_reports_on_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
