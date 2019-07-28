<?php
include('../../config/connect.php');
$search = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM produk WHERE kode_produk='".$search."'";
$result = mysqli_query($connect, $query);
$rowcount = mysqli_num_rows($result);
$data2 = mysqli_fetch_array($result);
$data["keterangan"] = "tidak ada";
$data["harga_satuan"] =  "tidak ada";
if($rowcount > 0)
{
	$data["keterangan"] = "ada";
	$data["harga_satuan"] = $data2['harga_jual_satuan'];
	echo json_encode($data);

}
else
{
	echo json_encode($data);
}
?>