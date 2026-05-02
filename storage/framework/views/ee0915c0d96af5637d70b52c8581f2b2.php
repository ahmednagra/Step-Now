<!-- Start sidebar widget content -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">X</a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="<?php echo e(route('front.index')); ?>"><img src="<?php echo e(asset($setting->logo)); ?>"
                                    width="200px" /></a>
                        </div>
                        <div class="content-box">
                            <h4>Über uns</h4>
                            <div class="inner-text">
                                <p>
                                    Car – Wo Frühadopter und Innovationssuchende lebendige, kreative Technik finden.
                                </p>
                            </div>
                        </div>



                        <div class="sidebar-contact-info">
                            <h4>Contact Info</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <span class="icon-pin"></span> <?php echo e($setting->address); ?>

                                </li>
                                <li>
                                    <span class="icon-call"></span>
                                    <a href="tel:<?php echo e($setting->phone_no); ?>"><?php echo e($setting->phone_no); ?></a>
                                </li>
                                <li>
                                    <span class="icon-envelope"></span>
                                    <a href="mailto:<?php echo e($setting->email); ?>"><?php echo e($setting->email); ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="thm-social-link1">
                            <ul class="social-box list-unstyled">
                                <?php if(!empty($setting->fb_link)): ?>
                                    <li><a href="<?php echo e($setting->fb_link); ?>" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($setting->insta_link)): ?>
                                    <li><a href="<?php echo e($setting->insta_link); ?>" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($setting->yt_link)): ?>
                                    <li><a href="<?php echo e($setting->yt_link); ?>" target="_blank"><i
                                                class="fab fa-youtube"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($setting->tiktok_link)): ?>
                                    <li><a href="<?php echo e($setting->tiktok_link); ?>" target="_blank"> <i
                                                class="bi bi-tiktok"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($setting->linkedin_link)): ?>
                                    <li><a href="<?php echo e($setting->linkedin_link); ?>" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/layouts/partials/x-side-bar.blade.php ENDPATH**/ ?>