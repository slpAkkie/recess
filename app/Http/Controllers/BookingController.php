<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    private function isWeekend(string $date)
    {
        $carbonDate = Carbon::parse($date)->dayOfWeek;

        return $carbonDate === 5 || $carbonDate === 6;
    }

    private function calculatePrice(int $service_id, string $date, int $duration)
    {
        $servicePrice = Service::find($service_id)->price_per_hour;
        $ratio = $this->isWeekend($date) ? 1.1 : 1;
        return round($servicePrice * $ratio * $duration, 0);
    }

    public function store(StoreBookingRequest $storeBookingRequest)
    {
        (new Booking([
            'service_id' => $storeBookingRequest->get('service_id'),
            'date' => $storeBookingRequest->get('date'),
            'duration' => $storeBookingRequest->get('duration'),
            'total' => $this->calculatePrice($storeBookingRequest->get('service_id'), $storeBookingRequest->get('date'), $storeBookingRequest->get('duration')),
            'user_id' => Auth::id(),
            'status_id' => 1,
        ]))->save();

        return response()->redirectToRoute('profile.index');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status_id < 3) $booking->delete();

        return response()->redirectToRoute('profile.bookings');
    }

    public function edit(Booking $booking)
    {
        return view('Admin.Booking.edit', [
            'booking' => $booking,
        ]);
    }

    public function update(UpdateBookingRequest $updateBookingRequest, Booking $booking)
    {
        $booking->update([
            'date' => $updateBookingRequest->get('date'),
            'duration' => $updateBookingRequest->get('duration'),
            'total' => $this->calculatePrice($booking->service_id, $updateBookingRequest->get('date'), $updateBookingRequest->get('duration')),
        ]);

        return response()->redirectToRoute('admin.bookings.edit', [
            'booking' => $booking,
        ]);
    }

    public function resolve(Booking $booking)
    {
        $booking->status_id = 2;
        $booking->save();

        return response()->redirectToRoute('admin.bookings.index');
    }

    public function reject(Booking $booking)
    {
        $booking->status_id = 4;
        $booking->save();

        return response()->redirectToRoute('admin.bookings.index');
    }

    public function close(Booking $booking)
    {
        $booking->status_id = 3;
        $booking->save();

        return response()->redirectToRoute('admin.bookings.index');
    }
}
