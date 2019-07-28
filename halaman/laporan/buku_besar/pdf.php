<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php
if(isset($_POST['first'])&&isset($_POST['last'])){
    $first = $_POST['first'];
    $last = $_POST['last'];

    $select_kode = "SELECT kode_transaksi AS kode, tgl_transaksi AS tgl FROM transaksi_akun WHERE tgl_transaksi between '$first' AND '$last'
    UNION 
    SELECT kode AS kode,tgl_transaksi AS tgl FROM transaksi_produk WHERE tgl_transaksi between '$first' AND '$last' ORDER BY tgl ASC";
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
                <thead class="bg-primary">
                    <tr>
                        <th>Nama Akun</th>
                        <th>Kode Transaksi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_utk_rincian_akun = "select transaksi.kode_akun as kode, transaksi_akun.tgl_transaksi from transaksi inner join transaksi_akun on transaksi.no = transaksi_akun.no WHERE transaksi_akun.tgl_transaksi between '$first' AND '$last' group by kode_akun";
                    
                    $hasil2 = mysqli_query($connect,$sql_utk_rincian_akun);
                    while($data_tempo = mysqli_fetch_array($hasil2))
                    {   $saldo = 0;
                        
                        $contoh = $data_tempo['kode'];
                        ?>
                            <tr>
                                <td colspan="5" class="bg-danger"><strong><?php echo $contoh; ?></strong></td>
                            </tr>
                        <?php
                        $sql_utk_rincian_akun = "select transaksi.kode_transaksi as kode_transaksi, transaksi.debit as debit, transaksi.kredit as kredit, transaksi_akun.tgl_transaksi as tgl from transaksi inner join transaksi_akun on transaksi.no = transaksi_akun.no WHERE transaksi.kode_akun='$contoh' AND transaksi_akun.tgl_transaksi between '$first' AND '$last'";
                        $hasil112 = mysqli_query($connect,$sql_utk_rincian_akun);
                        while($data_tempo = mysqli_fetch_array($hasil112))
                        { $saldo = $saldo + $data_tempo['debit'] - $data_tempo['kredit'];
                            if($saldo>=0){
                                $anu = $saldo;
                            }else if($saldo<0){
                                $anu = "(".abs($saldo).")";
                            }
                        ?>
                            <tr>
                                <td><?php echo $data_tempo['tgl']; ?></td>
                                <td><?php echo $data_tempo['kode_transaksi']; ?></td>
                                <td><?php echo $data_tempo['debit']; ?></td>
                                <td><?php echo $data_tempo['kredit']; ?></td>
                                <td><?php echo $anu; ?></td>
                            </tr>
                        <?php
                        } ?> 
                        <tr>
                            <td colspan="4"><strong>( <?php echo $contoh ?> ) | Saldo Akhir</strong></td>
                            <td class="bg-info"><strong><?php echo $anu ?></strong></td>
                        </tr>
                        <tr><td></td></tr>
                        <?php
                    }
                    ?>
                        
                </tbody>
            
            </table>
                    
        </div> 

    </div>                          
   
</body>
</html>
