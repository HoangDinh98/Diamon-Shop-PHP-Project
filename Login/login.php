<?php
//include '../include.php';
include 'action_login.php';
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../asset/bootstrap-3.3.7/css/bootstrap.min.css">
        <script src="../asset/bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
        <script src="../asset/bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        
                        <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                             alt="img/jpg">
                        
                        <form class="form-signin" method="POST">
                            <input type="text" class="form-control" placeholder="Email" name="username" id="username" value="<?php echo $user_name; ?>"  autofocus>
                            <span class="error"><?php echo $user_nameErr;?></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $pass_word; ?>">
                            <span class="error"><?php echo $pass_wordErr; ?></span>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">
                                Sign in</button>
                            <label class="checkbox pull-left">
                                <input type="checkbox" value="remember-me">
                                Remember me
                            </label>
                            <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                        </form>
                    </div>
                    <a href="register.php" class="text-center new-account">Bạn chưa có tài khoản? Đăng kí tại đây! </a>
                    <a href="../demo.php" class="text-center new-account" >Quay lại trang chủ</a>
                </div>
            </div>
        </div>

    </body>
</html>