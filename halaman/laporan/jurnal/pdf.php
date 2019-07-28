<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php
if(isset($_POST['first'])&&isset($_POST['last'])){
    $f = $_POST['first'];
    $l = $_POST['last'];

    $select_kode = "SELECT kode_transaksi AS kode, tgl_transaksi AS tgl FROM transaksi_akun WHERE tgl_transaksi between '$f' AND '$l'
    UNION 
    SELECT kode AS kode,tgl_transaksi AS tgl FROM transaksi_produk WHERE tgl_transaksi between '$f' AND '$l' ORDER BY tgl ASC";
    $res_kode = mysqli_query($connect, $select_kode);

}
else
{
    header("Location: /faktur_v2/");
}
?>   

</head>

<body onload="window.print();" >
                                
<div id="row-content" class="row content">
            
    <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
        
        <table class="table table-hover table-responsive" cellpadding="5">
            <thead class="row bg-primary">
                <th>Akun</th>
                <th style="text-align:right">Debit</th>
                <th style="text-align:right">Kredit</th>
            </thead>
            <tbody>
            <?php while($data_kode = mysqli_fetch_array($res_kode)){
                $total_debit = 0;
                $total_kredit = 0;
                ?>
                <tr>
                    <td class="bg-info" colspan="3"><?php echo $data_kode['kode']." | ".$data_kode['tgl']; ?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <?php $sql_transaksi = "SELECT kode_akun, debit, kredit FROM transaksi WHERE kode_transaksi = '".$data_kode['kode']."'";
                    $res_transaksi = mysqli_query($connect, $sql_transaksi);
                    while($data_transaksi = mysqli_fetch_array($res_transaksi)){
                        $total_debit = $total_debit + $data_transaksi['debit'];
                        $total_kredit = $total_kredit + $data_transaksi['kredit'];
                ?>
                    <tr> 
                        <td style="padding-left:20px"><?php echo $data_transaksi['kode_akun']; ?></td>
                        <td style="text-align:right"><?php echo number_format($data_transaksi['debit'],2,',','.'); ?></td>
                        <td style="text-align:right"><?php echo number_format($data_transaksi['kredit'],2,',','.'); ?></td>
                    </tr>
                    

                <?php } ?>
                <tr>
                        <td style="text-align:right"><strong>Total</strong></td>
                        <td style="text-align:right"><?php echo number_format($total_debit,2,',','.'); ?></td>
                        <td style="text-align:right"><?php echo number_format($total_kredit,2,',','.'); ?></td>
                    </tr>
            <?php } ?>



            </tbody>
        
        </table>
                
    </div> 

</div>



</body>
</html>
