<?php

session_start(); // Starting Session
$servername = "localhost";
$db_user = "root";
$db_password = "";
$dbname = "diamond_shop";
$connection = new mysqli($servername, $db_user, $db_password, $dbname);
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


        $query = mysqli_query($connection, "select id from user where user_name = '$username' AND password ='$password'");
        if (mysqli_num_rows($query) == 1)
            header("location: o.php");
    }
}
echo ('<p>' . $error . '</p>');
?>

