<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client_bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('client_bookings','persons')) {
                $table->unsignedTinyInteger('persons')->default(1);
            }
            if (!Schema::hasColumn('client_bookings','table_type')) {
                $table->string('table_type',20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('client_bookings', function (Blueprint $table) {
            $table->dropColumn(['persons','table_type']);
        });
    }
};
