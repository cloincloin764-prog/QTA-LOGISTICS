<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParcelStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_id',
        'status',
        'comment',
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
