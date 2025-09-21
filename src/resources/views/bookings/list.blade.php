<div class="container mt-5">
    <h2>All Bookings</h2>
    <form method="GET" action="{{ route('bookings.list') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="date_from" class="form-label">Date From</label>
            <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="date_to" class="form-label">Date To</label>
            <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="egn" class="form-label">EGN</label>
            <input type="text" name="egn" id="egn" class="form-control" value="{{ request('egn') }}">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Client Name</th>
                <th>EGN</th>
                <th>Description</th>
                <th>Notification Method</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->booking_time }}</td>
                <td>{{ $booking->client_name }}</td>
                <td>{{ $booking->egn }}</td>
                <td>{{ $booking->description }}</td>
                <td>{{ $booking->notification_method }}</td>
                <td>
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteBooking({{ $booking->id }}, this)">Delete</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script>
function deleteBooking(id, btn) {
    if (!confirm('Sure?')) return;
    fetch('/delete/' + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
       btn.closest('tr').remove();
    });
}
</script>