<?php

include('../connect.php');

$username = $_POST['user'];
$password = $_POST['pass'];
 
$login = "SELECT * from login where username='$username' and password='$password'";
$query = mysqli_query($connect, $login);
// $query1 = mysqli_query($connect, $login);
$data = mysqli_fetch_array($query1);
$cek = mysqli_num_rows($query);
 
if($cek > 0 && $data['count'] == 0){
    session_start();

    $data = mysqli_fetch_array($query);

    $update = "UPDATE login set count = 1 where username='$username'";
    mysqli_query($connect, $update);

   echo $_SESSION['username'] = $username;
   echo $_SESSION['password'] = $password;
   echo $_SESSION['fname'] = $data['fname'];
   echo $_SESSION['lname'] = $data['lname'];
   echo $_SESSION['mandatory'] = $data['mandatory'];
   echo $_SESSION['write'] = $data['write'];
   echo $_SESSION['status'] = "online";

    header("location:/faktur_v2/");    
}else{
   
	header("location:/faktur_v2/login/login.php");	
}


?>