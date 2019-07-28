<?php
include('../../../config/connect.php'); 

$nama_kontak = $_POST['nama_kontak'];
$person_phone = $_POST['person_phone'];
$alamat_kontak = $_POST['alamat_kontak'];
$email_kontak = $_POST['email_kontak'];
$tipe = implode($_POST['tipe']);
$errorMSG = "";

if (empty($tipe)) 
    {
        $errorMSG .= "tipe is required";
    }

    if (empty($nama_kontak)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($person_phone)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($alamat_kontak)) 
    {
         $errorMSG .= "satuan is required";
    }

     if (empty($email_kontak)) 
    {
         $errorMSG .= "satuan is required";
    }

if(empty($errorMSG))
{
    $nama_kontak = $_POST['nama_kontak'];
    $person_phone = $_POST['person_phone'];
    $alamat_kontak = $_POST['alamat_kontak'];
    $email_kontak = $_POST['email_kontak'];
    $tipe_kontak = $_POST['tipe_kontak'];
    $person_phone = $_POST['person_phone'];
    $tipe = implode($_POST['tipe']);

    $tipe_patokan = implode ( ",", $_POST['tipe_patokan'] );
    $nama_patokan = $_POST['nama_patokan'];

    $sql_update = "UPDATE `kontak` set `nama`='".$nama_kontak."', `tipe_kontak` = '".$tipe."', `email`='".$email_kontak."', `alamat_penagihan`='".$alamat_kontak."', `phone`='".$person_phone."' where nama='".$nama_patokan."' and tipe_kontak='".$tipe_patokan."'";

    $sql_update_transaksi = "UPDATE `transaksi_akun` set `kontak`='".$nama_kontak."' where kontak='".$nama_patokan."'";

    $sql_update_transaksi_produk = "UPDATE `transaksi_produk` set `pelanggan`='".$nama_kontak."' where pelanggan='".$nama_patokan."'";
    // mysqli_connect($connect, $sql_update);

    if (mysqli_connect_errno()) 
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if (!mysqli_query($connect, $sql_update)) 
    {
        printf("Errormessage: %s\n", mysqli_error($connect));
    }

    if (!mysqli_query($connect, $sql_update_transaksi)) 
    {
        printf("Errormessage: %s\n", mysqli_error($connect));
    }

    if (!mysqli_query($connect, $sql_update_transaksi_produk)) 
    {
        printf("Errormessage: %s\n", mysqli_error($connect));
    }
    echo json_encode(['code'=>berhasil, 'msg'=>'berhasil']);
        exit;
}
echo json_encode(['code'=>gagal, 'msg'=>$errorMSG]);
?>