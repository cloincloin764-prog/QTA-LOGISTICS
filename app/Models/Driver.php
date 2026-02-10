<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Added this import
use Illuminate\Support\Str;
use Carbon\Carbon;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',           // <--- Added
        'phone',           // <--- Added
        'vehicle_number',  // <--- Added
        'api_token',
        'token_expires_at',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
    ];

    /* =======================
       RELATIONSHIPS
    ======================= */

    /**
     * FIX: This connects the Driver to the User table
     * allowing access to name, email, etc.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }

    /* =======================
       TOKEN MANAGEMENT
    ======================= */

    public function generateToken(int $hours = 24): string
    {
        $token = hash('sha256', Str::random(60));

        // forceFill ensures values are saved even if not fillable
        $this->forceFill([
            'api_token'        => $token,
            'token_expires_at' => Carbon::now()->addHours($hours),
        ])->save();

        return $token;
    }

    public function tokenIsValid(string $token): bool
    {
        return
            ! empty($this->api_token) &&
            hash_equals($this->api_token, $token) &&
            $this->token_expires_at !== null &&
            Carbon::now()->lessThan($this->token_expires_at);
    }

    public function revokeToken(): void
    {
        $this->forceFill([
            'api_token'        => null,
            'token_expires_at' => null,
        ])->save();
    }
}