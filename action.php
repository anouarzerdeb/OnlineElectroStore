<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

// Get categories for sidebar
if (isset($_POST["category"])) {
	$result = safe_query($con, "SELECT * FROM categories");
	echo "<div class='aside'><h3 class='aside-title'>Categories</h3><div class='btn-group-vertical'>";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$cid = intval($row["cat_id"]);
			$cat_name = h($row["cat_title"]);
			$count_result = safe_query($con, "SELECT COUNT(*) AS count_items FROM products WHERE product_cat = ?", "i", [$cid]);
			$count_row = mysqli_fetch_array($count_result);
			$count = $count_row["count_items"];
			echo "<div type='button' class='btn navbar-btn category' cid='$cid'>
				<a href='#'><span></span> $cat_name <small class='qty'>($count)</small></a>
			</div>";
		}
		echo "</div>";
	}
}

// Get brands for sidebar
if (isset($_POST["brand"])) {
	$result = safe_query($con, "SELECT * FROM brands");
	echo "<div class='aside'><h3 class='aside-title'>Brand</h3><div class='btn-group-vertical'>";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$bid = intval($row["brand_id"]);
			$brand_name = h($row["brand_title"]);
			$count_result = safe_query($con, "SELECT COUNT(*) AS count_items FROM products WHERE product_brand = ?", "i", [$bid]);
			$count_row = mysqli_fetch_array($count_result);
			$count = $count_row["count_items"];
			echo "<div type='button' class='btn navbar-btn selectBrand' bid='$bid'>
				<a href='#'><span></span> $brand_name <small>($count)</small></a>
			</div>";
		}
		echo "</div>";
	}
}

// Pagination
if (isset($_POST["page"])) {
	$result = safe_query($con, "SELECT COUNT(*) AS total FROM products");
	$row = mysqli_fetch_array($result);
	$pageno = ceil($row["total"] / 9);
	for ($i = 1; $i <= $pageno; $i++) {
		echo "<li><a href='#product-row' page='$i' id='page' class='active'>$i</a></li>";
	}
}

// Get products (with pagination)
if (isset($_POST["getProduct"])) {
	$limit = 9;
	$start = 0;
	if (isset($_POST["setPage"])) {
		$pageno = intval($_POST["pageNumber"]);
		$start = ($pageno * $limit) - $limit;
	}
	$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id LIMIT ?, ?", "ii", [$start, $limit]);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			echo_product_card($row);
		}
	}
}

// Filter by category, brand, search, or price
if (isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"]) || isset($_POST["priceFilter"])) {
	if (isset($_POST["get_seleted_Category"])) {
		$id = intval($_POST["cat_id"]);
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = ? AND product_cat = cat_id", "i", [$id]);
	} elseif (isset($_POST["selectBrand"])) {
		$id = intval($_POST["brand_id"]);
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_brand = ? AND product_cat = cat_id", "i", [$id]);
	} elseif (isset($_POST["priceFilter"])) {
		$min = floatval($_POST["minPrice"] ?? 0);
		$max = floatval($_POST["maxPrice"] ?? 999999);
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id AND product_price BETWEEN ? AND ? ORDER BY product_price ASC", "dd", [$min, $max]);
	} else {
		$keyword = trim($_POST["keyword"]);
		$search = "%$keyword%";
		$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id AND (product_keywords LIKE ? OR product_title LIKE ?)", "ss", [$search, $search]);
	}
	$count = 0;
	while ($row = mysqli_fetch_array($result)) {
		echo_product_card($row);
		$count++;
	}
	if ($count === 0) {
		echo "<div class='col-md-12 text-center' style='padding:40px;'><i class='fa fa-search' style='font-size:48px;color:#ccc;'></i><h3 style='color:#999;'>No products found</h3><p style='color:#aaa;'>Try adjusting your filters or search terms</p></div>";
	}
}

