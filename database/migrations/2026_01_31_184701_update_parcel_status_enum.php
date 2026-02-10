<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
public function up()
{
    DB::statement("
        ALTER TABLE parcels 
        MODIFY status ENUM(
            'registered',
            'assigned',
            'in_transit',
            'delivered',
            'cancelled'
        ) NOT NULL DEFAULT 'registered'
    ");
}


public function down()
{
    DB::statement("
        ALTER TABLE parcels 
        MODIFY status ENUM(
            'registered',
            'in_transit',
            'delivered'
        ) NOT NULL DEFAULT 'registered'
    ");
}

};
