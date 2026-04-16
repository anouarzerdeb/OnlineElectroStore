<?php
include "db.php";
session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {
	$email = trim($_POST["email"]);
	$password = $_POST["password"];
	$ip_add = getenv("REMOTE_ADDR");

	// Try user login first
	$result = safe_query($con, "SELECT * FROM user_info WHERE email = ? LIMIT 1", "s", [$email]);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result);

		if (password_verify($password, $row["password"]) || $row["password"] === $password) {
			$_SESSION["uid"] = $row["user_id"];
			$_SESSION["name"] = $row["first_name"];

			// Merge guest cart into user cart
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				$product_list = json_decode($p_list, true);
				if (is_array($product_list)) {
					foreach ($product_list as $pid) {
						$pid = intval($pid);
						$check = safe_query($con, "SELECT id FROM cart WHERE user_id = ? AND p_id = ?", "ii", [$_SESSION["uid"], $pid]);
						if (mysqli_num_rows($check) < 1) {
							safe_query($con, "UPDATE cart SET user_id = ? WHERE ip_add = ? AND user_id = -1", "is", [$_SESSION["uid"], $ip_add]);
						} else {
							safe_query($con, "DELETE FROM cart WHERE user_id = -1 AND ip_add = ? AND p_id = ?", "si", [$ip_add, $pid]);
						}
					}
				}
				setcookie("product_list", "", strtotime("-1 day"), "/");
				echo "cart_login";
				exit();
			}

			echo "login_success";
			exit();
		}
	}

	// Try admin login
	$admin_password = md5($password);
	$result = safe_query($con, "SELECT * FROM admin_info WHERE admin_email = ? AND admin_password = ? LIMIT 1", "ss", [$email, $admin_password]);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result);
		$_SESSION["uid"] = $row["admin_id"];
		$_SESSION["name"] = $row["admin_name"];
		$_SESSION["is_admin"] = true;

		echo "login_success";
		echo "<script> location.href='admin/addproduct.php'; </script>";
		exit();
	}

	echo "<span style='color:red;'>Invalid email or password</span>";
	exit();
}
?>
