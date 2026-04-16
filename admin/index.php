<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Users List</h4></div>
        <div class="card-body"><div class="table-responsive">
          <table class="table table-hover tablesorter">
            <thead class="text-primary"><tr><th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>City</th></tr></thead>
            <tbody>
<?php
$result = safe_query($con, "SELECT user_id, first_name, last_name, email, mobile, address2 FROM user_info");
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . h($row['user_id']) . "</td><td>" . h($row['first_name'] . ' ' . $row['last_name']) . "</td><td>" . h($row['email']) . "</td><td>" . h($row['mobile']) . "</td><td>" . h($row['address2']) . "</td></tr>";
}
?>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary"><h4 class="card-title">Categories</h4></div>
          <div class="card-body"><div class="table-responsive">
            <table class="table table-hover tablesorter">
              <thead class="text-primary"><tr><th>ID</th><th>Category</th><th>Products</th></tr></thead>
              <tbody>
<?php
$result = safe_query($con, "SELECT c.cat_id, c.cat_title, COUNT(p.product_id) AS cnt FROM categories c LEFT JOIN products p ON p.product_cat = c.cat_id GROUP BY c.cat_id, c.cat_title");
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . h($row['cat_id']) . "</td><td>" . h($row['cat_title']) . "</td><td>" . $row['cnt'] . "</td></tr>";
}
?>
              </tbody>
            </table>
          </div></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary"><h4 class="card-title">Brands</h4></div>
          <div class="card-body"><div class="table-responsive">
            <table class="table table-hover tablesorter">
              <thead class="text-primary"><tr><th>ID</th><th>Brand</th><th>Products</th></tr></thead>
              <tbody>
<?php
$result = safe_query($con, "SELECT b.brand_id, b.brand_title, COUNT(p.product_id) AS cnt FROM brands b LEFT JOIN products p ON p.product_brand = b.brand_id GROUP BY b.brand_id, b.brand_title");
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . h($row['brand_id']) . "</td><td>" . h($row['brand_title']) . "</td><td>" . $row['cnt'] . "</td></tr>";
}
?>
              </tbody>
            </table>
          </div></div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Subscribers</h4></div>
        <div class="card-body"><div class="table-responsive">
          <table class="table table-hover tablesorter">
            <thead class="text-primary"><tr><th>ID</th><th>Email</th></tr></thead>
            <tbody>
<?php
$result = safe_query($con, "SELECT * FROM email_info");
while ($row = mysqli_fetch_array($result)) { echo "<tr><td>" . h($row[0]) . "</td><td>" . h($row[1]) . "</td></tr>"; }
?>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
