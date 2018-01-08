<?php
include 'include.php';
$_SESSION['task'] = 'products';
include 'header.php';
//include 'action.php';
//include 'footer.php';
$ce = $pe = $de = $ne = $masp = $msg = '';
?>

<?php
$id = "";
$page_return = 1;
$image_is_exist = $avatar_is_delete = 0;
$error_message = 'Vui lòng nhập đúng kiểu dữ liệu yêu cầu';
$name_err = $category_err = $provider_err = $promotion_err = $quantiy_err = $weight_err = $price_err = $avatar_err = $is_err = FALSE;

$p_name = $parent_id = $p_category = $p_provider = $p_promotion = $p_quantity = $p_weight = $p_price = $p_description = "";

///////////////////////////////////////////////////////////////
// Add product
// Function test file type. Accept only image file
function test_image_type($filename) {
//    if ($_FILES['avatar']['type'] == "image/jpeg" && $_FILES['image']['type'] = "image/png") {
//        return TRUE;
//    }
    $f1 = explode('.', $filename);
    $file_ext = strtolower(end($f1));

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

function addImage($connect, $input_name, $category_id, $product_id, $extend_name, $is_thumbnail) {
//    $pid = $product_id;
    if (!is_dir("../asset/images/product/$category_id"))
        mkdir("../asset/images/product/$category_id", 0777, true);
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $sub_folder = $category_id . '/' . $product_id . '/' . $year . '/' . $month . '/' . $day;
    $upload_url = 'asset/images/product/' . $sub_folder;


    $pdir = "../asset/images/product/" . $sub_folder;

    if (!is_dir("../asset/images/product/" . $sub_folder))
        if (!mkdir("../asset/images/product/" . $sub_folder, 0777, true))
            return FALSE;

    $file_type = $_FILES[$input_name]['type'];
    if (test_image_type($_FILES[$input_name]['name'])) {
        $ext = substr($_FILES[$input_name]['name'], strrpos($_FILES[$input_name]['name'], '.') + 1);
//                Set name for image follow the time HHMMSS
        $image_name = strftime("%H%M%S", time()) . $extend_name . '.' . $ext;

//                $image_name = time() . '.' . $ext;
        $img1 = "$pdir/$image_name";
        move_uploaded_file($_FILES[$input_name]['tmp_name'], $img1);
        /*
         * insert into photos table
         */
        mysqli_query($connect, "INSERT INTO images(path,product_id,is_thumbnail, is_active)"
                . "VALUES('./$upload_url/$image_name','$product_id','$is_thumbnail', '1')");
    }
}

if (isset($_GET['pid'])) {
    $id = intval($_GET['pid']);
    $pr = mysqli_query($connect, "SELECT * FROM products WHERE id = '$id'");
    $p = mysqli_fetch_array($pr);
    $p_name = $p['name'];
    $p_category = $p['category_id'];
    $p_provider = $p['provider_id'];
    $p_promotion = $p['promotion_id'];
    $p_quantity = $p['quantity'];
    $p_weight = $p['weight'];
    $p_price = $p['price'];
    $p_description = $p['description'];

    // lấy hết tất cả hình ảnh của sản phẩm
//    $image_result = mysqli_query($connect, "SELECT * FROM images "
//            . "WHERE  product_id = $id AND is_active = 1");
}

if(isset($_GET['page'])) {
    $page_return = $_GET['page'];
//    echo '<script> alert("'.$page_return.'")</script>';
}

//echo '<script>alert("Q1");</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    echo '<script>alert("Q1");</script>';
    //    Lấy tất cả thông tin sản phẩm từ form

    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }

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

    if (empty($_FILES['avatar']['name']) && $id == "") {
        $avatar_err = $is_err = TRUE;
    } elseif ($id != "" && $_POST["delete_avatar_notify"] == 1 && empty($_FILES['avatar']['name'])) {
        $avatar_err = $is_err = TRUE;
        $avatar_is_delete = 1;
    }

    if (!empty($_POST["description"])) {
        $p_description = $_POST["description"];
    }
    
    if(!empty($_POST['page_return'])) {
        $page_return = $_POST['page_return'];
    }


