<?php 
include('../../../config/connect.php');
$output ="";
$output .="<thead>
			<tr>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>No Telpon</th>
				<th>Saldo Tagihan</th>
				<th>Aksi</th>
			</tr>
			</thead><tbody>";
$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa, transaksi_produk.kolom from kontak inner join transaksi_produk on kontak.nama = transaksi_produk.pelanggan group by kode having kolom='pembelian';";
$hasil_sum = mysqli_query($connect, $sql);
while($data_sum = mysqli_fetch_array($hasil_sum))
{
	$output .="<tr>
					<td>".$data_sum['nama']."</td>
					<td>".$data_sum['alamat_penagihan']."</td>
					<td>".$data_sum['email']."</td>
					<td>".$data_sum['phone']."</td>
					<td>Rp. ".number_format($data_sum['sisa'], 2, '.', ',')."</td>
					<td>
						<a href='' data-sisa=".$data_sum['sisa']." data-telpon=".$data_sum['phone']."  data-alamat=".$data_sum['alamat_penagihan']." data-email=".$data_sum['email']." data-nama=".$data_sum['nama']." data-tipe=".$data_sum['tipe_kontak']." class='btn btn-success btn-rounded btn-sm edit'><span class='fa fa-edit'></span></a>
						<a href='' class='btn btn-danger btn-rounded btn-sm delete'><span class='fa fa-times'></span></a>
					</td>
				</tr>";
}
$output .='</tbody>';
echo $output;
?>