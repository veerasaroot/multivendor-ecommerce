<div class="container mt-5">
    <h2 class="text-center">Checkout</h2>
    <form action="/checkout/process" method="POST" class="mt-4">
        <h4>Shipping Information</h4>
        <div class="form-group">
            <label for="shipping_name">Full Name</label>
            <input type="text" name="shipping_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shipping_address">Address</label>
            <textarea name="shipping_address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="shipping_phone">Phone Number</label>
            <input type="tel" name="shipping_phone" class="form-control" required>
        </div>

        <h4 class="mt-4">Payment Information</h4>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="debit">Debit/Credit Card</option>
                <option value="paypal">Paypal</option>
            </select>
        </div>
        <div id="card_info" class="mt-3">
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" name="card_number" class="form-control">
            </div>
            <div class="form-group">
                <label for="card_expiration">Expiration Date</label>
                <input type="text" name="card_expiration" class="form-control" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="card_cvc">CVC</label>
                <input type="text" name="card_cvc" class="form-control">
            </div>
        </div>

        <div id="paypal_info" class="mt-3" style="display:none;">
            <p>You'll be redirected to PayPal to complete your purchase.</p>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Place Order</button>
        </div>
    </form>
</div>

<script>
document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
    var method = this.value;
    document.getElementById('card_info').style.display = (method === 'debit') ? 'block' : 'none';
    document.getElementById('paypal_info').style.display = (method === 'paypal') ? 'block' : 'none';
});
</script>
