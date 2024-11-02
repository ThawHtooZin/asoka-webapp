<x-layout>
    <div class="container">
        <h2>Purchase {{ $book->title }}</h2>
        <form id="payment-form">
            <div id="card-element"></div>
            <button id="submit">Pay</button>
            <div id="payment-message" class="hidden"></div>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}'); // Your Stripe public key
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {
                paymentIntent,
                error
            } = await stripe.confirmCardPayment('{{ $clientSecret }}', {
                payment_method: {
                    card: cardElement,
                }
            });

            if (error) {
                // Display error.message in your UI.
                console.error(error.message);
            } else {
                // Payment succeeded, redirect or show success message
                window.location.href = '/elibrary/payment-success'; // Redirect to success page
            }
        });
    </script>
</x-layout>
