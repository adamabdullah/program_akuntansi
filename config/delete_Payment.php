<?php 
include('connect.php');


if(empty($_POST['kode']))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    $kode = $_POST['kode'];
    $uang = (int)$_POST['uang'];
    $tag = $_POST['tag'];
}
$sql_delete_transaksi_akun = "DELETE FROM transaksi_akun WHERE kode_transaksi = '$kode'";
$query1 = mysqli_query($connect, $sql_delete_transaksi_akun);

$sql_delete_transaksi = "DELETE FROM transaksi WHERE kode_transaksi = '$kode'";
$query2 = mysqli_query($connect, $sql_delete_transaksi);

$sql_update_sisa_tagihan = "UPDATE transaksi_produk SET `sisa_tagihan`= sisa_tagihan+$uang WHERE `kode` = '$tag'";
$query3 = mysqli_query($connect, $sql_update_sisa_tagihan);


if($query1 && $query2 && $query3){

    echo "Success";

}else{

    printf("Errormessage: %s\n", mysqli_error($query));

}

?>