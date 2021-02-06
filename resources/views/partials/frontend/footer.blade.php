    <!-- Newsletter -->
    <div id="newsletter" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>{{ __('Sign Up for the ') }}<strong>{{ __('NEWSLETTER') }}</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i>{{ __(' Subscribe') }}</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('About Us') }}</h3>
                            <p>{{ __('SoftTech is an online market place by using which both buyers and sellers can be benefited.') }}</p>
                            <ul class="footer-links">
                                <li><a href="tel:+8801992775545"><i class="fa fa-phone"></i> {{ __('+8801992775545') }}</a></li>
                                <li><a href="mailto:nafiul1351@gmail.com"><i class="fa fa-envelope-o"></i> {{ __('nafiul1351@gmail.com') }}</a></li>
                                <li><i class="fa fa-map-marker"></i> {{ __('Mirpur, Dhaka') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('Information') }}</h3>
                            <ul class="footer-links">
                                <li><a href="{{ route('about.us') }}">{{ __('About Us') }}</a></li>
                                <li><a href="{{ route('contact.us') }}">{{ __('Contact Us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">{{ __('Service') }}</h3>
                            <ul class="footer-links">
                                <li><a href="{{ url('/home') }}">{{ __('My Account') }}</a></li>
                                <li><a href="{{ route('view.cart') }}">{{ __('View Cart') }}</a></li>
                                <li><a href="{{ route('show.wishlist') }}">{{ __('Wishlist') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="bottom-footer" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="copyright">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SoftTech
                        </span>
                        <p>This website is designed and developed by Md. Nafiul Islam</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>