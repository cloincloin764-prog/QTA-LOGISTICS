<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parcel_status_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parcel_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('status');
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcel_status_histories');
    }
};
