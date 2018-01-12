

<?php
include 'include.php';
require_once("header.php");
?>
<section class="main-content">
           <!-- <section class="header_text sub"> -->
    <!-- Đường dẫn banner -->               					
    <!--<img class="pageBanner" src="./asset/themes/images/banner2.jpg" alt="New products" >-->
    <h4><span>Chi Tiết Sản Phẩm</span></h4>			
    <div class="row">						
        <div class="span9">
            <!--            Load sản phẩm chính-->
            <div class="row">
                <div class="span4">


                    <!-- Sản phẩm chính -->			
                    <!--                    <a href="./asset/themes/images/ladies/daychuyen2.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 1">
                                            <img alt="" src="./asset/themes/images/ladies/daychuyen2.jpg"></a>												-->
                    <?php
                    $i = intval($_GET['i']);
                    $prs = mysqli_query($connect, " SELECT p.*, prv.name AS provider, prm.value AS promotion "
                            . "FROM products AS p JOIN providers AS prv ON p.provider_id = prv.id "
                            . "JOIN promotions AS prm ON p.promotion_id = prm.id WHERE p.id=$i;");
                    if (!mysqli_num_rows($prs))
                        echo "<span style='color:red'>Không có sản phẩm</span>";
                    else {
                        $pr = mysqli_fetch_array($prs);
                        $dir = "productimages/" . $pr['category_id'] . "/" . $pr['id'] . "/";
                        $cateId = $pr['category_id'];
                        $prId = $pr['id'];

                        /*
                         * lấy hết tất cả hình ảnh của sản phẩm này
                         */
                        $photo_result = $connect->query(" SELECT pt.*
                                                    FROM images pt
                                                    WHERE pt.product_id =$prId AND is_thumbnail = 1 AND is_active = 1;	
                                                                ");
//                          

                        if ($photo_result->num_rows > 0) {

                            while ($row = $photo_result->fetch_assoc()) {
                                $path = $row['path'];
                                echo "<img src='$path' width='400' height='500' alt='' />";
                            }
                        } else {
                            ?>
                            <img src="./asset/themes/images/ladies/daychuyen2.jpg" width="400" height="500" alt="" />


                            <?php
                        }
                        ?>





                    </div>
                    <div class="span5">
                        <address style="font-size: 16px;">
                            <strong>Tên sản phẩm: </strong> <span><?php echo $pr['name'] ?></span><br><br>
                            <strong>Nhãn hiệu: &nbsp;&nbsp;&nbsp;</strong> <span><?php echo $pr['provider'] ?></span><br><br>
    <!--                            <strong>Trạng thái:</strong> <span>Còn hàng</span><br>								-->

                            <p class="price">
                                <strong>Giá gốc: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo number_format($pr['price']); ?> đ
                            </p><br>
                            <p class="price">
                                <strong>Khuyến mãi: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $pr['promotion']; ?> %
                            </p><br>
                            <p class="price" style="font-weight: bold;">
                                Giá bán: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
//                                if ($pr['price'] > 0) {
//                                    echo($pr['price']);
//                                    echo(" VND");
//                                } else
//                                    echo(" Please Call!");
                                echo number_format(round($pr['price'] * (1 - $pr['promotion'] / 100))) . " đ";
                                ?>
                            </p>
                        </address>									
    <!--                        <h4><strong>Giá: 1.200.000VND</strong></h4>-->
                    </div>
                <?php } ?>  
                <div class="span5">
                    <form class="form-inline">
                        <!--                        <label>Số lượng:</label>
                                                <input type="text" class="span1" placeholder="1">
                                                <button class="btn btn-danger" type="submit">Mua ngay</button><br><br><br>-->
                        <button type="button" name="add_cart" class="add_cart btn btn-success" data-pid="<?php echo $i ?>">Thêm vào giỏ hàng</button>
                    </form>
                </div>							
            </div>


            <!--            Mô tả thông số của sản phẩm-->
            <div class="row">
                <div class="span9">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home">Mô tả</a></li>
                        <li class=""><a href="#profile">Thông số</a></li>
                    </ul>							 
                    <div class="tab-content">
                        <div class="tab-pane active" id="home"><?php
                            echo($pr['description']);
                            '';
                            ?></div>
                        <div class="tab-pane" id="profile">
                            <table class="table table-striped shop_attributes">	
                                <tbody>
                                    <tr class="">
                                        <th>Cân nặng</th>
                                        <td><?php
                                            echo($pr['weight']);
                                            '';
                                            ?> gam</td>
                                    </tr>		
                                    <tr class="alt">
                                        <th>Số lượng hàng</th>
                                        <td><?php
                                            echo($pr['quantity']);
                                            '';
                                            ?> chiếc</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>							
                </div>						
                <div class="span9">	
                    <br>
                    <h4 class="title">
                        <span class="pull-left"><span class="text">Sản Phẩm<strong> Liên Quan</strong> </span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel-1" class="carousel slide">
                        <div class="carousel-inner">
                            <!--xử lí sản phẩm liên quan-->
                            <?php
                            $prs = mysqli_query($connect, " SELECT p.id AS id , prm.value AS promotion,  name, price "
                                    . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id "
                                    . "WHERE p.category_id=$cateId ORDER by rand() LIMIT 9 ");

                            $step = 0;
                            $num_row = mysqli_num_rows($prs);
//                            echo '<script>alert("'.$num_row.'")</script>';

                            while ($pr = mysqli_fetch_array($prs)) {
                                $product_id = $pr['id'];
                                $ptr = mysqli_query($connect, "SELECT * FROM images WHERE product_id = $product_id LIMIT 1");
                                $pt = mysqli_fetch_array($ptr);
                                $img = $pt['path'];
                                if (!file_exists($img))
                                    $img = "./asset/themes/images/ladies/daychuyen2.jpg";

                                if ($step == 0) {
                                    echo '<div class="active item">';
                                    echo '<ul class="thumbnails listing-products"><br>';
                                } elseif ($step != 0 && $step % 3 == 0) {
                                    echo '<div class="item">';
                                    echo '<ul class="thumbnails listing-products"><br>';
                                }
                                ?> 
                                <li class="span3">
                                    <div class="product-box">
                                        <a style="display: block" href="product_detail.php?i=<?php echo $pr['id'] ?>">
                                            <span class="sale_tag" style="color: #FF0000;">
                                                <?php
                                                if ($pr['promotion'] > 0)
                                                    echo "- " . $pr['promotion'] . " %";
                                                ?>
                                            </span>
                                            <img src='<?php echo $img; ?>' alt="" >
                                            <p class="title"><?php echo $pr['name']; ?></p>
                                            <!--<p class="category">Phong cách thể thao</p>-->
                                            <p class="price">
                                                <?php
                                                if ($pr['promotion'] > 0) {
                                                    ?>
                                                    <span><del><?php echo number_format($pr['price']) . ' đ' ?></del></span>
                                                    <span class="official-price-box">
                                                        <?php echo number_format(round(($pr['price'] * (1 - $pr['promotion'] / 100)), 0)) . " đ" ?>
                                                    </span>
                                                    <?php
                                                } else {
                                                    echo '<span class="official-price-box">' . number_format($pr['price']) . ' đ</span>';
                                                }
                                                ?>
                                            </p>
                                        </a>
                                        <input type="button" name="add_cart" class="add_cart" data-pid="<?php echo $pr['id'] ?>" value="Thêm vào giỏ hàng">
                                    </div>
                                </li>	
                                <?php
                                if ($step % 3 == 2 || $step == $num_row - 1) {
                                    echo '</ul></div>';
                                }
                                $step += 1;
                            }
                            ?> 

                            <!--    Sản phẩm hot-->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--NỘI DUNG BÊN PHẢI-->
        <div class="span3 col">
            <div class="block">
                <h4 class="title">
                    <span class="pull-left"><span class="text">Sản phẩm <strong>bán chạy</strong></span></span>
                    <span class="pull-right">
                        <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                    </span>
                </h4>
                <div id="myCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $sql = "SELECT product_id, SUM(quantity) as Quantity FROM orders_detail 
                            GROUP BY product_id ORDER BY SUM(quantity) DESC LIMIT 6 ";
                        $query_execute = mysqli_query($connect, $sql);
                        $num = 0;
                        if (isset($query_execute)) {
                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                $product_id = $query_result['product_id'];
                                $query_execute2 = mysqli_query($connect, " SELECT p.id AS id , prm.value AS promotion,  name, price "
                                        . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id "
                                        . "WHERE p.id = $product_id ");
                                $query_result2 = mysqli_fetch_array($query_execute2);

                                $query_execute3 = mysqli_query($connect, "SELECT path FROM images "
                                        . "WHERE product_id = $product_id AND is_thumbnail = 1 AND is_active = 1");
                                $query_result3 = mysqli_fetch_array($query_execute3);
                                $img = $query_result3['path'];
                                if (!file_exists($img))
                                    $img = "./asset/themes/images/ladies/daychuyen2.jpg";
                                ?>
                                <div class="<?php if ($num == 0) echo 'active'; ?> item">
                                    <ul class="thumbnails listing-products">
                                        <li class="span3">
                                            <div class="product-box">
                                                <a style="display: block" href="product_detail.php?i=<?php echo $query_result2['id'] ?>">
                                                    <span class="sale_tag" style="color: #FF0000;">
                                                        <?php
                                                        if ($query_result2['promotion'] > 0)
                                                            echo "- " . $query_result2['promotion'] . " %";
                                                        ?>
                                                    </span>
                                                    <img src='<?php echo $img; ?>' alt="" >
                                                    <p class="title"><?php echo $query_result2['name']; ?></p>
                                                    <!--<p class="category">Phong cách thể thao</p>-->
                                                    <p class="price">
                                                        <?php
                                                        if ($query_result2['promotion'] > 0) {
                                                            ?>
                                                            <span><del><?php echo number_format($query_result2['price']) . ' đ' ?></del></span>
                                                            <span class="official-price-box">
                                                                <?php echo number_format(round(($query_result2['price'] * (1 - $query_result2['promotion'] / 100)), 0)) . " đ" ?>
                                                            </span>
                                                            <?php
                                                        } else {
                                                            echo '<span class="official-price-box">' . number_format($query_result2['price']) . ' đ</span>';
                                                        }
                                                        ?>
                                                    </p>
                                                </a>
                                                <input type="button" name="add_cart" class="add_cart" data-pid="<?php echo $query_result2['id'] ?>" value="Thêm vào giỏ hàng">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                $num += 1;
                            }
                        } else {
                            ?>
                            <div class="active item">
                                <ul class="thumbnails listing-products">
                                    <li class="span3">
                                        <div class="product-box">
                                            <span class="sale_tag"></span>												
                                            <a href="#"><img alt="" src="./asset/themes/images/ladies/daychuyen2.jpg"></a><br/>
                                            <a href="#" class="title">Dây chuyền bạc</a><br/>
                                            <a href="#" class="category">Kiểu đan chéo</a>
                                            <p class="price">1.200.000VND</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="block">								
                <h4 class="title">Đề xuất <strong>Dành Cho Bạn</strong></h4>								
                <ul class="small-product">
                    <?php
                    $query_execute = mysqli_query($connect, "SELECT id, name FROM products ORDER BY rand() LIMIT 6");
                    while ($query_result = mysqli_fetch_array($query_execute)) {
                        $product_id = $query_result['id'];
                        $query_execute2 = mysqli_query($connect, "SELECT path FROM images "
                                . "WHERE product_id = $product_id AND is_thumbnail = 1 AND is_active = 1");
                        $query_result2 = mysqli_fetch_array($query_execute2);
                        $img = $query_result2['path'];
                        if (!file_exists($img))
                            $img = "./asset/themes/images/ladies/daychuyen2.jpg";
                        ?>
                        <li>
                            <a href="./product_detail.php?i=<?php echo $query_result['id'] ?>" title="Praesent tempor sem sodales">
                                <img src="<?php echo $img ?>" alt="Praesent tempor sem sodales">
                            </a>
                            <a href="./product_detail.php?i=<?php echo $query_result['id'] ?>">
                                <?php
                                echo $query_result['name'];
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>

<!--                    <li>
                        <a href="#" title="Luctus quam ultrices rutrum">
                            <img src="./asset/themes/images/ladies/ear-ring3.jpg" alt="Luctus quam ultrices rutrum">
                        </a>
                        <a href="#">Bông tai cánh sen </a>
                    </li>
                    <li>
                        <a href="#" title="Fusce id molestie massa">
                            <img src="./asset/themes/images/ladies/watch1.jpg" alt="Fusce id molestie massa">
                        </a>
                        <a href="#">Đồng hồ OxyWatch</a>
                    </li>   -->
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
require_once 'footer.php';
include 'sticky-cart.php';
?>
<script src="./asset/themes/js/common.js"></script>
<script>
    $(function () {
        $('#myTab a:first').tab('show');
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    })
    $(document).ready(function () {
        $('.thumbnail').fancybox({
            openEffect: 'none',
            closeEffect: 'none'
        });

        $('#myCarousel-2').carousel({
            interval: 2500
        });
    });
</script>
