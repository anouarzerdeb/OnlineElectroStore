<?php
session_start();
include "db.php";

if (isset($_POST["f_name"])) {
	$f_name = trim($_POST["f_name"]);
	$l_name = trim($_POST["l_name"]);
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$mobile = trim($_POST['mobile']);
	$address1 = trim($_POST['address1']);
	$address2 = trim($_POST['address2']);

	$name_pattern = "/^[a-zA-Z ]+$/";
	$number_pattern = "/^[0-9]+$/";

	if (empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
		empty($mobile) || empty($address1) || empty($address2)) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields!</b></div>";
		exit();
	}

	if (!preg_match($name_pattern, $f_name)) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>First name is not valid!</b></div>";
		exit();
	}

	if (!preg_match($name_pattern, $l_name)) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Last name is not valid!</b></div>";
		exit();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email address is not valid!</b></div>";
		exit();
	}

	if (strlen($password) < 8) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password must be at least 8 characters</b></div>";
		exit();
	}

	if ($password !== $repassword) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Passwords do not match</b></div>";
		exit();
	}

	if (!preg_match($number_pattern, $mobile) || strlen($mobile) < 7) {
		echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Mobile number is not valid</b></div>";
		exit();
	}

	$result = safe_query($con, "SELECT user_id FROM user_info WHERE email = ? LIMIT 1", "s", [$email]);
	if (mysqli_num_rows($result) > 0) {
		echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email address is already registered</b></div>";
		exit();
	}

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	safe_query($con,
		"INSERT INTO user_info (user_id, first_name, last_name, email, password, mobile, address1, address2) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)",
		"sssssss", [$f_name, $l_name, $email, $hashed_password, $mobile, $address1, $address2]
	);

	$_SESSION["uid"] = mysqli_insert_id($con);
	$_SESSION["name"] = $f_name;
	$ip_add = getenv("REMOTE_ADDR");

	safe_query($con, "UPDATE cart SET user_id = ? WHERE ip_add = ? AND user_id = -1", "is", [$_SESSION["uid"], $ip_add]);

	echo "register_success";
	exit();
}
?>
