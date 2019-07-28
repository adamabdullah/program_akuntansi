<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

if(!empty($_POST)){

    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $sql_pengirim = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND kredit >0";
    $sql_penerima = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND debit >0 ";
    $sql_tgl = "SELECT tgl_transaksi FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $sql_total = "SELECT SUM(debit) AS total FROM transaksi WHERE kode_transaksi = '$kode'";

    $res_pengirim = mysqli_query($connect, $sql_pengirim);
    $res_penerima = mysqli_query($connect, $sql_penerima);
    $res_tgl = mysqli_query($connect, $sql_tgl);
    $res_total = mysqli_query($connect, $sql_total);
    

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
                    <div class="col-xs-6 col-sm-1 col-md-1 text-right">
                        <h1 style="margin-top:0.75em">
                        Selesai
                        </h1>
                    </div>
                </div>
                <div class="box-body" style="border-top:2px gray solid;">
                    
                    <div class="container-fluid bg-info" style="height:100%;">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6" style="padding:15px">
                                        <h4 style="padding:15px">Transfer Dari</h4>
                                        <h4 style="padding:15px">Setor ke</h4>
                                        <h4 style="padding:15px">Tanggal Transaksi</h4>
                                        <h4 style="padding:15px">Jumlah</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" style="padding:15px">
                                    <?php while($data_pengirim = mysqli_fetch_array($res_pengirim)){ ?>
                                        <h4 style="padding:15px"><?php $kata = $data_pengirim['kode_akun']; $kata2 = explode("|", $kata, 2); echo $kata2[1]; ?></h4>
                                    <?php } ?>
                                    <?php while($data_penerima = mysqli_fetch_array($res_penerima)){?>
                                        <h4 style="padding:15px"><?php $kata = $data_penerima['kode_akun']; $kata2 = explode("|", $kata, 2); echo $kata2[1]; ?></h4>
                                    <?php } ?>
                                    <?php while($data_tgl = mysqli_fetch_array($res_tgl)){?>
                                        <h4 style="padding:15px"><?php echo $data_tgl['tgl_transaksi']; ?></h4>
                                    <?php } ?>
                                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                                        <h4 style="padding:15px"><?php echo $data_total['total']; ?></h4>
                                    <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-5 pull-right" style="padding:15px">
                                <div class="row">
                                    <h4>No Transaksi</h4>
                                </div>
                                <div class="row">
                                    <h4><?php echo $kode2[1];?></h4>
                                </div>
                            </div>
                        </div>
                    </div>                   

                </div>
            </div>
        </section>
    </div>

</body>