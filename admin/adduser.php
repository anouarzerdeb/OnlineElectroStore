<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

if (isset($_POST['btn_save'])) {
    safe_query($con, "INSERT INTO user_info (first_name, last_name, email, password, mobile, address1, address2) VALUES (?, ?, ?, ?, ?, ?, ?)", "sssssss",
        [trim($_POST['first_name']), trim($_POST['last_name']), trim($_POST['email']), password_hash($_POST['password'], PASSWORD_DEFAULT), trim($_POST['phone']), trim($_POST['city']), trim($_POST['country'])]);
    header("Location: manageuser.php"); exit();
}
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Add User</h4></div>
        <div class="card-body">
          <form action="" method="post">
            <div class="row">
              <div class="col-md-3"><div class="form-group"><label>First Name</label><input type="text" name="first_name" class="form-control" required></div></div>
              <div class="col-md-4"><div class="form-group"><label>Last Name</label><input type="text" name="last_name" class="form-control" required></div></div>
            </div>
            <div class="row">
              <div class="col-md-6"><div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div></div>
              <div class="col-md-6"><div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div></div>
            </div>
            <div class="row"><div class="col-md-12"><div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control" required></div></div></div>
            <div class="row">
              <div class="col-md-4"><div class="form-group"><label>City</label><input type="text" name="city" class="form-control" required></div></div>
              <div class="col-md-4"><div class="form-group"><label>Address</label><input type="text" name="country" class="form-control" required></div></div>
            </div>
            <button type="submit" name="btn_save" class="btn btn-primary pull-right">Add User</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
