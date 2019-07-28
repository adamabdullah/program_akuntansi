<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $loop = 0 ;
    $loop1 = 0;
    
    $select = "SELECT transaksi.kode_akun as akun, transaksi.debit as debit, transaksi.kredit as kredit, transaksi_akun.tgl_transaksi as tgl from transaksi INNER JOIN transaksi_akun on transaksi.kode_transaksi = transaksi_akun.kode_transaksi where transaksi.kode_transaksi='$kode'";
    $res = mysqli_query($connect, $select);
    
    $selectsum = "SELECT sum(debit) AS debit, sum(kredit) AS kredit FROM transaksi WHERE kode_transaksi ='$kode'";
    $ressum = mysqli_query($connect, $selectsum);
    
    while($data1 = mysqli_fetch_array($res)){
        $akun[$loop] = $data1['akun'];
        $debit[$loop] = $data1['debit'];
        $kredit[$loop] = $data1['kredit'];
    
        $tgl = $data1['tgl'];
        $loop++;
    }
    
    while($data2 = mysqli_fetch_array($ressum)){
        $resultDebit[$loop1] = $data2['debit'];
        $resultKredit[$loop1] = $data2['kredit'];
        $loop1++;
    }
    
        

    
    

}else {
    header("Location: /faktur_v2/");
}

head(); //call func head from include php
?>

</head>
<body onload="window.print();">

<div class="content-wrapper">
        <section class="content">
            <div class="box">
                <div class="box-header row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <!-- <div class="page-title-heading"> -->
                        <h2>
                            <small>
                                Transaksi
                            </small><br>
                            <p class="text-primary"><?php echo $kode; ?></p>
                        </h2>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 text-right">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 text-right">
                    <?php ?>
                        <h2 style="margin-top:0.75em">
                            <?php ?>
                        </h2>
                    <?php  ?>
                    </div>
                </div>

                <div class="box-body" style="border-top:2px gray solid;">

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <strong>Tgl Transaksi : </strong>
                            </h4>
                            <h4>
                                <p><?php echo $tgl; ?></p>
                            </h4>
                        </div>
                        
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <strong>No Transaksi : </strong>
                            </h4>
                            <h4>
                                <p><?php echo $kode2[1] ?></p>
                            </h4>
                        </div>
                    </div>

                    <div class="container-fluid" style="margin-top:100px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="col-md-3 col-xs-3 col-sm-3">
                                        Kode Akun
                                    </th>
                                    <th class="col-md-3 col-xs-3 col-sm-3">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Debit (IDR)
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Kredit (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i = 0; $i<$loop;$i++){?>
                                <tr>
                                    <td><?php echo $akun[$i]; ?></td>
                                    <td></td>
                                    <td style="text-align:right"><?php echo number_format($debit[$i],2,',','.'); ?></td>
                                    <td style="text-align:right"><?php echo number_format($kredit[$i],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong> Total Debit </strong></h4>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong> Total Kredit</strong></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong><?php echo number_format($resultDebit[0],2,',','.'); ?></strong></h4>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong><?php echo number_format($resultKredit[0],2,',','.'); ?></strong></h4>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

</body>