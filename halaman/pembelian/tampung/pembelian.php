<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

// $first = '2019/02/01';
// $last = date('Y-m-d');

$year = $_POST['year'];
$month = $_POST['month'];

$sql_select_pembelian = "SELECT tgl_transaksi, kode, pelanggan, tgl_tempo, sisa_tagihan, total FROM transaksi_produk WHERE kolom='pembelian' AND MONTH(tgl_transaksi) = $month AND YEAR(tgl_transaksi) = $year ORDER BY kode ASC";
$res_select_pembelian = mysqli_query($connect,$sql_select_pembelian);


?>
<table id="Pembelian" class="table" style="width:100%">
    <thead class="table-header">
        <tr>
            <!-- <th align="center"><p><input type="checkbox" id="cb0"/></p></th> -->
            <th><p>Tanggal</p></th>
            <th><p>Nomor</p></th>
            <th><p>Supplier</p></th>
            <th><p>Tanggal Jatuh Tempo</p></th>
            <!-- <th><p>Status</p></th> -->
            <th><p>Sisa Tagihan<a class="text-light-blue"> (in IDR)</a></p></th>
            <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
        </tr>
    </thead>

    <tbody>
    <?php $row = mysqli_num_rows($res_select_pembelian);
    
    if($row>0)
    {
    while($data_select_pembelian = mysqli_fetch_array($res_select_pembelian)){ ?>
        <tr>
            <td><?php echo $data_select_pembelian['tgl_transaksi']; ?></td>
            <td class="kode"><h class="text-primary"><?php echo $data_select_pembelian['kode']; ?></h></td>
            <td><?php echo $data_select_pembelian['pelanggan']; ?></td>
            <td><?php echo $data_select_pembelian['tgl_tempo']; ?></td>
            <!-- <td><?php echo $data_select_pembelian['']; ?></td> -->
            <td><?php echo "Rp. ".number_format($data_select_pembelian['sisa_tagihan'],2,",",".");?></td>
            <td><?php echo "Rp. ".number_format($data_select_pembelian['total'],2,",","."); ?></td>
        </tr>

    <?php } 
    }else { ?> 
        <tr>
            <td align="center" colspan="9">kosong</td>
        </tr>
        <tr>
            
            <td align="center" colspan="9">
                <a href="new/" class="btn btn-primary"><img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">Buat Pembelian Baru</a>
            </td>

        </tr> 
    
    <?php }
    ?>

    </tbody>

</table>