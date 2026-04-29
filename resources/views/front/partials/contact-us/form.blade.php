{{--
    Public contact form.

    Compliance fixes (same as booking-1):
      - BFSG: <label> for every input.
      - Art. 13 DSGVO: notice + link to Datenschutzerklärung above submit.
      - Honeypot: hidden `website` field.
--}}
<section class="contact-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="contact-page__inner">
                    <div class="contact-page__right">
                        <h3 class="contact-page__form-title">Kostenloses Angebot anfordern</h3>
                        <form class="contact-form-validated contact-page__form"
                              action="{{ route('front.contactus.store') }}"
                              id="contactForm" method="POST">
                            @csrf

                            {{-- Honeypot --}}
                            <div style="position:absolute; left:-9999px; top:-9999px; width:0; height:0; overflow:hidden;" aria-hidden="true">
                                <label for="cf_website">Website</label>
                                <input type="text" id="cf_website" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <label for="cf_name" class="visually-hidden">Ihr Name</label>
                                        <input type="text" id="cf_name" name="name"
                                               placeholder="Ihr Name *" required autocomplete="name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <label for="cf_email" class="visually-hidden">Ihre E-Mail</label>
                                        <input type="email" id="cf_email" name="email"
                                               placeholder="Ihre E-Mail *" required autocomplete="email">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <label for="cf_phone" class="visually-hidden">Telefonnummer</label>
                                        <input type="tel" id="cf_phone" name="phone_no"
                                               placeholder="Telefonnummer *" required autocomplete="tel">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <label for="cf_subject" class="visually-hidden">Betreff</label>
                                        <input type="text" id="cf_subject" name="subject"
                                               placeholder="Betreff *" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box text-message-box">
                                        <label for="cf_message" class="visually-hidden">Nachricht</label>
                                        <textarea id="cf_message" name="enquiry_message"
                                                  placeholder="Nachricht *" required></textarea>
                                    </div>

                                    {{-- Art. 13 DSGVO notice --}}
                                    <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 16px;">
                                        Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer Anfrage
                                        und für etwaige Anschlussfragen gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet.
                                        Weitere Informationen finden Sie in unserer
                                        <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration: underline;">Datenschutzerklärung</a>.
                                    </p>

                                    <div class="contact-page__btn-box">
                                        <button type="submit" class="thm-btn contact-page__btn"
                                                data-loading-text="Bitte warten...">
                                            <span class="thm-btn-text">Nachricht senden</span>
                                            <span class="thm-btn-icon-box"><i class="fas fa-arrow-right"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Bootstrap-style screen-reader-only utility for visible labels      */
    /* without breaking the existing placeholder-driven design language. */
    .visually-hidden {
        position: absolute !important;
        width: 1px; height: 1px;
        padding: 0; margin: -1px; overflow: hidden;
        clip: rect(0,0,0,0); white-space: nowrap; border: 0;
    }
</style>
