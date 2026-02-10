<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class AdminParcelController extends Controller
{
    /**
     * List all parcels (optional status filter)
     */
    public function index(Request $request)
    {
        $query = Parcel::with(['user', 'driver']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json(
            $query->latest()->paginate(15)
        );
    }

    /**
     * Show full parcel details
     */
    public function show(Parcel $parcel)
    {
        return response()->json(
            $parcel->load([
                'user',
                'driver',
                'statusHistories' => fn ($q) => $q->latest(),
            ])
        );
    }
}
