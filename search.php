<?php
include 'include.php';
include 'header.php';
?>
<?php
if ($_POST ['search']) {
    $search = $_POST['searchtext'];
    $sql_search = "SELECT * FROM products WHERE name LIKE '%$search%' "
            . "or description LIKE '%$search%' or price LIKE '%$search%' ";
    $query_search = mysqli_query($connect, $sql_search);
}
?>
<?php
if (isset($_REQUEST['search'])) {
    // Gán hàm addslashes để chống sql injection
    $search = addslashes($_POST['searchtext']);

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($search)) {
        include 'content.php';
    } else {
        ?>

        <section  class="homepage-slider" id="home-slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="./asset/themes/images/carousel/slideshow1.jpg" alt="">
                    </li>
                    <li>
                        <img src="./asset/themes/images/carousel/slideshow2.jpg" alt="">
                    </li>
                </ul>
            </div>			
        </section>
        <section class="main-content">


        <?php if ($count = mysqli_num_rows($query_search) == 0) { ?>
                <div>
                    Không tìm thấy sản phẩm nào
                </div>
            <?php
        } else {
            ?>
                <div class="row">
                    <div class="span12">
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><span class="line">Sản Phẩm <strong>Tìm Thấy</strong></span></span></span>
                        </h4>
                        <div id="myCarousel-2" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">                    
            <?php
            while ($dong_search = mysqli_fetch_array($query_search)) {
                $product_id = $dong_search['id'];
                $ptr = mysqli_query($connect, "SELECT id, path FROM images where product_id = $product_id LIMIT 1");
                $pt = mysqli_fetch_array($ptr);
                $img = $pt['path'];
                if (!file_exists($img))
                    $img = "./asset/images/ladies/daychuyen2.jpg";
                ?>    
                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <a href="product_detail.php?i=<?php echo $dong_search['id'] ?>">
                                                        <p><img src='<?php echo $img; ?>' alt="" /></p>
                                                        <p class="title"><?php echo $dong_search['name']; ?></p>          
                                                        <p class="price"><?php
                            if ($dong_search['price'] > 0) {
                                echo($dong_search['price']);
                                echo(" VND");
                            } else
                                echo(" Please Call!");
                ?></p> 
                                                    </a>
                                                    <div>
                                                        <input type="submit" value="Thêm vào giỏ hàng">
                                                    </div>
                                                </div>
                                            </li>
                <?php
            }
            ?> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>							
                </div>
            <?php
        }
        ?>
            <!--phân trang-->
            <div style="margin-left: 50%;">
            <?php
            $rows_no = mysqli_num_rows($query_search);
            $rows_per_page = 8;
            $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;
            if ($pages_no > 1) {
                echo "Trang: ";
                if ($page_curent > 1) {
                    echo "<a href='demo.php?p=1' class=\"page\" >1</a>&nbsp;&nbsp;";
                    echo "<a href='demo.php?p=" . ($page_curent - 1) . "' class=\"page\">Trước&nbsp;&nbsp;";
                }
                echo "<b class=\"page\" >$page_curent</b>&nbsp;&nbsp;";
                if ($page_curent < $pages_no) {
                    echo "<a href='demo.php?p=" . ($page_curent + 1) . "' class=\"page\" >2&nbsp;&nbsp;";
                    echo "<a href='demo.php?p=$pages_no' class=\"page\" >3</a>&nbsp;&nbsp;";
                }
            }
            ?>
            </div>
            <div class="row feature_box">						
                <div class="span4">
                    <div class="service">
                        <div class="responsive">	
                            <img src="./asset/themes/images/feature_img_2.png" alt="" />
                            <h4>MODERN <strong>DESIGN</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>									
                        </div>
                    </div>
                </div>
                <div class="span4">	
                    <div class="service">
                        <div class="customize">			
                            <img src="./asset/themes/images/feature_img_1.png" alt="" />
                            <h4>FREE <strong>SHIPPING</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="service">
                        <div class="support">	
                            <img src="./asset/themes/images/feature_img_3.png" alt="" />
                            <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
                        </div>
                    </div>
                </div>	
            </div>		

            <!--			</section>-->
            <section class="our_client">
                <h4 class="title"><span class="text">Manufactures</span></h4>
                <div class="row">					
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/14.png"></a>
                    </div>
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/35.png"></a>
                    </div>
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/1.png"></a>
                    </div>
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/2.png"></a>
                    </div>
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/3.png"></a>
                    </div>
                    <div class="span2">
                        <a href="#"><img alt="" src="./asset/themes/images/clients/4.png"></a>
                    </div>
                </div>
            </section> 
        </section>
        <?php
    }
}
?>
<?php
include 'footer.php';
?>  


