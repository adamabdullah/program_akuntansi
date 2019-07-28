<?php 
include('connect.php');


if(empty($_POST))
{
    header('Location: /faktur_v2/'); 
    exit; 
}else{
    $kode = $_POST['kode'];
    $kontak = $_POST['kontak'];
    $tgl = $_POST['tgl'];
    $tag = $_POST['tag'];
    $cara = $_POST['cara'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];
    $uang = $_POST['uang'];
    $sisa_tagihan = $_POST['sisa_tagihan'];
    $memo = $_POST['memo'];

    // echo $kode.",".$kontak.",".$tgl.",".$tag.",".$debit.",".$kredit.",".$uang.",".$sisa_tagihan;

    $sql_insert_receive_payment = "INSERT INTO `transaksi_akun`(`kode_transaksi`, `kontak`, `tag`, `tgl_transaksi`, `cara_pembayaran`, `memo`) VALUES ('$kode', '$kontak', '$tag', '$tgl', '$cara', '$memo')";

    $sql_insert_akun_debit = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `debit`, `nama_produk`) VALUES ('$kode', '$tgl', '$debit', $uang, '$tag')";

    $sql_insert_akun_kredit = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kredit`, `nama_produk`) VALUES ('$kode', '$tgl', '$kredit', $uang, '$tag')";

    $sql_pembayaran = "INSERT INTO `transaksi_produk`(`kode`, `pelanggan`, `tgl_transaksi`, )";

    mysqli_query($connect, $sql_insert_receive_payment);
    mysqli_query($connect, $sql_insert_akun_debit);
    mysqli_query($connect, $sql_insert_akun_kredit);

    $sql_update_transaksi_produk = "UPDATE `transaksi_produk` SET `sisa_tagihan`= $sisa_tagihan WHERE kode = '$tag'";

    mysqli_query($connect, $sql_update_transaksi_produk);
    
}







?>