<?php
include('../../config/connect.php'); 
$pembelian_akun_kemana = $_POST['pembelian_akun_kemana'];
$harga_beli_satuan = $_POST['harga_beli_satuan']; 
$harga_jual_satuan = $_POST['harga_jual_satuan'];
$penjualan_akun_kemana = $_POST['penjualan_akun_kemana'];
$nama_produk = $_POST['nama_produk'];
$kode_produk = $_POST['kode_produk'];
$quantity = $_POST['quantity'];

$insert_produk ="INSERT INTO `produk`(`kode_produk`, `nama_produk`, `akun_beli`, `akun_jual`, `harga_beli_satuan`, `harga_jual_satuan`, `qty`) VALUES ('".$kode_produk."', '".$nama_produk."', '".$pembelian_akun_kemana."', '".$penjualan_akun_kemana."', '".$harga_beli_satuan."', '".$harga_jual_satuan."', '".$quantity."' )";
$query = mysqli_query($connect, $insert_produk);

if(!$query){

    printf("Errormessage: %s\n", mysqli_error($query));

}else{

    echo "Success";

}

?>