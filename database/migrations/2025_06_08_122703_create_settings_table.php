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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index(); // Setting key (e.g., 'mail_host')
            $table->text('value')->nullable(); // Setting value
            $table->string('group')->default('general')->index(); // Setting group (e.g., 'mail', 'general')
            $table->string('type')->default('string'); // Setting type (string, boolean, integer, json)
            $table->text('description')->nullable(); // Human-readable description
            $table->boolean('is_encrypted')->default(false); // Whether value is encrypted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
