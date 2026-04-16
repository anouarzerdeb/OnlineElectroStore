<?php
if (isset($_POST["login_user_with_product"])) {
	$product_list = $_POST["product_id"];
	$json_e = json_encode($product_list);
	setcookie("product_list", $json_e, strtotime("+1 day"), "/", "", "", TRUE);
}
?>
<div class="container-fluid">
	<div class="login-marg">
		<form onsubmit="return false" id="login" class="login100-form">
			<div class="billing-details jumbotron">
				<div class="section-title"><h2 class="login100-form-title">Login</h2></div>
				<div class="form-group">
					<label for="login_email">Email</label>
					<input class="input input-borders" type="email" name="email" placeholder="Email" id="login_email" required>
				</div>
				<div class="form-group">
					<label for="login_password">Password</label>
					<input class="input input-borders" type="password" name="password" placeholder="Password" id="login_password" required>
				</div>
				<input class="primary-btn btn-block" type="submit" value="Login">
				<div class="panel-footer" style="margin-top:15px;"><div id="e_msg"></div></div>
			</div>
		</form>
	</div>
</div>
