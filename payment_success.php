<?php
session_start();
if (!isset($_SESSION["uid"])) {
    header("Location: index.php");
    exit();
}

include "db.php";

if (isset($_GET["st"]) && $_GET["st"] == "Completed") {
    $trx_id = h($_GET["tx"] ?? '');
    $cm_user_id = intval($_GET["cm"] ?? 0);

    $query = safe_query($con, "SELECT p_id, qty FROM cart WHERE user_id = ?", "i", [$cm_user_id]);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            safe_query($con,
                "INSERT INTO orders (user_id, product_id, qty, trx_id, p_status) VALUES (?, ?, ?, ?, 'Completed')",
                "iiis", [$cm_user_id, intval($row["p_id"]), intval($row["qty"]), $trx_id]
            );
        }
        safe_query($con, "DELETE FROM cart WHERE user_id = ?", "i", [$cm_user_id]);
    } else {
        header("Location: index.php");
        exit();
    }
}

include "header.php";
?>
<div class="section main main-raised">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-top:30px;">
                    <div class="panel-body text-center" style="padding:40px;">
                        <i class="fa fa-check-circle" style="font-size:60px;color:#4CAF50;"></i>
                        <h2>Thank You!</h2>
                        <hr/>
                        <p>Hello <b><?php echo h($_SESSION["name"] ?? ''); ?></b>, your payment was processed successfully.</p>
                        <?php if (!empty($trx_id)): ?>
                            <p>Transaction ID: <b><?php echo $trx_id; ?></b></p>
                        <?php endif; ?>
                        <a href="store.php" class="btn btn-success btn-lg" style="margin-top:20px;">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "newsletter.php";
include "footer.php";
?>
