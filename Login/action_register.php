<?php

include '../include.php';

$user_name = $email = $password = $fullname = $gender = $birthday = $phone = '';
$user_nameErr = $emailErr = $passwordErr = $repasswordErr = $fullnameErr = $genderErr = $birthdayErr = $phoneErr = '';
$isErr = FALSE;


if (isset($_POST['submit'])) {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin");</script>';
    } else {
        $user_name = $_POST['username'];
        $pass_word = $_POST['password'];

        $query = mysqli_query($connect, "SELECT * FROM users WHERE user_name = '$user_name' AND password = MD5('$pass_word')");
        if (mysqli_num_rows($query) != 1) {
            unset($_POST["username"]);
            unset($_POST["password"]);
            echo '<script>alert("Username hoặc Mật khẩu bị sai");</script>';
        } else {
            header("Location: success.php");
        }
    }
}

// Xử lý cho form register
// Hàm chuẩn hóa dữ liệu
function standardize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_unique($data) {
    $query = mysqli_query($connect, "SELECT id FROM users WHERE user_name = '$data' OR email = '$data'");
    if (mysqli_num_rows($query) == 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

if (isset($_POST['register-submit'])) {
    if (empty($_POST['user_name'])) {
        $user_nameErr = "Vui lòng nhập tên tài khoản";
        $isErr = TRUE;
    } else {
        if (test_unique($_POST['user_name'])) {
            $user_name = standardize_data($_POST['user_name']);
        } else {
            $user_nameErr = "Tài khoản đã tồn tại";
        }
    }

    if (empty($_POST['email'])) {
        $emailErr = "Vui lòng nhập email";
        $isErr = TRUE;
    } else {
        if (test_unique($_POST['email'])) {
            $email = standardize_data($_POST['email']);
        } else {
            $emailErr = "Email đã tồn tại";
        }
    }

    if (empty($_POST['password']) && empty($_POST['repassword'])) {
        $passwordErr = 'Vui lòng nhập vào Mật khẩu';
        $isErr = TRUE;
    } elseif (empty($_POST['password']) && !empty($_POST['repassword'])) {
        $passwordErr = 'Vui lòng nhập vào Mật khẩu';
        $isErr = TRUE;
    } elseif (!empty($_POST['password']) && empty($_POST['repassword'])) {
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
            header("Location: ./register.php");
        }
    } else {
        header("Location: ./register.php");
    }
};
?>