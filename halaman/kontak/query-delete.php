<?php
include('../../config/connect.php');
$nama = $_POST['nama'];
$sql_kredit_null= "DELETE FROM `kontak` where `nama`='".$nama."'";
mysqli_query($connect, $sql_kredit_null);
?>