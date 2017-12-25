<!doctype html>
<?php
include 'include.php';
?>
<?php
if(isset($_POST['register-submit'])){
	$username=$_POST['username'];
	$email=$_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $fname= $_POST['fullname'];
//        $birthday= $_POST['birthday'];
        
	
	$register_query = "INSERT INTO users (`user_name`, `email`, `phone`, `password`, `fullname`)"
                . "VALUES ('$username','$email','$phone','$password','$fname')";
        mysqli_query($connect,$register_query);
}
?>