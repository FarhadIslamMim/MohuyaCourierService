<div class="slider">
    <div class="owl-carousel owl-theme" style="position: relative;
       z-index: 4;">
        @foreach ($sliders as $key => $slider)
            <div class="item {{ $key == 0 ? 'active' : '' }}">
                <div class="slider-image">
                    <section class="mask-overlay white-clr">
                        <div class="slider-image">
                            <img src={{ asset($slider->image) }} alt="">
                        </div>
                        <div class="slider-text">
                            <h2 class="section-title fs-48 effect  wow fadeInUp animated" data-wow-offset="50"
                            data-wow-delay=".20s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            {{ $slider->heading_text }}</h2>
                        <p class="effect wow fadeInUp animated slider_secondary_text">
                            {{ $slider->secondary_text }}</p>
                        </div>
                    </section>
                </div>
            </div>
        @endforeach
    </div>

</div>
