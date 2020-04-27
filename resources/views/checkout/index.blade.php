<h1 class="checkout-heading stylish-heading">Checkout</h1>
        <div class="checkout-section">

            <h2>{{$message ?? 'paiement pas encore fait'}}<h2>
            <div>
                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                    @csrf
                    <h2>Billing Details</h2>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        @if (auth()->user())
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name1">Name</label>
                        <input type="text" class="form-control" id="name" name="name1" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="line1">Address</label>
                        <input type="text" class="form-control" id="address" name="line1" value="{{ old('address') }}" required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postcode" value="{{ old('postalcode') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="spacer"></div>

                    <h2>Payment Details</h2>

                    <div class="form-group">
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                    </div>

                    <div class="form-group">
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element">
                          <!-- a Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="spacer"></div>

                    <script
                        src="https://checkout.stripe.com/checkout.js"
                        class="stripe-button"
                        data-key="{{ env('STRIPE_PUB_KEY') }}"
                        data-amount="1999"
                        data-name="Stripe Demo"
                        data-description="Online course about integrating Stripe"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="eur">
                        >
                    </script>


                </form>