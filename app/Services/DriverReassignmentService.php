<?php

namespace App\Services;

use App\Models\Parcel;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;

class DriverReassignmentService
{
    public static function reassign(
        Parcel $parcel,
        Driver $newDriver,
        ?string $reason = null
    ): bool {
        // If same driver, do nothing
        if ($parcel->driver_id === $newDriver->id) {
            return false;
        }

        DB::transaction(function () use ($parcel, $newDriver, $reason) {

            $oldDriverId = $parcel->driver_id;

            // Update parcel
            $parcel->update([
                'driver_id' => $newDriver->id,
                'status' => 'assigned',
            ]);

            // Log history
            $parcel->statusHistories()->create([
                'status' => 'assigned',
                'comment' => $reason
                    ? "Driver reassigned: {$reason}"
                    : "Driver reassigned from ID {$oldDriverId} to {$newDriver->id}",
            ]);
        });

        return true;
    }
}
