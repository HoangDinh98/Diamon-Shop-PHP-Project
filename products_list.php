<?php
include 'include.php';
include 'header.php';
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

    <div class="row">
        <div class="span12">

            <div class="row">
                <div class="span12">
                    <h4 class="title">
                      
                        <span class="pull-left"><span class="text"><span class="line">Sản Phẩm 
                                    <strong>
                                        <?php
                                        if(isset($_GET['pi'])) {
                                            $category_id = $_GET['pi'];
                                            $query_execute = mysqli_query($connect, "SELECT name FROM categories WHERE id = $category_id");
                                            while ($query_result = mysqli_fetch_array($query_execute)) {
                                                echo  $query_result['name'];
                                            }
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </strong></span></span></span>
                      
                    </h4>
                        <div id="myCarousel-2" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails"><br> 
                                        <?php
                                        $catg = $_GET['pi'];
                                        $rows_result = mysqli_query($connect, "SELECT id FROM products WHERE category_id=$catg");
                                        $rows_no = mysqli_num_rows($rows_result);
                                        $rows_per_page = 8;
                                        $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                                        $page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
                                        if (!$page_curent)
                                            $page_curent = 1;
                                        $start = ($page_curent - 1) * $rows_per_page;

                                        $prs = mysqli_query($connect, " SELECT id , name, price FROM products 
                                    	
                                            WHERE category_id=$catg
                                            order by id desc 
                                            limit $start,$rows_per_page");
                                        while ($pr = mysqli_fetch_array($prs)) {
                                            $product_id = $pr['id'];
                                            $ptr = mysqli_query($connect, "SELECT * FROM images WHERE product_id = $product_id LIMIT 1");
                                            $pt = mysqli_fetch_array($ptr);
                                            $img = $pt['path'];
                                            if (!file_exists($img))
                                                $img = "./asset/images/products/watch/watch1.jpg";
                                            ?>

                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <a href="product_detail.php?i=<?php echo $pr['id'] ?>">
                                                        <p> <img src='<?php echo $img; ?>' alt="" /></p>
                                                        <p  class="title"><?php echo $pr['name']; ?></p>
                                                        <p class="price"><?php
                                                            if ($pr['price'] > 0) {
                                                                echo($pr['price']);
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
//                                            $catg = $pr['category_id'];
                                        }
                                        ?> 
                                    </ul>
                                </div>
                            </div>
                        </div>


                      
            <!--phân trang-->
            <div style="margin-left: 50%;">
                <?php
                if ($pages_no > 1) {
                    echo "Trang: ";
                    if ($page_curent > 1) {
                        echo "<a href='products_list.php?p=1' class=\"page\" >1</a>&nbsp;&nbsp;";
                        echo "<a href='products_list.php?p=" . ($page_curent - 1) . "' class=\"page\">Trước&nbsp;&nbsp;";
                    }
                    echo "<b class=\"page\" >$page_curent</b>&nbsp;&nbsp;";
                    if ($page_curent < $pages_no) {
                        echo "<a href='products_list.php?p=" . ($page_curent + 1) . "' class=\"page\" >2&nbsp;&nbsp;";
                        echo "<a href='products_list.php?p=$pages_no' class=\"page\" >3</a>&nbsp;&nbsp;";
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
include 'footer.php';
?>

