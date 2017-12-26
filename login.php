<?php
include 'include.php';
?>

<?php

$error = array(); // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
// Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];


        $query = mysqli_query($connect, "select id from user where user_name = '$username' AND password =md5('$password')");
        if (mysqli_num_rows($query) == 1)
            header("location: o.php");
    }
}
//echo ('<p>' . $error . '</p>');
?>

