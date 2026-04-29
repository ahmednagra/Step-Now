@extends('front.layouts.master')
@section('title', __('Newsletter unsubscribed'))
@section('content')

@include('front.layouts.partials.banner', [
    'title'    => __('Unsubscribe successful'),
    'subTitle' => __('Newsletter unsubscribed'),
])

<section class="page-content" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div style="font-size: 4rem; color: #6c757d; margin-bottom: 18px;">✕</div>
                <h2>{{ __('Sorry to see you go.') }}</h2>
                <p style="font-size: 1.05rem; line-height: 1.6; color: #555;">
                    {{ __('Your email address has been removed from the newsletter list. You will no longer receive newsletter emails from us.') }}
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
