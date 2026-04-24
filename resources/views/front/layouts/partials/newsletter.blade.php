<div class="rts-cta-area-one">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('front.newsletter.store') }}" id="newsLetterForm" method="POST">
                    @csrf
                    <div class="cta-main-area-wrapper-one bg_image">
                    <div class="left-areas">
                        <span class="pre">Latest Education News</span>
                        <h3 class="title">Sign Up Newsletter</h3>
                    </div>
                    <div class="right-area">
                        <div class="inpur-area-main">
                            <input type="email" placeholder="Enter Email Address" name="email">
                            <button class="rts-btn btn-primary">Subscribe Now</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
