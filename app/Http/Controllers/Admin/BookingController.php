<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

/**
 * Admin Booking Controller (Wave 4 — minor revision).
 *
 * Changes:
 *   - index() now respects ?status=… query param so the dashboard
 *     pipeline links land you on a pre-filtered list.
 *   - Bookings are ordered newest first by default (was: insertion order).
 *   - All() retained for backwards compat with the existing index view,
 *     which does its own client-side filter once the rows are in the DOM.
 *     For DBs with thousands of rows, switch to ->paginate(50) below
 *     and add Bootstrap pagination markup at the bottom of the index view.
 */
class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query()->orderBy('created_at', 'desc');

        $status = $request->query('status');
        if ($status && in_array($status, ['pending', 'inprocess', 'confirmed', 'canceled', 'completed'], true)) {
            $query->where('status', $status);
        }

        $bookings = $query->get();

        return view('admin.booking.index', compact('bookings'));
    }

    public function add()
    {
        return view('admin.booking.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_id'      => 'nullable|string|max:120',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:30',
            'pickup'        => 'required|string|max:255',
            'destination'   => 'nullable|string|max:255',
            'booking_date'  => 'required|date',
            'booking_time'  => 'required',
            'no_of_people'  => 'required|integer|min:1|max:50',
            'message'       => 'nullable|string|max:2000',
            'status'        => 'required|in:pending,inprocess,confirmed,canceled,completed',
            'admin_remarks' => 'nullable|string|max:2000',
        ]);

        $booking = new Booking();
        $booking->offer_id      = $request->offer_id;
        $booking->full_name     = $request->full_name;
        $booking->email         = $request->email;
        $booking->phone         = $request->phone;
        $booking->pickup        = $request->pickup;
        $booking->destination   = $request->destination;
        $booking->booking_date  = $request->booking_date;
        $booking->booking_time  = $request->booking_time;
        $booking->no_of_people  = $request->no_of_people;
        $booking->message       = $request->message;
        $booking->status        = $request->status;
        $booking->admin_remarks = $request->admin_remarks;
        $booking->save();

        return redirect()->route('admin.booking.index')->with('notification', [
            'message' => 'Booking added successfully!',
            'alert'   => 'success',
        ]);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'offer_id'      => 'nullable|string|max:120',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:30',
            'pickup'        => 'required|string|max:255',
            'destination'   => 'nullable|string|max:255',
            'booking_date'  => 'required|date',
            'booking_time'  => 'required',
            'no_of_people'  => 'required|integer|min:1|max:50',
            'message'       => 'nullable|string|max:2000',
            'status'        => 'required|in:pending,inprocess,confirmed,canceled,completed',
            'admin_remarks' => 'nullable|string|max:2000',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->only([
            'offer_id', 'full_name', 'email', 'phone', 'pickup', 'destination',
            'booking_date', 'booking_time', 'no_of_people', 'message',
            'status', 'admin_remarks',
        ]));

        return redirect()->route('admin.booking.index')->with('notification', [
            'message' => 'Booking updated successfully!',
            'alert'   => 'success',
        ]);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();   /* soft-delete (uses SoftDeletes trait on model) */

        return redirect()->route('admin.booking.index')->with('notification', [
            'message' => 'Booking deleted successfully!',
            'alert'   => 'success',
        ]);
    }
}
