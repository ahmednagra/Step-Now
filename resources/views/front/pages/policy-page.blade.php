@extends('front.layouts.master')
@section('title', $page_title)
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <style>
        .policy-content { padding: 60px 0 80px; }
        .policy-content h2 { font-size: 1.85rem; margin-bottom: 1rem; }
        .policy-content h3 { font-size: 1.25rem; margin: 1.75rem 0 0.75rem; }
        .policy-content p, .policy-content ul, .policy-content ol { line-height: 1.7; }
        .policy-content ul, .policy-content ol { padding-left: 1.5rem; }
        .policy-content li { margin-bottom: 0.4rem; }
        .policy-content a { text-decoration: underline; }
    </style>
@endsection
@section('content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $page_title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ $page_title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="policy-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article class="policy-body">
                        {!! $description !!}
                    </article>
                </div>
            </div>
        </div>
    </section>

@endsection
