<?php
include 'include.php';
include 'header.php';
//include 'product-action.php';
?>

<div id="page" class="dashboard">
    <!--    <div class="alert alert-info">
            <button data-dismiss="alert" class="close">×</button>
            Welcome to the <strong>Admin Lab</strong> Theme. Please don't forget to check all the pages! 
        </div>-->
    <?php
    if (isset($_SESSION['notify'])) {
        ?>
        <div class="alert alert-info" id="notify">
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
        <button type="button" name="product-create" value="Thêm sản phẩm">
            <a href="./create-product.php">Thêm sản phẩm</a>
        </button>
    </div>
    <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
    <!-- Show firt table -->
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <!--              <div class="widget-title">
                                <h4><i class="icon-envelope"></i> Mailbox</h4>
                                <div class="tools pull-right mtop7 mail-btn">
                                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Share" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-share-alt"></i></a><a class="btn btn-small element" data-original-title="Report" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-exclamation-sign"></i></a><a class="btn btn-small element" data-original-title="Delete" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-trash"></i></a></div>
                                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Move to" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-folder-close"></i></a><a class="btn btn-small element" data-original-title="Tag" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-tag"></i></a></div>
                                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Prev" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-chevron-left"></i></a><a class="btn btn-small element" data-original-title="Next" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-chevron-right"></i></a></div>
                                </div>
                              </div>-->
                <?php
                $rows_result = mysqli_query($connect, "SELECT id FROM products");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 20;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

//                $pr = mysqli_query($connect, "SELECT * FROM products WHERE is_active = 1 ORDER BY id LIMIT $start,$rows_per_page");
                $pr = mysqli_query($connect, "SELECT p.*, c.name AS cname, pro.name AS proname FROM products AS p "
                        . "INNER JOIN categories AS c ON p.category_id = c.id "
                        . "INNER JOIN providers AS pro ON p.provider_id = pro.id "
                        . "WHERE p.is_active = '1' ORDER BY p.id LIMIT $start,$rows_per_page ");
//                if ($pr) {
//                    echo '<script> alert("OK") </script>';
//                } else {
//                    echo '<script> alert("'. var_dump($pr).'") </script>';
//                }
                $num = 0;
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
                                <th>Hành động</th>
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
                                        <a href="create-product.php?pid=<?php echo $p['id']?>">Chỉnh sửa</a>&nbsp;&nbsp;
                                        <a onclick="addNotifier(<?php echo $p["id"] ?>)">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
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

    function addNotifier(product_id) {
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
                                window.location.href = "action.php?product_delete_id=" + product_id;
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

<!--<div class="widget-body">
    <table class="table table-condensed table-striped table-hover no-margin">
        <thead>
            <tr>
                <th style="width:3%"><input type="checkbox" class="no-margin" /></th>
                <th style="width:17%"> Sent by </th>
                <th class="hidden-phone" style="width:55%"> Subject </th>
                <th class="right-align-text hidden-phone" style="width:12%"> Labels </th>
                <th class="right-align-text hidden-phone" style="width:12%"> Date </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" class="no-margin" /></td>
                <td> Dulal khan </td>
                <td class="hidden-phone"><strong> Senior Creative Designer </strong><small class="info-fade"> Vector Lab </small></td>
                <td class="right-align-text hidden-phone"><span class="label label label-info"> Read </span></td>
                <td class="right-align-text hidden-phone"> Yesterday </td>
            </tr>
        </tbody>
    </table>
</div>-->
<?php
include 'footer.php';
?>