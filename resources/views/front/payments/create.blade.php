<x-front-layout title="Order Payment">
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div id="payment-message" style="display: none;" class="alert alert-info"></div>

                    <form action="" method="post" id="payment-form">
                        <div id="payment-element"></div>


                        <div class="mt-3 text-start">
                            <button type="submit" id="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">
                                <span id="button-text">Pay now</span>
                                <span id="spinner" style="display: none;">
                                    <span class="spinner-border spinner-border-sm align-middle me-1" role="status"
                                        aria-hidden="true"></span>
                                    Processing...
                                </span>
                            </button>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/dahlia/stripe.js"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");
        let elements;
        initialize();
        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);
        async function initialize() {
            const {
                clientSecret
            } = await fetch("{{ route('stripe.paymentIntent.create', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "_token": "{{ csrf_token() }}"
                }),
            }).then((r) => r.json());
            elements = stripe.elements({
                clientSecret
            });
            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('stripe.return', $order->id) }}",
                },
            });
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }
        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.style.display = "block";
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.style.display = "none";
                messageText.textContent = "";
            }, 4000);  
        }
        function setLoading(isLoading) {
            if (isLoading) {
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").style.display = "inline";
                document.querySelector("#button-text").style.display = "none";
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").style.display = "none";
                document.querySelector("#button-text").style.display = "inline";
            }
        }
    </script>
</x-front-layout>