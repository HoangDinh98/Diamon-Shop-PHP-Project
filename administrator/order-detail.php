<?php
include 'include.php';
include './required.php';
$_SESSION['task'] = 'orders';
include 'header.php';
//include 'product-action.php';
?>

<?php
$order_id = "";

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
}
?>

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="./index.php"><i class="icon-home" style="font-size: 18px; width: 30px;"></i></a><span class="divider">&nbsp;</span></li>
            <li><a href="./orders.php<?php if(isset($_GET['page'])) echo '?page='.$_GET['page']; ?>">Đơn hàng</a><span class="divider">&nbsp;</span></li>
            <li><a href="#"><?php if(isset($_GET['pid'])) echo 'Chỉnh sửa'; else echo 'Thêm mới'; ?></a><span class="divider-last">&nbsp;</span></li>
        </ul>
    </div>
</div>

<div id="page" class="dashboard">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <?php
                $query_execute = mysqli_query($connect, "SELECT customer_name, address, phone, email, export_date "
                        . "FROM orders WHERE id = '$order_id' ORDER BY id ASC");
                ?>

                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <caption style="font-size: 20px; background-color: #3f51b5; color: #FFFFFF; padding: 5px;
                                 border-bottom: 2px solid;">
                            Thông tin tổng quát
                        </caption>
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đặt hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                ?>
                                <tr>
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $query_result['customer_name'] ?></td>
                                    <td><?php echo $query_result['address'] ?></td>
                                    <td><?php echo $query_result['phone'] ?></td>
                                    <td><?php echo $query_result['email'] ?></td>
                                    <td><?php echo $query_result['export_date'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="widget">
                <div class="widget-body">
                    <table class="table table-condensed table-striped table-hover no-margin">
                        <caption style="font-size: 20px; background-color: #3f51b5; color: #FFFFFF; padding: 5px;
                                 border-bottom: 2px solid;">
                            Thông tin chi tiết
                        </caption>

                        <?php
                        $query_1 = "SELECT p.name AS product_name, o.quantity, original_price, o.price 
                            FROM orders_detail AS o JOIN products AS p ON o.product_id = p.id 
                            WHERE order_id = $order_id;";
                        $query_execute = mysqli_query($connect, $query_1)
                        ?>
                        <thead>
                            <tr>
                                <!--<th style="display: none"></th>-->
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th style=" text-align: right;">Số lượng</th>
                                <th style=" text-align: right;">Giá gốc</th>
                                <th style=" text-align: right;">Giá bán</th>
                                <th style=" text-align: right;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 0;
                            $sum_price = 0;
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                ?>
                                <tr>
                                    <td><?php echo ++$num ?></td>
                                    <td><?php echo $query_result['product_name'] ?></td>
                                    <td style=" text-align: right;"><?php echo $query_result['quantity'] ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($query_result['original_price']) . " đ" ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($query_result['price']) . " đ" ?></td>
                                    <td style=" text-align: right;">
                                        <?php
                                        $sum_price += $query_result['price'] * $query_result['quantity'];
                                        echo number_format($query_result['price'] * $query_result['quantity']) . " đ";
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        <thead>
                            <tr style="background-color: #8fC1F5; color: #090909; font-weight: bold;">
                                <td colspan="5" style="text-align: right" >Tổng tiền</td>
                                <td style=" text-align: right;"><?php echo number_format($sum_price) . " đ" ?></td>
                            </tr>
                        </thead>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

