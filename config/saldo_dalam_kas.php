<?php 
include('connect.php');
include('../modal/modal.php');
$output ="";
$output .="<thead>
            <tr>
                <th>Tanggal</th>
				<th>Kode Akun</th>
				<th>Nama Akun</th> 
				<th>Pelanggan</th>
				<th>Tgl Jatuh Tempo</th>
				<th>Status</th>
                <th>Sisa Tagihan</th>
                <th>Total</th>
			</tr>
			</thead><tbody>";
$sql = "SELECT * FROM transaksi_produk WHERE kolom='penjualan' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$hasil_sum = mysqli_query($connect, $sql);
while($data_sum = mysqli_fetch_array($hasil_sum))
{
	$output .="<tr>
					<td>".$data_sum['tgl_transaksi']."</td>
					<td>".$data_sum['kode']."</td>
					<td>".$data_sum['pelanggan']."</td>
                    <td>".$data_sum['tgl_tempo']."</td>
                    <td>".$data_sum['status']."</td>
                    <td>Rp. ".number_format($data_sum['sisa_tagihan'],2,'.',',')."</td>
                    <td>Rp. ".number_format($data_sum['total'],2,'.',',')."</td>
				</tr>";
}
$output .='</tbody>';
echo $output;
?>