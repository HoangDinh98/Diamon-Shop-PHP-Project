<?php
include './include.php';

$is_exist = 0;
if (!isset($_SESSION["product"])) {
    $_SESSION["product_num"] = 1;
} else {
    $_SESSION["product_num"] +=1;
}
if (isset($_SESSION["product"])) {
    foreach ($_SESSION["product"] AS $id => $quantity) {
        if ($id == $_GET["pid"]) {
            $_SESSION["product"]["$id"]["quantity"] += 1;
            $is_exist = 1;
        }
    }
}

if ($is_exist == 0) {
    $pid = $_GET["pid"];
    $_SESSION["product"]["$pid"]["quantity"] = 1;
//    $promotion = (int) $_GET["promotion"];
//    $_SESSION["product"]["$pid"]["promotion"] = $promotion;
}

//foreach ($_SESSION["product"] AS $id => $quantity) {
//    if ($id == $_POST["add_cart"]) {
//        $_SESSION["product"]["$id"]["quantity"] += 1;
//        $is_exist = 1;
//    }
//}
//
//if ($is_exist == 0) {
//    $pid = $_POST["add_cart"];
//    $_SESSION["product"]["$pid"]["quantity"] = 1;
//}
?>
<p><?php echo $_SESSION["product_num"]; ?></p>








