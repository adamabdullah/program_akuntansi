<?php
include('../../config/connect.php');
$kode = $_POST['kode'];
$sql_kredit_null= "DELETE FROM `akun` where `kode_akun`='".$kode."'";
mysqli_query($connect, $sql_kredit_null); 
?>