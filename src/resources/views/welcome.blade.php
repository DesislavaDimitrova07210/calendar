<!DOCTYPE html>
<html>
<head>
    <title>Booking App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1>Welcome to the Booking App</h1>
    <div class="mt-4">
        <a href="{{ route('bookings.create') }}" class="btn btn-success me-2">Add New Booking</a>
<a href="{{ route('bookings.list') }}" class="btn btn-primary">View All Bookings</a>
    </div>
</body>
</html>