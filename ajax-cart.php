<?php

include './include.php';

//echo date("Y-m-d H:i:m");

echo var_dump($_SESSION["product"]);
if (isset($_SESSION["product"])) {
    foreach ($_SESSION["product"] AS $key => $value) {
        echo 'ID = '.$key . '     Quantity = ' . $value['quantity'] . '<br>';
    }
    echo 'Total: '.$_SESSION["product_num"];
} else {
    echo 'Không có sản phẩm nào trong giỏ hàng';
}
if(isset($_SESSION["notify"])) {
    echo $_SESSION["notify"];
}
?>

