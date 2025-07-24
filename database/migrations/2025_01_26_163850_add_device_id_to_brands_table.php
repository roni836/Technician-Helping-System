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
        // Only add if the column does not already exist
        if (!Schema::hasColumn('brands', 'device_id')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->unsignedBigInteger('device_id')->nullable()->after('name');
                $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('brands', 'device_id')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->dropForeign(['device_id']);
                $table->dropColumn('device_id');
            });
        }
    }
};
