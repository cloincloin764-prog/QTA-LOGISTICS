<?php

namespace App\Services;

use App\Models\Parcel;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;

class DriverAssignmentService
{
    public static function assign(Parcel $parcel): bool
    {
        // Prevent double assignment
        if ($parcel->driver_id !== null) {
            return false;
        }

        // Pick first available driver (simple logic)
        $driver = Driver::first();

        if (!$driver) {
            return false; // No driver available
        }

        DB::transaction(function () use ($parcel, $driver) {

            // Assign driver + update status
            $parcel->update([
                'driver_id' => $driver->id,
                'status' => 'assigned',
            ]);

            // Log history
            $parcel->statusHistories()->create([
                'status'  => 'assigned',
                'comment' => 'Driver automatically assigned',
            ]);
        });

        return true;
    }
}
