<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.booking.index', compact('bookings'));
    }

    public function add()
    {
        return view('admin.booking.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_id'      => 'required',
            'full_name'    => 'required',
            'email'        => 'required',
            'phone'        => 'required',
            'pickup'       => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'no_of_people'   => 'required',
            'message'      => 'nullable',
            'status'       => 'required',
            'admin_remarks' => 'nullable',
            'destination' => 'nullable',
        ]);

        $booking = new Booking();
        $booking->offer_id = $request->offer_id;
        $booking->full_name = $request->full_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->pickup = $request->pickup;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->no_of_people = $request->no_of_people;
        $booking->message = $request->message;
        $booking->status = $request->status;
        $booking->destination = $request->destination;
        $booking->admin_remarks = $request->admin_remarks;


        $booking->save();

        $notification = array(
            'message' => 'Booking Added Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.booking.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking.edit', compact('booking')); // ✅ use without quotes
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'offer_id'      => 'required',
            'full_name'    => 'required',
            'email'        => 'required',
            'phone'        => 'required',
            'pickup'       => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'no_of_people'   => 'required',
            'message'      => 'nullable',
            'status'       => 'required',
            'admin_remarks' => 'nullable',
            'destination' => 'nullable',

        ]);

        $booking = Booking::find($id);
        $booking->offer_id = $request->offer_id;
        $booking->full_name = $request->full_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->pickup = $request->pickup;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->no_of_people = $request->no_of_people;
        $booking->message = $request->message;
        $booking->status = $request->status;
        $booking->destination = $request->destination;
        $booking->admin_remarks = $request->admin_remarks;
        $booking->save();

        $notification = array(
            'message' => 'Booking Updated Successfully!',
            'alert' => 'success',
        );


        return redirect()->route('admin.booking.index')->with('notification', $notification);
    }

    public function delete($id)
    {
        $booking = Booking::find($id);

        $booking->delete();

        $notification = array(
            'message' => 'Booking Deleted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
}
