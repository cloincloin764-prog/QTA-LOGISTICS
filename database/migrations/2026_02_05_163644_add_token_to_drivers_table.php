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
    Schema::table('drivers', function (Blueprint $table) {
        $table->string('api_token', 80)->unique()->nullable();
        $table->timestamp('token_expires_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('drivers', function (Blueprint $table) {
        $table->dropColumn(['api_token', 'token_expires_at']);
    });
}

};
