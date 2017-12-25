<?php
//action.php
session_start();
$connect = mysqli_connect("localhost", "root","", "diamond_shop");
if(isset($_POST["username"]))
{ 
    $query ="
            SELECT * FROM diamond_shop WHERE user_name = '".$_POST["usrname"]."' AND password ='".$_POST["password"]."'";

    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)> 0)
    {
        $_SESSION["username"] = $_POST["username"];
        echo 'Yes';
    }
 else {
        echo 'No';
    }
}
if(isset($_POST["action"]))
{
    unset($_SESSION["username"]);
}
?>
