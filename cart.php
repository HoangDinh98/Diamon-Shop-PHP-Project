<?php
include './include.php';
include './header.php';
$total_money = 0;
?>
<?php
// time is second
$session_timeout = 60 * 60;

if (!isset($_SESSION['last_visit'])) {
    $_SESSION['last_visit'] = time();
} // I like brackets!

if ((time() - $_SESSION['last_visit']) > $session_timeout) {
//    session_destroy();
    unset($_SESSION['product']);
}

$_SESSION['last_visit'] = time();
?>

<section class = "main-content">
    <div class = "row" style="margin-bottom: 100px;">
        <div class = "span9">
            <h4 class = "title"><span class = "text"><strong>GIỎ HÀNG</strong> CỦA BẠN</span></h4>

            <div id="notify-container">
                <?php
                if (isset($_SESSION['notify'])) {
                    ?>
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">×</button>
                        <?php
                        echo $_SESSION['notify'];
                        unset($_SESSION['notify']);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>


            <table class = "table table-striped">
                <?php
                if (isset($_SESSION['product']) && $_SESSION['product_num'] > 0) {
                    ?>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="number-box">Giá bán</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th class="number-box">Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                }
                ?>

                <tbody>
                    <?php
                    if (isset($_SESSION['product']) && $_SESSION['product_num'] > 0) {
                        foreach ($_SESSION['product'] AS $key => $value) {
                            $query = "SELECT price, img.path AS image, prm.value AS promotion, name, price "
                                    . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id "
                                    . "JOIN images AS img ON p.id = img.product_id "
                                    . "WHERE p.id = $key AND img.is_thumbnail = 1 AND img.is_active = 1";
//                            $_SESSION['notify'] = $query;

                            $query_execute = mysqli_query($connect, $query);
                            if (isset($query_execute)) {
                                while ($query_result = mysqli_fetch_array($query_execute)) {
                                    ?>
                                    <tr id="row-id-<?php echo $key ?>">

                                        <td><a href = "product_detail.html">
                                                <img alt = "" width="100px" src = "<?php echo $query_result['image'] ?>">
                                            </a>
                                        </td>
                                        <td><?php echo $query_result['name'] ?></td>
                                        <td class="number-box">
                                            <?php echo number_format($price = round($query_result['price'] * (1 - $query_result['promotion'] / 100), 0)) . " đ" ?>
                                        </td>
                                        <td class="number-box">
                                            <div class="product-num-box">
                                                <span data-id="<?php echo $key ?>" class="change-num-direct minus">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </span>
                                                <span class="product-num" id="change-num-<?php echo $key ?>">
                                                    <?php echo number_format($value['quantity']) ?>
                                                </span>
                                                <span data-id="<?php echo $key ?>" class="change-num-direct plus">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="number-box" id="sum-price-<?php echo $key ?>">
                                            <?php
                                            $total_money += $value['quantity'] * $price;
                                            echo number_format($value['quantity'] * $price) . " đ";
                                            ?>
                                        </td>
                                        <td class="number-box">
                                            <a class="remove-product" data-id="<?php echo $key; ?>">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    } else {
                        echo '<tr><td style="font-size: 16px;">Bạn chưa thêm sản phầm nào vào giỏ hàng</td></tr>';
                    }
                    ?>
<!--                    <tr>
        <td>&nbsp;
        </td>
        <td>&nbsp;
        </td>
        <td>&nbsp;
        </td>
        <td>&nbsp;
        </td>
        <td>&nbsp;
        </td>
        <td></td>
    </tr>-->
                </tbody>
            </table>
        </div>
        <div class = "span3 col">
            <div class = "block fixed-cart" style="position: fixed; min-width: 19%;">
                <h4>Thông tin đơn hàng</h4>
                <div class="line-block"> Giỏ hàng của bạn hiện có: 
                    <div>
                        <b id="notify-num-box">
                            <?php
                            if (isset($_SESSION['product_num'])) {
                                echo $_SESSION['product_num'];
                            } else {
                                echo '0';
                            }
                            ?>
                        </b> sản phẩm
                    </div> 
                </div>
                <div class="line-block">
                    <span class="float-left">Tạm tính:</span>
                    <span class="number-box float-right" id="temp-money"><?php echo number_format($total_money) . " đ" ?></span>
                </div>
                <div class="line-block">
                    <span class="float-left"><b>Tổng tiền:</b></span>
                    <span class="number-box float-right"><b id="total-money"><?php echo number_format($total_money) . " đ" ?></b></span>
                </div>
                <div id="check-out-container">
                    <?php if (isset($_SESSION['product']) && $_SESSION['product_num'] > 0) { ?>
                        <input id="check-out" type="button" value="TIẾN HÀNH THANH TOÁN">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include './footer.php';
?>

