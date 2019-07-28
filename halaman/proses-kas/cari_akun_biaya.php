<?php
include('../../config/connect.php'); 
// include('../../modal/modal.php'); 
$output = '';

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM akun 
	WHERE nama_akun LIKE '%".$search."%'
	 OR kode_akun LIKE '%".$search."%'
	";

}
else  
{
	$query = 'SELECT * FROM akun ';
}

if($query != '')
{
	$result = mysqli_query($connect, $query);
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0)
	{
		$output .= '<li id="" class="penerima_modal es-visible"> <i class="fa fa-plus"></i>&nbsp; Ketuk untuk menambahkan</li>';
		 
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<li value='.$row["nama_akun"].' id="" class="pmbyrn es-visible">'.$row["kode_akun"].' | '.$row["nama_akun"].'</li>';
			// $output .='<option>'.$row["nama"].'(new)</option>';
			// $output .= '
			//    <tr>
			//     <td>'.$row["CustomerName"].'</td>
			//     <td>'.$row["Address"].'</td>
			//     <td>'.$row["City"].'</td>
			//     <td>'.$row["PostalCode"].'</td>
			//     <td>'.$row["Country"].'</td>
			//    </tr>
			//   ';
			// $output .= $row["nama"];
		}
		echo $output;
	}
	else 
	{
		$output .= '<li value='.$_POST["query"].' id="" class="penerima_modal2 es-visible">'.$_POST["query"].'(new)</li>';
		// $output .= ''.$_POST["query"].'new';
		echo $output;
	}	
}
else
{
}

?>