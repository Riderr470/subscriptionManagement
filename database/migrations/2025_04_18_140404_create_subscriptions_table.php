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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->integer('plan_id');
            $table->string('stripe_id')->unique(); // Unique identifier from mock "Stripe"
            $table->enum('stripe_status', ['active', 'canceled', 'incomplete'])->default('active');
            $table->string('stripe_price'); // Price ID from mock "Stripe"
            $table->integer('quantity')->default(1);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable(); // For cancellation date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
