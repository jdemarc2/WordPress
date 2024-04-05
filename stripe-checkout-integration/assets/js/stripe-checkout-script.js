document.addEventListener('DOMContentLoaded', function() {
    fetch('/wp-content/plugins/stripe-checkout-integration/create-checkout-session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        var stripe = Stripe('YOUR_PUBLIC_KEY'); // Replace with your actual Stripe public key
        stripe.redirectToCheckout({
            sessionId: data.sessionId
        });
    });
});
