<?php
include 'include.php';
include 'header.php';
$is_continue = 0;
?>
<?php
if (isset($_POST ['search']) || isset($_GET['page'])) {
    if (isset($_POST['searchtext'])) {
        $search = $_POST['searchtext'];
    }

    if (isset($_GET['searchtext'])) {
        $search = $_GET['searchtext'];
        $is_continue = 1;
//        echo '<script>alert( " AN ' . $search . '")</script>';
    }

//    $sql_search = "SELECT * FROM products WHERE name LIKE '%$search%' "
//            . "OR description LIKE '%$search%' OR price LIKE '%$search%' ";
    $sql_search = "SELECT p.id AS id , prm.value AS promotion,  name, price "
            . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id  WHERE p.name LIKE '%$search%' "
            . "OR p.description LIKE '%$search%' OR p.price LIKE '%$search%' ";

//    echo '<script>alert( " AN ' . $sql_search . '")</script>';

    $query_search = mysqli_query($connect, $sql_search);

    $page_curent = isset($_GET['page']) ? $_GET['page'] : 1;
    $rows_no = mysqli_num_rows($query_search);
//    echo '<script>alert("'.$rows_no.'")</script>';
    $rows_per_page = 8;
    $pages_no = intval(($rows_no - 1) / $rows_per_page) + 1;
    if (!$page_curent)
        $page_curent = 1;
    $start = ($page_curent - 1) * $rows_per_page;

//    $sql_search = "SELECT * FROM products WHERE name LIKE '%$search%' "
//            . "OR description LIKE '%$search%' OR price LIKE '%$search%'  LIMIT $start,$rows_per_page  ";

    $sql_search = "SELECT p.id AS id , prm.value AS promotion,  name, price "
            . "FROM products AS p JOIN promotions AS prm ON p.promotion_id = prm.id  WHERE p.name LIKE '%$search%' "
            . "OR p.description LIKE '%$search%' OR p.price LIKE '%$search%'  LIMIT $start,$rows_per_page  ";

    $query_search = mysqli_query($connect, $sql_search);
//    echo '<script>alert( " A1 ' . mysqli_num_rows($query_search) . '")</script>';
}
?>
<?php
if (isset($_REQUEST['search']) || $is_continue == 1) {
    // Gán hàm addslashes để chống sql injection
    if (isset($_REQUEST['search'])) {
        $search = addslashes($_POST['searchtext']);
    }

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($search) && $is_continue == 0) {
//        echo '<script>alert( " AE  ")</script>';
        include 'content.php';
    } else {
//        echo '<script>alert( " AF  ")</script>';
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


            <?php if (mysqli_num_rows($query_search) == 0) { ?>
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
                                                    <a style="display: block" href="product_detail.php?i=<?php echo $dong_search['id'] ?>">
                                                        <span class="sale_tag" style="color: #FF0000;">
                                                            <?php
                                                            if ($dong_search['promotion'] > 0)
                                                                echo "- " . $dong_search['promotion'] . " %";
                                                            ?>
                                                        </span>
                                                        <img src='<?php echo $img; ?>' alt="" >
                                                        <p class="title"><?php echo $dong_search['name']; ?></p>
                                                        <!--<p class="category">Phong cách thể thao</p>-->
                                                        <p class="price">
                                                            <?php
                                                            if ($dong_search['promotion'] > 0) {
                                                                ?>
                                                                <span><del><?php echo number_format($dong_search['price']) . ' đ' ?></del></span>
                                                                <span class="official-price-box">
                                                                    <?php echo number_format(round(($dong_search['price'] * (1 - $dong_search['promotion'] / 100)), 0)) . " đ" ?>
                                                                </span>
                                                                <?php
                                                            } else {
                                                                echo '<span class="official-price-box">' . number_format($dong_search['price']) . ' đ</span>';
                                                            }
                                                            ?>
                                                        </p>
                                                    </a>
                                                    <input type="button" name="add_cart" class="add_cart" data-pid="<?php echo $dong_search['id'] ?>" value="Thêm vào giỏ hàng">
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
                if ($pages_no > 1) {
                    echo "Pages: ";
                    if ($page_curent >= 1) {
                        if ($page_curent > 1) {
                            echo "<a href='search.php?page=1&searchtext=" . $search . "' class=\"page-direct\" >&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
                            echo "<a href='search.php?page=" . ($page_curent - 1) . "&searchtext=" . $search . "' class=\"page-direct\">&nbsp;&nbsp;<&nbsp;&nbsp;</a>";
                        }

                        for ($i = 1; $i <= $pages_no; $i++) {
                            ?>
                            <a href='search.php?page=<?php echo $i ?>&searchtext=<?php echo $search; ?>' 
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
                        echo "<a href='search.php?page=" . ($page_curent + 1) . "&searchtext=" . $search . "' class=\"page-direct\" >&nbsp;&nbsp;>&nbsp;&nbsp;</a>";
                        echo "<a href='search.php?page=" . $pages_no . "&searchtext=" . $search . "' class=\"page-direct\" >&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
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
include './sticky-cart.php';
include 'footer.php';
?>  


