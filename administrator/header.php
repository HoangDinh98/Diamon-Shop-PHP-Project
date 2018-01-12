<!DOCTYPE html><!--[if IE 8]><html lang="en" class="ie8"></html><![endif]--><!--[if IE 9]><html lang="en" class="ie9"></html><![endif]--><!--[if !IE]><!-->
<html lang="vi">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Admin Lab Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!--<link href="./css/mystyle.css" rel="stylesheet" type="text/css">-->
        
        <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="./assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="./assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="./css/style.min.css" rel="stylesheet" />
        <link href="./css/style_responsive.css" rel="stylesheet" />

        <link href="./css/style_default.css" rel="stylesheet" id="style_color" />
        <link href="./assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="./assets/uniform/css/uniform.default.css" />
        <link href="./assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="./assets/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />

        <!--<link href="./css/mystyle.css" rel="stylesheet" type="text/css">-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="../asset/bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>

    </head>
    <body class="fixed-top">
        <div id="header" class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid"><a class="brand" href="./index.php"><img src="./img/logo.png" alt="Admin Lab" /></a><a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span><span class="arrow"></span></a>
                    <div id="top_menu" class="nav notify-row">
                        <ul class="nav top-menu">
                            <li class="dropdown"><a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Settings"><i class="icon-cog"></i></a></li>
                            <li class="dropdown" id="header_inbox_bar"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope-alt"></i><span class="badge badge-important">5</span></a>
                                <ul class="dropdown-menu extended inbox">
                                    <li>
                                        <p>You have 5 new messages</p>
                                    </li>
                                    <li><a href="#"><span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span><span class="subject"><span class="from">Dulal Khan</span><span class="time">Just now</span></span><span class="message"> Hello, this is an example messages please check </span></a></li>
                                    <li><a href="#"><span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span><span class="subject"><span class="from">Rafiqul Islam</span><span class="time">10 mins</span></span><span class="message"> Hi, Mosaddek Bhai how are you ? </span></a></li>
                                    <li><a href="#"><span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span><span class="subject"><span class="from">Sumon Ahmed</span><span class="time">3 hrs</span></span><span class="message"> This is awesome dashboard templates </span></a></li>
                                    <li><a href="#"><span class="photo"><img src="./img/avatar-mini.png" alt="avatar" /></span><span class="subject"><span class="from">Dulal Khan</span><span class="time">Just now</span></span><span class="message"> Hello, this is an example messages please check </span></a></li>
                                    <li><a href="#">See all messages</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" id="header_notification_bar"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bell-alt"></i><span class="badge badge-warning">7</span></a>
                                <ul class="dropdown-menu extended notification">
                                    <li>
                                        <p>You have 7 new notifications</p>
                                    </li>
                                    <li><a href="#"><span class="label label-important"><i class="icon-bolt"></i></span> Server #3 overloaded. <span class="small italic">34 mins</span></a></li>
                                    <li><a href="#"><span class="label label-warning"><i class="icon-bell"></i></span> Server #10 not respoding. <span class="small italic">1 Hours</span></a></li>
                                    <li><a href="#"><span class="label label-important"><i class="icon-bolt"></i></span> Database overloaded 24%. <span class="small italic">4 hrs</span></a></li>
                                    <li><a href="#"><span class="label label-success"><i class="icon-plus"></i></span> New user registered. <span class="small italic">Just now</span></a></li>
                                    <li><a href="#"><span class="label label-info"><i class="icon-bullhorn"></i></span> Application error. <span class="small italic">10 mins</span></a></li>
                                    <li><a href="#">See all notifications</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--  -->

                    <div class="shop-name">
                        Diamond shop
                    </div>


                    <div class="top-nav ">
                        <ul class="nav pull-right top-menu">
                            <li class="dropdown mtop5"><a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Chat"><i class="icon-comments-alt"></i></a></li>
                            <li class="dropdown mtop5"><a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Help"><i class="icon-headphones"></i></a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="./img/avatar1_small.jpg" alt="" /><span class="username">Mosaddek Hossain</span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
                                    <li><a href="#"><i class="icon-calendar"></i> Calendar</a></li>
                                    <li class="divider"></li>
                                    <li><a href="./login/logout.php"><i class="icon-key"></i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="container" class="row-fluid">
            <div id="sidebar" class="nav-collapse collapse">
                <div class="sidebar-toggler hidden-phone"></div>
                <div class="navbar-inverse">
                    <form class="navbar-search visible-phone" />

                    <input type="text" class="search-query" placeholder="Search" />
                    </form>
                </div>
                <ul class="sidebar-menu">
                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'home') echo 'active';?>">
                        <a href="./index.php" class=""><span class="icon-box"><i class="icon-home"></i></span>
                            Trang chủ Admin 
                        </a>
                    </li>
                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'products') echo 'active';?>">
                        <a href="./products.php" class="" id="product-page"><span class="icon-box"><i class="icon-leaf"></i></span>
                            Sản phẩm 
                        </a>
                    </li>
                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'categories') echo 'active';?>">
                        <a href="./categories.php" class=""><span class="icon-box"><i class="icon-tasks"></i></span>
                            Danh mục sản phẩm 
                        </a>
                    </li>

                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'providers') echo 'active';?>">
                        <a href="./providers.php" class=""><span class="icon-box"><i class="icon-briefcase"></i></span>
                            Nhà cung cấp 
                        </a>
                    </li>

                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'promotions') echo 'active';?>">
                        <a href="./promotions.php" class=""><span class="icon-box"><i class="icon-fire"></i></span>
                            Khuyến mãi 
                        </a>
                    </li>

                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'users') echo 'active';?>">
                        <a href="./users.php" class=""><span class="icon-box"><i class="icon-group"></i></span>
                            Tài khoản người dùng 
                        </a>
                    </li>
                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'orders') echo 'active';?>">
                        <a href="./orders.php" class=""><span class="icon-box"><i class="icon-shopping-cart"></i></span>
                            Đơn hàng 
                        </a>
                    </li>
