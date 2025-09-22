<?php

namespace App\Http\Controllers\Api;

use App\Services\BookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingApiController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of bookings.
     */
    public function index(Request $request)
    {
        return response()->json($this->bookingService->getBookings($request->all()));
    }

    /**
     * Store a newly created booking in storage.
     */
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
        return response()->json($booking, 201);
    }

    /**
     * Display the specified booking along with upcoming bookings for the same client.
     */
    public function show($id)
    {
        [$booking, $upcomingBookings] = $this->bookingService->getUpcoming($id);
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }
        return response()->json(['booking' => $booking, 'upcoming' => $upcomingBookings]);
    }

    /**
     * Update the specified booking.
     */
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

        return response()->json($booking);
    }

    /**
     * Remove a booking from db.
     */
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