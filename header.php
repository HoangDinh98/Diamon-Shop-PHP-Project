<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Diamond Shop</title>
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
        <link href="./asset/font/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

    </head>
    <body>		
        <div id="top-bar" class="container">
            <div class="row">
                <div class="span4">
                    <a href="index.php" class="logo pull-left">
                        <img src="./asset/themes/images/logo1.png" class="site_logo" alt=""></a>

                </div>
                <div class="span8">
                    <div class="account pull-right">
                        <ul class="user-menu">
                            <?php if (isset($_SESSION['username'])) {
                                ?>
                                <li><a href="#">Xin chào <?php echo $_SESSION['username']; ?></a></li>
                                <?php
                                if($_SESSION['username']=='admin') {
                                    echo '<li><a href = "./administrator/login/login.php">Quản trị trang</a></li>';
                                }
                                ?>
                                <li><a href="./Login/logout.php">Đăng xuất</a></li>
                                <?php
                            } else {
                                ?>
                                <li><a href="Login/login.php">Đăng Nhập</a></li>					
                                <li><a href="Login/register.php">Đăng kí</a></li>
                                <?php
                            }
                            ?> 

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper" class="container">
            <section class="navbar main-menu">
                <div class="navbar-inner main-menu">
                    <div class="span4">

                        <!--                        <form action="search.php" method="POST" >
                                                    <table cellpadding="0px" cellspacing="0px"> 
                                                        <tr> 
                                                            <td style="border-style:solid none solid solid;border-color:#4B7B9F;border-width:1px;">
                                                                <input type="text" name="searchtext" style="width:30%; border:0px solid; height:10%; padding:0px 3px; position:relative;"> 
                                                            </td>
                                                            <td style="border-style:solid;border-color:#4B7B9F;border-width:1px;"> 
                                                                <input type="submit" name ="search" style="border-style: none; background: url('searchbutton3.gif') no-repeat; width: 24px; height: 20px;">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>-->
                        <form action="search.php" method="POST" class="search_form">
                            <table>
                                <tr>
                                    <td>
                                        <input type="text" class="input-block-level search-query" Placeholder="Nhập thông tin cần tìm"
                                               style="color: black;" name="searchtext">
                                    </td>
                                    <td>
                                        <!--                            cần thêm hình ảnh icon search vào-->
                                        <input type="submit" value="" name="search" style="background-image: url(./asset/images/iconsearch4.jpg); width: 50%; height: 100%;">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <nav id="menu" class="pull-right">
                        <ul style="margin-right: 97px;">
                            <li><a href="index.php">Trang chủ</a>

                                <?php
                                $i = 0;
                                $cats = mysqli_query($connect, "SELECT * FROM categories WHERE parent_id=0");
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
                                            <li><a href="products_list.php?pi=<?php echo $sc['id'] ?>"><?php echo $sc['name'] ?></a></li>
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