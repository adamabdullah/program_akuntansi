<?php 
include('../../../config/connect.php');
$output ="";
$output .="<thead>
			<tr>
				<th>Tanggal</th>
				<th>Nomor</th>
				<th>Pelanggan</th>
				<th>Tanggal Jatuh Tempo</th>
				<th>Status</th>
                <th>Sisa Tagihan</th>
                <th>Total</th>
			</tr>
			</thead><tbody>";
$sql = "SELECT * FROM transaksi_produk where kolom='penjualan'";
$result1 = mysqli_query($connect, $sql);
while($data1 = mysqli_fetch_array($result1))
{
    $sum = $data1['sisa_tagihan'];
    if($sum > 0)
    {
         $output .=" <tr> 
                    <td>".$data1['tgl_transaksi']."</td>
                    <td class='kode'><h class='text-primary'>".$data1['kode']."</h></td>
                    <td>".$data1['pelanggan']."</td>
                    <td>".$data1['tgl_tempo']."</td>
                    <td>".$data1['status']."</td>
                    <td>".$data1['sisa_tagihan']."</td>
                    <td>".$data1['total']."</td>
                </tr>";
    }
   
}
$output .='</tbody>';
echo $output;
?>