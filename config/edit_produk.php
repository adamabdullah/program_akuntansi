<?php 
include('connect.php');


if(empty($_POST))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    $kode = $_POST['kode'];

    $nama = $_POST['nama'];
    $buyPrice = $_POST['buyPrice'];
    $sellPrice = $_POST['sellPrice'];
    $qty = $_POST['qty'];
    $akunJual = $_POST['akunJual'];
    $akunBeli = $_POST['akunBeli'];
    // echo "Success";
}
$sql_edit_produk = "UPDATE `produk` SET `nama_produk`='$nama', `harga_beli_satuan`='$buyPrice', `harga_jual_satuan`='$sellPrice', `qty`='$qty', `akun_jual` = '$akunJual', `akun_beli` = '$akunBeli' WHERE `kode_produk` ='$kode'";
$query = mysqli_query($connect, $sql_edit_produk);


if(!$query){

    printf("Errormessage: %s\n", mysqli_error($query));

}else{

    echo "Success";

}



?>