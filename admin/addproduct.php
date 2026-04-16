<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

if (isset($_POST['btn_save'])) {
    $product_name = trim($_POST['product_name']);
    $details = trim($_POST['details']);
    $price = floatval($_POST['price']);
    $product_type = intval($_POST['product_type']);
    $brand = intval($_POST['brand']);
    $tags = trim($_POST['tags']);

    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($picture_name, PATHINFO_EXTENSION));

    if (in_array($picture_type, $allowed_types) && in_array($ext, $allowed_ext) && $picture_size <= 5000000) {
        $pic_name = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '', $picture_name);
        move_uploaded_file($picture_tmp, "../product_images/" . $pic_name);
        safe_query($con, "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) VALUES (?, ?, ?, ?, ?, ?, ?)", "iisdsss", [$product_type, $brand, $product_name, $price, $details, $pic_name, $tags]);
        header("Location: productlist.php");
        exit();
    }
}
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <div class="card-header card-header-primary"><h5 class="title">Add Product</h5></div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12"><div class="form-group"><label>Product Title</label><input type="text" name="product_name" class="form-control" required></div></div>
                <div class="col-md-4"><label>Image</label><input type="file" name="picture" class="btn btn-fill btn-success" required></div>
                <div class="col-md-12"><div class="form-group"><label>Description</label><textarea rows="4" name="details" class="form-control" required></textarea></div></div>
                <div class="col-md-12"><div class="form-group"><label>Price</label><input type="text" name="price" class="form-control" required></div></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-header card-header-primary"><h5 class="title">Categories</h5></div>
            <div class="card-body">
              <div class="col-md-12"><div class="form-group"><label>Category ID</label><input type="number" name="product_type" class="form-control" required></div></div>
              <div class="col-md-12"><div class="form-group"><label>Brand ID</label><input type="number" name="brand" class="form-control" required></div></div>
              <div class="col-md-12"><div class="form-group"><label>Keywords</label><input type="text" name="tags" class="form-control" required></div></div>
            </div>
            <div class="card-footer"><button type="submit" name="btn_save" class="btn btn-fill btn-primary">Add Product</button></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include "footer.php"; ?>
