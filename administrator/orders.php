<?php
include 'include.php';
$_SESSION['task'] = 'orders';
include 'header.php';
//include 'product-action.php';
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="#">Đơn hàng</a><span class="divider-last">&nbsp;</span></li>
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
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $rows_result = mysqli_query($connect, "SELECT id FROM orders");
                $rows_no = mysqli_num_rows($rows_result);
                $rows_per_page = 10;
                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
                if (!$page_curent)
                    $page_curent = 1;
                $start = ($page_curent - 1) * $rows_per_page;

                $num = $rows_per_page * ($page_curent - 1);

                $query_execute = mysqli_query($connect, "SELECT id, customer_name, address, phone, email, export_date "
                        . "FROM orders ORDER BY id DESC LIMIT $start,$rows_per_page ");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đặt hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                ?>
                                <tr>
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $query_result['customer_name'] ?></td>
                                    <td><?php echo $query_result['address'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['export_date'] ?></td>
                                    <td>
                                        <a class="button-a edit-button" href="order-detail.php?order_id=<?php echo $query_result['id'] ?>&page=<?php echo $page_curent ?>"><i class="icon-info-sign"></i></a>&nbsp;
                                        <!--<a class="button-a delete-button" onclick="addNotifier(<?php echo $p["id"] ?>)"><i class="icon-trash"></i></a>-->
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
                                echo "<a href='orders.php?page=1' class=\"page-direct\" ><<</a>";
                                echo "<a href='orders.php?page=" . ($page_curent - 1) . "' class=\"page-direct\"><</a>";
                            }

                            for ($i = 1; $i <= $pages_no; $i++) {
                                ?>
                                <a href='orders.php?page=<?php echo $i ?>' 
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
                            echo "<a href='orders.php?page=" . ($page_curent + 1) . "' class=\"page-direct\" >></a>";
                            echo "<a href='orders.php?page=$pages_no' class=\"page-direct\" >>></a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>