<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driver_id',
        'sender_name',
        'sender_phone',
        'receiver_name',
        'receiver_phone',
        'origin_city',
        'destination_city',
        'weight',
        'parcel_type',
        'status',
        'tracking_code',
    ];

    /* =======================
       RELATIONSHIPS
    ======================= */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(ParcelStatusHistory::class);
    }

    /* =======================
       STATUS CONSTANTS
    ======================= */

    const STATUS_REGISTERED       = 'registered';
    const STATUS_ASSIGNED         = 'assigned';
    const STATUS_OUT_FOR_DELIVERY = 'out_for_delivery';
    const STATUS_DELIVERED        = 'delivered';
    const STATUS_CANCELLED        = 'cancelled';

    /* =======================
       FSM: ALLOWED TRANSITIONS
    ======================= */

    protected static array $allowedTransitions = [
        self::STATUS_REGISTERED => [
            self::STATUS_ASSIGNED,
            self::STATUS_CANCELLED,
        ],
        self::STATUS_ASSIGNED => [
            self::STATUS_OUT_FOR_DELIVERY,
            self::STATUS_CANCELLED,
        ],
        self::STATUS_OUT_FOR_DELIVERY => [
            self::STATUS_DELIVERED,
        ],
        self::STATUS_DELIVERED => [],
        self::STATUS_CANCELLED => [],
    ];

    protected function canChangeStatus(string $newStatus): bool
    {
        return in_array(
            $newStatus,
            self::$allowedTransitions[$this->status] ?? [],
            true
        );
    }

    /* =======================
       MODEL BOOT
    ======================= */

    protected static function booted(): void
    {
        static::creating(function (Parcel $parcel) {
            if (empty($parcel->tracking_code)) {
                $parcel->tracking_code = self::generateTrackingCode();
            }

            if (empty($parcel->status)) {
                $parcel->status = self::STATUS_REGISTERED;
            }
        });
    }

    public static function generateTrackingCode(): string
    {
        return 'TRK-' . strtoupper(Str::random(10));
    }

    /* =======================
       BUSINESS ACTIONS
    ======================= */

    /**
     * Assign driver (ADMIN ONLY)
     */
    public function assignDriver(Driver $driver, ?string $comment = null): void
    {
        if ($this->status !== self::STATUS_REGISTERED) {
            throw new \DomainException(
                'Driver can only be assigned to a registered parcel.'
            );
        }

        $this->update([
            'driver_id' => $driver->id,
            'status'    => self::STATUS_ASSIGNED,
        ]);

        $this->statusHistories()->create([
            'status'  => self::STATUS_ASSIGNED,
            'comment' => $comment ?? 'Driver assigned',
        ]);
    }

    /**
     * Change parcel status (DRIVER / SYSTEM)
     */
    public function changeStatus(string $newStatus, ?string $comment = null): void
    {
        if (! $this->canChangeStatus($newStatus)) {
            throw new \DomainException(
                "Invalid status transition: {$this->status} → {$newStatus}"
            );
        }

        // Enforce driver presence before delivery starts
        if (
            $newStatus === self::STATUS_OUT_FOR_DELIVERY &&
            $this->driver_id === null
        ) {
            throw new \DomainException(
                'Cannot start delivery without an assigned driver.'
            );
        }

        // Final states protection
        if (in_array($this->status, [
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ], true)) {
            throw new \DomainException(
                'Final parcel state cannot be changed.'
            );
        }

        $this->update([
            'status' => $newStatus,
        ]);

        $this->statusHistories()->create([
            'status'  => $newStatus,
            'comment' => $comment,
        ]);
         $this->update(['status' => $newStatus]);

    // TRIGGER NOTIFICATION
    $message = "Your parcel #{$this->tracking_code} is now " . strtoupper($newStatus);
    
    // Notify the Customer (Sender)
    if ($this->user) {
        $this->user->notify(new ParcelStatusUpdated($this, $message));
    }
    
    // Record in history (Already done in your model)
    }
}
