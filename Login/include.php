<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="diamond_shop";
$connect;
try{
	$connect = mysqli_connect($servername, $username,$password,$dbname);
        mysqli_set_charset($connect, 'UTF8');
	echo("successful in connection");
}catch(MySQLi_Sql_Exception $ex){
	echo("error in connection");
}
?>

