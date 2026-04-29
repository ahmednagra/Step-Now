@extends('front.layouts.master')
@section('title', __('Newsletter signup confirmed'))
@section('content')

@include('front.layouts.partials.banner', [
    'title'    => __('Signup confirmed'),
    'subTitle' => __('Newsletter signup confirmed'),
])

<section class="page-content" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div style="font-size: 4rem; color: #198754; margin-bottom: 18px;">✓</div>
                <h2>{{ __('Thank you!') }}</h2>
                <p style="font-size: 1.05rem; line-height: 1.6; color: #555;">
                    {{ __('Your newsletter subscription has been confirmed successfully. You will now receive our updates by email.') }}
                </p>
                <p style="margin-top: 30px;">
                    <a href="{{ route('front.index') }}" class="thm-btn">
                        {{ __('Back to home') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
