<div class="mt-5 text-center">
    @if (!Request::is('list'))
        <a href="{{ url('/list') }}" class="btn btn-primary me-2">Bookings</a>
    @endif
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Home</a>
</div>