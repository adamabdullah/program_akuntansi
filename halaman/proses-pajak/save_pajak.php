<?php
include('../../config/connect.php');
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$akun_pajak_penjualan = $_POST['akun_pajak_penjualan'];
$akun_pajak_pembelian = $_POST['akun_pajak_pembelian'];
// $tipe=[];
// foreach ($_POST['tipe'] as $key => $value) 
// {
// 	echo $tipe[$key] = $value;
// }

$sql21 = "INSERT INTO pajak (nama_pajak, berapa_persen, akun_pajak_penjualan, akun_pajak_pembelian) VALUES ('".$nama."', '".$jumlah."', '".$akun_pajak_penjualan."', '".$akun_pajak_pembelian."')";
mysqli_query($connect, $sql21);
?>