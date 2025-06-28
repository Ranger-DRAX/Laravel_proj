<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('client_bookings', 'table_type')) {
            Schema::table('client_bookings', function (Blueprint $table) {
                $table->string('table_type')->default('duo');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('client_bookings', 'table_type')) {
            Schema::table('client_bookings', function (Blueprint $table) {
                $table->dropColumn('table_type');
            });
        }
    }
};
