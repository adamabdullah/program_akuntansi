<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];

    $sql_pengirim = "SELECT kode_akun,kredit FROM transaksi WHERE kode_transaksi = '$kode' AND debit = 0";

    $sql_penerima = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND debit > 0";
    
    $sql_person = "SELECT * FROM transaksi_akun WHERE kode_transaksi = '$kode'";

    $sql_pajak = "SELECT harga_pajak FROM transaksi WHERE kode_transaksi = '$kode' AND harga_pajak != 0 ";

    $sql_total = "SELECT  SUM(kredit)-SUM(harga_pajak) AS subtotal, SUM(debit) as total FROM transaksi WHERE kode_transaksi = '$kode'";
    

    
    $res_pengirim = mysqli_query($connect, $sql_pengirim);
    $res_penerima = mysqli_query($connect, $sql_penerima);
    $res_person = mysqli_query($connect, $sql_person);

    $res_pajak = mysqli_query($connect, $sql_pajak);
    $res_total = mysqli_query($connect,$sql_total);
    

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
                    <?php while($data_pengirim = mysqli_fetch_array($res_pengirim)){ ?>
                    <div class="container-fluid bg-info" style="height:100px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *Bayar dari </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary"><?php echo $data_pengirim['kode_akun'];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-4 pull-right">
                            <h3>
                                <strong>Total</strong> <p class="text-primary pull-right"><?php echo $data_pengirim['kredit'];?></p>
                            </h3>
                           
                        </div>
                    </div> 
                    <?php } ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php while($data_person= mysqli_fetch_array($res_person)){ ?>
                        <div class="col-md-2 col-sm-7 col-xs-9">
                            <h4>
                                <strong>*Pembayar</strong>
                                <p class="text-primary pull-right"><?php echo $data_person['kontak']; ?></p>
                            </h5>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-9">
                            <h4>
                                <strong>*Tanggal Transaksi</strong>
                                <p class="pull-right"><?php echo $data_person['tgl_transaksi']; ?></p>
                            </h4>
                        </div>

                        <div class="col-md-5 col-sm-7 col-xs-9">
                            <h4>
                                <strong>*Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $data_person['kode_transaksi']; ?></p>
                            </h4>
                        </div>
                    <?php } ?>
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-4 col-sm-4 col-xs-4">
                                        Akun
                                    </th>
                                    <th class="col-md-4 col-sm-4 col-xs-4">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_penerima = mysqli_fetch_array($res_penerima)){ ?>
                                <tr>
                                    <td><?php echo $data_penerima['kode_akun']; ?></td>
                                    <td><?php echo $data_penerima['kolom']; ?></td>
                                    <td style="text-align:right"><?php echo $data_penerima['debit']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h4>
                                <strong>SubTotal</strong>
                                <p class="text-primary pull-right"><?php echo $data_total['subtotal'];?></p>
                                </h4>
                            </div>
                        </div>
                        <?php while($data_pajak = mysqli_fetch_array($res_pajak)){?>
                        <div class="row">
                            <!-- <div class="col-md-4 pull-right">
                                <h4>
                                <strong>Nama Pajak</strong>
                                <p class="text-primary pull-right"><?php echo $data_pajak['nama_pajak'];?></p>
                                </h4>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right"><?php echo $data_pajak['harga_pajak'];?></p>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h3>
                                <strong>Total</strong>
                                <p class="text-primary pull-right"><?php echo $data_total['total'];?></p>
                                </h3>
                            </div>
                        </div>
                    <?php } ?>
                    </div>

                </div>
            </div>
        </section>
    </div>

</body>