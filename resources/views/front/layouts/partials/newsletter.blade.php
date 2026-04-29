{{--
  Newsletter signup partial — Double-Opt-In compliant.
  Posts to /newsletter-store; controller emails a confirmation token.
--}}
<section class="newsletter-section" style="padding: 50px 0; background: #181818;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <h3 style="color: #fff; margin: 0 0 6px; font-size: 1.4rem;">
                    {{ __('Stay Informed') }}
                </h3>
                <p style="color: rgba(255,255,255,.7); margin: 0; font-size: .95rem;">
                    @if(app()->getLocale() === 'en')
                        Receive updates on offers and news. Unsubscribe at any time.
                    @else
                        Erhalten Sie Updates zu Angeboten und Neuigkeiten. Jederzeit kündbar.
                    @endif
                </p>
            </div>
            <div class="col-md-7">
                <form action="{{ route('front.newsletter.store') }}" method="POST"
                      id="newsletterForm" class="newsletter-form">
                    @csrf

                    {{-- Honeypot --}}
                    <div style="position:absolute; left:-9999px; top:-9999px; width:0; height:0; overflow:hidden;" aria-hidden="true">
                        <label for="nl_website">Website</label>
                        <input type="text" id="nl_website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="newsletter-form__input-box" style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <label for="nl_email" class="visually-hidden">{{ __('Email Address') }}</label>
                        <input type="email" id="nl_email" name="email"
                               placeholder="{{ __('Email Address') }}"
                               required autocomplete="email"
                               style="flex:1; min-width: 200px; padding: 12px 16px; border: 0; border-radius: 4px;">
                        <button type="submit" class="thm-btn"
                                style="padding: 12px 24px; border: 0; border-radius: 4px; background: #ffc107; color: #111; cursor: pointer; font-weight: 600;">
                            {{ __('Subscribe') }}
                        </button>
                    </div>

                    <label style="display: block; margin-top: 12px; color: rgba(255,255,255,.7); font-size: .8rem; line-height: 1.5;">
                        <input type="checkbox" name="consent" value="1" required style="margin-right: 6px;">
                        @if(app()->getLocale() === 'en')
                            I consent to having my email address processed for newsletter delivery.
                            I can withdraw this consent at any time for the future via the "Unsubscribe"
                            link in any newsletter email. More information in the
                            <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="color: #ffc107;">{{ __('Privacy Policy') }}</a>.
                        @else
                            Ich willige ein, dass meine E-Mail-Adresse zum Versand des Newsletters verarbeitet wird.
                            Diese Einwilligung kann ich jederzeit mit Wirkung für die Zukunft über den
                            „Abmelden"-Link in jeder Newsletter-Mail widerrufen. Weitere Informationen in der
                            <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="color: #ffc107;">Datenschutzerklärung</a>.
                        @endif
                    </label>

                    <div class="ajax-response" style="color: #fff; margin-top: 8px; font-size: .9rem;"></div>
                </form>
            </div>
        </div>
    </div>
</section>
