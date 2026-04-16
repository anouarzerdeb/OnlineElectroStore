<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

$user_id = intval($_REQUEST['user_id'] ?? 0);
$result = safe_query($con, "SELECT user_id, first_name, last_name, email FROM user_info WHERE user_id = ?", "i", [$user_id]);
$user = mysqli_fetch_array($result);
if (!$user) { header("Location: manageuser.php"); exit(); }

if (isset($_POST['btn_save'])) {
    $fn = trim($_POST['first_name']);
    $ln = trim($_POST['last_name']);
    $em = trim($_POST['email']);
    $pw = $_POST['password'];
    if (!empty($pw)) {
        safe_query($con, "UPDATE user_info SET first_name=?, last_name=?, email=?, password=? WHERE user_id=?", "ssssi", [$fn, $ln, $em, password_hash($pw, PASSWORD_DEFAULT), $user_id]);
    } else {
        safe_query($con, "UPDATE user_info SET first_name=?, last_name=?, email=? WHERE user_id=?", "sssi", [$fn, $ln, $em, $user_id]);
    }
    header("Location: manageuser.php"); exit();
}
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-5 mx-auto">
      <div class="card">
        <div class="card-header card-header-primary"><h5 class="title">Edit User</h5></div>
        <form action="edituser.php" method="post">
          <div class="card-body">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="col-md-12"><div class="form-group"><label>First Name</label><input type="text" name="first_name" class="form-control" value="<?php echo h($user['first_name']); ?>"></div></div>
            <div class="col-md-12"><div class="form-group"><label>Last Name</label><input type="text" name="last_name" class="form-control" value="<?php echo h($user['last_name']); ?>"></div></div>
            <div class="col-md-12"><div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="<?php echo h($user['email']); ?>"></div></div>
            <div class="col-md-12"><div class="form-group"><label>New Password (blank = keep current)</label><input type="password" name="password" class="form-control"></div></div>
          </div>
          <div class="card-footer"><button type="submit" name="btn_save" class="btn btn-fill btn-primary">Update</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
