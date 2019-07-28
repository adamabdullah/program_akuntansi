<?php
include('../../config/connect.php'); 
// include('../../modal/modal.php'); 
$output = '';

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM produk 
	WHERE nama_produk LIKE '%".$search."%'
	 OR kode_produk LIKE '%".$search."%'
	";

}
else  
{
	$query = 'SELECT * FROM produk ';
}

if($query != '')
{
	$result = mysqli_query($connect, $query);
	$rowcount = mysqli_num_rows($result);
	if($rowcount > 0)
	{
		$output .= '<li id="tambah_produk_new_append" class="akun_terima_dari_tabel es-visible"> <i class="fa fa-plus"></i>&nbsp; Ketuk untuk menambahkan</li>';
		 
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<li value='.$row["nama_produk"].' class="isi_produk es-visible" >'.$row["kode_produk"].' | '.$row["nama_produk"].'</li>';
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
		$output .= '<li value='.$_POST["query"].' id="tambah_produk_append" class="akun_terima_dari_tabel_append_ketik_baru es-visible">'.$_POST["query"].'(new)</li>';
		// $output .= ''.$_POST["query"].'new';
		echo $output;
	}	
}
else
{
}

?>