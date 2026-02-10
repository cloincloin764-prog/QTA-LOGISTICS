<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    
     use HasApiTokens, HasFactory, Notifiable;
    /**
     * Role constants (LOCKED)
     */
    public const ROLE_ADMIN    = 'admin';
    public const ROLE_STAFF    = 'staff';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_DRIVER   = 'driver';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * =========================
     * Relationships
     * =========================
     */

    // Customer → many parcels
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }

    // Driver → one driver profile
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    /**
     * =========================
     * Role helpers
     * =========================
     */

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isDriver(): bool
    {
        return $this->role === self::ROLE_DRIVER;
    }
}
