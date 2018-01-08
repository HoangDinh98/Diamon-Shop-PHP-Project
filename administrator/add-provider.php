<?php
include 'include.php';
$_SESSION['task'] = 'providers';
include 'header.php';
?>

<?php
$page_return = 1;
if (isset($_GET['page'])) {
    $page_return = $_GET['page'];
}

$provider_id = $pro_name = $pro_address = $pro_email = $pro_website = $pro_phone = "";
$pro_nameErr = $pro_addressErr = $pro_emailErr = $pro_phoneErr = FALSE;
$isErr = FALSE;
$error_message = "Vui lòng nhập đúng dữ liệu theo yêu cầu";

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// This is edit case
if (isset($_GET['provider_id'])) {
    $provider_id = $_GET['provider_id'];

    $query_execute = mysqli_query($connect, "SELECT name, address, email, website, phone FROM providers WHERE id = '$provider_id'");
    $query_result = mysqli_fetch_array($query_execute);

    $pro_name = $query_result['name'];
    $pro_address = $query_result['address'];
    $pro_email = $query_result['email'];
    $pro_website = $query_result['website'];
    $pro_phone = $query_result['phone'];
}
//End Edit case
//Start Create Category case
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
//    Get provider_id to decide Update (isset id) or Create (id="") new.
    if (isset($_POST['provider_id'])) {
        $provider_id = $_POST['provider_id'];
    }

    if (empty($_POST['name'])) {
        $pro_nameErr = TRUE;
        $isErr = TRUE;
    } else {
        $pro_name = standardize_data($_POST['name']);
    }

    if (empty($_POST['address'])) {
        $pro_addressErr = TRUE;
        $isErr = TRUE;
    } else {
        $pro_address = standardize_data($_POST['address']);
    }

    if (empty($_POST['email'])) {
        $pro_emailErr = TRUE;
        $isErr = TRUE;
    } else {
        $pro_email = standardize_data($_POST['email']);
    }

    if (empty($_POST['phone'])) {
        $pro_phoneErr = TRUE;
        $isErr = TRUE;
    } else {
        $pro_phone = standardize_data($_POST['phone']);
    }

    if (isset($_POST['website'])) {
        $pro_website = standardize_data($_POST['website']);
    }
    
    if(!empty($_POST['page_return'])) {
        $page_return = $_POST['page_return'];
    }



    if (!$isErr) {
//        Update for Edit case
        if (isset($provider_id) && $provider_id != "") {
            $query_execute = mysqli_query($connect, "UPDATE providers SET "
                    . "name = '$pro_name', address = '$pro_address', email = '$pro_email', phone = '$pro_phone', website ='$pro_website' "
                    . "WHERE id = '$provider_id'");
            if ($query_execute) {
                $_SESSION['notify'] = "Cập nhật thông tin thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể cập nhật thông tin!";
            }
        } else {
//            Insert Category for create new case
            $is_active = 1;
            $query = "INSERT INTO providers (name, address, email, phone, website, is_active) VALUES(?, ?, ?, ?, ?, ?) ";
            $stmt = $connect->prepare($query);
            $stmt->bind_param('sssssi', $pro_name, $pro_address, $pro_email, $pro_phone, $pro_website, $is_active);
            if ($stmt->execute()) {
                $_SESSION['notify'] = "Thêm nhà cung cấp thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể thêm mới nhà cung cấp!";
            }
        }
        echo '<script>window.location.href = "./providers.php?page=' . $page_return . '"</script>';
    }
}
// End Create category case
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="./providers.php<?php if(isset($_GET['page'])) echo '?page='.$_GET['page']; ?>">Nhà cung cấp</a><span class="divider">&nbsp;</span></li>
            <li><a href="#"><?php if(isset($_GET['provider_id'])) echo 'Chỉnh sửa'; else echo 'Thêm mới'; ?></a><span class="divider-last">&nbsp;</span></li>
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
                        echo '<div><h3 style="color: #009688"> Chỉnh sửa thông tin </h3></div>';
                    } else {
                        echo '<div><h3 style="color: #009688"> Thêm mới nhà cung cấp </h3></div>';
                    }
                    ?>
                    <form class="form-horizontal" method="POST" 
                          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                          enctype="multipart/form-data">

                        <input type="hidden" id="provider_id" name="provider_id" value="<?php echo $provider_id ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                <?php if ($pro_nameErr) echo 'style="border-color: #CF1212"' ?> 
                                       value="<?php echo $pro_name; ?>">
                                <span class="error">
                                    * <?php if ($pro_nameErr) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" name="address"
                                <?php if ($pro_addressErr) echo 'style="border-color: #CF1212"' ?> 
                                        value="<?php echo $pro_address; ?>">
                                <span class="error">
                                    * <?php if ($pro_addressErr) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                <?php if ($pro_emailErr) echo 'style="border-color: #CF1212"' ?> 
                                        value="<?php echo $pro_email; ?>">
                                <span class="error">
                                    * <?php if ($pro_emailErr) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Sô điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone"
                                <?php if ($pro_phoneErr) echo 'style="border-color: #CF1212"' ?> 
                                        value="<?php echo $pro_phone; ?>">
                                <span class="error">
                                    * <?php if ($pro_phoneErr) echo $error_message ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Website</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="website" name="website" value="<?php echo $pro_website; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" id="page_return" name="page_return"
                                   value="<?php echo $page_return ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" id="add_provider_submit" name="add_provider_submit" value="OK">
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


