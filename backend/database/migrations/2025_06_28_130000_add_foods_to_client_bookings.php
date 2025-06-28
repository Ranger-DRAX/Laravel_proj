<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client_bookings', function (Blueprint $table) {
            $table->text('foods')->nullable(); // JSON encoded food list
        });
    }

    public function down(): void
    {
        Schema::table('client_bookings', function (Blueprint $table) {
            $table->dropColumn('foods');
        });
    }
};
