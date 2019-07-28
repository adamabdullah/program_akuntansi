<?php
include('../../config/connect.php');
$nama_kontak = $_POST['nama_kontak'];
$person_phone = $_POST['person_phone'];
$alamat_kontak = $_POST['alamat_kontak'];
$email_kontak = $_POST['email_kontak'];
$tipe_kontak = $_POST['tipe_kontak'];
$tipe = implode($_POST['tipe']);
// $tipe=[];
// foreach ($_POST['tipe'] as $key => $value) 
// {
// 	echo $tipe[$key] = $value;
// }

$sql21 = "INSERT INTO kontak (nama, tipe_kontak, email, alamat_penagihan, phone) VALUES ('".$nama_kontak."', '".$tipe."', '".$email_kontak."', '".$alamat_kontak."', '".$person_phone."')";
mysqli_query($connect, $sql21);
?>