//    If data is validation page will direct to action.php
    if (!$is_err) {
// if this is $id != null, update else insert

        if (isset($id) && $id != "") {
//            Update
//            echo '<script> alert("This is update");</script>';
            $query = "UPDATE products "
                    . "SET category_id='$p_category', provider_id='$p_provider', "
                    . "promotion_id='$p_promotion', name='$p_name', quantity='$p_quantity', "
                    . "weight='$p_weight', price='$p_price', description='$p_description'  "
                    . "WHERE id = '$id'";

//            echo '<script> alert(" SSSS2 ' . $query . '");</script>';

            $_SESSION['notify'] = $query;
            mysqli_query($connect, $query);
            $pid = $id;

            if (!empty($_FILES['avatar']['name'])) {
                addImage($connect, 'avatar', $p_category, $pid, '-avt', 1);
            } else {
                echo "Image Avt error";
            }

            if (!empty($_FILES['image1']['name'])) {
                addImage($connect, 'image1', $p_category, $pid, '-i1', 0);
            } else {
                echo "Image 1 error";
            }

            if (!empty($_FILES['image2']['name'])) {
                addImage($connect, 'image2', $p_category, $pid, '-i2', 0);
            } else {
                echo "Image 2 error";
            }

            if (!empty($_FILES['image3']['name'])) {
                addImage($connect, 'image3', $p_category, $pid, '-i3', 0);
            } else {
                echo "Image 3 error";
            }

            $_SESSION['notify'] = "Cập nhật thông tin sản phẩm thành công";
//            echo '<script> alert("window.location.href = ./productlist.php?page='.$page_return.'")</script>';
            echo '<script>window.location.href = "./products.php?page='.$page_return.'"</script>';
//            END UPDATE CASE
        } else {
//            Insert Product
            $query = "INSERT INTO products(name, category_id, provider_id, promotion_id, quantity, weight, price, is_active, description)"
                    . "VALUES ('$p_name','$p_category','$p_provider','$p_promotion','$p_quantity', '$p_weight', '$p_price', '1', '$p_description')";

            mysqli_query($connect, "INSERT INTO products(name, category_id, provider_id, promotion_id, quantity, weight, price, is_active, description)"
                    . "VALUES ('$p_name','$p_category','$p_provider','$p_promotion','$p_quantity', '$p_weight', '$p_price', '1', '$p_description')");

            $p_id = mysqli_insert_id($connect);

            //	echo $pid;
//        $thumb_width = 150;
            //$thumb_height=100;



            if (!empty($_FILES['avatar']['name'])) {
                addImage($connect, 'avatar', $p_category, $p_id, '-avt', 1);
            } else {
                echo "Image error";
            }

            if (!empty($_FILES['image1']['name'])) {
                addImage($connect, 'image1', $p_category, $p_id, '-i1', 0);
            } else {
                echo "Image 1 error";
            }

            if (!empty($_FILES['image2']['name'])) {
                addImage($connect, 'image2', $p_category, $p_id, '-i2', 0);
            } else {
                echo "Image 2 error";
            }

            if (!empty($_FILES['image3']['name'])) {
                addImage($connect, 'image3', $p_category, $p_id, '-i3', 0);
            } else {
                echo "Image 3 error";
            }
//            header("location: productlist.php");

            $_SESSION['notify'] = "Thêm sản phẩm thành công";
            
            echo '<script>window.location.href = "./products.php"</script>';
        }
        //            Reset all variable
        $name_err = $category_err = $provider_err = $promotion_err = $quantiy_err = $weight_err = $price_err = $is_err = FALSE;
        $p_name = $p_category = $p_provider = $p_promotion = $p_quantity = $p_weight = $p_price = $p_description = "";
    }
