<?php
include('../connect.php');
$nama_akun_modal = $_POST['nama_akun_modal'];
$nomor_akun_modal = $_POST['nomor_akun_modal'];
$kategori_modal = $_POST['kategori_modal'];

 
$sql = "INSERT INTO akun (kode_akun, nama_akun,  kategori_akun) VALUES ( '".$nomor_akun_modal."','".$nama_akun_modal."','".$kategori_modal."')";
$res = mysqli_query($connect, $sql);

if(!$res){
    echo "gagal";
}
?>