

<?php
include 'include.php';
require_once("header.php");
?>
<section class="main-content">
           <!-- <section class="header_text sub"> -->
    <!-- Đường dẫn banner -->               					
    <img class="pageBanner" src="./asset/themes/images/banner2.jpg" alt="New products" >
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
                    $prs = mysqli_query($connect, " SELECT p.*
                                            FROM products p

                                            WHERE p.id=$i;	
                                                                ");
                    if (!mysqli_num_rows($prs))
                        echo "<span style='color:red'>Item not found</span>";
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
                                
                                if($photo_result->num_rows > 0 )  {
                                    
                                    while($row = $photo_result->fetch_assoc()) {
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
                        <address>
                            <strong>Nhãn hiệu:</strong> <span>DiamondShop</span><br>
                            <strong>Mã sản phẩm:</strong> <span>NV 123</span><br>
<!--                            <strong>Trạng thái:</strong> <span>Còn hàng</span><br>								-->
                        <a href="product_detail.php" class="title"><?php echo $pr['name']; ?></a><br/>
                                                    <a href="product_detail.php" class="category">Phong cách thể thao</a>
                                                    <p class="price"><?php
                                                        if ($pr['price'] > 0) {
                                                            echo($pr['price']);
                                                            echo(" VND");
                                                        } else
                                                            echo(" Please Call!");
                                                        ?></p>
                        </address>									
<!--                        <h4><strong>Giá: 1.200.000VND</strong></h4>-->
                    </div>
                  <?php } ?>  
                    <div class="span5">
                        <form class="form-inline">
                            <label>Số lượng:</label>
                            <input type="text" class="span1" placeholder="1">
                            <button class="btn btn-danger" type="submit">Mua ngay</button><br><br><br>
                            <button class="btn btn-success" type="submit">Thêm vào giỏ hàng</button>
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
                            <div class="tab-pane active" id="home"><?php echo($pr['description']); '';?></div>
                            <div class="tab-pane" id="profile">
                                <table class="table table-striped shop_attributes">	
                                    <tbody>
                                        <tr class="">
                                            <th>Cân nặng</th>
                                            <td><?php echo($pr['weight']); '';?> gam</td>
                                        </tr>		
                                        <tr class="alt">
                                            <th>Số lượng hàng</th>
                                            <td><?php echo($pr['quantity']); '';?> chiếc</td>
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
                                <div class="active item">
                                    <ul class="thumbnails listing-products">


                                        <!--xử lí sản phẩm liên quan-->
                                         <?php
                $prs = mysqli_query($connect," SELECT p.* FROM products p
                        
                                                  WHERE category_id=$cateId 
                                                  order by rand()
                                            limit 3 ");
                
                $i = 0;
                while ($pr = mysqli_fetch_array($prs)) {
                    $product_id = $pr['id'];
                    $ptr = mysqli_query($connect, "SELECT * FROM images WHERE product_id = $product_id LIMIT 1");
                    $pt = mysqli_fetch_array($ptr);
                    $img = $pt['path'];
                    if (!file_exists($img))
                      $img = "./asset/themes/images/ladies/daychuyen2.jpg";
                    
                    ?> 

                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                              
<!--                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen6.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền vàng</a><br/>
                                                <a href="#" class="category">Kiểu hình bi</a>
                                                <p class="price">3.100.000VND</p>-->
                                                 <p><a href="product_detail.php?i=<?php echo $pr['id'] ?>"><img src='<?php echo $img; ?>' alt="" /></a></p>
                                                    <a href="product_detail.php" class="title"><?php echo $pr['name']; ?></a><br/>
<!--                                                    <a href="product_detail.php" class="category">Phong cách thể thao</a>-->
                                                    <p class="price"><?php
                                                        if ($pr['price'] > 0) {
                                                            echo($pr['price']);
                                                            echo(" VND");
                                                        } else
                                                            echo(" Please Call!");
                                                        ?></p>
                                                    <input type="submit" value="Thêm vào giỏ hàng">
                                            </div>
                                        </li>
                                            <?php
                    $i++;
                }
                ?>
                                        
                                        
<!--                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>												
                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen7.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền bạc</a><br/>
                                                <a href="#" class="category">Kiểu Ý</a>
                                                <p class="price">1.200.000VND</p>
                                            </div>
                                        </li>       
                                        <li class="span3">
                                            <div class="product-box">												
                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen8.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền bạc</a><br/>
                                                <a href="#" class="category">Kiểu mặt đá cẩm thạch</a>
                                                <p class="price">5.000.000VND</p>
                                            </div>
                                        </li>												-->
                                    </ul>
                                </div>
<!--                                Sản phẩm hot-->
                


                                <div class="item">
                                    <ul class="thumbnails listing-products">
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>												
                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen3.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền bạc</a><br/>
                                                <a href="#" class="category">Kiểu đan chéo</a>
                                                <p class="price">1.100.000VND</p>
                                            </div>
                                        </li>       
                                        <li class="span3">
                                            <div class="product-box">												
                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen5.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền bạc</a><br/>
                                                <a href="#" class="category">Kiểu Pháp</a>
                                                <p class="price">1.300.000VND</p>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>												
                                                <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen7.jpg"></a><br/>
                                                <a href="product_detail.html" class="title">Dây chuyền vàng</a><br/>
                                                <a href="#" class="category">Kiểu vàng Ý</a>
                                                <p class="price">2.000.000VND</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3 col">
                <div class="block">	
                    <ul class="nav nav-list">
                        <li class="nav-header">DANH MỤC</li>
                        <li><a href="products.html">Dây chuyền</a></li>
                        <li class="active"><a href="products.html">Sản phẩm mới</a></li>
                        <li><a href="products.html">Đồng hồ</a></li>
                        <li><a href="products.html">Nhẫn</a></li>
                        <li><a href="products.html">Bông tai</a></li>

                    </ul>
                    <br/>
                    <ul class="nav nav-list below">
                        <li class="nav-header">NHÀ SẢN XUẤT</li>
                        <li><a href="products.html">Adidas</a></li>
                        <li><a href="products.html">Nike</a></li>
                        <li><a href="products.html">Dunlop</a></li>
                        <li><a href="products.html">Yamaha</a></li>
                    </ul>
                </div>
                <div class="block">
                    <h4 class="title">
                        <span class="pull-left"><span class="text">Sản phẩm hot</span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails listing-products">
                                    <li class="span3">
                                        <div class="product-box">
                                            <span class="sale_tag"></span>												
                                            <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen2.jpg"></a><br/>
                                            <a href="product_detail.html" class="title">Dây chuyền bạc</a><br/>
                                            <a href="#" class="category">Kiểu đan chéo</a>
                                            <p class="price">1.200.000VND</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails listing-products">
                                    <li class="span3">
                                        <div class="product-box">												
                                            <a href="product_detail.html"><img alt="" src="./asset/themes/images/ladies/daychuyen7.jpg"></a><br/>
                                            <a href="product_detail.html" class="title">Dây chuyền vàng</a><br/>
                                            <a href="#" class="category">Kiểu đan chéo Ý</a>
                                            <p class="price">1.300.000VND</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block">								
                    <h4 class="title">Sản phẩm <strong>Nổi Bật</strong></h4>								
                    <ul class="small-product">
                        <li>
                            <a href="#" title="Praesent tempor sem sodales">
                                <img src="./asset/themes/images/ladies/ring1.jpg" alt="Praesent tempor sem sodales">
                            </a>
                            <a href="#">Nhẫn bạc đan chéo</a>
                        </li>
                        <li>
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
                        </li>   
                    </ul>
                </div>
            </div>
        </div>
    <?php require_once 'footer.php'; ?>
</div>
</section>
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
