<?php
include('../../config/connect.php');
$nama_kontak = $_POST['nama_kontak'];
$person_phone = $_POST['person_phone'];
$alamat_kontak = $_POST['alamat_kontak'];
$email_kontak = $_POST['email_kontak'];
$tipe = implode($_POST['tipe']);
$errorMSG = "";

if (empty($tipe)) 
    {
         $errorMSG .= "satuan is required";
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

if(empty($errorMSG)){

$nama_kontak = $_POST['nama_kontak'];
$person_phone = $_POST['person_phone'];
$alamat_kontak = $_POST['alamat_kontak'];
$email_kontak = $_POST['email_kontak'];
$tipe = implode($_POST['tipe']);
// $tipe=[];
// foreach ($_POST['tipe'] as $key => $value) 
// {
// 	echo $tipe[$key] = $value;
// }

$sql21 = "INSERT INTO kontak (nama, tipe_kontak, email, alamat_penagihan, phone) VALUES ('".$nama_kontak."', '".$tipe."', '".$email_kontak."', '".$alamat_kontak."', '".$person_phone."')";
mysqli_query($connect, $sql21);
  echo json_encode(['code'=>berhasil, 'msg'=>'berhasil']);
	exit;
}
echo json_encode(['code'=>gagal, 'msg'=>$errorMSG]);
?> 