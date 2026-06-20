<x-front-layout :title="__('Contact Us')">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Contact Us') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                        <li>{{ __('Contact') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>{{ __('Contact Us') }}</h2>
                            <p>{{ __('contact_section_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="single-info-head">
                                <div class="single-info">
                                    <i class="lni lni-map"></i>
                                    <h3>{{ __('Address') }}</h3>
                                    <ul>
                                        <li>{{ __('store_address_details') }}</li>
                                    </ul>
                                </div>
                                <div class="single-info">
                                    <i class="lni lni-phone"></i>
                                    <h3>{{ __('Call us on') }}</h3>
                                    <ul>
                                        <li><a href="tel:+18005554400">+1 800 555 44 00 ({{ __('Toll free') }})</a></li>
                                        <li><a href="tel:+321556667890">+321 55 666 7890</a></li>
                                    </ul>
                                </div>
                                <div class="single-info">
                                    <i class="lni lni-envelope"></i>
                                    <h3>{{ __('Mail at') }}</h3>
                                    <ul>
                                        <li><a href="mailto:support@shopgrids.com">support@shopgrids.com</a></li>
                                        <li><a href="mailto:career@shopgrids.com">career@shopgrids.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-12">
                            <div class="contact-form-head">
                                <div class="form-main">
                                    <form class="form" method="post" action="assets/mail/mail.php">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" placeholder="{{ __('Your Name') }}"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="subject" type="text"
                                                        placeholder="{{ __('Your Subject') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email"
                                                        placeholder="{{ __('Your Email') }}" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="phone" type="text" placeholder="{{ __('Your Phone') }}"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group message">
                                                    <textarea name="message"
                                                        placeholder="{{ __('Your Message') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn">
                                                        {{ __('Submit Message') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>