@extends('front.layouts.master')
@section('title', 'Newsletter abgemeldet')
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
@endsection
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="page-header__inner">
                <h3>Abmeldung erfolgreich</h3>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 style="margin-bottom: 1rem;">Schade, dass Sie gehen.</h2>
                    <p style="font-size: 1.1rem;">
                        Ihre E-Mail-Adresse wurde aus dem Newsletter-Verteiler entfernt.
                        Sie erhalten keine weiteren Newsletter-Mails von uns.
                    </p>
                    <p style="margin-top: 2rem;">
                        <a href="{{ route('front.index') }}" class="thm-btn">Zur Startseite</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
