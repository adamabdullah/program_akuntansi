<?php
include('../../config/connect.php');
$search = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM pajak WHERE nama_pajak='".$search."'";
$result = mysqli_query($connect, $query);
$rowcount = mysqli_num_rows($result);
if($rowcount > 0) 
{ 
	echo "ada";
}
else
{
	echo "tidak ada";
}
?>