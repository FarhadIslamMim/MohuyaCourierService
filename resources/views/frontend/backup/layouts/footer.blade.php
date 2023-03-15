<footer>
    <div class="footer-main white-clr">
        <div class="theme-container container">
            <div class="row">
                <div class="col-md-3 col-sm-6 footer-widget">
                    <img width="120px" src="{{ asset($setting->logo) }}"
                    alt="">
                </div>
                {{-- <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">quick links</h2>
                    <ul>
                        <li> <a href="#">sitemap</a> </li>
                        <li> <a href="#">pricing</a> </li>
                        <li> <a href="#">payment method</a> </li>
                        <li> <a href="#">support</a> </li>
                    </ul>
                </div> --}}
                {{-- <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">important links</h2>
                    <ul>
                        <li> <a href="#">themeforest</a> </li>
                        <li> <a href="#">envato</a> </li>
                        <li> <a href="#">audiojungle</a> </li>
                        <li> <a href="#">videohibe</a> </li>
                    </ul>
                </div> --}}
                <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">get in touch</h2>
                    <ul class="social-icons list-inline">
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"> <a
                                href="{{ $setting->facebook }}" class="fa fa-facebook"></a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"> <a
                                href="{{ $setting->twitter }}" class="fa fa-twitter"></a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"> <a
                                href="{{ $setting->google_plus }}" class="fa fa-google-plus"></a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"> <a
                                href="{{ $setting->instagram }}" class="fa fa-instagram"></a> </li>
                    </ul>
                    {{-- <ul class="payment-icons list-inline">
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"> <a href="#"> <img
                                    alt="#" src="assets/img/icons/payment-1.png" /> </a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"> <a href="#"> <img
                                    alt="#" src="assets/img/icons/payment-2.png" /> </a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"> <a href="#"> <img
                                    alt="#" src="assets/img/icons/payment-3.png" /> </a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"> <a href="#"> <img
                                    alt="#" src="assets/img/icons/payment-4.png" /> </a> </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="theme-container container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p> © Copyright 2021-{{ date('Y') }}, All rights reserved </p>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                    <p> Developed by <a href="https://www.onepointitbd.com/" class="main-clr">
                            One Point IT Solutions </a> </p>
                </div>
            </div>
        </div>
    </div>
</footer>
