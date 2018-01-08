<?php

include 'include.php';
?>

<?php

// Delete product
if (isset($_GET["product_delete_id"])) {
    $product_id = $_GET["product_delete_id"];
    $exe = mysqli_query($connect, "UPDATE products SET is_active = 0 WHERE id = $product_id;");
    if ($exe) {
        $_SESSION["notify"] = "Xóa sản phẩm thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa sản phẩm";
    }
    if (isset($_GET['page'])) {
        $page_return = $_GET['page'];
    }
    header("Location: products.php?page=$page_return");
}

///////////////////////////////////////////////////////////////
// Delete Category
if (isset($_GET["category_delete_id"])) {
    $category_id = $_GET["category_delete_id"];
    $exe = mysqli_query($connect, "UPDATE categories SET is_active = 0 WHERE id = $category_id;");
    if ($exe) {
        $_SESSION["notify"] = "Xóa danh mục thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa danh mục";
    }
    if (isset($_GET['page'])) {
        $page_return = $_GET['page'];
    }
    header("Location: categories.php?page=$page_return");
}

///////////////////////////////////////////////////////////////
// Delete Promotion
if (isset($_GET["promotion_delete_id"])) {
    $promotion_id = $_GET["promotion_delete_id"];
    $exe = mysqli_query($connect, "UPDATE promotions SET is_active = 0 WHERE id = $promotion_id;");
    if ($exe) {
        $_SESSION["notify"] = "Xóa thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa";
    }
    if (isset($_GET['page'])) {
        $page_return = $_GET['page'];
    }
    header("Location: promotions.php?page=$page_return");
}

///////////////////////////////////////////////////////////////
// Delete Provider
if (isset($_GET["provider_delete_id"])) {
    $provider_id = $_GET["provider_delete_id"];
    $exe = mysqli_query($connect, "UPDATE providers SET is_active = 0 WHERE id = $provider_id;");
    if ($exe) {
        $_SESSION["notify"] = "Xóa thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa";
    }
    if (isset($_GET['page'])) {
        $page_return = $_GET['page'];
    }
    header("Location: providers.php?page=$page_return");
}

///////////////////////////////////////////////////////////////
// Delete user
if (isset($_GET["user_delete_id"])) {
    $user_id = $_GET["user_delete_id"];
    $exe = mysqli_query($connect, "UPDATE users SET is_active = 0 WHERE id = $user_id;");
    if ($exe) {
        $_SESSION["notify"] = "Xóa thành công";
    } else {
        $_SESSION["notify"] = "Đã xảy ra lỗi khi xóa";
    }
    if (isset($_GET['page'])) {
        $page_return = $_GET['page'];
    }
    header("Location: users.php?page=$page_return");
}


?>