// Sort products
if (isset($_POST["sortProducts"])) {
	$sort = $_POST["sortBy"] ?? "popular";
	switch ($sort) {
		case "price_low": $order = "product_price ASC"; break;
		case "price_high": $order = "product_price DESC"; break;
		case "newest": $order = "product_id DESC"; break;
		default: $order = "product_id ASC";
	}
	$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id ORDER BY $order");
	while ($row = mysqli_fetch_array($result)) {
		echo_product_card($row);
	}
}

// Add to cart
if (isset($_POST["addToCart"])) {
	$p_id = intval($_POST["proId"]);

	if (isset($_SESSION["uid"])) {
		$user_id = intval($_SESSION["uid"]);
		$check = safe_query($con, "SELECT * FROM cart WHERE p_id = ? AND user_id = ?", "ii", [$p_id, $user_id]);
		if (mysqli_num_rows($check) > 0) {
			echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product is already in your cart!</b></div>";
		} else {
			safe_query($con, "INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES (?, ?, ?, 1)", "isi", [$p_id, $ip_add, $user_id]);
			echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product added to cart!</b></div>";
		}
	} else {
		$check = safe_query($con, "SELECT id FROM cart WHERE ip_add = ? AND p_id = ? AND user_id = -1", "si", [$ip_add, $p_id]);
		if (mysqli_num_rows($check) > 0) {
			echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product is already in your cart!</b></div>";
			exit();
		}
		safe_query($con, "INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES (?, ?, -1, 1)", "is", [$p_id, $ip_add]);
		echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product added to cart!</b></div>";
		exit();
	}
}

// Count cart items
if (isset($_POST["count_item"])) {
	if (isset($_SESSION["uid"])) {
		$uid = intval($_SESSION["uid"]);
		$result = safe_query($con, "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = ?", "i", [$uid]);
	} else {
		$result = safe_query($con, "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = ? AND user_id < 0", "s", [$ip_add]);
	}
	$row = mysqli_fetch_array($result);
	echo $row["count_item"];
	exit();
}

