<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverAndStatusToParcelsTable extends Migration
{
    public function up(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            if (!Schema::hasColumn('parcels', 'driver_id')) {
                $table->foreignId('driver_id')
                      ->nullable()
                      ->constrained()
                      ->nullOnDelete();
            }

            if (!Schema::hasColumn('parcels', 'status')) {
                $table->enum('status', [
                    'pending',
                    'assigned',
                    'in_transit',
                    'delivered'
                ])->default('pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            if (Schema::hasColumn('parcels', 'driver_id')) {
                $table->dropForeign(['driver_id']);
                $table->dropColumn('driver_id');
            }

            if (Schema::hasColumn('parcels', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
