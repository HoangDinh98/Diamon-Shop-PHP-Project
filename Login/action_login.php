<?php

include '../include.php';

$user_name = $pass_word = '';
$user_nameErr = $pass_wordErr = '';

if (isset($_POST['submit'])) {
    
//    ( isset($_POST['username']) && $_POST['username'] != '' ) && isset($_POST['password']) && $_POST['password'] != ''
    

    if (( isset($_POST['username']) && $_POST['username'] != '' ) ||
            (isset($_POST['password']) && $_POST['password'] != '')) {
        $user_name = $_POST['username'];
        $pass_word = $_POST['password'];
        
        $query = mysqli_query($connect, "SELECT * FROM users WHERE user_name = '$user_name'");
        if (mysqli_num_rows($query) == 1) {
            $query2 = mysqli_query($connect, "SELECT * FROM users WHERE user_name = '$user_name' AND password = MD5('$pass_word')");
            if(mysqli_num_rows($query2)==1) {
                header("Location: success.php");
            } else {
                $pass_word == '' ? $pass_wordErr = 'Vui lòng nhập Mật khẩu': $pass_wordErr = 'Mật khẩu bị sai';
            }
            
        } else {
            $user_name == '' ? $user_nameErr = 'Vui lòng nhập Tên đăng nhập': $user_nameErr = 'Tên đăng nhập bị sai';
        }
    } else {
        $user_nameErr = 'Vui lòng nhập Tên đăng nhập';
        $pass_wordErr = 'Vui lòng nhập Mật khẩu';
    }
}
?>