// Get cart items (dropdown + checkout page)
if (isset($_POST["Common"])) {
	if (isset($_SESSION["uid"])) {
		$uid = intval($_SESSION["uid"]);
		$query = safe_query($con, "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty FROM products a, cart b WHERE a.product_id = b.p_id AND b.user_id = ?", "i", [$uid]);
	} else {
		$query = safe_query($con, "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty FROM products a, cart b WHERE a.product_id = b.p_id AND b.ip_add = ? AND b.user_id < 0", "s", [$ip_add]);
	}

	// Dropdown cart items
	if (isset($_POST["getCartItem"])) {
		if (mysqli_num_rows($query) > 0) {
			$n = 0;
			$total_price = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$total_price += $row["product_price"];
				echo '<div class="product-widget">
					<div class="product-img"><img src="product_images/' . h($row["product_image"]) . '" alt="' . h($row["product_title"]) . '"></div>
					<div class="product-body">
						<h3 class="product-name"><a href="#">' . h($row["product_title"]) . '</a></h3>
						<h4 class="product-price"><span class="qty">' . $n . '</span>$' . h($row["product_price"]) . '</h4>
					</div>
				</div>';
			}
			echo '<div class="cart-summary"><small class="qty">' . $n . ' Item(s) selected</small><h5>$' . $total_price . '</h5></div>';
			exit();
		}
	}

	// Checkout details (cart page)
	if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			echo '<div class="main"><div class="table-responsive">
			<form method="post" action="login_form.php">
			<table id="cart" class="table table-hover table-condensed">
			<thead><tr>
				<th style="width:50%">Product</th>
				<th style="width:10%">Price</th>
				<th style="width:8%">Quantity</th>
				<th style="width:7%" class="text-center">Subtotal</th>
				<th style="width:10%"></th>
			</tr></thead><tbody>';

			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$pid = intval($row["product_id"]);
				$title = h($row["product_title"]);
				$price = h($row["product_price"]);
				$image = h($row["product_image"]);
				$cart_id = intval($row["id"]);
				$qty = intval($row["qty"]);

				echo '<tr>
					<td data-th="Product"><div class="row">
						<div class="col-sm-4"><img src="product_images/' . $image . '" style="height:70px;width:75px;" alt="' . $title . '"/>
						<h4 class="nomargin product-name header-cart-item-name"><a href="product.php?p=' . $pid . '">' . $title . '</a></h4></div>
					</div></td>
					<input type="hidden" name="product_id[]" value="' . $pid . '"/>
					<td data-th="Price"><input type="text" class="form-control price" value="' . $price . '" readonly></td>
					<td data-th="Quantity"><input type="text" class="form-control qty" value="' . $qty . '"></td>
					<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="' . $price . '" readonly></td>
					<td class="actions" data-th="">
						<div class="btn-group">
							<a href="#" class="btn btn-info btn-sm update" update_id="' . $pid . '"><i class="fa fa-refresh"></i></a>
							<a href="#" class="btn btn-danger btn-sm remove" remove_id="' . $pid . '"><i class="fa fa-trash-o"></i></a>
						</div>
					</td>
				</tr>';
			}

			echo '</tbody><tfoot><tr>
				<td><a href="store.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
				<td colspan="2" class="hidden-xs"></td>
				<td class="hidden-xs text-center"><b class="net_total"></b></td>
				<td>';

			if (!isset($_SESSION["uid"])) {
				echo '<a href="" data-toggle="modal" data-target="#Modal_register" class="btn btn-success">Ready to Checkout</a></td>
				</tr></tfoot></table></div></div>';
			} else {
				echo '</form>
				<form action="checkout.php" method="post">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="upload" value="1">';

				$uid = intval($_SESSION["uid"]);
				$cart_query = safe_query($con, "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty FROM products a, cart b WHERE a.product_id = b.p_id AND b.user_id = ?", "i", [$uid]);
				$x = 0;
				while ($cart_row = mysqli_fetch_array($cart_query)) {
					$x++;
					echo '<input type="hidden" name="total_count" value="' . $x . '">
						<input type="hidden" name="item_name_' . $x . '" value="' . h($cart_row["product_title"]) . '">
						<input type="hidden" name="item_number_' . $x . '" value="' . $x . '">
						<input type="hidden" name="amount_' . $x . '" value="' . h($cart_row["product_price"]) . '">
						<input type="hidden" name="quantity_' . $x . '" value="' . intval($cart_row["qty"]) . '">';
				}

				echo '<input type="hidden" name="custom" value="' . $uid . '"/>
					<input type="submit" name="submit" class="btn btn-success" value="Ready to Checkout">
					</form></td></tr></tfoot></table></div></div>';
			}
		}
	}
}

// Remove item from cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = intval($_POST["rid"]);
	if (isset($_SESSION["uid"])) {
		$uid = intval($_SESSION["uid"]);
		safe_query($con, "DELETE FROM cart WHERE p_id = ? AND user_id = ?", "ii", [$remove_id, $uid]);
	} else {
		safe_query($con, "DELETE FROM cart WHERE p_id = ? AND ip_add = ?", "is", [$remove_id, $ip_add]);
	}
	echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product removed from cart</b></div>";
	exit();
}

// Update cart item qty
if (isset($_POST["updateCartItem"])) {
	$update_id = intval($_POST["update_id"]);
	$qty = intval($_POST["qty"]);
	if ($qty < 1) $qty = 1;

	if (isset($_SESSION["uid"])) {
		$uid = intval($_SESSION["uid"]);
		safe_query($con, "UPDATE cart SET qty = ? WHERE p_id = ? AND user_id = ?", "iii", [$qty, $update_id, $uid]);
	} else {
		safe_query($con, "UPDATE cart SET qty = ? WHERE p_id = ? AND ip_add = ?", "iis", [$qty, $update_id, $ip_add]);
	}
	echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Cart updated</b></div>";
	exit();
}

// Helper: render product card
function echo_product_card($row) {
	$pid = intval($row['product_id']);
	$title = h($row['product_title']);
	$price = h($row['product_price']);
	$image = h($row['product_image']);
	$cat = h($row['cat_title']);

	echo "<div class='col-md-4 col-xs-6'>
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
?>
