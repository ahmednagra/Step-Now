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
        $package = Package::where('id', $id)->where('status', 'active')->where('publish', 'published')->firstOrFail();
        return view('front.pages.rent-now', compact('package'));
    }

    public function contactUsStore(Request $request)
    {
        // Honeypot — bots fill this, humans don't see it.
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Ihre Nachricht wurde erfolgreich übermittelt!',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'phone_no'        => 'required|string|max:20',
            'email'           => 'required|email|max:255',
            'subject'         => 'required|string|max:255',
            'enquiry_message' => 'required|string|max:1000',
        ], [
            'name.required'            => 'Bitte geben Sie Ihren Namen an.',
            'phone_no.required'        => 'Bitte geben Sie Ihre Telefonnummer an.',
            'email.required'           => 'Bitte geben Sie eine E-Mail-Adresse an.',
            'email.email'              => 'Bitte geben Sie eine gültige E-Mail-Adresse an.',
            'subject.required'         => 'Bitte geben Sie einen Betreff an.',
            'enquiry_message.required' => 'Bitte geben Sie eine Nachricht ein.',
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
            'message' => 'Ihre Nachricht wurde erfolgreich übermittelt! Wir melden uns zeitnah bei Ihnen.',
        ]);
    }

    public function bookingStore(Request $request)
    {
        // Honeypot
        if (filled($request->input('website'))) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Ihre Buchungsanfrage wurde erfolgreich übermittelt!',
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
            'full_name.required'           => 'Bitte geben Sie Ihren vollständigen Namen an.',
            'email.required'               => 'Bitte geben Sie eine E-Mail-Adresse an.',
            'email.email'                  => 'Bitte geben Sie eine gültige E-Mail-Adresse an.',
            'phone.required'               => 'Bitte geben Sie Ihre Telefonnummer an.',
            'pickup.required'              => 'Bitte geben Sie einen Abholort an.',
            'booking_date.required'        => 'Bitte wählen Sie ein Datum.',
            'booking_date.after_or_equal'  => 'Das Buchungsdatum muss heute oder in der Zukunft liegen.',
            'booking_time.required'        => 'Bitte wählen Sie eine Uhrzeit.',
            'booking_time.date_format'     => 'Bitte wählen Sie eine gültige Uhrzeit (Format HH:MM).',
            'no_of_people.required'        => 'Bitte geben Sie die Anzahl der Personen an.',
            'no_of_people.min'             => 'Die Anzahl der Personen muss mindestens 1 betragen.',
            'no_of_people.max'             => 'Maximal 20 Personen pro Buchung.',
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
                'message' => 'Ihre Buchungsanfrage wurde erfolgreich übermittelt! Wir bestätigen Ihre Buchung in Kürze.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Booking Store Error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Etwas ist schiefgelaufen. Bitte versuchen Sie es erneut.',
            ], 500);
        }
    }
}
