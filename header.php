<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Electro Store</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Custom stylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/accountbtn.css"/>
	<link type="text/css" rel="stylesheet" href="css/custom.css"/>
</head>
<body>
	<div class="wait overlay"><div class="loader"></div></div>

	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-right">
					<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
					<li><?php
						include "db.php";
						if (isset($_SESSION["uid"]) && !isset($_SESSION["is_admin"])) {
							$stmt = mysqli_prepare($con, "SELECT first_name FROM user_info WHERE user_id=?");
							mysqli_stmt_bind_param($stmt, "i", $_SESSION["uid"]);
							mysqli_stmt_execute($stmt);
							$query = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_array($query);
							mysqli_stmt_close($stmt);
							if ($row) {
								echo '<div class="dropdownn">
									<a href="#" class="dropdownn"><i class="fa fa-user-o"></i> Hi ' . h($row["first_name"]) . '</a>
									<div class="dropdownn-content">
										<a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
									</div>
								</div>';
							}
						} else {
							echo '<div class="dropdownn">
								<a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-o"></i> My Account</a>
								<div class="dropdownn-content">
									<a href="" data-toggle="modal" data-target="#Modal_login"><i class="fa fa-sign-in"></i> Login</a>
									<a href="" data-toggle="modal" data-target="#Modal_register"><i class="fa fa-user-plus"></i> Register</a>
								</div>
							</div>';
						}
					?></li>
				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="header-logo">
							<a href="index.php" class="logo">
								<h1 class="site-logo">Electro Store</h1>
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="header-search">
							<form>
								<select class="input-select">
									<option value="0">All Categories</option>
									<option value="1">Electronics</option>
									<option value="2">Fashion</option>
								</select>
								<input class="input" id="search" type="text" placeholder="Search here">
								<button type="button" id="search_btn" class="search-btn">Search</button>
							</form>
						</div>
					</div>
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<div class="badge qty">0</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list" id="cart_product"></div>
									<div class="cart-btns">
										<a href="cart.php" style="width:100%;"><i class="fa fa-edit"></i> View Cart</a>
									</div>
								</div>
							</div>
							<div class="menu-toggle">
								<a href="#"><i class="fa fa-bars"></i><span>Menu</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /MAIN HEADER -->
	</header>

	<!-- NAVIGATION -->
	<nav id="navigation">
		<div class="container" id="get_category_home"></div>
	</nav>

	<!-- Login Modal -->
	<div class="modal fade" id="Modal_login" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body"><?php include "login_form.php"; ?></div>
			</div>
		</div>
	</div>

	<!-- Register Modal -->
	<div class="modal fade" id="Modal_register" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body"><?php include "register_form.php"; ?></div>
			</div>
		</div>
	</div>
