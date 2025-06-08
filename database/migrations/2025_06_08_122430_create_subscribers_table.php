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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->index(); // Email address - unique and indexed for performance
            $table->string('name')->nullable(); // Optional subscriber name
            $table->string('token')->unique()->nullable(); // Unique token for unsubscribe/confirmation links
            $table->timestamp('subscribed_at')->nullable(); // When they subscribed (also indicates confirmed status)
            $table->timestamp('unsubscribed_at')->nullable(); // When they unsubscribed (null if still subscribed)
            $table->timestamps(); // created_at and updated_at
            
            // Add index for performance on common queries
            $table->index(['subscribed_at', 'unsubscribed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
