<?php
include('../../../config/connect.php');
$search = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM pajak WHERE nama_pajak='".$search."'";
$result = mysqli_query($connect, $query);
$rowcount = mysqli_num_rows($result);
$data["keterangan"] = "tidak ada";
if($rowcount > 0)
{
	// while($data3 = mysqli_fetch_array($result))
	// {
	// 	$data['alamat_penagihan'] =  $data3['alamat_penagihan'];
	// 	$data['email'] = $data3['email'];
	// 	$data['phone'] = $data3['phone'];
	// }
	$data["keterangan"] = "ada";
	echo json_encode($data);

}
else
{
	echo json_encode($data);
}
?>