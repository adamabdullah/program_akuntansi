<?php
session_start();
include('../connect.php');

if(!empty($_POST['newPass1']))
{
    $username = $_SESSION['username'];
    $newPass = $_POST['newPass1'];
    
    $edit = "UPDATE `login` SET `password`='$newPass' WHERE `username` = '$username'";
    $query = mysqli_query($connect, $edit);

    
    if($query)
    {

        $data = mysqli_fetch_array($query);

        $update = "UPDATE login set count = 1 where username='$username'";
        mysqli_query($connect, $update);

        $_SESSION['password'] = $newPass;

    }
    else
    {

        echo "gagal";
    }

}else{

    header("location:/faktur_v2/");	

}


?>