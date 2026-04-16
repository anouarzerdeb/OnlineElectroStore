<?php
include 'header.php';
?>
<div class="main main-raised">
	<div class="section">
		<div class="container">
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<div id="get_category"></div>
					<div class="aside">
						<h3 class="aside-title">Price</h3>
						<div class="price-filter">
							<div id="price-slider"></div>
							<div class="input-number price-min">
								<input id="price-min" type="number" placeholder="Min">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input id="price-max" type="number" placeholder="Max">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
					</div>
					<div id="get_brand"></div>
					<div class="aside" style="text-align:center;">
						<a href="#" id="reset-filters" class="btn btn-block" style="background:#E85D75;color:#fff;border-radius:6px;">
							<i class="fa fa-refresh"></i> Show All Products
						</a>
					</div>
					<div class="aside">
						<h3 class="aside-title">Top Selling</h3>
						<div id="get_product_home"></div>
					</div>
				</div>
				<!-- /ASIDE -->

				<!-- STORE -->
				<div id="store" class="col-md-9">
					<div class="store-filter clearfix">
						<div class="store-sort">
							<label>Sort By:
								<select class="input-select">
									<option value="">Default</option>
									<option value="price_low">Price: Low to High</option>
									<option value="price_high">Price: High to Low</option>
									<option value="newest">Newest First</option>
								</select>
							</label>
						</div>
						<ul class="store-grid">
							<li class="active"><i class="fa fa-th"></i></li>
							<li><a href="#"><i class="fa fa-th-list"></i></a></li>
						</ul>
					</div>

					<div id="cart_msg"></div>

					<div class="row" id="product-row">
						<div class="col-md-12 col-xs-12" id="product_msg"></div>
						<div id="get_product">
							<div class="text-center" style="padding:40px;">
								<i class="fa fa-spinner fa-spin fa-2x"></i>
							</div>
						</div>
					</div>

					<div class="store-filter clearfix">
						<ul class="store-pagination" id="pageno"></ul>
					</div>
				</div>
				<!-- /STORE -->
			</div>
		</div>
	</div>
</div>
<?php
include "newsletter.php";
include "footer.php";
?>
