<?php
include('../../config/connect.php');
$output = ''; 
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM pajak 
	WHERE nama_pajak LIKE '%".$search."%'
	";

}
else 
{
	$query = 'SELECT * FROM pajak ';
}

if($query != '')
{
	$result = mysqli_query($connect, $query);
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0)
	{
		$output .= '<li id="nambah_pajak" class="es-visible"> <i class="fa fa-plus"></i>&nbsp; Ketuk untuk menambahkan pajak</li>';
		 
		while($row = mysqli_fetch_array($result)) 
		{
			$output .= '<li value='.$row["nama_pajak"].' id="pajak_append_isi" class="pajak_append_isi_value es-visible">'.$row["nama_pajak"].' | '.$row["berapa_persen"].'%</li>';
		}
		echo $output;
	}
	else
	{
		$output .= '<li value='.$_POST["query"].' id="pajak_modal_new" class="es-visible">'.$_POST["query"].'(new)</li>';
		echo $output;
	}	
}
else
{
}

?>