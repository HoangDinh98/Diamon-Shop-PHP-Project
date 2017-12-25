<?php
$hostname = "localhost";
$dbname = "diamond_shop";
$db_user = "root";
$db_password = "";

$connect = new mysqli($hostname, $db_user, $db_password, $dbname);
mysqli_set_charset($connect, 'UTF8');

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} else {
//    echo '<script> alert("Connect Successful");</script>';
}
//ob_start();
//mysqli_query("set names 'utf8'");
?>

