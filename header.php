<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap E-commerce Templates</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
        <!-- bootstrap -->
        <link href="./asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">      
        <link href="./asset/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="./asset/themes/css/bootstrappage.css" rel="stylesheet"/>

        <!-- global styles -->
        <link href="./asset/themes/css/flexslider.css" rel="stylesheet"/>
        <link href="./asset/themes/css/main.css" rel="stylesheet"/>

        <!-- scripts -->
        <script src="./asset/themes/js/jquery-1.7.2.min.js"></script>
        <script src="./asset/bootstrap/js/bootstrap.min.js"></script>				
        <script src="./asset/themes/js/superfish.js"></script>	
        <script src="./asset/themes/js/jquery.scrolltotop.js"></script>
        <!--[if lt IE 9]>			
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>		
        <div id="top-bar" class="container">
            <div class="row">
                <div class="span4">
                    <form method="POST" class="search_form">
                        <input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
                    </form>
                </div>
                <div class="span8">
                    <div class="account pull-right">
                        <ul class="user-menu">				
                            <li><a href="cart.html">Giỏ Hàng</a></li>
                            <li><a href="Login/login.php">Đăng Nhập</a></li>					
                            <li><a href="Login/register.php">Đăng kí</a></li>		
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper" class="container">
            <section class="navbar main-menu">
                <div class="navbar-inner main-menu">				
                    <a href="index.html" class="logo pull-left"><img src="./asset/themes/images/logo_1.png" class="site_logo" alt=""></a>
                    <nav id="menu" class="pull-right">
                        <ul style="margin-right: 97px;">
                            <li><a href="demo.php">Trang chủ</a>

                                <?php
                                $i = 0;
                                $cats = mysqli_query($connect, "SELECT * FROM categories where parent_id=0");
                                while ($c = mysqli_fetch_array($cats)) {
                                    ?>

                                <li><a href=""> <?php echo $c['name'] ?></a>					
                                    <ul <?php
                                    echo($i);
                                    $i++;
                                    ?> >
                                            <?php
                                            $scats = mysqli_query($connect, "SELECT * FROM categories WHERE parent_id=$c[id]");
                                            while ($sc = mysqli_fetch_array($scats)) {
                                                ?>
                                            <li><a href="./products.php"><?php echo $sc['name'] ?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>                         					
                        </ul>
                    </nav>
                </div>
            </section>