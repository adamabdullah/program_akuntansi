<?php
session_start();

include('../connect.php');
echo $username = $_SESSION['username'];

 
$update = "UPDATE login set count = 0, last_activity = now() where username='$username'";
mysqli_query($connect, $update);

	
	session_destroy();
	header("location:/faktur_v2/login/login.php");	


?>