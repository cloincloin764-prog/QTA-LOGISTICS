<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // --- DASHBOARD & UTILS ---

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Placeholder for routes view (if still needed)
    public function routes()
    {
        return view('admin.routes');
    }

    // --- PARCEL MANAGEMENT ---

    /**
     * List all parcels (Paginated)
     */
    public function indexParcels()
    {
        // Fetch all parcels with pagination (15 per page)
        $parcels = Parcel::with(['user', 'driver.user'])->latest()->paginate(15);

        return view('admin.parcels.index', compact('parcels'));
    }

    /**
     * Show Create Parcel Form
     */
    public function createParcel()
    {
        // Fetch users with the role 'customer'
        $customers = User::where('role', 'customer')->get();

        return view('admin.add-parcel', compact('customers'));
    }

    /**
     * Store the parcel
     */
public function storeParcel(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required',
        'sender_name' => 'required',
        'sender_phone' => 'required',
        'origin_city' => 'required',
        'pickup_address' => 'required', // Add this
        'receiver_name' => 'required',
        'receiver_phone' => 'required',
        'destination_city' => 'required',
        'delivery_address' => 'required', // Add this
        'weight' => 'required',
        'parcel_type' => 'required',
    ]);

    Parcel::create($validated);
    return redirect()->route('admin.dashboard')->with('success', 'Parcel registered!');
}

    /**
     * Show Parcel Details (Timeline)
     */
    public function showParcel(Parcel $parcel)
    {
        // Load relationships and sort history by latest first
        $parcel->load(['user', 'driver.user', 'statusHistories' => function($query) {
            $query->latest();
        }]);

        return view('admin.parcels.show', compact('parcel'));
    }

    /**
     * Show Assign Driver Form
     */
    public function showAssignForm(Parcel $parcel)
    {
        $drivers = Driver::with('user')->get();
        return view('admin.parcels.assign', compact('parcel', 'drivers'));
    }

    // --- DRIVER MANAGEMENT ---

    /**
     * List all Drivers
     */
    public function indexDrivers()
    {
        // Fetch drivers with User info and count active parcels
        $drivers = Driver::with('user')->withCount(['parcels' => function($query) {
            $query->whereIn('status', ['assigned', 'out_for_delivery']);
        }])->latest()->paginate(10);

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show Add Driver Form
     */
    public function createDriver()
    {
        // Fetch users with role 'driver' who don't have a driver profile yet
        $users = User::where('role', 'driver')->doesntHave('driver')->get();
        
        return view('admin.drivers.create', compact('users'));
    }


public function storeDriver(Request $request)
    {
        // 1. Validation Logic
        $rules = [
            'vehicle_number' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
        ];

        // Validate based on mode (New vs Existing)
        if (empty($request->user_id)) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:6';
        } else {
            $rules['user_id'] = 'required|exists:users,id|unique:drivers,user_id';
        }

        $request->validate($rules);

        // 2. Define the $user object
        if ($request->user_id) {
            // CASE A: Existing User -> Fetch them from DB
            $user = \App\Models\User::findOrFail($request->user_id);
        } else {
            // CASE B: New User -> Create them
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'driver',
            ]);
        }

        // 3. Create the Driver Profile
        // Now $user is guaranteed to exist, so $user->email will work.
        $driver = \App\Models\Driver::create([
            'user_id' => $user->id,
            'email' => $user->email, // <--- This caused the error before
            'vehicle_number' => $request->vehicle_number,
            'phone' => $request->phone, 
        ]);
        
        // 4. Generate Token
        $token = $driver->generateToken();

        return redirect()->route('admin.drivers.index')
            ->with('success', "Driver created successfully! Access Token: $token");
    }
    public function updateStatus(Request $request, Parcel $parcel)
{
    $request->validate([
        'status' => 'required|string',
        'comment' => 'nullable|string|max:255',
    ]);

    try {
        // Call the FSM (Finite State Machine) logic from your Model
        $parcel->changeStatus($request->status, $request->comment);

        return back()->with('success', 'Shipment status updated to ' . strtoupper($request->status));
    } catch (\DomainException $e) {
        // This catches "Invalid status transition" errors from your model
        return back()->with('error', $e->getMessage());
    }
}
}