<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

// $first = '2019/02/01';
// $last = date('Y-m-d');

$year = $_POST['year'];
$month = $_POST['month'];

$sql_select_biaya = "SELECT transaksi_akun.tgl_transaksi AS tgl_transaksi, transaksi_akun.kontak AS kontak, transaksi_akun.kode_transaksi AS kode_transaksi, SUM(transaksi.debit) AS total FROM transaksi_akun INNER JOIN transaksi ON transaksi_akun.kode_transaksi = transaksi.kode_transaksi WHERE transaksi_akun.kolom ='biaya' AND MONTH(transaksi.tgl_transaksi) = $month AND YEAR(transaksi.tgl_transaksi) = $year GROUP BY kode_transaksi";
$res_select_biaya = mysqli_query($connect, $sql_select_biaya);


?>
<table id="Biaya" class="display" style="width:100%">
    <thead class="table-header">
        <tr>
            <!-- <th align="center"><p><input type="checkbox" id="cb0"/></p></th> -->
            <th><p>Tanggal</p></th>
            <th><p>Kode</p></th>
            <th><p>Penerima</p></th>
            <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
        </tr>
    </thead>

    <tbody>
    <?php while($data_select_biaya = mysqli_fetch_array($res_select_biaya)){ ?>

            <tr>
            <td><?php echo $data_select_biaya['tgl_transaksi']; ?></td>
            <td class="kode" value="<?php echo $data_select_biaya['kode_transaksi']; ?>"><h class="text-primary"><?php echo $data_select_biaya['kode_transaksi']; ?></h></td>
            <td><?php echo $data_select_biaya['kontak']; ?></td>
            <td><?php echo $data_select_biaya['total']; ?></td>
            </tr>
    <?php } ?>

    </tbody>

</table>