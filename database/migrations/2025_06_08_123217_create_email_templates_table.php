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
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Template name (e.g., "Standard Newsletter", "Welcome Email")
            $table->string('subject'); // Email subject line
            $table->longText('body'); // HTML email content
            $table->text('description')->nullable(); // Optional description for the template
            $table->boolean('is_active')->default(true); // Whether template is active/usable
            $table->timestamps();
            
            // Add index for common queries
            $table->index(['is_active', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