//    echo '<script>alert("'.$is_err.'")</script>';
//   //////////////////////////////////////////
//   //////////////////////////////////////////
//   ////////////////////////////////////////////
//    Update product
}
?>


<script type="text/javascript" src="./ckeditor/ckeditor.js" charset="utf-8"></script>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="./products.php<?php if(isset($_GET['page'])) echo '?page='.$_GET['page']; ?>">Sản phẩm</a><span class="divider">&nbsp;</span></li>
            <li><a href="#"><?php if(isset($_GET['pid'])) echo 'Chỉnh sửa'; else echo 'Thêm mới'; ?></a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-body">
                    <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tên sản phẩm:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" <?php if ($name_err) echo 'style="border-color: #CF1212"' ?> id="name" name="name" value="<?php echo $p_name; ?>">
                                <span class="error">
                                    * <?php if ($name_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Danh mục:</label>
                            <div class="col-sm-10">
<!--                                <input type="text" class="form-control" id="name" name="name">
                                <input type="text" class="form-control" id="name" name="name">-->
                                <select id="category-parent" name="category-parent" <?php if ($category_err) echo 'style="border-color: #CF1212"' ?>>
                                    <option value="0">-- Danh mục gốc --</option>
                                    <?php
                                    $parent_id = "";
                                    if (isset($p_category)) {
                                        $s1 = mysqli_query($connect, "SELECT parent_id FROM categories WHERE id=$p_category");
                                        $fs1 = mysqli_fetch_array($s1);
                                        $parent_id = $fs1['parent_id'];
                                    }

                                    $cs = mysqli_query($connect, "SELECT * FROM categories WHERE parent_id=0");
                                    while ($ci = mysqli_fetch_array($cs)) {
                                        ?>
                                        <option value="<?php echo $ci['id'] ?>" <?php if ($parent_id == $ci['id']) echo "selected='true'" ?> > <?php echo $ci['name'] ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select id="category-child" name="category-child" <?php if ($category_err) echo 'style="border-color: #CF1212"' ?>>
                                    <option value="">-- Danh mục con --</option>
                                    <?php
                                    if (isset($_GET['i'])) {
                                        $id1 = intval($_GET['i']);
                                        $pr1 = mysqli_query($connect, "select * from products where id = $id1");
                                        $p1 = mysqli_fetch_array($pr1);
                                        $ce1 = $p1['category_id'];
                                        ?>
                                        <option value="<?php echo $ce1; ?> "  <?php echo "selected='true'" ?> >
                                            <?php
                                            $pr2 = mysqli_query($connect, "select name from category where id=$ce1 ");
                                            $p2 = mysqli_fetch_array($pr2);
                                            echo $p2['name'];
                                            ?> </option>
                                    <?php } ?>

                                    <?php
                                    if (isset($p_category)) {
                                        $query = mysqli_query($connect, "SELECT id, name FROM categories WHERE parent_id = '$parent_id'");
                                        while ($result = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?php echo $result['id']; ?> "  <?php if ($result['id'] == $p_category) echo "selected='true'" ?> >
                                                <?php echo $result['name'] ?>
                                            </option>
                                            <?php
                                        };
                                    }
                                    ?>
                                </select>
                                <span class="error">
                                    * <?php if ($category_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Nhà cung cấp:</label>
                            <div class="col-sm-10">
                                <select id="provider" name="provider" <?php if ($provider_err) echo 'style="border-color: #CF1212"' ?>>
                                    <option value="0" selected="true">-- Vui lòng chọn --</option>
                                    <?php
                                    $query_execute = mysqli_query($connect, "SELECT id, name FROM providers");
                                    while ($query_result = mysqli_fetch_array($query_execute)) {
                                        ?>
                                        <option value="<?php echo $query_result["id"] ?>" 
                                                <?php if ($p_provider == $query_result['id']) echo 'selected = "true"' ?>> 
                                                    <?php echo $query_result["name"] ?>
                                        </option>
                                        <?php
                                    };
                                    ?>
                                </select>
                                <span class="error">
                                    * <?php if ($provider_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Mã khuyến mãi:</label>
                            <div class="col-sm-10">
                                <select id="promotion" name="promotion" <?php if ($promotion_err) echo 'style="border-color: #CF1212"' ?>>
                                    <option value="0" selected="true">-- Vui lòng chọn --</option>
                                    <?php
                                    $query_execute = mysqli_query($connect, "SELECT id, value FROM promotions ORDER BY value ASC");
                                    while ($query_result = mysqli_fetch_array($query_execute)) {
                                        ?>
                                        <option value="<?php echo $query_result["id"] ?>" 
                                                <?php if ($p_promotion == $query_result['id']) echo 'selected = "true"' ?>> 
                                                    <?php echo $query_result["value"] . "%" ?>
                                        </option>
                                        <?php
                                    };
                                    ?>
                                </select>
                                <span class="error">
                                    * <?php if ($promotion_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Số lượng:</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if ($quantiy_err) echo 'style="border-color: #CF1212"' ?> id="quantity" name="quantity" value="<?php echo $p_quantity; ?>">
                                <span class="error">
                                    * <?php if ($quantiy_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Trọng lượng (gam):</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if ($weight_err) echo 'style="border-color: #CF1212"' ?> id="weight" name="weight" value="<?php echo $p_weight; ?>">
                                <span class="error">
                                    * <?php if ($weight_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Giá:</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if ($price_err) echo 'style="border-color: #CF1212"' ?> id="price" name="price" value="<?php echo $p_price; ?>">
                                <span class="error">
                                    * <?php if ($price_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="pwd">Hình đại diện:</label>
                            <?php
                            $image_result = mysqli_query($connect, "SELECT * FROM images "
                                    . "WHERE  product_id = $id AND is_active = 1 AND is_thumbnail = 1");
                            if (isset($image_result) && $image_result != FALSE) {
                                if ($image = mysqli_fetch_array($image_result)) {
                                    $image_is_exist = 1;
                                    ?>
                                    <div id="<?php echo 'image-id-' . $image['id']; ?>" class="col-sm-10">
                                        <img width="70px" src="<?php echo "." . $image['path'] ?>">
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $image["id"] . ", 'avatar'" ?>)"><i class="icon-remove"></i></a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="col-sm-10">          
                                <input type="file" class="form-control" id="avatar" name="avatar" 
                                       onclick="return warnningChangeImage(<?php echo $image_is_exist ?>);">
                                <span class="error">
                                    * <?php if ($avatar_err) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="pwd">Hình thứ 1:</label>
                            <?php
                            $image_result = mysqli_query($connect, "SELECT * FROM images "
                                    . "WHERE  product_id = $id AND is_active = 1 AND is_thumbnail = 0");
                            if (isset($image_result) && $image_result != FALSE) {
                                if ($image = mysqli_fetch_array($image_result)) {
                                    $image_is_exist = 1;
                                    ?>
                                    <div id="<?php echo 'image-id-' . $image['id']; ?>" class="col-sm-10">
                                        <img width="70px" src="<?php echo "." . $image['path'] ?>">
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $image["id"] . ", 'image1'" ?>)"><i class="icon-remove"></i></a>
                                    </div>
                                    <?php
                                } else {
                                    $image_is_exist = 0;
                                }
                            }
                            ?>
                            <div class="col-sm-10">          
                                <input type="file" class="form-control" id="image1" name="image1"
                                       onclick="return warnningChangeImage(<?php echo $image_is_exist ?>);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="pwd">Hình thứ 2:</label>
                            <?php
                            if (isset($image_result) && $image_result != FALSE) {
                                if ($image = mysqli_fetch_array($image_result)) {
                                    $image_is_exist = 1;
                                    ?>
                                    <div id="<?php echo 'image-id-' . $image['id']; ?>" class="col-sm-10">
                                        <img width="70px" src="<?php echo "." . $image['path'] ?>">
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $image["id"] . ", 'image2'" ?>)"><i class="icon-remove"></i></a>
                                    </div>
                                    <?php
                                } else {
                                    $image_is_exist = 0;
                                }
                            }
                            ?>
                            <div class="col-sm-10">          
                                <input type="file" class="form-control" id="image2" name="image2" 
                                       onclick="return warnningChangeImage(<?php echo $image_is_exist ?>);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="pwd">Hình thứ 3:</label>
                            <?php
                            if (isset($image_result) && $image_result != FALSE) {
                                if ($image = mysqli_fetch_array($image_result)) {
                                    $image_is_exist = 1;
                                    ?>
                                    <div id="<?php echo 'image-id-' . $image['id']; ?>" class="col-sm-10">
                                        <img width="70px" src="<?php echo "." . $image['path'] ?>">
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $image["id"] . ", 'image3'" ?>)"><i class="icon-remove"></i></a>
                                    </div>
                                    <?php
                                } else {
                                    $image_is_exist = 0;
                                }
                            }
                            ?>
                            <div class="col-sm-10">          
                                <input type="file" class="form-control" id="image3" name="image3" 
                                       onclick="return warnningChangeImage(<?php echo $image_is_exist ?>);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="pwd">Mô tả:</label>
                            <div class="col-sm-12">          
                                <textarea type="text" class="form-control" id="description" name="description"><?php echo $p_description; ?></textarea>
                            </div>
                            <input type="hidden" id="delete_avatar_notify" name="delete_avatar_notify" 
                                   value="<?php echo $avatar_is_delete; ?>">
                            <input type="hidden" id="page_return" name="page_return"
                                   value="<?php echo $page_return?>">
                        </div>

                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="edit_product_submit" id="edit_product_submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description')
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#category-parent").change(function () {
            $.ajax({
                type: "GET",
                url: 'ajax-sub-category.php',
                data: "c=" + $(this).val(),
                success: function (data) {
                    $("#category-child").html(data);
                }
            });
            return false;
        });
    });

    function addNotifier(image_id, input_file_name) {
        var notifier = $.Notifier("Cảnh báo",
                "Bạn có thực sự muốn xóa hình ảnh này?",
                "warning",
                {
                    vertical_align: "center",
                    rtl: false,
                    btns: [
                        {
                            label: "OK",
                            type: "success",
                            onClick: function () {
                                $.ajax({
                                    type: "POST",
                                    url: 'ajax-delete-image.php',
                                    data: "image_id=" + image_id,
                                    success: function (data) {
                                        if (data.success == true) {
                                            $('#image-id-' + image_id).remove();
                                            $('#' + input_file_name).attr("onclick", "return warnningChangeImage(0);");
                                            if (input_file_name == 'avatar') {
                                                $("#delete_avatar_notify").val(1);
                                            }
                                        } else {
                                            alert('There is someting wrong!');
                                        }

                                    }
                                });
//                                window.location.href = "action.php?image_id=" + photo_id;
                                return true;
                            }
                        },
                        {
                            label: "Hủy",
                            type: "default",
                            onClick: function () {
                                debugger;
                            }
                        }
                    ],
                    callback: function () {
                        debugger;
                    }
                });

    }

    function warnningChangeImage(isExist) {
        if (isExist == 0) {
            return true;
        } else {
            $.Notifier("Cảnh báo",
                    "Bạn phải xóa hình ảnh cũ trước khi chọn ảnh khác!",
                    "info",
                    {
                        vertical_align: "center",
                        rtl: false,
                        btns: [
                            {
                                label: "OK",
                                type: "success",
                                onClick: function () {
//                                window.location.href = "action.php?image_id=" + photo_id;
                                    return false;
                                }
                            }
                        ],
                        callback: function () {
                            return false;
                        }
                    });
            return false;
        }
    }
</script>
<?php
include 'footer.php';
?>


