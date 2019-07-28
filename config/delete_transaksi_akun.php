<?php 
include('connect.php');


if(empty($_POST))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    echo $kode = $_POST['kode'];
}
$sql_delete_transaksi = "DELETE FROM transaksi WHERE kode_transaksi = '$kode'";
$sql_delete_transaksi_akun = "DELETE FROM transaksi_akun WHERE kode_transaksi = '$kode'";


mysqli_query($connect, $sql_delete_transaksi_akun);
mysqli_query($connect, $sql_delete_transaksi);


// if(mysqli_affected_rows($res_del_trans) >0 && mysqli_affected_rows($res_del_trans_akun) >0 && mysqli_affected_rows($res_del_trans_produk) >0 ){
//     echo "Succes";
// }




?>