<?php
include "db.php";
include "header.php";
?>

<style>
.row-checkout { display:flex; flex-wrap:wrap; margin:0 -16px; }
.col-25 { flex:25%; }
.col-50 { flex:50%; }
.col-75 { flex:75%; }
.col-25, .col-50, .col-75 { padding:0 16px; }
.container-checkout { background:#f2f2f2; padding:5px 20px 15px 20px; border:1px solid lightgrey; border-radius:3px; }
.checkout-btn { background-color:#4CAF50; color:white; padding:12px; margin:10px 0; border:none; width:100%; border-radius:3px; cursor:pointer; font-size:17px; }
.checkout-btn:hover { background-color:#45a049; }
span.price { float:right; color:grey; }
@media (max-width:800px) { .row-checkout { flex-direction:column-reverse; } .col-25 { margin-bottom:20px; } }
</style>

<section class="section">
    <div class="container-fluid">
        <div class="row-checkout">
<?php
if (isset($_SESSION["uid"])) {
    $uid = intval($_SESSION["uid"]);
    $user_result = safe_query($con, "SELECT * FROM user_info WHERE user_id = ?", "i", [$uid]);
    $user = mysqli_fetch_array($user_result);

    $total_count = intval($_POST['total_count'] ?? 0);
    $total = 0;

    echo '<div class="col-75"><div class="container-checkout">
    <form id="checkout_form" action="checkout_process.php" method="POST">
        <div class="row-checkout">
            <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" class="form-control" name="firstname" value="' . h($user["first_name"] . ' ' . $user["last_name"]) . '" required>
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" class="form-control" value="' . h($user["email"]) . '" required>
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" class="form-control" value="' . h($user["address1"]) . '" required>
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" class="form-control" value="' . h($user["address2"]) . '" required>
                <div class="row">
                    <div class="col-50"><label for="state">State</label><input type="text" id="state" name="state" class="form-control" required></div>
                    <div class="col-50"><label for="zip">Zip</label><input type="text" id="zip" name="zip" class="form-control" required></div>
                </div>
            </div>
            <div class="col-50">
                <h3>Payment</h3>
                <label>Accepted Cards</label>
                <div class="icon-container">
                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" class="form-control" required>
                <div class="form-group" id="card-number-field">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                </div>
                <label for="expdate">Exp Date</label>
                <input type="text" id="expdate" name="expdate" class="form-control" placeholder="12/25" required>
                <div class="row"><div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" name="cvv" id="cvv" required>
                </div></div>
            </div>
        </div>
        <label><input type="checkbox" name="q" value="conform" required> Shipping address same as billing</label>';

    for ($i = 1; $i <= $total_count; $i++) {
        $item_name = h($_POST['item_name_' . $i] ?? '');
        $amount = floatval($_POST['amount_' . $i] ?? 0);
        $quantity = intval($_POST['quantity_' . $i] ?? 0);
        $total += $amount;

        $prod_result = safe_query($con, "SELECT product_id FROM products WHERE product_title = ?", "s", [$_POST['item_name_' . $i]]);
        $prod_row = mysqli_fetch_array($prod_result);
        $prod_id = intval($prod_row["product_id"] ?? 0);

        echo "<input type='hidden' name='prod_id_$i' value='$prod_id'>
              <input type='hidden' name='prod_price_$i' value='$amount'>
              <input type='hidden' name='prod_qty_$i' value='$quantity'>";
    }

    echo '<input type="hidden" name="total_count" value="' . $total_count . '">
          <input type="hidden" name="total_price" value="' . $total . '">
          <input type="submit" value="Continue to checkout" class="checkout-btn">
    </form></div></div>';
} else {
    echo "<script>window.location.href = 'cart.php'</script>";
}
?>

            <div class="col-25">
                <div class="container-checkout">
<?php
if (isset($_POST["cmd"]) && $total_count > 0) {
    echo "<h4>Cart <span class='price' style='color:black'><i class='fa fa-shopping-cart'></i> <b>$total_count</b></span></h4>
    <table class='table table-condensed'><thead><tr><th>No</th><th>Product</th><th>Qty</th><th>Amount</th></tr></thead><tbody>";

    for ($i = 1; $i <= $total_count; $i++) {
        $item_name = h($_POST['item_name_' . $i] ?? '');
        $item_number = h($_POST['item_number_' . $i] ?? '');
        $amount = h($_POST['amount_' . $i] ?? '');
        $quantity = h($_POST['quantity_' . $i] ?? '');
        echo "<tr><td>$item_number</td><td>$item_name</td><td>$quantity</td><td>$amount</td></tr>";
    }

    echo "</tbody></table><hr><h3>Total <span class='price' style='color:black'><b>\$$total</b></span></h3>";
}
?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "newsletter.php";
include "footer.php";
?>
