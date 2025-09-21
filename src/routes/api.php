<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingApiController;

Route::get('/bookings', [BookingApiController::class, 'index']); // All bookings - curl http://127.0.0.1:8081/api/bookings
Route::get('/bookings/{id}', [BookingApiController::class, 'show']); // Booking details - curl http://127.0.0.1:8081/api/bookings/{id}
Route::delete('/bookings/{id}', [BookingApiController::class, 'destroy']); // Delete booking - curl -X DELETE http://127.0.0.1:8081/api/bookings/{id}

/* Edit booking - example curl command to test the update API endpoint:
   curl -X PUT http://127.0.0.1:8081/api/bookings/edit/29
   -H "Content-Type: application/json"
   -d '{"booking_time":"2025-10-16 14:00:00","client_name":"tst update","egn":"1234567890","description":"CURL UPDATE test ID 29","notification_method":"SMS"}'
*/
Route::put('/bookings/edit/{id}', [BookingApiController::class, 'update']);

/* Add new record in db - example curl command to test the create API endpoint:
    curl -X POST http://127.0.0.1:8081/api/bookings/create \
    -H "Content-Type: application/json" \
    -d '{"booking_time":"2025-10-13 17:35:00","client_name":"John Doe","egn":"1234567890","description":"Test booking","notification_method":"SMS"}'
*/
  Route::post('/bookings/create', [BookingApiController::class, 'store']);

