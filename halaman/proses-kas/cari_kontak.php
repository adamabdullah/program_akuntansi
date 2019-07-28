<?php
include('../../config/connect.php');
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM kontak 
	WHERE nama LIKE '%".$search."%'
	";
}
else
{
	$query = 'SELECT * FROM kontak'; 
}

if($query != '')
{
	$result = mysqli_query($connect, $query);
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0)
	{
		$output .= '<li id="" class="kontak_baru es-visible"> <i class="fa fa-plus"></i>&nbsp; Ketuk untuk menambahkan</li>';
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<li value='.$row["nama"].'id="kontak_penerima" class="kontak_penerima es-visible">'.$row["nama"].'</li>';
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
		$output .= '<li value='.$_POST["query"].' id="kontak_penerima_new" class="kontak_penerima_new es-visible">'.$_POST["query"].'(new)</li>';
		// $output .= ''.$_POST["query"].'new';
		echo $output;
	}	
}
else
{
}

?>