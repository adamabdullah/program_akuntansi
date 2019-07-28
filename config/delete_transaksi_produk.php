<?php 
include('connect.php');


if(empty($_POST))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    echo $kode = $_POST['kode'];
}
$sql_delete_transaksi = "DELETE FROM transaksi WHERE kode_transaksi = '$kode' OR nama_produk = '$kode'";
$sql_delete_transaksi_produk = "DELETE FROM transaksi_produk WHERE kode = '$kode'";
$sql_delete_transaksi_pembayaran = "DELETE FROM transaksi_akun WHERE tag = '$kode'";

mysqli_query($connect, $sql_delete_transaksi_produk);
mysqli_query($connect, $sql_delete_transaksi);
mysqli_query($connect, $sql_delete_transaksi_pembayaran);


// if(mysqli_affected_rows($res_del_trans) >0 && mysqli_affected_rows($res_del_trans_akun) >0 && mysqli_affected_rows($res_del_trans_produk) >0 ){
//     echo "Succes";
// }




?>