<?php
if (!isset($con)) {
    $servername = "db";
    $username = "db";
    $password = "db";
    $database = "db";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($con, "utf8mb4");
}

if (!function_exists('safe_query')) {
    function safe_query($con, $sql, $types = "", $params = []) {
        $stmt = mysqli_prepare($con, $sql);
        if ($types && $params) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }

    function h($str) {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}
?>
