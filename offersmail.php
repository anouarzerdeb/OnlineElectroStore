<?php
session_start();
include "db.php";

if (isset($_POST["email"])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please enter your email!</b></div>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please enter a valid email address!</b></div>";
        exit();
    }

    $result = safe_query($con, "SELECT email_id FROM email_info WHERE email = ? LIMIT 1", "s", [$email]);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email is already subscribed</b></div>";
        exit();
    }

    safe_query($con, "INSERT INTO email_info (email_id, email) VALUES (NULL, ?)", "s", [$email]);
    echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Thanks for subscribing!</b></div>";
}
?>
