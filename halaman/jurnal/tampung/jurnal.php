<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

// $first = '2019/02/01';
// $last = date('Y-m-d');

$year = $_POST['year'];
$month = $_POST['month'];

$sql_select_jurnal = "SELECT transaksi_akun.kode_transaksi AS kode, transaksi_akun.tgl_transaksi AS tgl, sum(transaksi.debit) AS total FROM transaksi_akun INNER JOIN transaksi ON transaksi_akun.kode_transaksi = transaksi.kode_transaksi WHERE transaksi.kode_transaksi LIKE '%Jurnal%' AND MONTH(transaksi.tgl_transaksi) = $month AND YEAR(transaksi.tgl_transaksi) = $year GROUP BY transaksi.kode_transaksi";
$res_select_jurnal = mysqli_query($connect, $sql_select_jurnal);



?>

    <table id="Jurnal" class="table table-hover table-responsive">
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
        <?php while($data_select_jurnal = mysqli_fetch_array($res_select_jurnal)){ ?>

                <tr>
                <td><?php echo $data_select_jurnal['tgl']; ?></td>
                <td class="kode" value="<?php echo $data_select_jurnal['kode']; ?>"><p class="text-primary"><?php echo $data_select_jurnal['kode']; ?></p></td>
                <td> - </td>
                <td><?php echo number_format($data_select_jurnal['total'] ,2,',','.'); ?></td>
                </tr>
        <?php } ?>

        </tbody>

    </table>