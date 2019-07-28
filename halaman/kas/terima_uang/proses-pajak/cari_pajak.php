<?php
include('../../../../config/connect.php');
// include('../../modal/modal.php');
$output = ''; 

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM pajak 
	WHERE nama_pajak LIKE '%".$search."%'
	 OR berapa_persen LIKE '%".$search."%'
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
		$output .= '<li id="nambah_pajak_baru_terima_uang" class="es-visible"> <i class="fa fa-plus"></i>&nbsp; Ketuk untuk menambahkan pajak</li>';
		 
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<li value='.$row["nama_pajak"].' class="pajak_append_isi es-visible">'.$row["nama_pajak"].' | '.$row["berapa_persen"].'%</li>';
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
		$output .= '<li value='.$_POST["query"].' id="pajak_modal_ketik_baru" class="pajak_append_isi es-visible">'.$_POST["query"].'(new)</li>';
		// $output .= ''.$_POST["query"].'new';
		echo $output;
	}	
}
else
{
}

?>