<?php 
include('connect.php');


if(empty($_POST['kode']))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    $kode = $_POST['kode'];
    $sisaTagihan = $_POST['sisaTagihanNew'];
    $bayar = $_POST['bayarNew'];
    $tgl = $_POST['tgl'];
    $tag = $_POST['tag'];
    $memo = $_POST['memo'];
    $opsi = $_POST['opsi'];
    
}

$sql_update_transaksi_produk = "UPDATE transaksi_produk SET `sisa_tagihan`= $sisaTagihan WHERE `kode`='$tag'";
$query1 = mysqli_query($connect, $sql_update_transaksi_produk);

$sql_update_transaksi_akun = "UPDATE transaksi_akun SET `tgl_transaksi` = '$tgl', `cara_pembayaran` = '$opsi', `memo` = '$memo' WHERE `kode_transaksi` = '$kode'";
$query2 = mysqli_query($connect, $sql_update_transaksi_akun);

$sql_update_transaksi1 = "UPDATE transaksi SET `tgl_transaksi` = '$tgl', `debit` = $bayar WHERE `kode_transaksi` = '$kode' AND `debit` > 0";
$query3 = mysqli_query($connect, $sql_update_transaksi1);

$sql_update_transaksi2 = "UPDATE transaksi SET `tgl_transaksi` = '$tgl', `kredit` = $bayar WHERE `kode_transaksi` = '$kode' AND `kredit` > 0";
$query4 = mysqli_query($connect, $sql_update_transaksi2);


if($query1 && $query2 && $query3 && $query4){

    echo "Success";

}else{

    printf("Errormessage: %s\n", mysqli_error($query1));

}



?>