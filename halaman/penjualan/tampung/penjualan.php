<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

// $first = '2019/02/01';
// $last = date('Y-m-d');

$year = $_POST['year'];
$month = $_POST['month'];

?>
<table id="Penjualan" class="display" style="width:100%">
    <thead class="table-header">
        <tr>
            <th><p>Tanggal</p></th>
            <th><p>Nomor</p></th>
            <th><p>Pelanggan</p></th>
            <th><p>Tanggal Jatuh Tempo</p></th>
            <th><p>Status</p></th>
            <th><p>Sisa Tagihan<a class="text-light-blue"> (in IDR)</a></p></th>
            <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
        </tr>
    </thead>

    <tbody>
        <?php
            $sql = "SELECT * FROM transaksi_produk where kolom='penjualan' AND MONTH(tgl_transaksi) = $month AND YEAR(tgl_transaksi) = $year ORDER BY tgl_transaksi ASC";
            $result1 = mysqli_query($connect, $sql);
            $row1 = mysqli_num_rows($result1);
            if ( $row1 > 0) {                                                            
        
                while($data1 = mysqli_fetch_array($result1))
                {
                    ?>
                    <tr><td><?php echo $data1['tgl_transaksi']; ?></td>
                        <td class="kode"><h class="text-primary"><?php echo $data1['kode']; ?></h></td>
                        <td><?php echo $data1['pelanggan']; ?></td>
                        <td><?php echo $data1['tgl_tempo']; ?></td>
                        <td><?php echo $data1['status']; ?></td>
                        <td><?php echo $data1['sisa_tagihan']; ?></td>
                        <td><?php echo $data1['total']; ?></td>
                    </tr>
                <?php
                } 
            } else { 

                ?>
                <tr><td align="center" colspan="9">kosong</td></tr>
                <tr>
                    
                    <td align="center" colspan="9">
                        <a href="new/" class="btn btn-primary"><img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">Buat Penjualan Baru</a>
                    </td>

                </tr>   <?php }?>

    </tbody>

</table>