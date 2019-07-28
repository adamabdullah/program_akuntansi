<?php
include('../../config/connect.php');
echo $nama_akun_modal = $_POST['nama_akun_modal'];
echo $nomor_akun_modal = $_POST['nomor_akun_modal'];
echo $kategori_modal = $_POST['kategori_modal'];

// $tipe=[];
// foreach ($_POST['tipe'] as $key => $value) 
// {
// 	echo $tipe[$key] = $value;
// }
 
$sql21 = "INSERT INTO akun (kode_akun, nama_akun,  kategori_akun) VALUES ( '".$nomor_akun_modal."','".$nama_akun_modal."','".$kategori_modal."')";
mysqli_query($connect, $sql21);
?>