<?php

include 'include.php';
?>

<?php

$id = FALSE;
$error_message = 'Vui lòng nhập đúng kiểu dữ liệu yêu cầu';
$name_err = $category_err = $provider_err = $promotion_err = $quantiy_err = $weight_err = $price_err = $is_err = FALSE;
$p_name = $p_category = $p_provider = $p_promotion = $p_quantity = $p_weight = $p_price = $p_description = "";

// Delete product
if (isset($_GET["product_delete_id"])) {
    $product_id = $_GET["product_delete_id"];
    $exe = mysqli_query($connect, "UPDATE products SET is_active = 0 WHERE id = $product_id;");
    if($exe) {
        $_SESSION["notify"] = "Xóa sản phẩm thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa sản phẩm";
    }
    header("Location: productlist.php");
}

///////////////////////////////////////////////////////////////
// Add product
