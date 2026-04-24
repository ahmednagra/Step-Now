<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    Booking,
    Enquiry,
    Slider,
    ServiceCategory,
    FaqSection,
    Package,
    WhyChooseUsSection,
    Service,
    InfoBlock,
    PackageCategory,
    TestimonialSection,
};
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{

    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial_no', 'ASC')->get();
        $why_choose_us = WhyChooseUsSection::where('show_on', 'home')->first();
        $about_us = InfoBlock::first();
        $faq = FaqSection::first();
        $testimonial = TestimonialSection::first();
        $services = Service::where('status', 'publish')->where('isfeature', 'featured')->get();
        return view('front.index', compact('testimonial', 'sliders', 'services', 'why_choose_us', 'about_us', 'faq'));
    }

    public function aboutUs()
    {
        $about_us = InfoBlock::first();
        $why_choose_us = WhyChooseUsSection::first();
        $testimonial = TestimonialSection::first();
        return view('front.pages.about-us', compact('about_us', 'testimonial', 'why_choose_us'));
    }

    public function contactUs()
    {
        return view('front.pages.contact-us');
    }

    public function services()
    {
        $serviceCategories = ServiceCategory::where('status', 'publish')->get();
        return view('front.pages.services', compact('serviceCategories'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->where('status', 'publish')->with('serviceCategory')->firstOrFail();
        $relatedServices = Service::where('service_category_id', $service->service_category_id)
                              ->where('id', '!=', $service->id)
                              ->take(6)
                              ->get();

        return view('front.pages.service_detail', compact('service', 'relatedServices'));
    }

    public function pricing()
    {
        $package_categories = PackageCategory::where('status', 'active')
            ->with(['packages' => function ($query) {
                $query->where('status', 'active')
                    ->where('publish', 'published')
                    ->orderBy('order_no', 'ASC');
            }, 'packages.details' => function ($query) {
                $query->orderBy('order_no', 'ASC');
            }])
            ->orderBy('order_no', 'ASC')
            ->get();

        return view('front.pages.pricing', compact('package_categories'));
    }

    public function rentNow($id)
    {
        $package = Package::find($id)->where('status', 'active')->where('publish', 'published')->firstOrFail();
        return view('front.pages.rent-now', compact('package'));
    }

    public function contactUsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'enquiry_message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $enquiry = new Enquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone_no = $request->phone_no;
        $enquiry->subject = $request->subject;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->save();

        return  response()->json([
            'status' => 'success',
            'message' => 'Enquiry Submitted Successfully!',
        ]);
    }

    public function bookingStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'nullable|exists:packages,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'pickup' => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'no_of_people' => 'required|integer|min:1',
            'message' => 'nullable|string|max:1000',
        ], [
            'booking_date.after_or_equal' => 'Booking date must be today or a future date.',
            'booking_time.date_format' => 'Please select a valid time format.',
            'no_of_people.min' => 'Number of people must be at least 1.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $booking = new Booking();
            $booking->offer_id = $request->offer_id;
            $booking->full_name = $request->full_name;
            $booking->email = $request->email;
            $booking->phone = $request->phone;
            $booking->pickup = $request->pickup;
            $booking->destination = $request->destination;
            $booking->booking_date = $request->booking_date;
            $booking->booking_time = $request->booking_time;
            $booking->no_of_people = $request->no_of_people;
            $booking->message = $request->message;
            $booking->status = 'pending';
            $booking->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Booking Submitted Successfully! We will contact you soon.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Booking Store Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }
}
