<div class="single-testimonials-style-five">
    <div class="thumbnail">
        <img src="{{ asset($testimonial->image) }}" alt="testimoanils">
    </div>
    <div class="inner-content">
        <div class="name-area">
            <h5 class="title">{{ $testimonial->name }}</h5>
            <b><u>{{ $testimonial->designation }}</u></b>
        </div>
        <p class="disc">
            “{{ $testimonial->feedback }}”
        </p>
        <div class="body-end">
            <div class="star-icon">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</div>
