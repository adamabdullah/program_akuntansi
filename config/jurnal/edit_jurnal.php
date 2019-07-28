<?php 
include('../connect.php');  

if(!empty($_POST['kode'])){

$kode = $_POST['kode'];
// $memo = $_POST['memo'];
$memo = "dummy";

//<array
$akun = $_POST['res_akun'];
$desk = $_POST['res_desc'];
$debit = $_POST['res_debit'];
$kredit = $_POST['res_kredit'];
$tgl = $_POST['tgl'];
//array>
$delete_transaksi = "DELETE  `transaksi_akun` , `transaksi` FROM  `transaksi_akun` INNER JOIN  `transaksi` ON transaksi_akun.kode_transaksi = transaksi.kode_transaksi WHERE transaksi.kode_transaksi = '$kode'";
$res_delete = mysqli_query($connect, $delete_transaksi);

$insert_jurnal = "INSERT INTO `transaksi_akun`(`kode_transaksi`, `tag`, `tgl_transaksi`,`kolom`, `memo`) VALUES ('$kode', '', '$tgl', 'jurnal', '$memo' )";
$res_insert_jurnal = mysqli_query($connect, $insert_jurnal);

$select_no = "SELECT no AS no FROM transaksi_akun WHERE kode_transaksi = '$kode'";
$data = mysqli_fetch_array(mysqli_query($connect, $select_no));

$no = (int)$data['no'];

foreach($akun as $key => $value){

    $insert_jurnal2 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `tgl_transaksi`, `kolom`, `debit`, `kredit`, `no`, `qty_produk`) VALUES ('$kode', '$value', '$tgl', 'jurnal', '$debit[$key]', '$kredit[$key]', $no, 1)";
    mysqli_query($connect, $insert_jurnal2);
    
}

if(!$res_delete || !$res_insert_jurnal){
    echo "gagal";
}



}else{
    header("Location: /faktur_v2/");
}
?>