<section class="call-one">
    <div class="container">
        <div class="call-one__inner wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="call-one__inner-content">
                <div class="call-one__bg">
                </div>
                <div class="call-one__left">
                    <p class="call-one__sub-title">Rund um die Uhr verfügbar</p>
                    <h4 class="call-one__title">Rufen Sie jederzeit für Buchungen an</h4>
                </div>
                <div class="call-one__details">
                    <div class="call-one__icon">
                        <span class="icon-call-2"></span>
                    </div>
                    <div class="call-one__content">
                        <p>Notruf</p>
                        <h4><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></h4>
                    </div>
                </div>
                <div class="call-one__btn-box">
                    <a href="{{ route("front.contactus") }}" class="thm-btn">Jetzt mieten<span class="fas fa-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
