<?php
session_start();
include "db.php";

if (!isset($_SESSION["uid"])) {
    header("Location: index.php");
    exit();
}

$user_id = intval($_SESSION["uid"]);
$f_name = trim($_POST["firstname"] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');
$city = trim($_POST['city'] ?? '');
$state = trim($_POST['state'] ?? '');
$zip = trim($_POST['zip'] ?? '');
$cardname = trim($_POST['cardname'] ?? '');
$cardnumber = trim($_POST['cardNumber'] ?? '');
$expdate = trim($_POST['expdate'] ?? '');
$cvv = trim($_POST['cvv'] ?? '');
$total_count = intval($_POST['total_count'] ?? 0);
$prod_total = floatval($_POST['total_price'] ?? 0);

// Mask card number for storage (only keep last 4 digits)
$masked_card = str_repeat('*', max(0, strlen($cardnumber) - 4)) . substr($cardnumber, -4);

safe_query($con,
    "INSERT INTO orders_info (user_id, f_name, email, address, city, state, zip, cardname, cardnumber, expdate, prod_count, total_amt, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
    "isssssisssiis",
    [$user_id, $f_name, $email, $address, $city, $state, $zip, $cardname, $masked_card, $expdate, $total_count, $prod_total, '***']
);

$order_id = mysqli_insert_id($con);

for ($i = 1; $i <= $total_count; $i++) {
    $prod_id = intval($_POST['prod_id_' . $i] ?? 0);
    $prod_price = floatval($_POST['prod_price_' . $i] ?? 0);
    $prod_qty = intval($_POST['prod_qty_' . $i] ?? 0);
    $sub_total = $prod_price * $prod_qty;

    safe_query($con,
        "INSERT INTO order_products (order_pro_id, order_id, product_id, qty, amt) VALUES (NULL, ?, ?, ?, ?)",
        "iiid", [$order_id, $prod_id, $prod_qty, $sub_total]
    );
}

// Clear user cart
safe_query($con, "DELETE FROM cart WHERE user_id = ?", "i", [$user_id]);

header("Location: store.php");
exit();
?>
