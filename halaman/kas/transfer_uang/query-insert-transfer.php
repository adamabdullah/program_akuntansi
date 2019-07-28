<?php
include('../../../config/connect.php');

$akun_ke = $_POST['akun_ke'];
$akun_dari = $_POST['akun_dari'];
$no_transaksi = $_POST['no_transaksi'];
$uang = $_POST['uang'];
$tanggalan = $_POST['tanggalan'];
 $errorMSG = '';

if (empty($akun_ke)) 
{
    $errorMSG .= "akun_ke is required";
}
if (empty($akun_dari)) 
{
    $errorMSG .= "akun_dari is required";
}
if (empty($no_transaksi)) 
{
    $errorMSG .= "no_transaksi is required";
}
if (empty($uang)) 
{
    $errorMSG .= "uang is required";
}
if (empty($tanggalan)) 
{
    $errorMSG .= "tanggalan is required";
}

if(empty($errorMSG))
{
    $akun_ke = $_POST['akun_ke'];
    $akun_dari = $_POST['akun_dari'];
    $no_transaksi = $_POST['no_transaksi'];
    $uang = $_POST['uang'];
    $tanggalan = $_POST['tanggalan'];
    $memo = $_POST['memo'];

    $sql ="INSERT INTO `transaksi_akun`(`no`, `kode_transaksi`, `tgl_transaksi`) VALUES ('NULL', '".$no_transaksi."', '".$tanggalan."')";
    mysqli_query($connect, $sql);

    $query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$no_transaksi."'";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarang = $data['kode_child'];
    $noUrut = (int)$kodeBarang; 

    $sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) VALUES ('".$no_transaksi."', '".$tanggalan."', '".$akun_ke."', 'transfer_uang', '".$uang."' ,'0','".$noUrut."')";
        mysqli_query($connect, $sql_kirim);

    $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) VALUES ('".$no_transaksi."', '".$tanggalan."', '".$akun_dari."', 'transfer_uang', '0', '".$uang."', '".$noUrut."')";
    mysqli_query($connect, $sql_kirim1);
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}  
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);
?>