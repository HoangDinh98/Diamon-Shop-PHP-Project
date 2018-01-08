<?php
include 'include.php';
$_SESSION['task'] = 'products';
include 'header.php';
//include 'product-action.php';
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="#">Sản phẩm</a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
    <?php
    if (isset($_SESSION['notify'])) {
        ?>
        <div class="alert alert-success" id="notify">
            <button data-dismiss="alert" class="close">×</button>
            <?php
            echo $_SESSION['notify'];
            unset($_SESSION['notify']);
            ?>
        </div>
        <script>
            $(document).ready(function () {
                $('#notify').delay(5000).fadeOut();
            });
        </script>
        <?php
    }
    ?>
    <div>
        <a class="create-button" href="./add-product.php">Thêm sản phẩm</a>
    </div>
    <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
    <!-- Show firt table -->
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $rows_result = mysqli_query($connect, "SELECT id FROM products WHERE is_active = 1");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 10;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

//                $pr = mysqli_query($connect, "SELECT * FROM products WHERE is_active = 1 ORDER BY id LIMIT $start,$rows_per_page");
                $pr = mysqli_query($connect, "SELECT p.*, c.name AS cname, pro.name AS proname FROM products AS p "
                        . "INNER JOIN categories AS c ON p.category_id = c.id "
                        . "INNER JOIN providers AS pro ON p.provider_id = pro.id "
                        . "WHERE p.is_active = '1' ORDER BY p.id DESC LIMIT $start,$rows_per_page ");
//                if ($pr) {
//                    echo '<script> alert("OK") </script>';
//                } else {
//                    echo '<script> alert("'. var_dump($pr).'") </script>';
//                }
                $num = $page_curent * 10 - 10;
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Nhà cung cấp</th>
                                <th>Số lượng</th>
                                <th>Trọng lượng</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th style="width: 11%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($p = mysqli_fetch_array($pr)) {
                                ?>
                                <tr>
                                    <!--<td style="display: none"><?php echo $p['id'] ?></td>-->
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $p['name']; ?></td>
                                    <td><?php echo $p['proname'] ?></td>
                                    <td><?php echo $p['cname'] ?></td>
                                    <td><?php echo $p['quantity'] ?></td>
                                    <td><?php echo $p['weight'] ?></td>
                                    <td><?php echo $p['price'] ?></td>
                                    <td><?php echo $p['description'] ?></td>
                                    <td>
    <!--                                        <a href="addproduct.php?i=<?php echo $p['id'] ?>" >Chỉnh sửa</a>&nbsp;&nbsp;-->
    <!--                                        <a href="products.php?delete=<?php echo $p['id'] ?>" >Xóa</a>-->
                                        <a class="button-a edit-button" href="add-product.php?pid=<?php echo $p['id'] ?>&page=<?php echo $page_curent ?>"><i class="icon-edit"></i></a>&nbsp;
                                        <a class="button-a delete-button" onclick="addNotifier(<?php echo $p["id"].', '.$page_curent ?>)"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="widget-body">
                    <?php
                    if ($pages_no > 1) {
                        echo "Pages: ";
                        if ($page_curent >= 1) {
                            if ($page_curent > 1) {
                                echo "<a href='products.php?page=1' class=\"page-direct\" ><<</a>";
                                echo "<a href='products.php?page=" . ($page_curent - 1) . "' class=\"page-direct\"><</a>";
                            }

                            for ($i = 1; $i <= $pages_no; $i++) {
                                ?>
                                <a href='products.php?page=<?php echo $i ?>' 
                                   class="page <?php
                                   if ($page_curent == $i) {
                                       echo 'page-active';
                                   }
                                   ?>" >
                                <?php echo $i ?>
                                </a>
                                <?php
                            }
                        }
                        if ($page_curent < $pages_no) {
                            echo "<a href='products.php?page=" . ($page_curent + 1) . "' class=\"page-direct\" >></a>";
                            echo "<a href='products.php?page=$pages_no' class=\"page-direct\" >>></a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function testA() {
        if (confirm("Do you want to delete thi recode")) {
            alert("You selected Yes");
        } else {
            alert("You selected No");
        }
    }

    function addNotifier(product_id, page_return) {
        var notifier = $.Notifier("Cảnh báo",
                "Bạn có thực sự muốn xóa bản ghi này?",
                "warning",
                {
                    vertical_align: "center",
                    rtl: false,
                    btns: [
                        {
                            label: "OK",
                            type: "success",
                            onClick: function () {
                                window.location.href = "action.php?product_delete_id=" + product_id +"&page=" + page_return;
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
</script>

<?php
include 'footer.php';
?>