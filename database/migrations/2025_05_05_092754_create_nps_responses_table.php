<?php

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
        Schema::create('nps_responses', function (Blueprint $table) {
    $table->id();
    $table->foreignId('site_id')->constrained()->onDelete('cascade');
    $table->tinyInteger('score'); // 0–10
    $table->text('feedback')->nullable();
    $table->ipAddress('ip_address')->nullable();
    $table->string('fingerprint')->nullable(); // bijv. browser/device hash
    $table->string('tag')->nullable();
    $table->timestamp('submitted_at');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nps_responses');
    }
};
