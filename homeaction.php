<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

// Navigation categories
if (isset($_POST["categoryhome"])) {
	$result = safe_query($con, "SELECT * FROM categories WHERE cat_id != 1");
	echo '<div id="responsive-nav"><ul class="main-nav nav navbar-nav">
		<li class="active"><a href="index.php">Home</a></li>
		<li><a href="store.php">Electronics</a></li>';
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$cid = intval($row["cat_id"]);
			$cat_name = h($row["cat_title"]);
			echo "<li class='categoryhome' cid='$cid'><a href='store.php'>$cat_name</a></li>";
		}
		echo '</ul></div>';
	}
}

// Pagination
if (isset($_POST["page"])) {
	$result = safe_query($con, "SELECT COUNT(*) AS total FROM products");
	$row = mysqli_fetch_array($result);
	$pageno = ceil($row["total"] / 2);
	for ($i = 1; $i <= $pageno; $i++) {
		echo "<li><a href='#product-row' page='$i' id='page'>$i</a></li>";
	}
}

// Product widgets for sidebar
if (isset($_POST["getProducthome"])) {
	$limit = 3;
	$start = 0;
	if (isset($_POST["setPage"])) {
		$pageno = intval($_POST["pageNumber"]);
		$start = ($pageno * $limit) - $limit;
	}
	$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id LIMIT ?, ?", "ii", [$start, $limit]);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$pid = intval($row['product_id']);
			$title = h($row['product_title']);
			$price = h($row['product_price']);
			$image = h($row['product_image']);
			$cat = h($row['cat_title']);
			echo "<div class='product-widget'>
				<a href='product.php?p=$pid'>
					<div class='product-img'><img src='product_images/$image' alt='$title'></div>
					<div class='product-body'>
						<p class='product-category'>$cat</p>
						<h3 class='product-name'><a href='product.php?p=$pid'>$title</a></h3>
						<h4 class='product-price'>\$$price<del class='product-old-price'>\$990.00</del></h4>
					</div>
				</a>
			</div>";
		}
	}
}

// Home page featured products
if (isset($_POST["gethomeProduct"])) {
	$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id ORDER BY product_id DESC LIMIT 4");
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$pid = intval($row['product_id']);
			$title = h($row['product_title']);
			$price = h($row['product_price']);
			$image = h($row['product_image']);
			$cat = h($row['cat_title']);
			echo "<div class='col-md-3 col-xs-6'>
				<a href='product.php?p=$pid'><div class='product'>
					<div class='product-img'>
						<img src='product_images/$image' style='max-height:170px;' alt='$title'>
						<div class='product-label'>
							<span class='sale'>-30%</span>
							<span class='new'>NEW</span>
						</div>
					</div></a>
					<div class='product-body'>
						<p class='product-category'>$cat</p>
						<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pid'>$title</a></h3>
						<h4 class='product-price header-cart-item-info'>\$$price<del class='product-old-price'>\$990.00</del></h4>
						<div class='product-rating'>
							<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
						</div>
						<div class='product-btns'>
							<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
							<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
							<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
						</div>
					</div>
					<div class='add-to-cart'>
						<button pid='$pid' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
					</div>
				</div>
			</div>";
		}
	}
}

// Category filter from home
if (isset($_POST["get_seleted_Category"]) || isset($_POST["search"])) {
	if (isset($_POST["get_seleted_Category"])) {
		$id = intval($_POST["cat_id"]);
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = ? AND product_cat = cat_id", "i", [$id]);
	} else {
		$keyword = trim($_POST["keyword"]);
		$search = "%$keyword%";
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id AND product_keywords LIKE ?", "s", [$search]);
	}
	while ($row = mysqli_fetch_array($result)) {
		$pid = intval($row['product_id']);
		$title = h($row['product_title']);
		$price = h($row['product_price']);
		$image = h($row['product_image']);
		$cat = h($row['cat_title']);
		echo "<div class='col-md-4 col-xs-6'>
			<a href='product.php?p=$pid'><div class='product'>
				<div class='product-img'>
					<img src='product_images/$image' style='max-height:170px;' alt='$title'>
					<div class='product-label'><span class='sale'>-30%</span><span class='new'>NEW</span></div>
				</div></a>
				<div class='product-body'>
					<p class='product-category'>$cat</p>
					<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pid'>$title</a></h3>
					<h4 class='product-price header-cart-item-info'>\$$price<del class='product-old-price'>\$990.00</del></h4>
					<div class='product-rating'>
						<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
					</div>
					<div class='product-btns'>
						<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
						<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
						<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
					</div>
				</div>
				<div class='add-to-cart'>
					<button pid='$pid' id='product' href='#' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
				</div>
			</div>
		</div>";
	}
}
?>
