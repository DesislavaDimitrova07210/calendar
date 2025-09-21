@extends('layouts.app')

@section('title', 'Add New Booking')

@section('content')
<div class="container mt-5">
    <h2>Booking Details</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Date & Time:</strong> {{ $booking->booking_time }}</p>
            <p><strong>Client Name:</strong> {{ $booking->client_name }}</p>
            <p><strong>EGN:</strong> {{ $booking->egn }}</p>
            <p><strong>Description:</strong> {{ $booking->description }}</p>
            <p><strong>Notification Method:</strong> {{ $booking->notification_method }}</p>
        </div>
    </div>

    <h4>Upcoming Bookings for {{ $booking->client_name }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Description</th>
                <th>Notification Method</th>
            </tr>
        </thead>
        <tbody>
            @forelse($upcomingBookings as $upcoming)
            <tr>
                <td>{{ $upcoming->booking_time }}</td>
                <td>{{ $upcoming->description }}</td>
                <td>{{ $upcoming->notification_method }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No upcoming bookings for this client.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@include('bookings.footer')
@endsection