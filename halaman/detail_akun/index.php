<table border="black">
	<thead>
		<tr>
			<th>Kode Transaksi</th>
			<th>Kontak</th>
			<th>Nama Akun</th>
			<th>Debit</th>
			<th>Kredit</th>
		</tr>
	</thead>
	<tbody>	
<?php
include('../../config/connect.php');
$nama_akun = $_POST['nama_akun'];
$sql2 = "SELECT nama_akun,sum(debit) as debit, sum(kredit) as kredit,kode_transaksi,kontak from (select nama_akun, debit, kredit, kode_transaksi,kontak from detail_akun group by nama_akun, debit, kredit, kode_transaksi,kontak) A where 
		nama_akun  LIKE '%".$nama_akun."%' group by nama_akun order by nama_akun desc";
$result2 = mysqli_query($connect, $sql2);
while($data2 = mysqli_fetch_array($result2))
{
	?>
	<tr>
		<td><?php echo $data2['kode_transaksi']; ?></td>
		<td><?php echo $data2['kontak']; ?></td>
		<td><?php echo $data2['nama_akun']; ?></td>
		<td><?php echo $data2['debit'];?></td>
		<td><?php echo $data2['kredit'];?></td>
	</tr>
	<?php
}


?>
	</tbody>
</table>