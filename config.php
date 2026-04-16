
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'ecommerce');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $stmt = mysqli_prepare($db, "SELECT * FROM register WHERE Name=? OR email=? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);

  if ($user) { // if user exists
    if ($user['Name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_DEFAULT);

  	$stmt = mysqli_prepare($db, "INSERT INTO register (Name, email, password) VALUES(?, ?, ?)");
  	mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
  	mysqli_stmt_execute($stmt);
  	mysqli_stmt_close($stmt);
  	$_SESSION['Name'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$stmt = mysqli_prepare($db, "SELECT * FROM register WHERE email=? LIMIT 1");
  	mysqli_stmt_bind_param($stmt, "s", $username);
  	mysqli_stmt_execute($stmt);
  	$results = mysqli_stmt_get_result($stmt);
  	if (mysqli_num_rows($results) == 1) {
  	  $row = mysqli_fetch_assoc($results);
  	  if (password_verify($password, $row['password'])) {
  	    $_SESSION['email'] = $username;
  	    $_SESSION['success'] = "You are now logged in";
  	    header('location: index.php');
  	  } else {
  	    array_push($errors, "Wrong username/password combination");
  	  }
  	} else {
  		array_push($errors, "Wrong username/password combination");
  	}
  	mysqli_stmt_close($stmt);
  }
}

?>