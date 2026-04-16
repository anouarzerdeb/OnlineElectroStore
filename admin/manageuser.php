<?php
session_start();
if (!isset($_SESSION["is_admin"])) { header("Location: ../index.php"); exit(); }
include("../db.php");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id'])) {
    safe_query($con, "DELETE FROM user_info WHERE user_id = ?", "i", [intval($_GET['user_id'])]);
    header("Location: manageuser.php");
    exit();
}
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary"><h4 class="card-title">Manage Users</h4></div>
        <div class="card-body"><div class="table-responsive">
          <table class="table tablesorter table-hover">
            <thead class="text-primary"><tr><th>Email</th><th>Name</th><th><a href="adduser.php" class="btn btn-success">Add New</a></th></tr></thead>
            <tbody>
<?php
$result = safe_query($con, "SELECT user_id, first_name, last_name, email FROM user_info");
while ($row = mysqli_fetch_array($result)) {
    $uid = intval($row['user_id']);
    echo "<tr><td>" . h($row['email']) . "</td><td>" . h($row['first_name'] . ' ' . $row['last_name']) . "</td>
    <td><a href='edituser.php?user_id=$uid' class='btn btn-info btn-link btn-sm'><i class='material-icons'>edit</i></a>
    <a href='manageuser.php?user_id=$uid&action=delete' class='btn btn-danger btn-link btn-sm' onclick='return confirm(\"Delete?\")'><i class='material-icons'>close</i></a></td></tr>";
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
