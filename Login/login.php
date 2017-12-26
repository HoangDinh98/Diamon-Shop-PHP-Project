<?php 
session_start();
include 'include.php';
if(isset($_POST['submit']))
{
    $query = "SELECT * FROM users WHERE user_name = '".$_POST["username"]."' 
        AND password ='".$_POST["password"]."'";
    $result = mysqli_query($connect, $query);
    if($row=mysql_fetch_array($result))
    {
        $_SESSION['username'] = $_POST['username'];
        echo 'Yes';
    }
 else {
        echo 'No';
    }
}
//if(isset($_POST["logout"]))
//    {
//    unset($_SESSION["username"]);
//    }
?>