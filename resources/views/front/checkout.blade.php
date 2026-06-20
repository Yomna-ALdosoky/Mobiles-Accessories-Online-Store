<x-front-layout :title="__('Checkout')">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Checkout') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ __('Shop') }}</a></li>
                            <li>{{ __('Checkout') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!--====== Checkout Form Steps Part Start ======-->
    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <div class="checkout-steps-form-style-1">
                            <ul id="accordionExample">
                                <!-- Step 1: Personal Details -->
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">
                                        {{ __('Your Personal Details') }}</h6>
                                    <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('User Name') }}</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[billing][first_name]"
                                                                :placeholder="__('First Name')" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[billing][last_name]"
                                                                :placeholder="__('Last Name')" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Email Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input type="email" name="addr[billing][email]"
                                                            :placeholder="__('Email Address')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Phone Number') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][phone_number]"
                                                            :placeholder="__('Phone Number')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Mailing Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][street_address]"
                                                            :placeholder="__('Mailing Address')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('City') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][city]"
                                                            :placeholder="__('City')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Post Code') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][postal_code]"
                                                            :placeholder="__('Post Code')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Region/State') }}</label>
                                                    <div class="select-items">
                                                        <x-form.input name="addr[billing][state]"
                                                            :placeholder="__('State')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Country') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="addr[billing][country]"
                                                            :options="$countries" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" name="same_as_billing" value="1"
                                                        id="checkbox-3" checked>
                                                    <label for="checkbox-3"><span></span></label>
                                                    <p>{{ __('My delivery and mailing addresses are the same.') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseFour">{{ __('Next Step') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>

                                <!-- Step 2: Shipping Address -->
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">{{ __('Shipping Address') }}
                                    </h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('User Name') }}</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[shipping][first_name]"
                                                                :placeholder="__('First Name')" />
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[shipping][last_name]"
                                                                :placeholder="__('Last Name')" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Email Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input type="email" name="addr[shipping][email]"
                                                            :placeholder="__('Email Address')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Phone Number') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][phone_number]"
                                                            :placeholder="__('Phone Number')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Mailing Address') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][street_address]"
                                                            :placeholder="__('Mailing Address')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('City') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][city]"
                                                            :placeholder="__('City')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Post Code') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][postal_code]"
                                                            :placeholder="__('Post Code')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Region/State') }}</label>
                                                    <div class="select-items">
                                                        <x-form.input name="addr[shipping][state]"
                                                            :placeholder="__('State')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>{{ __('Country') }}</label>
                                                    <div class="form-input form">
                                                        <x-form.select name="addr[shipping][country]"
                                                            :options="$countries" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="heading-6 font-weight-400 payment-title">
                                                        {{ __('Select Delivery Option') }}</h6>
                                                    <div class="payment-option-wrapper">
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping_method" value="standard"
                                                                checked id="shipping-1">
                                                            <label for="shipping-1">
                                                                <img src="https://via.placeholder.com/60x32"
                                                                    alt="Shipping">
                                                                <p>{{ __('Standard Shipping') }}</p>
                                                                <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">{{ __('Previous') }}</button>
                                                    <button type="button" class="btn btn-alt" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsefive" aria-expanded="false"
                                                        aria-controls="collapsefive">{{ __('Save & Continue')
                                                        }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>

                                <!-- Step 3: Payment Info -->
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                        aria-expanded="false" aria-controls="collapsefive">{{ __('Payment Info') }}</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapsefive"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="checkout-payment-form">
                                                    <div class="single-form form-default">
                                                        <label>{{ __('Cardholder Name') }}</label>
                                                        <div class="form-input form">
                                                            <input type="text" name="payment[card_name]"
                                                                placeholder="{{ __('Cardholder Name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default">
                                                        <label>{{ __('Card Number') }}</label>
                                                        <div class="form-input form">
                                                            <input id="credit-input" type="text"
                                                                name="payment[card_number]"
                                                                placeholder="0000 0000 0000 0000">
                                                            <img src="assets/images/payment/card.png" alt="card">
                                                        </div>
                                                    </div>
                                                    <div class="payment-card-info">
                                                        <div class="single-form form-default mm-yy">
                                                            <label>{{ __('Expiration') }}</label>
                                                            <div class="expiration d-flex">
                                                                <div class="form-input form">
                                                                    <input type="text" name="payment[expiry_month]"
                                                                        placeholder="MM">
                                                                </div>
                                                                <div class="form-input form">
                                                                    <input type="text" name="payment[expiry_year]"
                                                                        placeholder="YYYY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-form form-default">
                                                            <label>{{ __('CVC/CVV') }} <span><i
                                                                        class="mdi mdi-alert-circle"></i></span></label>
                                                            <div class="form-input form">
                                                                <input type="text" name="payment[cvv]"
                                                                    placeholder="***">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-form form-default button">
                                                        <button type="submit" class="btn">{{ __('Pay Now') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>

                <!-- Sidebar Summary -->
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <p>{{ __('Apply Coupon to get discount!') }}</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="{{ __('Coupon Code') }}">
                                    </div>
                                    <div class="button">
                                        <button type="button" class="btn">{{ __('Apply') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">{{ __('Pricing Table') }}</h5>
                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">{{ __('Subtotal Price:') }}</p>
                                    <p class="price">{{ Currency::format($cart->total()) }}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">{{ __('Shipping:') }}</p>
                                    <p class="price">$10.50</p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">{{ __('Discount:') }}</p>
                                    <p class="price">-$10.00</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">{{ __('Total Payable:') }}</p>
                                    <p class="price">{{ Currency::format($cart->total() + 10.50 - 10.00) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Checkout Form Steps Part Ends ======-->
</x-front-layout>