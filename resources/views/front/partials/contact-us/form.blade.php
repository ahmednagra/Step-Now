<section class="contact-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="contact-page__inner">
                    <div class="contact-page__right">
                        <h3 class="contact-page__form-title">Kostenloses Angebot anfordern</h3>
                        <form class="contact-form-validated contact-page__form"
                            action="{{ route('front.contactus.store') }}" id="contactForm" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <input type="text" name="name" placeholder="Ihr Name" required="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <input type="email" name="email" placeholder="Ihre E-Mail" required="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <input type="text" placeholder="Telefonnummer" name="phone_no" required="">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <input type="text" placeholder="Betreff" name="subject" required="">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box text-message-box">
                                        <textarea name="enquiry_message" placeholder="Nachricht" required=""></textarea>
                                    </div>
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
