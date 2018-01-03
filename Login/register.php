<!DOCTYPE html>
<?php
include '../include.php';
?>

<?php
$user_name = $email = $password = $fullname = $gender = $birthday = $phone = '';
$user_nameErr = $emailErr = $passwordErr = $repasswordErr = $fullnameErr = $genderErr = $birthdayErr = $phoneErr = '';
$isErr = FALSE;

function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_unique($data, $connect, $type) {
    switch ($type) {
        case 1: $query = mysqli_query($connect, "SELECT id FROM users WHERE user_name = '$data'");
            break;
        case 2: $query = mysqli_query($connect, "SELECT id FROM users WHERE email = '$data'");
            break;
    }
//    $query = mysqli_query($connect, "SELECT id FROM users WHERE user_name = '$data' OR email = '$data'");
    if (mysqli_num_rows($query) == 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

;
//echo '<script>alert("OK")</script>';

if (isset($_POST["submit"])) {
//    echo '<script>alert("OK 2")</script>';
    if (empty($_POST['user_name'])) {
        $user_nameErr = "Vui lòng nhập tên tài khoản";
        $isErr = TRUE;
    } else {
        if (test_unique($_POST['user_name'], $connect, 1)) {
            $user_name = standardize_data($_POST['user_name']);
        } else {
            $user_name = $_POST['user_name'];
            $user_nameErr = "Tài khoản đã tồn tại";
            $isErr = TRUE;
        }
    }

    if (empty($_POST['email'])) {
        $emailErr = "Vui lòng nhập email";
        $isErr = TRUE;
    } else {
        if (test_unique($_POST['email'], $connect, 2)) {
            $email = standardize_data($_POST['email']);
        } else {
            $email = $_POST['email'];
            $emailErr = "Email đã tồn tại";
            $isErr = TRUE;
        }
    }

    if (empty($_POST['password']) && empty($_POST['repassword'])) {
        $passwordErr = 'Vui lòng nhập vào Mật khẩu';
        $isErr = TRUE;
    } elseif (empty($_POST['password']) && !empty($_POST['repassword'])) {
        $passwordErr = 'Vui lòng nhập vào Mật khẩu';
        $isErr = TRUE;
    } elseif ((!empty($_POST['password']) && empty($_POST['repassword'])) || (!empty($_POST['password']) && !empty($_POST['repassword']))) {
        if (strlen($_POST['password']) < 8) {
            $passwordErr = 'Mật khẩu phải từ 8 ký tự trở lên';
        }
        $repasswordErr = 'Vui lòng xác nhận lại Mật khẩu';
        $isErr = TRUE;
    } else {
        if ($_POST['password'] != $_POST['repassword']) {
            $passwordErr = "Mật khẩu và xác nhận mật khẩu không giống nhau";
        }
        $password = standardize_data($_POST['password']);
    }

    if (empty($_POST['fullname'])) {
        $fullnameErr = 'Vui lòng nhập họ tên đầy đủ';
        $isErr = TRUE;
    } else {
        $fullname = standardize_data($_POST['fullname']);
    }

    if (empty($_POST['birthday'])) {
        $birthdayErr = 'Vui lòng nhập ngày tháng năm sinh';
        $isErr = TRUE;
    } else {
        $birthday = $_POST['birthday'];
    }

    if (!$isErr) {
        $query = "INSERT INTO users(user_name, email, password, fullname, gender, birthday, phone)"
                . "VALUES(?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssssids", $user_name, $email, MD5($pass_word), $fullname, $gender, $birthday, $phone);
        if ($stmt->execute()) {
            echo '<script>alert("Đăng ký thành công! Nhẫn OK để Đăng nhập")</script>';
            header("Location: ./login.php");
        } else {
            echo '<script>alert("Đã xảy ra lỗi!")</script>';
//                    header("Location: ./register.php");
        }
    } else {
//                header("Location: ./register.php");
    }
}
?>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../asset/bootstrap-3.3.7/css/bootstrap.min.css">
        <script src="../asset/bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="../asset/bootstrap-3.3.7/js/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Enter Your Details Here
                    </div>
                    <div class="panel-body">
                        <form id="register-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group">
                                <label for="myName">Tên tài khoản *</label>
                                <input id="user_name" name="user_name" class="form-control" type="text" data-validation="required" value="<?php echo $user_name ?>">
                                <span id="error_name" class="text-danger"><?php echo $user_nameErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Email *</label>
                                <input id="email" name="email" class="form-control" type="email" data-validation="email" value="<?php echo $email ?>">
                                <span id="error_lastname" class="text-danger"><?php echo $emailErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="age">Mật khẩu *</label>
                                <input id="password" name="password"  class="form-control" type="password">
                                <span id="error_age" class="text-danger"><?php echo $passwordErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="age">Nhập lại mật khẩu *</label>
                                <input id="repassword" name="repassword"  class="form-control" type="password">
                                <span id="error_age" class="text-danger"><?php echo $repasswordErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="myName">Tên đầy đủ*</label>
                                <input id="fullname" name="fullname" class="form-control" type="text" data-validation="required" value="<?php echo $fullname ?>">
                                <span id="error_name" class="text-danger"><?php echo $fullnameErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option selected value="1">Male</option>
                                    <option value="0">Female</option>
                                    <option value="2">Other</option>
                                </select>
                                <span id="error_gender" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date Of Birth *</label>
                                <input type="date" name="birthday" id="birthday" class="form-control">
                                <span id="error_dob" class="text-danger"><?php echo $birthdayErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại *</label>
                                <input type="text" id="phone" name="phone" class="form-control" >
                                <span id="error_phone" class="text-danger"><?php echo $phoneErr ?></span>
                            </div>
                            <input type="submit" id="submit" name="submit" value="SUBMIT" class="btn btn-primary center">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>