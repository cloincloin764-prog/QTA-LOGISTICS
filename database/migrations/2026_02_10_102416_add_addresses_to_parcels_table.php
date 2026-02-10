<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('parcels', function (Blueprint $table) {
        $table->text('pickup_address')->after('origin_city')->nullable();
        $table->text('delivery_address')->after('destination_city')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            //
        });
    }
};
