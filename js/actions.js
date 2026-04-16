$(document).ready(function(){
	cat();
	cathome();
	brand();
	product();
	producthome();
	gethomeproduts();

	// Fetch categories for store sidebar
	function cat(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {category:1},
			success: function(data){
				$("#get_category").html(data);
			}
		})
	}

	// Fetch categories for home navigation
	function cathome(){
		$.ajax({
			url: "homeaction.php",
			method: "POST",
			data: {categoryhome:1},
			success: function(data){
				$("#get_category_home").html(data);
			}
		})
	}

	// Fetch brands for store sidebar
	function brand(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {brand:1},
			success: function(data){
				$("#get_brand").html(data);
			}
		})
	}

	// Fetch products for store page
	function product(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {getProduct:1},
			success: function(data){
				$("#get_product").html(data);
			}
		})
	}

	// Fetch featured products for home
	function gethomeproduts(){
		$.ajax({
			url: "homeaction.php",
			method: "POST",
			data: {gethomeProduct:1},
			success: function(data){
				$("#get_home_product").html(data);
			}
		})
	}

	// Fetch product widgets for sidebar
	function producthome(){
		$.ajax({
			url: "homeaction.php",
			method: "POST",
			data: {getProducthome:1},
			success: function(data){
				$("#get_product_home").html(data);
			}
		})
	}

	// ========== CATEGORY FILTER (Store Sidebar) ==========
	$("body").delegate(".category","click",function(event){
		event.preventDefault();
		$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
		$(".category").removeClass("active");
		$(this).addClass("active");
		$(".selectBrand").removeClass("active");
		var cid = $(this).attr('cid');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {get_seleted_Category:1, cat_id:cid},
			success: function(data){
				$("#get_product").html(data);
				scrollToProducts();
			}
		})
	})

	// ========== CATEGORY FILTER (Home Nav) ==========
	$("body").delegate(".categoryhome","click",function(event){
		event.preventDefault();
		$("#get_category_home .main-nav li").removeClass("active");
		$(this).addClass("active");
		var cid = $(this).attr('cid');
		window.location.href = "store.php";
	})

	// ========== BRAND FILTER ==========
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
		$(".selectBrand").removeClass("active");
		$(this).addClass("active");
		$(".category").removeClass("active");
		var bid = $(this).attr('bid');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {selectBrand:1, brand_id:bid},
			success: function(data){
				$("#get_product").html(data);
				scrollToProducts();
			}
		})
	})

	// ========== PRICE FILTER ==========
	$("body").delegate("#price-min, #price-max","change",function(){
		var min = $("#price-min").val() || 0;
		var max = $("#price-max").val() || 999999;
		if (parseFloat(min) > parseFloat(max)) return;
		$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
		$(".category").removeClass("active");
		$(".selectBrand").removeClass("active");
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {priceFilter:1, minPrice:min, maxPrice:max},
			success: function(data){
				$("#get_product").html(data);
			}
		})
	})

	// ========== SEARCH ==========
	$("#search_btn").click(function(){
		doSearch();
	})

	// Enter key support for search
	$("#search").keypress(function(e){
		if(e.which == 13){
			e.preventDefault();
			doSearch();
		}
	})

	function doSearch(){
		var keyword = $("#search").val().trim();
		if(keyword != ""){
			$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
			$(".category").removeClass("active");
			$(".selectBrand").removeClass("active");
			$.ajax({
				url: "action.php",
				method: "POST",
				data: {search:1, keyword:keyword},
				success: function(data){
					// If on homepage, redirect to store
					if($("#get_product").length === 0){
						window.location.href = "store.php";
					} else {
						$("#get_product").html(data);
						scrollToProducts();
					}
				}
			})
		}
	}

	// ========== SORT ==========
	$("body").delegate(".store-sort .input-select","change",function(){
		var sortVal = $(this).val();
		if(sortVal == "" || sortVal == "0") return;
		$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {sortProducts:1, sortBy:sortVal},
			success: function(data){
				$("#get_product").html(data);
			}
		})
	})

	// ========== SHOW ALL / RESET FILTERS ==========
	$("body").delegate("#reset-filters","click",function(event){
		event.preventDefault();
		$(".category").removeClass("active");
		$(".selectBrand").removeClass("active");
		$("#price-min").val("");
		$("#price-max").val("");
		$("#search").val("");
		product();
	})

	// ========== LOGIN ==========
	$("#login").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "login.php",
			method: "POST",
			data: $(this).serialize(),
			success: function(data){
				if(data == "login_success"){
					window.location.href = "index.php";
				}else if(data == "cart_login"){
					window.location.href = "cart.php";
				}else{
					$("#e_msg").html(data);
					$(".overlay").hide();
				}
			}
		})
	})

	// ========== REGISTER ==========
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "register.php",
			method: "POST",
			data: $(this).serialize(),
			success: function(data){
				$(".overlay").hide();
				if(data == "register_success"){
					window.location.href = "cart.php";
				}else{
					$("#signup_msg").html(data);
				}
			}
		})
	})

	// ========== NEWSLETTER ==========
	$("#offer_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url: "offersmail.php",
			method: "POST",
			data: $(this).serialize(),
			success: function(data){
				$(".overlay").hide();
				$("#offer_msg").html(data);
			}
		})
	})

	// ========== ADD TO CART ==========
	$("body").delegate("#product","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("pid");
		var btn = $(this);
		btn.html('<i class="fa fa-spinner fa-spin"></i> Adding...');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {addToCart:1, proId:pid},
			success: function(data){
				btn.html('<i class="fa fa-check"></i> Added!');
				setTimeout(function(){
					btn.html('<i class="fa fa-shopping-cart"></i> add to cart');
				}, 1500);
				count_item();
				getCartItem();
				$('#product_msg').html(data);
				setTimeout(function(){ $('#product_msg').fadeOut(500, function(){ $(this).html('').show(); }); }, 3000);
			}
		})
	})

	// ========== CART COUNT ==========
	count_item();
	function count_item(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {count_item:1},
			success: function(data){
				$(".badge").html(data);
			}
		})
	}

	// ========== CART DROPDOWN ==========
	getCartItem();
	function getCartItem(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {Common:1, getCartItem:1},
			success: function(data){
				if(data.trim() === ""){
					$("#cart_product").html('<div class="text-center" style="padding:20px;color:#999;"><i class="fa fa-shopping-cart" style="font-size:24px;"></i><p>Your cart is empty</p></div>');
				} else {
					$("#cart_product").html(data);
				}
				net_total();
			}
		})
	}

	// ========== QTY CHANGE ==========
	$("body").delegate(".qty","keyup",function(event){
		event.preventDefault();
		var row = $(this).parent().parent();
		var price = row.find('.price').val();
		var qty = row.find('.qty').val();
		if(isNaN(qty) || qty < 1) qty = 1;
		var total = price * qty;
		row.find('.total').val(total);
		var net_total = 0;
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total: $" + net_total.toFixed(2));
	})

	// ========== REMOVE FROM CART ==========
	$("body").delegate(".remove","click",function(event){
		event.preventDefault();
		var remove = $(this).parent().parent().parent();
		var remove_id = remove.find(".remove").attr("remove_id");
		remove.fadeOut(300);
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {removeItemFromCart:1, rid:remove_id},
			success: function(data){
				$("#cart_msg").html(data);
				count_item();
				getCartItem();
				checkOutDetails();
			}
		})
	})

	// ========== UPDATE CART QTY ==========
	$("body").delegate(".update","click",function(event){
		event.preventDefault();
		var update = $(this).parent().parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {updateCartItem:1, update_id:update_id, qty:qty},
			success: function(data){
				$("#cart_msg").html(data);
				count_item();
				getCartItem();
				checkOutDetails();
			}
		})
	})

	// ========== CHECKOUT DETAILS ==========
	checkOutDetails();
	net_total();

	function checkOutDetails(){
		$('.overlay').show();
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {Common:1, checkOutDetails:1},
			success: function(data){
				$('.overlay').hide();
				if(data.trim() === ""){
					$("#cart_checkout").html('<div class="text-center" style="padding:60px;"><i class="fa fa-shopping-cart" style="font-size:64px;color:#ddd;"></i><h3 style="color:#999;margin-top:15px;">Your cart is empty</h3><p style="color:#aaa;">Browse our products and add items to your cart</p><a href="store.php" class="btn btn-primary" style="margin-top:15px;background:#2B3A67;border:none;">Start Shopping</a></div>');
				} else {
					$("#cart_checkout").html(data);
				}
				net_total();
			}
		})
	}

	// ========== NET TOTAL CALCULATION ==========
	function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent();
			var price = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
		})
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').html("Total: $" + net_total.toFixed(2));
	}

	// ========== PAGINATION ==========
	page();
	function page(){
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {page:1},
			success: function(data){
				$("#pageno").html(data);
			}
		})
	}

	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$("#get_product").html("<div class='text-center' style='padding:40px;'><i class='fa fa-spinner fa-spin fa-2x'></i></div>");
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {getProduct:1, setPage:1, pageNumber:pn},
			success: function(data){
				$("#get_product").html(data);
				scrollToProducts();
			}
		})
	})

	// ========== HELPER: Scroll to products area ==========
	function scrollToProducts(){
		if($("body").width() < 768){
			$('html,body').animate({scrollTop: $("#product-row").offset().top - 100}, 400);
		}
	}

	// ========== SCROLL TO TOP BUTTON ==========
	$("body").append('<a id="scroll-top" href="#" style="display:none;position:fixed;bottom:30px;right:30px;width:45px;height:45px;background:#2B3A67;color:#fff;border-radius:50%;text-align:center;line-height:45px;font-size:18px;z-index:999;box-shadow:0 3px 10px rgba(0,0,0,0.2);transition:all 0.3s;"><i class="fa fa-chevron-up"></i></a>');

	$(window).scroll(function(){
		if($(this).scrollTop() > 300){
			$('#scroll-top').fadeIn(300);
		} else {
			$('#scroll-top').fadeOut(300);
		}
	});

	$("body").delegate("#scroll-top","click",function(e){
		e.preventDefault();
		$('html,body').animate({scrollTop:0}, 500);
	});
})
