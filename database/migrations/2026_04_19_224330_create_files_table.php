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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('filename');
            $table->string('path');
            $table->string('disk')->default('local');
            $table->bigInteger('size', false, true);
            $table->string('mime_type');
            $table->string('extension');
            $table->timestamps();
            $table->binary('dedup_hash', 32)->index('idx_files_on_dedup_hash');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->bigInteger('uploaded_by', false, true)->after('disk');
            $table->foreign('uploaded_by', 'fk_files_on_uploaded_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