<!--                    <li class="has-sub <?php if(isset($_SESSION['task']) && $_SESSION['task'] == 'comments') echo 'active';?>">
                        <a href="./comments.php" class=""><span class="icon-box"><i class="icon-comments"></i></span>
                            Bình luận 
                        </a>
                    </li>-->
                </ul>
            </div>
            <div id="main-content">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div id="theme-change" class="hidden-phone"><i class="icon-cogs"></i><span class="settings"><span class="text">Theme:</span><span class="colors"><span class="color-default" data-style="default"></span><span class="color-gray" data-style="gray"></span><span class="color-purple" data-style="purple"></span><span class="color-navy-blue" data-style="navy-blue"></span></span></span></div>
                            <h3 class="page-title">
                                <?php
                                    if($_SESSION['task'] == 'home') {
                                        echo 'TRANG CHỦ ADMIN';
                                    }
                                    if($_SESSION['task'] == 'products') {
                                        echo 'QUẢN LÝ SẢN PHẨM';
                                    }
                                    if($_SESSION['task'] == 'categories') {
                                        echo 'QUẢN LÝ DANH MỤC SẢN PHẨM';
                                    }
                                    if($_SESSION['task'] == 'providers') {
                                        echo 'QUẢN LÝ CÁC NHÀ CUNG CẤP';
                                    }
                                    if($_SESSION['task'] == 'promotions') {
                                        echo 'QUẢN LÝ CÁC KHUYẾN MÃI';
                                    }
                                    if($_SESSION['task'] == 'users') {
                                        echo 'QUẢN LÝ TÀI KHOẢN NGƯỜI DÙNG';
                                    }
                                    if($_SESSION['task'] == 'orders') {
                                        echo 'QUẢN LÝ ĐƠN HÀNG';
                                    }
                                    if($_SESSION['task'] == 'comments') {
                                        echo 'QUẢN LÝ CÁC BÌNH LUẬN';
                                    }
                                ?>
                            </h3>
                            
                        </div>
                    </div>