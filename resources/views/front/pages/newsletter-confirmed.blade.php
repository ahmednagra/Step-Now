@extends('front.layouts.master')
@section('title', 'Newsletter bestätigt')
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
@endsection
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="page-header__inner">
                <h3>Anmeldung bestätigt</h3>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 style="margin-bottom: 1rem;">Vielen Dank!</h2>
                    <p style="font-size: 1.1rem;">
                        Ihre Anmeldung zum Newsletter wurde erfolgreich bestätigt. Sie erhalten ab sofort
                        unsere Neuigkeiten per E-Mail.
                    </p>
                    <p style="margin-top: 2rem;">
                        <a href="{{ route('front.index') }}" class="thm-btn">Zur Startseite</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
