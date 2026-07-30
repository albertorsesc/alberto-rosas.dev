<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            // pending (awaiting double-opt-in) | confirmed | unsubscribed
            $table->string('status')->default('pending');
            $table->string('token', 64)->unique();
            // where they signed up: 'assessment', 'footer', 'post:<slug>', etc.
            $table->string('source')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            // when the confirmed contact was pushed to the Resend audience
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
