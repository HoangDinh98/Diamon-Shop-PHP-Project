<?php include 'include.php'; ?>
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
                        <span class="pull-left"><span class="text"><span class="line">Sản Phẩm <strong>Nổi Bật</strong></span></span></span>
                          

                        <div id="myCarousel-2" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails"><br> 
                                        <?php
                                        $rows_result = mysqli_query($connect, "SELECT id FROM products");
                                        $rows_no = mysqli_num_rows($rows_result);
                                        $rows_per_page = 8;
                                        $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                                        $page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
                                        if (!$page_curent)
                                            $page_curent = 1;
                                        $start = ($page_curent - 1) * $rows_per_page;

                                        $prs = mysqli_query($connect, " SELECT id , name, price FROM products
                                                            order by id desc 
                                                            limit $start,$rows_per_page
                                                                ");

                                        while ($pr = mysqli_fetch_array($prs)) {

                                            $product_id = $pr['id'];
                                            $ptr = mysqli_query($connect, "SELECT id, path FROM images where product_id = $product_id LIMIT 1");
                                            $pt = mysqli_fetch_array($ptr);
                                            $img = $pt['path'];
                                            if (!file_exists($img))
                                                $img = "./asset/images/ladies/daychuyen2.jpg";
                                            ?>


                                            <li class="span3">

                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <p><a href="product_detail.php?i=<?php echo $pr['id'] ?>"><img src='<?php echo $img; ?>' alt="" /></a></p>
                                                    <a href="product_detail.php" class="title"><?php echo $pr['name']; ?></a><br/>
                                                    <a href="product_detail.php" class="category">Phong cách thể thao</a>
                                                    <p class="price"><?php
                                        if ($pr['price'] > 0) {
                                            echo($pr['price']);
                                            echo(" VND");
                                        } else
                                            echo(" Please Call!");
                                        ?></p>

                                                </div>
                                            </li>


                                            <?php
                                        }
                                        ?> 
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <br>
                        <div class="row">
                            <div class="span12">
                                <h4 class="title">
                                    <span class="pull-left"><span class="text"><span class="line">Sản Phẩm <strong>Phổ Biến</strong></span></span></span>

                                </h4>
                                <div id="myCarousel-2" class="myCarousel carousel slide">
                                    <div class="carousel-inner">
                                        <div class="active item">
                                            <ul class="thumbnails">
                                                <?php
                                                $rows_result = mysqli_query($connect, "SELECT id FROM products");
                                                $rows_no = mysqli_num_rows($rows_result);
                                                $rows_per_page = 8;
                                                $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;

                                                $page_curent = isset($_GET['p']) ? $_GET['p'] : 1;
                                                if (!$page_curent)
                                                    $page_curent = 1;
                                                $start = ($page_curent - 1) * $rows_per_page;

                                                $prs = mysqli_query($connect, " SELECT id , name, price FROM products
                                                            order by id desc 
                                                            limit $start,$rows_per_page
                                                                ");

                                                while ($pr = mysqli_fetch_array($prs)) {

                                                    $product_id = $pr['id'];
                                                    $ptr = mysqli_query($connect, "SELECT * FROM images where product_id = $product_id LIMIT 1");
                                                    $pt = mysqli_fetch_array($ptr);
                                                    $img = $pt['path'];
                                                    if (!file_exists($img))
                                                        $img = "./asset/images/ladies/daychuyen2.jpg";
                                                    ?>


                                                    <li class="span3">

                                                        <div class="product-box">
                                                            <span class="sale_tag"></span>
                                                            <p><a href="product_detail.php?i=<?php echo $pr['id'] ?>"><img src='<?php echo $img; ?>' alt="" /></a></p>
                                                            <a href="product_detail.php" class="title"><?php echo $pr['name']; ?></a><br/>
                                                            <a href="product_detail.php" class="category">Phong cách thể thao</a>
                                                            <p class="price"><?php
                                                                if ($pr['price'] > 0) {
                                                                    echo($pr['price']);
                                                                    echo(" VND");
                                                                } else
                                                                    echo(" Please Call!");
                                                                ?></p>

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
                </div>						
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
