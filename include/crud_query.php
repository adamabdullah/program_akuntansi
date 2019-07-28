<?php 
$connect = mysqli_connect("localhost", "root", "", "keuangan");

//sql ambil nama pelanggan dari tabel kontak

$sql_0101_kontak = "SELECT * FROM kontak";
$result_0101_kontak = mysqli_query($connect, $sql_0101_kontak);




?>