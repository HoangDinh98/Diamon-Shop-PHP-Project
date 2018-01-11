<?php

include './include.php';

$quantity = $price = $promotion = $sumprice = $totalmoney = 0;
$product_name = "";

//******************************************
// MINUS PRODUCT
//Get id of product
if (isset($_GET['delete_product_id'])) {
    $product_id = $_GET['delete_product_id'];

    //get quantity of product
    if ($_SESSION["product"]["$product_id"]["quantity"] > 1) {
        $_SESSION['product_num'] -= 1;
        $quantity = --$_SESSION["product"]["$product_id"]["quantity"];
    } else {
        $quantity = 1;
    }

//Caculate sum price of product
    $query_execute = mysqli_query($connect, "SELECT price, promotions.value AS promotion "
            . "FROM products JOIN promotions ON products.promotion_id = promotions.id WHERE products.id = $product_id");
    if (!empty($query_execute)) {
        while ($query_result = mysqli_fetch_array($query_execute)) {
            $price = $query_result['price'];
            $promotion = $query_result['promotion'];
        }
        $sumprice = $quantity * round($price * (1 - $promotion / 100));
    }

//caculate total money
    foreach ($_SESSION["product"] as $key => $value) {
        $query_execute = mysqli_query($connect, "SELECT price, promotions.value AS promotion "
                . "FROM products JOIN promotions ON products.promotion_id = promotions.id WHERE products.id = $key");
        if (!empty($query_execute)) {
            while ($query_result = mysqli_fetch_array($query_execute)) {
                $price = $query_result['price'];
                $promotion = $query_result['promotion'];
            }
            $totalmoney += $value['quantity'] * round($price * (1 - $promotion / 100));
        }
    }

    $result = array(
        'quantity' => $quantity,
        'sumprice' => $sumprice,
        'sumquantity' => $_SESSION['product_num'],
        'totalmoney' => $totalmoney);
    echo json_encode($result);
    die();
}


//******************************************
//******************************************
// PLUS PRODUCT
//Get id of product
if (isset($_GET['add_product_id'])) {
    $product_id = $_GET['add_product_id'];

    //get quantity of product
    if ($_SESSION["product"]["$product_id"]["quantity"] < 50) {
        $_SESSION['product_num'] ++;
        $quantity = ++$_SESSION["product"]["$product_id"]["quantity"];
    } else {
        $quantity = 50;
    }

//Caculate sum price of product
    $query_execute = mysqli_query($connect, "SELECT price, promotions.value AS promotion "
            . "FROM products JOIN promotions ON products.promotion_id = promotions.id WHERE products.id = $product_id");
    if (!empty($query_execute)) {
        while ($query_result = mysqli_fetch_array($query_execute)) {
            $price = $query_result['price'];
            $promotion = $query_result['promotion'];
        }
        $sumprice = $quantity * round($price * (1 - $promotion / 100));
    }

//caculate total money
    foreach ($_SESSION["product"] as $key => $value) {
        $query_execute = mysqli_query($connect, "SELECT price, promotions.value AS promotion "
                . "FROM products JOIN promotions ON products.promotion_id = promotions.id WHERE products.id = $key");
        if (!empty($query_execute)) {
            while ($query_result = mysqli_fetch_array($query_execute)) {
                $price = $query_result['price'];
                $promotion = $query_result['promotion'];
            }
            $totalmoney += $value['quantity'] * round($price * (1 - $promotion / 100));
        }
    }

    $result = array(
        'quantity' => $quantity,
        'sumprice' => $sumprice,
        'sumquantity' => $_SESSION['product_num'],
        'totalmoney' => $totalmoney);
    echo json_encode($result);
    die();
}
//******************************************
//******************************************


//******************************************
// REMOVE PRODUCT
if (isset($_GET['remove_product_id'])) {
    $product_id = $_GET['remove_product_id'];
    $_SESSION['product_num'] -= $_SESSION["product"]["$product_id"]["quantity"];
    unset($_SESSION["product"]["$product_id"]);
    
    $query_execute = mysqli_query($connect, "SELECT name FROM products WHERE id = $product_id");
    $query_result = mysqli_fetch_array($query_execute);
    $product_name = $query_result['name'];
    
//    $_SESSION['notify'] = "Bạn đã xóa sản phẩm khỏi giỏ hàng thành công!";
//    $_SESSION["product"] = array_values($_SESSION["product"]);
    
//    sleep(1);
    $totalmoney = 0;
    foreach ($_SESSION["product"] as $key => $value) {
        $query_execute = mysqli_query($connect, "SELECT price, promotions.value AS promotion "
                . "FROM products JOIN promotions ON products.promotion_id = promotions.id WHERE products.id = $key");
        if (!empty($query_execute)) {
            while ($query_result = mysqli_fetch_array($query_execute)) {
                $price = $query_result['price'];
                $promotion = $query_result['promotion'];
            }
            $totalmoney += $value['quantity'] * round($price * (1 - $promotion / 100));
        }
    }

    $result = array(
        'status' => 1,
        'productname' => $product_name,
        'sumquantity' => $_SESSION['product_num'],
        'totalmoney' => $totalmoney);
    echo json_encode($result);
    die();
}
?>

