<?php
include 'include.php';
$_SESSION['task'] = 'categories';
include 'header.php';
?>

<?php
$page_return = 1;
$category_id = $category_name = $category_nameErr = $parent_id = $parent_name = "";
$isErr = FALSE;

// This is edit case
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $query_execute = mysqli_query($connect, "SELECT name, parent_id FROM categories WHERE id = $category_id");
    $query_result = mysqli_fetch_array($query_execute);
    $category_name = $query_result['name'];
    $parent_id = intval($query_result['parent_id']);
}
//End Edit case
if (isset($_GET['page'])) {
    $page_return = $_GET['page'];
}

//Start Create Category case
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST['name'])) {
        $category_nameErr = "Vui lòng nhập đúng dữ liệu theo yêu cầu";
        $isErr = TRUE;
    } else {
        $category_name = $_POST['name'];
        $parent_id = intval($_POST['parent_category']);
    }

    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
    }
    
    if(!empty($_POST['page_return'])) {
        $page_return = $_POST['page_return'];
    }

    if (!$isErr) {
//        Update for Edit case
        if (isset($category_id) && $category_id != "") {
            $query_execute = mysqli_query($connect, "UPDATE categories SET "
                    . "name = '$category_name', parent_id = '$parent_id' "
                    . "WHERE id = '$category_id'");
            if ($query_execute) {
                $_SESSION['notify'] = "Cập nhật danh mục thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể cập nhật danh mục!";
            }
        } else {
//            Insert Category for create new case
            $is_active = 1;
            $query = "INSERT INTO categories (name, parent_id, is_active) VALUES(?, ?, ?) ";
            $stmt = $connect->prepare($query);
            $stmt->bind_param('sii', $category_name, $parent_id, $is_active);
            if ($stmt->execute()) {
                $_SESSION['notify'] = "Thêm danh mục thành công";
            } else {
                $_SESSION['notify'] = "LỖI! Không thể thêm danh mục!";
            }
        }
        echo '<script>window.location.href = "./categories.php?page='.$page_return.'"</script>';
    }
}
// End Create category case
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="./categories.php<?php if (isset($_GET['page'])) echo '?page=' . $_GET['page']; ?>">Danh mục sản phẩm</a><span class="divider">&nbsp;</span></li>
            <li><a href="#"><?php if (isset($_GET['category_id']))
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
                    if (isset($category_id) && $category_id != "") {
                        echo '<div><h3 style="color: #009688"> Chỉnh sửa danh mục </h3></div>';
                    } else {
                        echo '<div><h3 style="color: #009688"> Thêm danh mục mới </h3></div>';
                    }
                    ?>
                    <form class="form-horizontal" method="POST" 
                          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                          enctype="multipart/form-data">

                        <input type="hidden" id="category_id" name="category_id" value="<?php echo $category_id ?>">
                        <div class="form-group">
                            <div>Tên danh mục:</div>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name"
                                       value="<?php echo $category_name ?>">
                                <span class="error">
                                    * <?php if ($isErr) echo $category_nameErr ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>Danh mục này sẽ được chứa trong:</div>
                            <div class="col-sm-10">
                                <select id="parent_category" name="parent_category">
                                    <option value="0" selected="true">-- Danh mục gốc --</option>
                                    <?php
                                    if ($category_id == "") {
                                        $query_execute = mysqli_query($connect, "SELECT id, name FROM categories "
                                                . "WHERE parent_id = '0'");
                                        while ($query_result = mysqli_fetch_array($query_execute)) {
                                            ?>
                                            <option value="<?php echo $query_result['id'] ?>">
                                            <?php
                                            echo $query_result['name'];
                                            ?>
                                            </option>
                                            <?php
                                        }
                                    } else {
                                        $query_execute = mysqli_query($connect, "SELECT id, name FROM categories "
                                                . "WHERE parent_id = '0'");
                                        while ($query_result = mysqli_fetch_array($query_execute)) {
                                            ?>
                                            <option value="<?php echo $query_result['id'] ?>"
                                                <?php if ($parent_id == $query_result['id']) echo 'selected="true"'; ?>>

                                            <?php
                                            echo $query_result['name'];
                                            ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="page_return" name="page_return"
                                   value="<?php echo $page_return ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" id="add_category_submit" name="add_category_submit">
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

