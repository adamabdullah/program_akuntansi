<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

// $first = '2019/02/01';
// $last = date('Y-m-d');

$first = $_POST['f'];
$last = $_POST['l'];

$sel_akun_4 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '4%' AND tgl_transaksi between '".$first."' AND '".$last."'";
$res_akun_4 = mysqli_query($connect, $sel_akun_4);

$sel_akun_5 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '5%' AND tgl_transaksi between '".$first."' AND '".$last."'";
$res_akun_5 = mysqli_query($connect, $sel_akun_5);

$sel_akun_6 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '6%' AND tgl_transaksi between '".$first."' AND '".$last."'";
$res_akun_6 = mysqli_query($connect, $sel_akun_6);

$sel_akun_7 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '7%' AND tgl_transaksi between '".$first."' AND '".$last."'";
$res_akun_7 = mysqli_query($connect, $sel_akun_7);

$sel_akun_8 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '8%' AND tgl_transaksi between '".$first."' AND '".$last."'";
$res_akun_8 = mysqli_query($connect, $sel_akun_8);



?>

            
                
<div id="row-content" class="row content">

    <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
        
        <table class="table table-hover" cellpadding="5">
            <thead class="bg-primary">
            <tr>
                <th>Tanggal</th>
                <th class="pull-right"><?php echo $first." sampai ".$last; ?></th>
            </tr>
            </thead>

            <tbody>
<!-- akun 4 -->
                <tr class="bg-info">
                    <td colspan="2"><Strong>Pendapatan Dari Penjualan</Strong></td>
                </tr>
                <?php $total1 = (int)0; while($data_akun_4 = mysqli_fetch_array($res_akun_4)){
                    $total1 = $total1 + $data_akun_4['total']; ?>
                    <tr>
                        <td><?php echo $data_akun_4['kode_akun'] ?></td>
                        <td style="text-align:right"><?php echo number_format($data_akun_4['total'] ,2,',','.'); ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td><p>Total Pendapatan Dari Penjualan</p></td>
                    <td style="text-align:right"><?php echo   number_format($total1 ,2,',','.'); ?></td>
                </tr>
<!-- akun 4 -->

<!-- akun 5 -->
                <tr class="bg-info">
                    <td colspan="2"><Strong>Harga Pokok Penjualan</Strong></td>
                </tr>
                <?php $total2 = (int)0; while($data_akun_5 = mysqli_fetch_array($res_akun_5)){
                    $total2 = $total2 + $data_akun_5['total']; 
                    ?>
                    <tr>
                        <td><?php echo $data_akun_5['kode_akun'] ?></td>
                        <td style="text-align:right"><?php echo number_format($data_akun_5['total'] ,2,',','.'); ?></td>
                    </tr>
                <?php } $total1 = $total1 - $total2; ?>

                <tr>
                    <td><p>Total Harga Pokok Penjualan</p></td>
                    <td style="text-align:right"><?php echo  number_format($total2 ,2,',','.'); ?></td>
                </tr>
<!-- akun 5 -->

<!-- laba kotor -->
                    <tr>
                        <td><strong class="text-primary">Laba Kotor</strong></td>
                        <td style="text-align:right "><strong class="text-primary"><?php echo number_format($total1,2,',','.'); ?></strong></td>
                    </tr>
<!-- laba kotor -->
                <tr>
                    <td></td>
                    <td></td>
                </tr>

<!-- akun 6 -->
                <tr class="bg-info">
                    <td colspan="2"><Strong>Biaya Operasional</Strong></td>
                </tr>
                <?php $total3 = (int)0; while($data_akun_6 = mysqli_fetch_array($res_akun_6)){
                    $total3 = $total3 + $data_akun_6['total']; 
                    ?>
                    <tr>
                        <td><?php echo $data_akun_6['kode_akun'] ?></td>
                        <td style="text-align:right"><?php echo number_format($data_akun_6['total'] ,2,',','.'); ?></td>
                    </tr>
                <?php } $total1 = $total1 - $total3;  ?>

                <tr>
                    <td><p>Total Biaya Operasional</p></td>
                    <td style="text-align:right"><?php echo number_format($total3 ,2,',','.'); ?></td>
                </tr>
                <tr>
                    <td><strong class="text-primary">Pendapatan Bersih Operasional</strong></td>
                    <td style="text-align:right"><strong class="text-primary"><?php echo number_format($total1,2,',','.'); ?></strong></td>
                </tr>
<!-- akun 6 -->

                <tr>
                    <td></td>
                    <td></td>
                </tr>

<!-- akun 7 -->
                <tr class="bg-info">
                    <td colspan="2"><Strong>Pendapatan Lainnya</Strong></td>
                </tr>
                <?php $total4 = (int)0; while($data_akun_7 = mysqli_fetch_array($res_akun_7)){
                    $total4 = $total4 + $data_akun_7['total']; 
                        ?>
                    <tr>
                        <td><?php echo $data_akun_7['kode_akun'] ?></td>
                        <td style="text-align:right"><?php echo number_format($data_akun_7['total'] ,2,',','.'); ?></td>
                    </tr>
                <?php } $total1 = $total1 - $total4; ?>

                <tr>
                    <td><p>Total Pendapatan Lainnya</p></td>
                    <td style="text-align:right"><?php echo number_format($total4 ,2,',','.'); ?></td>
                </tr>
<!-- akun 7 -->

<!-- akun 8 -->
                <tr class="bg-info">
                    <td colspan="2"><Strong>Biaya Lainnya</Strong></td>
                </tr>
                <?php $total5 = (int)0; while($data_akun_8 = mysqli_fetch_array($res_akun_8)){
                    $total5 = $total5 + $data_akun_8['total']; 
                    ?>
                    <tr>
                        <td><?php echo $data_akun_8['kode_akun'] ?></td>
                        <td style="text-align:right"><?php echo number_format($data_akun_8['total'],2,',','.'); ?></td>
                    </tr>
                <?php } $total1 = $total1 - $total5; ?>

                <tr>
                    <td><p>Total Biaya Lainnya</p></td>
                    <td style="text-align:right"><?php echo number_format($total5,2,',','.');  ?></td>
                </tr>
<!-- akun 8 -->

<!-- laba kotor -->
                    <tr>
                        <td><strong class="text-primary">Laba Bersih</strong></td>
                        <td style="text-align:right "><stronstrong class="text-primary"><?php echo number_format($total1,2,',','.');  ?></stronstrong></td>
                    </tr>
<!-- laba kotor -->

            </tbody>
        </table>
                
        
    </div> 
</div> 

