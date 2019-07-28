<?php 
include('../connect.php');  

if(!empty($_POST['kode'])){

$kode = $_POST['kode'];
$memo = $_POST['memo'];
// $memo = "dummy";

//<array
$akun = $_POST['res_akun'];
$desk = $_POST['res_desc'];
$debit = $_POST['res_debit'];
$kredit = $_POST['res_kredit'];
$tgl = $_POST['tgl'];
$tag = $_POST['tag'];

$tags = implode(", ", $tag);
//array>

$insert_jurnal = "INSERT INTO `transaksi_akun`(`kode_transaksi`, `tag_2`, `tgl_transaksi`,`kolom`, `memo`) VALUES ('$kode', '$tags', '$tgl', 'jurnal', '$memo' )";
mysqli_query($connect, $insert_jurnal);

$select_no = "SELECT no AS no FROM transaksi_akun WHERE kode_transaksi = '$kode'";
$data = mysqli_fetch_array(mysqli_query($connect, $select_no));

$no = (int)$data['no'];

foreach($akun as $key => $value){

    $insert_jurnal2 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `tgl_transaksi`, `kolom`, `debit`, `kredit`, `no`, `qty_produk`) VALUES ('$kode', '$value', '$tgl', 'jurnal', '$debit[$key]', '$kredit[$key]', $no, 1)";
    mysqli_query($connect, $insert_jurnal2);
    
}



}else{
    header("Location: /faktur_v2/");
}
?>