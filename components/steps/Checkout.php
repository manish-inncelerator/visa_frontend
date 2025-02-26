<!-- </?php
// $price = $database->get('orders', ['order_total', 'order_currency'], [
//     'order_id' => $order_id
// ]);
// if ($price['order_currency'] === '') {
//     $payCurr = 'SGD';
// } else {
//     $payCurr = $price['order_currency'];
// }
?>
<div class="card">
    <div class="card-header"><i class="bi bi-bag-heart-fill"></i> Checkout</div>
    <div class="card-body text-center">
        <h2><b>Congratulations 🎉 form submitted successfully.</b></h2>
        <p>Your visa application process will start after payment.</p>
        <p>Please make a payment of <span id="amount" class="fw-bold text-success"></?php echo $price['order_total']; ?> </?php echo $payCurr; ?></span></p>
        <button class="btn btn-primary btn-lg cta-button rounded-pill mt-3 p-3 plexFont" onclick="pay()">Pay Now <i class="bi bi-arrow-right-circle ms-2"></i></button>
    </div>
</div>
<script src="https://checkout.flywire.com/flywire-payment.js"></script>
<script src="assets/js/pay.js"></script> -->

<div class="card">
    <div class="card-header"><i class="bi bi-bag-heart-fill"></i> Checkout</div>
    <div class="card-body text-center">
        <h2><b>Congratulations 🎉 form submitted successfully.</b></h2>
    </div>
</div>