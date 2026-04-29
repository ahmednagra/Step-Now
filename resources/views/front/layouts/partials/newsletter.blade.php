{{--
    Newsletter sign-up — German Double-Opt-In flow.

    Why an explicit checkbox here (and not on booking/contact):
      Newsletter is processed under Art. 6 Abs. 1 lit. a DSGVO (consent),
      not lit. b (contract). Consent must be:
        - actively given (checkbox unticked by default),
        - documented (we store ip_address + user_agent + timestamp),
        - withdrawable (every newsletter mail contains an unsubscribe link).

    The address only becomes an active subscriber after the user clicks
    the confirmation link in the DOI mail. See Front\NewsletterController.
--}}
<div class="rts-cta-area-one">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('front.newsletter.store') }}" id="newsLetterForm" method="POST">
                    @csrf

                    {{-- Honeypot --}}
                    <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
                        <label for="nf_website">Website</label>
                        <input type="text" id="nf_website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="cta-main-area-wrapper-one bg_image">
                        <div class="left-areas">
                            <span class="pre">Bleiben Sie informiert</span>
                            <h3 class="title">Newsletter abonnieren</h3>
                        </div>
                        <div class="right-area">
                            <div class="inpur-area-main">
                                <label for="nf_email" class="visually-hidden">E-Mail-Adresse</label>
                                <input type="email" id="nf_email" name="email" placeholder="E-Mail-Adresse" required>
                                <button type="submit" class="rts-btn btn-primary">Abonnieren</button>
                            </div>
                            <label style="display:flex; gap:8px; align-items:flex-start; margin-top:10px; font-size:.82rem; color:#eee; line-height:1.45;">
                                <input type="checkbox" name="consent" value="1" required style="margin-top:4px;">
                                <span>
                                    Ich willige ein, dass meine E-Mail-Adresse zum Versand des Newsletters verarbeitet wird.
                                    Diese Einwilligung kann ich jederzeit mit Wirkung für die Zukunft über den
                                    „Abmelden“-Link in jeder Newsletter-Mail widerrufen. Weitere Informationen in der
                                    <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration:underline; color:#fff;">Datenschutzerklärung</a>.
                                </span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .visually-hidden {
        position: absolute !important;
        width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden;
        clip: rect(0,0,0,0); white-space: nowrap; border: 0;
    }
</style>
