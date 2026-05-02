<section class="contact-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="contact-page__inner">
                    <div class="contact-page__right">
                        <h3 class="contact-page__form-title"><?php echo e(__('Request a Free Quote')); ?></h3>
                        <form class="contact-form-validated contact-page__form"
                              action="<?php echo e(route('front.contactus.store')); ?>"
                              id="contactForm" method="POST">
                            <?php echo csrf_field(); ?>

                            
                            <div style="position:absolute; left:-9999px; top:-9999px; width:0; height:0; overflow:hidden;" aria-hidden="true">
                                <label for="cf_website">Website</label>
                                <input type="text" id="cf_website" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <label for="cf_name" class="visually-hidden"><?php echo e(__('Your Name')); ?></label>
                                        <input type="text" id="cf_name" name="name"
                                               placeholder="<?php echo e(__('Your Name')); ?> *" required autocomplete="name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <label for="cf_email" class="visually-hidden"><?php echo e(__('Your Email')); ?></label>
                                        <input type="email" id="cf_email" name="email"
                                               placeholder="<?php echo e(__('Your Email')); ?> *" required autocomplete="email">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="contact-page__input-box">
                                        <label for="cf_phone" class="visually-hidden"><?php echo e(__('Phone Number')); ?></label>
                                        <input type="tel" id="cf_phone" name="phone_no"
                                               placeholder="<?php echo e(__('Phone Number')); ?> *" required autocomplete="tel">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="contact-page__input-box">
                                        <label for="cf_subject" class="visually-hidden"><?php echo e(__('Subject')); ?></label>
                                        <input type="text" id="cf_subject" name="subject"
                                               placeholder="<?php echo e(__('Subject')); ?> *" required>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-page__input-box text-message-box">
                                        <label for="cf_message" class="visually-hidden"><?php echo e(__('Message')); ?></label>
                                        <textarea id="cf_message" name="enquiry_message"
                                                  placeholder="<?php echo e(__('Message')); ?> *" required></textarea>
                                    </div>

                                    <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 16px;">
                                        <?php if(app()->getLocale() === 'en'): ?>
                                            By submitting your enquiry, your information will be processed for handling
                                            your enquiry and any follow-up under Art. 6(1)(b) GDPR. More information in our
                                            <a href="<?php echo e(route('front.datenschutz')); ?>" target="_blank" rel="noopener" style="text-decoration: underline;"><?php echo e(__('Privacy Policy')); ?></a>.
                                        <?php else: ?>
                                            Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer Anfrage
                                            und für etwaige Anschlussfragen gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet.
                                            Weitere Informationen finden Sie in unserer
                                            <a href="<?php echo e(route('front.datenschutz')); ?>" target="_blank" rel="noopener" style="text-decoration: underline;">Datenschutzerklärung</a>.
                                        <?php endif; ?>
                                    </p>

                                    <div class="contact-page__btn-box">
                                        <button type="submit" class="thm-btn contact-page__btn"
                                                data-loading-text="<?php echo e(__('Please wait...')); ?>">
                                            <span class="thm-btn-text"><?php echo e(__('Send Message')); ?></span>
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
    .visually-hidden {
        position: absolute !important; width: 1px; height: 1px;
        padding: 0; margin: -1px; overflow: hidden;
        clip: rect(0,0,0,0); white-space: nowrap; border: 0;
    }
</style>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/contact-us/form.blade.php ENDPATH**/ ?>