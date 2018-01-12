<?php
include 'include.php';
include './required.php';
$_SESSION['task'] = 'promotions';
include 'header.php';
?>

<?php
$page_return = 1;
$promotion_id = $prom_value = $prom_description = "";
$prom_valueErr = $isErr = FALSE;

//$error_message = "Vui lòng nhập đúng dữ liệu theo yêu cầu";
if (isset($_GET['page'])) {
    $page_return = $_GET['page'];
}

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// This is edit case
if (isset($_GET['promotion_id'])) {
    $promotion_id = $_GET['promotion_id'];

    $query_execute = mysqli_query($connect, "SELECT value, description FROM promotions WHERE id = '$promotion_id'");
    $query_result = mysqli_fetch_array($query_execute);

    $prom_value = $query_result['value'];
    $prom_description = $query_result['description'];
}
//End Edit case
//Start Create Category case
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
//    Get provider_id to decide Update (isset id) or Create (id="") new.
    if (isset($_POST['promotion_id'])) {
        $promotion_id = $_POST['promotion_id'];
    }

    if (empty($_POST['value'])) {
        $prom_valueErr = "Không thể để trống trường này";
        $isErr = TRUE;
    } else {
        //        test UNIQUE for promotion
        $temp = $_POST['value'];
        $query_execute = mysqli_query($connect, "SELECT id FROM promotions WHERE value = '$temp'");
        if (mysqli_affected_rows($connect) != 0) {
            $prom_value = $_POST['value'];
            $prom_valueErr = "Khuyến mãi này đã tồn tại! Vui lòng kiểm tra lại! Nếu khuyến mãi này bị Tắt/Xóa, xin hãy vui lòng bật lại!";
            $isErr = TRUE;
        } else {
            $prom_value = standardize_data($_POST['value']);
        }
    }

    if (empty($_POST['description'])) {
        $prom_description = standardize_data($_POST['description']);
    }
    
    if(!empty($_POST['page_return'])) {
        $page_return = $_POST['page_return'];
    }



    if (!$isErr) {
//        Update for Edit case
        if (isset($promotion_id) && $promotion_id != "") {
            $query_execute = mysqli_query($connect, "UPDATE promotions SET "
                    . "value = '$prom_value', description = '$prom_description' "
                    . "WHERE id = '$promotion_id'");
            if ($query_execute) {
                $_SESSION['notify'] = "Cập nhật khuyễn mãi thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể cập nhật khuyến mãi!";
            }
        } else {
//            Insert Category for create new case
            $is_active = 1;
            $query = "INSERT INTO promotions (value, description, is_active) VALUES(?, ?, ?) ";
            $stmt = $connect->prepare($query);
            $stmt->bind_param('isi', $prom_value, $prom_description, $is_active);
            if ($stmt->execute()) {
                $_SESSION['notify'] = "Thêm khuyến mãi thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể thêm mới khuyến mãi!";
            }
        }
        echo '<script>window.location.href = "./promotions.php?page=' . $page_return . '"</script>';
    }
}
// End Create category case
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="./promotions.php<?php if (isset($_GET['page'])) echo '?page=' . $_GET['page']; ?>">Khuyến mãi</a><span class="divider">&nbsp;</span></li>
            <li><a href="#"><?php
                    if (isset($_GET['promotion_id']))
                        echo 'Chỉnh sửa';
                    else
                        echo 'Thêm mới';
                    ?></a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-body">
                    <?php
//                    print title
                    if (isset($provider_id) && $provider_id != "") {
                        echo '<div><h3 style="color: #009688"> Chỉnh sửa thông tin khuyễn mãi </h3></div>';
                    } else {
                        echo '<div><h3 style="color: #009688"> Thêm mới khuyễn mãi </h3></div>';
                    }
                    ?>
                    <form class="form-horizontal" method="POST" 
                          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                          enctype="multipart/form-data">

                        <input type="hidden" id="promotion_id" name="promotion_id" value="<?php echo $promotion_id ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Giá trị khuyến mãi (%)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="value" name="value" <?php if ($prom_valueErr != "") echo 'style="border-color: #CF1212"' ?> 
                                       value="<?php echo $prom_value; ?>">   
                                <span class="error">
                                    * <?php if ($prom_valueErr != "") echo $prom_valueErr ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Mô tả khuyến mãi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description"
                                       value="<?php echo $prom_description; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="page_return" name="page_return"
                                   value="<?php echo $page_return ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="add_promotion_submit" name="add_promotion_submit" value="OK">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>


