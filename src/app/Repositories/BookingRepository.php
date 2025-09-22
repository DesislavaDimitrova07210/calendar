<?php 

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository
{
    /**
     * Get all bookings with filters.
     */
    public function all(array $filters = [])
    {
        $query = Booking::query();

        if (isset($filters['egn'])) {
            $query->where('egn', $filters['egn']);
        }
        if (isset($filters['date_from'])) {
            $query->where('booking_time', '>=', $filters['date_from']);
        }
        if (isset($filters['date_to'])) {
            $query->where('booking_time', '<=', $filters['date_to']);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function getUpcoming(Booking $booking)
    {
        return Booking::where('client_name', $booking->client_name)
            ->where('booking_time', '>', now())
            ->where('id', '!=', $booking->id)
            ->orderBy('booking_time')
            ->get();
    }
    /**
     * Update a booking.
     */
    public function update($id, array $data)
    {
        $booking = $this->find($id);
        $booking->update($data);
        return $booking;
    }
    /**
     * Find a booking by ID.
     */
    public function find($id)
    {
        return Booking::findOrFail($id);
    }    
    /**
     * Delete a booking.
     */
    public function delete($id): bool
    {
        $booking = $this->find($id);

        if (!$booking) {
            return false;
        }

        return (bool) $booking->delete();
    }
}
