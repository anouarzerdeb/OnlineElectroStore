
<div class="main main-raised">
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom:0;">
			<div class="carousel-inner">
				<div class="item active"><img src="img/banner3.jpg" alt="Banner" style="width:100%;"></div>
				<div class="item"><img src="img/banner2.jpg" alt="Banner" style="width:100%;"></div>
				<div class="item"><img src="img/banner4.jpg" alt="Banner" style="width:100%;"></div>
				<div class="item"><img src="img/banner1.jpg" alt="Banner" style="width:100%;"></div>
			</div>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>

	<!-- Shop Categories -->
	<div class="section mainn mainn-raised">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=78"><div class="shop">
						<div class="shop-img"><img src="./img/shop01.png" alt="Laptops"></div>
						<div class="shop-body"><h3>Laptop<br>Collection</h3>
							<a href="product.php?p=78" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div></a>
				</div>
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=72"><div class="shop">
						<div class="shop-img"><img src="./img/shop03.png" alt="Accessories"></div>
						<div class="shop-body"><h3>Accessories<br>Collection</h3>
							<a href="product.php?p=72" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div></a>
				</div>
				<div class="col-md-4 col-xs-6">
					<a href="product.php?p=79"><div class="shop">
						<div class="shop-img"><img src="./img/shop02.png" alt="Cameras"></div>
						<div class="shop-body"><h3>Cameras<br>Collection</h3>
							<a href="product.php?p=79" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div></a>
				</div>
			</div>
		</div>
	</div>

	<!-- New Products -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
								<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
								<li><a data-toggle="tab" href="#tab1">Cameras</a></li>
								<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-12 mainn mainn-raised">
					<div class="row">
						<div class="products-tabs">
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
<?php
include 'db.php';
$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id ORDER BY product_id DESC LIMIT 6");
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$pid = intval($row['product_id']);
		$title = h($row['product_title']);
		$price = h($row['product_price']);
		$image = h($row['product_image']);
		$cat = h($row['cat_title']);
		echo "<div class='product'>
			<a href='product.php?p=$pid'><div class='product-img'>
				<img src='product_images/$image' style='max-height:170px;' alt='$title'>
				<div class='product-label'><span class='sale'>-30%</span><span class='new'>NEW</span></div>
			</div></a>
			<div class='product-body'>
				<p class='product-category'>$cat</p>
				<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pid'>$title</a></h3>
				<h4 class='product-price header-cart-item-info'>\$$price<del class='product-old-price'>\$990.00</del></h4>
				<div class='product-rating'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></div>
				<div class='product-btns'>
					<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
					<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
					<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
				</div>
			</div>
			<div class='add-to-cart'>
				<button pid='$pid' id='product' class='add-to-cart-btn block2-btn-towishlist'><i class='fa fa-shopping-cart'></i> add to cart</button>
			</div>
		</div>";
	}
}
?>
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Hot Deal -->
	<div id="hot-deal" class="section mainn mainn-raised">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<ul class="hot-deal-countdown">
							<li><div><h3>02</h3><span>Days</span></div></li>
							<li><div><h3>10</h3><span>Hours</span></div></li>
							<li><div><h3>34</h3><span>Mins</span></div></li>
							<li><div><h3>60</h3><span>Secs</span></div></li>
						</ul>
						<h2 class="text-uppercase">hot deal this week</h2>
						<p>New Collection Up to 50% OFF</p>
						<a class="primary-btn cta-btn" href="store.php">Shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Top Selling -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Top Selling</h3>
					</div>
				</div>
				<div class="col-md-12 mainn mainn-raised" id="get_home_product">
				</div>
			</div>
		</div>
	</div>
</div>
