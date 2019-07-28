<?php 
include("../../../config/connect.php");

if(!empty($_POST))
{
    $kode = $_POST['kode'];
    $pengirim = $_POST['pengirim'];
    $penerima = $_POST['penerima'];
    $uang = $_POST['uang'];
    $memo = $_POST['memo'];
    $tgl = $_POST['date'];
    // $tag = $_POST['tag'];
    $errorMSG  = '';
    if (empty($kode)) 
    {
        $errorMSG .= "akun_ke is required";
    }
    if (empty($pengirim)) 
    {
        $errorMSG .= "akun_dari is required";
    }
    if (empty($penerima)) 
    {
        $errorMSG .= "no_transaksi is required";
    }
    if (empty($uang)) 
    {
        $errorMSG .= "uang is required";
    }
    if (empty($tgl)) 
    {
        $errorMSG .= "tanggalan is required";
    }

    if(empty($errorMSG))
    {
        $update_transaksi_akun = "UPDATE `transaksi_akun` SET  `memo` = '$memo', `tgl_transaksi` = '$tgl' WHERE kode_transaksi = '$kode'";

        $update_transaksi_debit = "UPDATE `transaksi` SET `kode_akun` = '$pengirim', `kredit` = '$uang', `tgl_transaksi` = '$tgl' WHERE `kode_transaksi` = '$kode' AND `kredit` > 0";

        $update_transaksi_kredit = "UPDATE `transaksi` SET `kode_akun` = '$penerima', `debit` = '$uang', `tgl_transaksi` = '$tgl' WHERE `kode_transaksi` = '$kode' AND `debit` > 0";

        mysqli_query($connect, $update_transaksi_akun);
        mysqli_query($connect, $update_transaksi_debit);
        mysqli_query($connect, $update_transaksi_kredit);
        echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
        exit;
    }
    echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);

}else{
    header("Location: /faktur_v2/");
}


?>