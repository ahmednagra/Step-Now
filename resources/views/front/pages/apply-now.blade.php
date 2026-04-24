@extends('front.layouts.master')
@section('title', 'Apply Now')
@section('content')
    @include('front.partials.breadcrumb.breadcrumb-1', [
        'title' => 'Apply Now',
        'sub_title' => 'Apply Now',
    ])

    <div class="appoinment-area-start pb--50 mt-dec-30">
        <div class="container">
            <div class="row align-items-center">
                @include('front.partials.apply-now.form')
                <div class="col-lg-5">
                    <div class="appoinment-thumbnail">
                        <img loading="lazy" src="{{ asset('assets/temp/02.webp') }}" alt="appoinment">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
