<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Models\Booking;

class BookingService
{
    protected $repo;

    public function __construct(BookingRepository $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * Get all bookings.
     */
    public function getBookings($filters = [])
    {
        return $this->repo->all($filters);
    }

    /**
     * Create a new booking.
     */
    public function create(array $data)
    {
        $booking = $this->repo->create($data);

        return $booking;
    }

    /**
     * Find a booking by ID.
     */
    public function find(int $id): ?Booking
    {
        return Booking::find($id);
    }
    /**
     * Get upcoming bookings for the same client.
     */
    public function getUpcoming($id)
    {
        $booking = $this->find($id);

        if (!$booking) {
            return [null, []];
        }
        $upcoming = $this->repo->getUpcoming($booking);
        return [$booking, $upcoming];
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id): bool
    {
        return $this->repo->delete($id);
    }
    
}