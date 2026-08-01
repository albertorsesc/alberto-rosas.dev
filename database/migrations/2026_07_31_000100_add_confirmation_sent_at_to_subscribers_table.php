<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            // When the last confirmation email went out. Gates resends per address
            // so a repeated (forged) submit can't bomb a victim's inbox; the per-IP
            // throttle alone doesn't stop a proxy pool.
            $table->timestamp('confirmation_sent_at')->nullable()->after('token');
        });
    }

    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('confirmation_sent_at');
        });
    }
};
