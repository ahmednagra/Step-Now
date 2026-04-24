<div class="rts-single-wized contact">
    <div class="wized-header">
        <a href="#"><img src="{{ asset($setting->footer_logo) }}"></a>
    </div>
    <div class="wized-body">
        <h5 class="title">Need Help? We Are Here
            To Help You</h5>

        <div class="mb-5">
            <h6 class="m-0 text-white"><i class="fa-solid fa-phone-alt"></i> Call Us 24/7</h6>
            <a href="te:{{ $setting->phone_no }}" class="text-white">{{ $setting->phone_no }}</a>
        </div>
    </div>
    <a class="rts-btn btn-primary bg-white text-success mx-auto" href="{{ route('front.contactus') }}">Contact Us</a>
</div>
