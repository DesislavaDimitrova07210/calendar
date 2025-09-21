@extends('layouts.app')

@section('title', 'Add New Booking')

@section('content')
<div class="container mt-5">
    <h2>Add New Booking</h2>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <div class="mb-3">
            <label for="booking_time" class="form-label">Date & Time</label>
            <input type="datetime-local" name="booking_time" id="booking_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="egn" class="form-label">EGN</label>
            <input type="text" name="egn" id="egn" class="form-control" required maxlength="10">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="notification_method" class="form-label">Notification Method</label>
            <select name="notification_method" id="notification_method" class="form-control" required>
                @foreach(config('constant.notification_methods') as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Booking</button>
    </form>
</div>
@include('bookings.footer')
@endsection