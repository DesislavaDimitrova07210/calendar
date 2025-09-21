<?php
namespace App\Http\Controllers\Web;

use App\Services\BookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $bookings = $this->bookingService->getBookings($request->all());
        return view('bookings.list', compact('bookings'));
    }

    public function create()
    {   
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $methods = implode(',', array_keys(config('constant.notification_methods')));
        $validated = $request->validate([
            'booking_time' => 'required|date|after:now',
            'client_name' => 'required|string|max:255',
            'egn' => 'required|digits:10',
            'description' => 'nullable|string',
            'notification_method' => "required|in:$methods",
        ]);
        $booking = $this->bookingService->create($validated);

         return redirect()
        ->route('bookings.create')
        ->with('success', "Successfully booked an appointment! The client will be notified via {$booking->notification_method}.");
    }

    public function show($id)
    {
        [$booking, $upcomingBookings] = $this->bookingService->getUpcoming($id);

        return view('bookings.show', compact('booking', 'upcomingBookings'));
    }

    public function edit($id)
    {
        $booking = $this->bookingService->find($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $methods = implode(',', array_keys(config('constant.notification_methods')));
        $validated = $request->validate([
            'booking_time' => 'required|date|after:now',
            'client_name' => 'required|string|max:255',
            'egn' => 'required|digits:10',
            'description' => 'nullable|string',
            'notification_method' => "required|in:$methods",
        ]);
        $booking = $this->bookingService->update($id, $validated);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking updated!');
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->bookingService->delete($id);

            if ($deleted) {
                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'Booking not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
