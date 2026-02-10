namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Parcel;
use Illuminate\Http\Request;

class DriverPortalController extends Controller
{
    public function showPortal($token)
    {
        $driver = Driver::where('api_token', $token)->with('user')->firstOrFail();
        
        // Only show parcels assigned to them that aren't finished
        $parcels = Parcel::where('driver_id', $driver->id)
            ->whereNotIn('status', [Parcel::STATUS_DELIVERED, Parcel::STATUS_CANCELLED])
            ->latest()
            ->get();

        return view('driver.portal', compact('driver', 'parcels', 'token'));
    }

    public function updateStatus(Request $request, $token, Parcel $parcel)
    {
        $driver = Driver::where('api_token', $token)->firstOrFail();
        if ($parcel->driver_id !== $driver->id) abort(403);

        $parcel->changeStatus($request->status, $request->comment);
        return back()->with('success', 'Status updated successfully!');
    }
}