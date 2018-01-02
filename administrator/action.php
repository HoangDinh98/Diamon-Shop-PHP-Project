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
// Function test file type. Accept only image file
function test_image_type($filename) {
//    if ($_FILES['avatar']['type'] == "image/jpeg" && $_FILES['image']['type'] = "image/png") {
//        return TRUE;
//    }
    $file_ext = strtolower(end(explode('.', $filename)));

    $expensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

    if (in_array($file_ext, $expensions) === false) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['i'])) {
    $id = intval($_GET['i']);
    $pr = mysqli_query($conn, "select * from products where id = $id");
    $p = mysqli_fetch_array($pr);
    // $ce = $p['category'];
    $pe = $p['price'];
    $de = $p['description'];
    $ne = $p['name'];
    $masp = $p['productcode'];

    // lấy hết tất cả hình ảnh của sản phẩm
    $photo_result = mysqli_query($conn, "select * from photos where product_id = $id");
}

//echo '<script>alert("Q1");</script>';

if (isset($_POST['edit_product_submit'])) {
    echo '<script>alert("Q1");</script>';
    //    Lấy tất cả thông tin sản phẩm từ form
//    $p_name = $_POST['name'];
//    $p_category = trim($_POST['category-child']);
//    $p_provider = $_POST['provider'];
//    $p_promotion = $_POST['promotion'];
//    $p_quatity = $_POST['quantity'];
//    $p_weight = $_POST["weight"];
//    $p_price = $_POST["price"];
//    $p_avatar = $_POST["avatar"];
//    echo var_dump($p_avatar);
//    $p_description = $_POST["description"];

    if (empty($_POST["name"])) {
        $name_err = $is_err = TRUE;
    } else {
        $p_name = standardize_data($_POST["name"]);
    }

    if (empty($_POST["category-child"])) {
        $category_err = $is_err = TRUE;
    } else {
        $p_category = standardize_data($_POST["category-child"]);
    }

    if (empty($_POST["provider"])) {
        $provider_err = $is_err = TRUE;
    } else {
        $p_provider = standardize_data($_POST["provider"]);
    }

    if (empty($_POST["promotion"])) {
        $promotion_err = $is_err = TRUE;
    } else {
        $p_promotion = standardize_data($_POST["promotion"]);
    }

    if (empty($_POST["quantity"])) {
        $quantiy_err = $is_err = TRUE;
    } else {
        $p_quantity = standardize_data($_POST["quantity"]);
    }

    if (empty($_POST["weight"])) {
        $weight_err = $is_err = TRUE;
    } else {
        $p_weight = standardize_data($_POST["weight"]);
    }

    if (empty($_POST["price"])) {
        $price_err = $is_err = TRUE;
    } else {
        $p_price = standardize_data($_POST["price"]);
    }

    if (!empty($_POST["description"])) {
        $p_description = standardize_data($_POST["description"]);
    }


//    If data is validation page will direct to action.php
    if ($is_err) {
        header("Location: ./create-product.php");
    } else {

        if ($id) {
            $d = mysqli_escape_string($conn, $d);
            mysqli_query($conn, "update products set
                                                                                        name='$n',
                                                                                        categoryid='$c',
                                                                                        price='$p',
                                                                                        description='$d',
                                                                                        productcode='$pc'
                                                                                where id = $id	
                                                                                        ");
            $pid = $id;
            $r = '';
            if (!is_dir("../productimages/$c"))
                mkdir("../productimages/$c", 0777, true);
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $sub_folder = $c . '/' . $pid . '/' . $year . '/' . $month . '/' . $day;
            $upload_url = 'productimages/' . $sub_folder;


            $pdir = "../productimages/" . $sub_folder;

            if (!is_dir("../productimages/" . $sub_folder))
                if (!mkdir("../productimages/" . $sub_folder, 0777, true))
                    return FALSE;

            if (isset($_FILES['image'])) {
                $thumb_width = 150;
                $file_type = $_FILES['image']['type'];
                if ($_FILES['image']['type'] = "image/jpeg" && $_FILES['image']['type'] = "image/png") {

                    $ext = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
                    $image_name = time() . '.' . $ext;
                    $img1 = "$pdir/$image_name";
                    move_uploaded_file($_FILES['image']['tmp_name'], $img1);
                    /*
                     * insert into photos table
                     */
                    mysqli_query($conn, "insert into photos(path,product_id,is_thumbnail,created_date) 
                                                  values('$upload_url/$image_name','$pid','0',now())
                                                        ");
                }
            }

            header("location: products.php");
        } else {
            $query = "INSERT INTO products(name, category_id, provider_id, promotion_id, quantity, weight, price, is_active, description)"
                    . "VALUES ('$p_name','$p_category','$p_provider','$p_promotion','$p_quatity', '$p_weight', '$p_price', '1', '$p_description')";

            mysqli_query($connect, "INSERT INTO products(name, category_id, provider_id, promotion_id, quantity, weight, price, is_active, description)"
                    . "VALUES ('$p_name','$p_category','$p_provider','$p_promotion','$p_quatity', '$p_weight', '$p_price', '1', '$p_description')");

            $p_id = mysqli_insert_id($connect);

            //	echo $pid;
//        $thumb_width = 150;
            //$thumb_height=100;

            if (!is_dir("../asset/images/product/$p_category"))
                mkdir("../asset/images/product/$p_category", 0777, true);
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $sub_folder = $p_category . '/' . $p_id . '/' . $year . '/' . $month . '/' . $day;
            $upload_url = 'asset/images/product/' . $sub_folder;


            $pdir = "../asset/images/product/" . $sub_folder;

            if (!is_dir("../asset/images/product/" . $sub_folder))
                if (!mkdir("../asset/images/product/" . $sub_folder, 0777, true))
                    return FALSE;

            if (isset($_FILES['avatar'])) {
                $thumb_width = 150;
                $file_type = $_FILES['avatar']['type'];
                if (test_image_type($_FILES['avatar']['name'])) {
                    $ext = substr($_FILES['avatar']['name'], strrpos($_FILES['avatar']['name'], '.') + 1);
//                Set name for image follow the time HHMMSS
//                $format = "%H%M%S";
//                $timestamp = time();
//                echo $strTime = strftime($format, $timestamp);
                    $image_name = strftime("%H%M%S", time()) . '.' . $ext;

//                $image_name = time() . '.' . $ext;
                    $img1 = "$pdir/$image_name";
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $img1);
                    /*
                     * insert into photos table
                     */
                    mysqli_query($connect, "INSERT INTO images(path,product_id,is_thumbnail)"
                            . "VALUES('./$upload_url/$image_name','$p_id','1')");
                }
            } else {
                echo "Image error";
            }

            header("location: productlist.php");
            //$im = "images_upload/".$_FILES['image']['name'];
        }
    }
//   //////////////////////////////////////////
//   //////////////////////////////////////////
//   ////////////////////////////////////////////
//    Update product
}
?>

