<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['product_id'])) {
    $pid = intval($_GET['product_id']);
    $r = safe_query($con, "SELECT product_image FROM products WHERE product_id = ?", "i", [$pid]);
    $row = mysqli_fetch_array($r);
    if ($row && file_exists("../product_images/" . $row['product_image'])) unlink("../product_images/" . $row['product_image']);
    safe_query($con, "DELETE FROM products WHERE product_id = ?", "i", [$pid]);
    header("Location: electroniclist.php"); exit();
}
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * 12;

include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Electronics List</h4></div>
        <div class="card-body"><div class="table-responsive">
          <table class="table table-hover tablesorter">
            <thead class="text-primary"><tr><th>Image</th><th>Name</th><th>Price</th><th><a class="btn btn-primary" href="addproduct.php">Add New</a></th></tr></thead>
            <tbody>
<?php
$result = safe_query($con, "SELECT product_id, product_image, product_title, product_price FROM products WHERE product_cat = 1 LIMIT ?, 12", "i", [$offset]);
while ($row = mysqli_fetch_array($result)) {
    $pid = intval($row['product_id']);
    echo "<tr><td><img src='../product_images/" . h($row['product_image']) . "' style='width:50px;height:50px'></td><td>" . h($row['product_title']) . "</td><td>" . h($row['product_price']) . "</td>";
    echo "<td><a class='btn btn-danger btn-sm' href='electroniclist.php?product_id=$pid&action=delete' onclick='return confirm(\"Delete?\")'>Delete</a></td></tr>";
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
