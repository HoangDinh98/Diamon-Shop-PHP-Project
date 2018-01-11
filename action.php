<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "diamond_shop");
alert("connect successful");
if (isset($_POST["username"])) {
    $pass = $_POST["password"];
    $query = "  
      SELECT * FROM users  
      WHERE user_name = '" . $_POST["username"] . "'  
      AND password = md5($pass);
      ";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $_POST['username'];
        echo 'Yes';
    } else {
        echo 'No';
    }
}
if (isset($_POST["action"])) {
    unset($_SESSION["username"]);
}
?>


