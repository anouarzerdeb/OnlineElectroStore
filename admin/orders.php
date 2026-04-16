<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['order_id'])) {
    safe_query($con, "DELETE FROM orders WHERE order_id = ?", "i", [intval($_GET['order_id'])]);
    header("Location: orders.php"); exit();
}
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * 10;

include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Orders / Page <?php echo $page; ?></h4></div>
        <div class="card-body"><div class="table-responsive">
          <table class="table table-hover tablesorter">
            <thead class="text-primary"><tr><th>Customer</th><th>Product</th><th>Email</th><th>City</th><th>Qty</th><th></th></tr></thead>
            <tbody>
<?php
$result = safe_query($con, "SELECT o.order_id, p.product_title, u.first_name, u.email, u.address2, o.qty FROM orders o JOIN products p ON o.product_id = p.product_id JOIN user_info u ON u.user_id = o.user_id LIMIT ?, 10", "i", [$offset]);
while ($row = mysqli_fetch_array($result)) {
    $oid = intval($row['order_id']);
    echo "<tr><td>" . h($row['first_name']) . "</td><td>" . h($row['product_title']) . "</td><td>" . h($row['email']) . "</td><td>" . h($row['address2']) . "</td><td>" . h($row['qty']) . "</td>";
    echo "<td><a class='btn btn-danger btn-sm' href='orders.php?order_id=$oid&action=delete' onclick='return confirm(\"Delete?\")'>Delete</a></td></tr>";
}
?>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
