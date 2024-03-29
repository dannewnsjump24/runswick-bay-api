<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('locations', 'trip_id')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->foreignUlid('trip_id')->after('id');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('locations', 'trip_id')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('trip_id');
        });
    }
};
