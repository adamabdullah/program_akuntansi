<?php
include('../../config/connect.php');
$nama_akun_modal = $_POST['nama_akun_modal'];
$nomor_akun_modal = $_POST['nomor_akun_modal'];
$kategori_modal = $_POST['kategori_modal'];
$akun_lengkap = $_POST['akun_lengkap'];
$akun_update = $_POST['akun_update'];
$akun_patokan = $_POST['akun_patokan'];

$sql_update_akun = "UPDATE `akun` set `kode_akun`='".$nomor_akun_modal."', `nama_akun`='".$nama_akun_modal."', `kategori_akun`='".$kategori_modal."' where kode_akun='".$akun_patokan."' ";
// mysqli_connect($connect, $sql_update_akun);

$sql_update = "UPDATE `transaksi` set `kode_akun`='".$akun_update."'where kode_akun='".$akun_lengkap."' ";
// mysqli_connect($connect, $sql_update);

// if (mysqli_connect_errno()) 
// {
// 	printf("Connect failed: %s\n", mysqli_connect_error());
// 	exit();
// }
// if (!mysqli_query($connect, $sql_update)) 
// {
//     printf("Errormessage: %s\n", mysqli_error($connect));
// }

if (!mysqli_query($connect, $sql_update_akun)) 
{
    printf("Errormessage: %s\n", mysqli_error($connect));
}

if (!mysqli_query($connect, $sql_update)) 
{
    printf("Errormessage: %s\n", mysqli_error($connect));
}
?>