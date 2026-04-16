<?php
include "header.php";
include "db.php";

$product_id = intval($_GET['p'] ?? 0);
if ($product_id < 1) {
    header("Location: store.php");
    exit();
}
?>
<div class="section main main-raised">
    <div class="container">
        <div class="row">
<?php
$result = safe_query($con, "SELECT * FROM products WHERE product_id = ?", "i", [$product_id]);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $title = h($row['product_title']);
    $price = h($row['product_price']);
    $image = h($row['product_image']);
    $pid = intval($row['product_id']);
?>
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="product-preview">
                        <img src="product_images/<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="col-md-2 col-md-pull-5">
                <div id="product-imgs">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="product-preview">
                        <img src="product_images/<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="col-md-5">
                <div id="product_msg"></div>
                <div class="product-details">
                    <h2 class="product-name"><?php echo $title; ?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#review-form">10 Review(s) | Add your review</a>
                    </div>
                    <div>
                        <h3 class="product-price">$<?php echo $price; ?> <del class="product-old-price">$990.00</del></h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p>High quality product with excellent features and performance. Browse our store for more options.</p>

                    <div class="product-options">
                        <label>Size <select class="input-select"><option value="0">X</option></select></label>
                        <label>Color <select class="input-select"><option value="0">Red</option></select></label>
                    </div>

                    <div class="add-to-cart">
                        <div class="qty-label">
                            Qty
                            <div class="input-number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <div class="btn-group" style="margin-left:25px;margin-top:15px">
                            <button class="add-to-cart-btn" pid="<?php echo $pid; ?>" id="product"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- Product tabs -->
            <div class="col-md-12">
                <div id="product-tab">
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                        <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row"><div class="col-md-12">
                                <p>Premium quality product designed with attention to detail. Built for durability and performance.</p>
                            </div></div>
                        </div>
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row"><div class="col-md-12">
                                <p>Detailed specifications and technical information available upon request.</p>
                            </div></div>
                        </div>
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg"><span>4.5</span>
                                            <div class="rating-stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">Customer</h5>
                                                    <p class="date">Recent</p>
                                                    <div class="review-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o empty"></i></div>
                                                </div>
                                                <div class="review-body"><p>Great product, highly recommended!</p></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 mainn">
                                    <div id="review-form">
                                        <form class="review-form">
                                            <input class="input" type="text" placeholder="Your Name">
                                            <input class="input" type="email" placeholder="Your Email">
                                            <textarea class="input" placeholder="Your Review"></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
    $_SESSION['product_id'] = $pid;
}
?>
        </div>
    </div>
</div>

<!-- Related Products -->
<div class="section main main-raised">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center"><h3 class="title">Related Products</h3></div>
            </div>
<?php
$result = safe_query($con, "SELECT * FROM products, categories WHERE product_cat = cat_id AND product_id BETWEEN ? AND ? AND product_id != ?", "iii", [$product_id, $product_id + 4, $product_id]);
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
                    <div class='product-label'><span class='sale'>-30%</span><span class='new'>NEW</span></div>
                </div></a>
                <div class='product-body'>
                    <p class='product-category'>$cat</p>
                    <h3 class='product-name header-cart-item-name'><a href='product.php?p=$pid'>$title</a></h3>
                    <h4 class='product-price header-cart-item-info'>\$$price<del class='product-old-price'>\$990.00</del></h4>
                    <div class='product-rating'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></div>
                </div>
                <div class='add-to-cart'>
                    <button pid='$pid' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> add to cart</button>
                </div>
            </div>
        </div>";
    }
}
?>
        </div>
    </div>
</div>
<?php
include "newsletter.php";
include "footer.php";
?>
