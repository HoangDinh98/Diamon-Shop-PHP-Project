<?php
include 'include.php';
include 'header.php';
//include 'action.php';
//include 'footer.php';
$ce = $pe = $de = $ne = $masp = $msg = '';
?>

<?php
$error_message = 'Vui lòng nhập đúng kiểu dữ liệu yêu cầu';
$name_err = $category_err = $provider_err = $promotion_err = $quantiy_err = $weight_err = $price_err = $is_err = FALSE;
$name = $category_id = $provider_id  = $promotion_id = $quantity = $weight = $price = $description = "";

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])){
        $name_err = $is_err = TRUE;
    } else {
        $name = standardize_data($_POST["name"]);
    }
    
    if(empty($_POST["category-child"])){
        $category_err = $is_err = TRUE;
    }else {
        $category_id = standardize_data($_POST["category-child"]);
    }
    
    if(empty($_POST["provider"])){
        $provider_err = $is_err = TRUE;
    } else {
        $provider_id = standardize_data($_POST["provider"]);
    }
    
    if(empty($_POST["promotion"])){
        $promotion_err = $is_err = TRUE;
    } else {
        $promotion_id = standardize_data($_POST["promotion"]);
    }
    
    if(empty($_POST["quantity"])){
        $quantiy_err = $is_err = TRUE;
    } else {
        $quantity = standardize_data($_POST["quantity"]);
    }
    
    if(empty($_POST["weight"])){
        $weight_err = $is_err = TRUE;
    } else {
        $weight = standardize_data($_POST["weight"]);
    }
    
    if(empty($_POST["price"])){
        $price_err = $is_err = TRUE;
    } else {
        $price = standardize_data($_POST["price"]);
    }
    
    if(!empty($_POST["description"])){
        $description = standardize_data($_POST["description"]);
    }
    
    
//    If data is validation page will direct to action.php
    if(!$is_err) {
        echo '<script>alert("Prepare");</script>';
        echo '<script> window.location.href = "./action.php"</script>';
//        header("Location: ./action.php");
    }
}
?>
<script type="text/javascript" src="./ckeditor/ckeditor.js" charset="utf-8"></script>



<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-body">
                    <form class="form-horizontal" method="POST" action="./action.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tên sản phẩm:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" <?php if($name_err) echo 'style="border-color: #CF1212"'?> id="name" name="name" value="<?php echo $name;?>">
                                <span class="error">
                                    *
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Danh mục:</label>
                            <div class="col-sm-10">
<!--                                <input type="text" class="form-control" id="name" name="name">
                                <input type="text" class="form-control" id="name" name="name">-->
                                <select id="category-parent" name="category-parent">
                                    <option value="0">-- Danh mục gốc --</option>
                                    <?php
                                    $cs = mysqli_query($connect, "SELECT * FROM categories WHERE parent_id=0");
                                    while ($ci = mysqli_fetch_array($cs)) {
                                        ?>
                                        <option value="<?php echo $ci['id'] ?>" <?php if ($pe == $ci['id']) echo "selected='true'" ?> > <?php echo $ci['name'] ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select id="category-child" name="category-child">
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Nhà cung cấp:</label>
                            <div class="col-sm-10">
                                <select id="provider" name="provider">
                                    <option value="0" selected="true">-- Vui lòng chọn --</option>
                                    <?php
                                    $query_execute = mysqli_query($connect, "SELECT id, name FROM providers");
                                    while ($query_result = mysqli_fetch_array($query_execute)) {
                                        ?>
                                        <option value="<?php echo $query_result["id"] ?>"> <?php echo $query_result["name"] ?></option>
                                        <?php
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Mã khuyến mãi:</label>
                            <div class="col-sm-10">
                                <select id="promotion" name="promotion">
                                    <option value="0" selected="true">-- Vui lòng chọn --</option>
                                    <?php
                                    $query_execute = mysqli_query($connect, "SELECT id, value FROM promotions ORDER BY value ASC");
                                    while ($query_result = mysqli_fetch_array($query_execute)) {
                                        ?>
                                        <option value="<?php echo $query_result["id"] ?>"> <?php echo $query_result["value"] . "%" ?></option>
                                        <?php
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Số lượng:</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if($quantiy_err) echo 'style="border-color: #CF1212"'?> id="quantity" name="quantity" value="<?php echo $quantity;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Trọng lượng (gam):</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if($weight_err) echo 'style="border-color: #CF1212"'?> id="weight" name="weight" value="<?php echo $weight;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Giá:</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" <?php if($price_err) echo 'style="border-color: #CF1212"'?> id="price" name="price" value="<?php echo $price;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="pwd">Hình đại diện:</label>
                            <div class="col-sm-10">          
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="pwd">Mô tả:</label>
                            <div class="col-sm-12">          
                                <textarea type="text" class="form-control" id="description" name="description"><?php echo $description;?></textarea>
                            </div>
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
    })
</script>
<?php
include 'footer.php';
?>


