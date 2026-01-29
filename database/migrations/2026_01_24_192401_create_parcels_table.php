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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //sender info
            $table->string('sender_name');
            $table->string('sender_phone');
            //receiver info
            $table->string('receiver_name');
            $table->string('receiver_phone');
            //parcel detail
            $table->string('tracking_code')->unique();
            $table->string('parcel_type');
            $table->float('weight')->nullable();
            //Route
            $table->string('origin_city');
            $table->string('destination_city');
            //status
            $table->enum('status',['pending','in_transit','delivered'])
                ->default('pending');
                //Driver assignment
                $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
