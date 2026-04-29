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

/**
 * Public-facing controller for step-now.de.
 *
 * i18n approach:
 *   - All user-visible strings in this file are wrapped with __() so they
 *     resolve against lang/de.json or lang/en.json depending on the
 *     locale set by App\Http\Middleware\SetLocale.
 *   - Translation keys are English (e.g. __('Please enter your name.')).
 *     Laravel's __() with a missing key returns the key unchanged, so
 *     English locale needs no en.json entry — the key IS the English string.
 *   - Validation rule keys (e.g. 'full_name.required') stay in code.
 *     Their MESSAGES are translated.
 *   - Database columns stay English (full_name, booking_date, etc.) —
 *     they're internal identifiers, never shown.
 *   - \Log::error messages stay English — log files are read by the
 *     developer / sysadmin, not customers.
 */
class FrontController extends Controller
{
    /* =====================================================================
     * GET endpoints — render pages
     * =====================================================================*/

    public function index()
    {
        $sliders       = Slider::where('status', 1)->orderBy('serial_no', 'ASC')->get();
        $why_choose_us = WhyChooseUsSection::where('show_on', 'home')->first();
        $about_us      = InfoBlock::first();
        $faq           = FaqSection::first();
        $testimonial   = TestimonialSection::first();
        $services      = Service::where('status', 'publish')->where('isfeature', 'featured')->get();

        return view('front.index', compact(
            'testimonial', 'sliders', 'services', 'why_choose_us', 'about_us', 'faq'
        ));
    }

    public function aboutUs()
    {
        $about_us      = InfoBlock::first();
        $why_choose_us = WhyChooseUsSection::first();
        $testimonial   = TestimonialSection::first();
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
        $service = Service::where('slug', $slug)
            ->where('status', 'publish')
            ->with('serviceCategory')
            ->firstOrFail();

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
        $package = Package::where('id', $id)
            ->where('status', 'active')
            ->where('publish', 'published')
            ->firstOrFail();
        return view('front.pages.rent-now', compact('package'));
    }

    public function gallery()
    {
        return view('front.pages.gallery');
    }

    /* =====================================================================
     * POST endpoints — store contact / booking
     * =====================================================================*/

    public function contactUsStore(Request $request)
    {
        // Honeypot — bots fill 'website', humans don't see it.
        // We respond with a generic success and silently drop the input.
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => __('Your message has been sent successfully!'),
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'phone_no'        => 'required|string|max:20',
            'email'           => 'required|email|max:255',
            'subject'         => 'required|string|max:255',
            'enquiry_message' => 'required|string|max:1000',
        ], [
            'name.required'            => __('Please enter your name.'),
            'phone_no.required'        => __('Please enter your phone number.'),
            'email.required'           => __('Please enter an email address.'),
            'email.email'              => __('Please enter a valid email address.'),
            'subject.required'         => __('Please enter a subject.'),
            'enquiry_message.required' => __('Please enter a message.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $enquiry = new Enquiry();
        $enquiry->name            = $request->name;
        $enquiry->email           = $request->email;
        $enquiry->phone_no        = $request->phone_no;
        $enquiry->subject         = $request->subject;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->save();

        return response()->json([
            'status'  => 'success',
            'message' => __('Your message has been sent successfully! We will get back to you shortly.'),
        ]);
    }

    public function bookingStore(Request $request)
    {
        // Honeypot
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => __('Your booking request has been sent successfully!'),
            ]);
        }

        $validator = Validator::make($request->all(), [
            'offer_id'     => 'nullable|exists:packages,id',
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'pickup'       => 'required|string|max:255',
            'destination'  => 'nullable|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'no_of_people' => 'required|integer|min:1|max:20',
            'message'      => 'nullable|string|max:1000',
        ], [
            'full_name.required'           => __('Please enter your full name.'),
            'email.required'               => __('Please enter an email address.'),
            'email.email'                  => __('Please enter a valid email address.'),
            'phone.required'               => __('Please enter your phone number.'),
            'pickup.required'              => __('Please enter a pickup location.'),
            'booking_date.required'        => __('Please select a date.'),
            'booking_date.after_or_equal'  => __('The booking date must be today or in the future.'),
            'booking_time.required'        => __('Please select a time.'),
            'booking_time.date_format'     => __('Please select a valid time (HH:MM).'),
            'no_of_people.required'        => __('Please enter the number of people.'),
            'no_of_people.min'             => __('Number of people must be at least 1.'),
            'no_of_people.max'             => __('Maximum 20 people per booking.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $booking = new Booking();
            $booking->offer_id     = $request->offer_id;
            $booking->full_name    = $request->full_name;
            $booking->email        = $request->email;
            $booking->phone        = $request->phone;
            $booking->pickup       = $request->pickup;
            $booking->destination  = $request->destination;
            $booking->booking_date = $request->booking_date;
            $booking->booking_time = $request->booking_time;
            $booking->no_of_people = $request->no_of_people;
            $booking->message      = $request->message;
            $booking->status       = 'pending';
            $booking->save();

            return response()->json([
                'status'  => 'success',
                'message' => __('Your booking request has been sent successfully! We will confirm your booking shortly.'),
            ]);
        } catch (\Exception $e) {
            // Logs stay English — they are read by developers, not customers.
            \Log::error('Booking Store Error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => __('Something went wrong. Please try again.'),
            ], 500);
        }
    }
}
