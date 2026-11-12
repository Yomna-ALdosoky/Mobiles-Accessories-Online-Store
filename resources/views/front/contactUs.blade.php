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
                            <p>{{ $settings?->contact_section_desc }}</p>
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
                                        <li>{{ $settings?->address ?? __('Address not available') }}</li>
                                    </ul>
                                </div>
                                <div class="single-info">
                                    <i class="lni lni-phone"></i>
                                    <h3>{{ __('Call us on') }}</h3>
                                    <ul>
                                        @if($settings?->primary_phone)
                                        <li><a href="tel:{{ $settings->primary_phone }}">{{ $settings->primary_phone
                                                }}</a></li>
                                        @endif
                                        @if($settings?->secondary_phone)
                                        <li><a href="tel:{{ $settings->secondary_phone }}">{{ $settings->secondary_phone
                                                }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="single-info">
                                    <i class="lni lni-envelope"></i>
                                    <h3>{{ __('Mail at') }}</h3>
                                    <ul>
                                        @if($settings?->support_email)
                                        <li><a href="mailto:{{ $settings->support_email }}">{{ $settings->support_email
                                                }}</a></li>
                                        @endif
                                        @if($settings?->career_email)
                                        <li><a href="mailto:{{ $settings->career_email }}">{{ $settings->career_email
                                                }}</a></li>
                                        @endif
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12 col-12">
                            <div class="contact-form-head">
                                <div class="form-main">
                                    @if(session('success'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <form class="form" method="post" action="{{ route('contact.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="name" type="text" value="{{ old('name') }}"
                                                        placeholder="{{ __('Your Name') }}" required>
                                                    @error('name') <small class="text-danger d-block mt-1">{{ $message
                                                        }}</small> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="subject" type="text" value="{{ old('subject') }}"
                                                        placeholder="{{ __('Your Subject') }}" required>
                                                    @error('subject') <small class="text-danger d-block mt-1">{{
                                                        $message }}</small> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email" value="{{ old('email') }}"
                                                        placeholder="{{ __('Your Email') }}" required>
                                                    @error('email') <small class="text-danger d-block mt-1">{{ $message
                                                        }}</small> @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="phone" type="text" value="{{ old('phone') }}"
                                                        placeholder="{{ __('Your Phone') }}" required>
                                                    @error('phone') <small class="text-danger d-block mt-1">{{ $message
                                                        }}</small> @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group message">
                                                    <textarea name="message" placeholder="{{ __('Your Message') }}"
                                                        required>{{ old('message') }}</textarea>
                                                    @error('message') <small class="text-danger d-block mt-1">{{
                                                        $message }}</small> @enderror
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