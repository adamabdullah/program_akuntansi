<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $loop = 0;
    $loop2 = 0;

    $sisa_tagihan = "SELECT CASE WHEN sisa_tagihan > 0 THEN 'Belum Lunas' WHEN sisa_tagihan = 0 THEN 'Lunas' END AS kategori FROM transaksi_produk WHERE kode = '$kode'";
    $res_tagihan = mysqli_query($connect, $sisa_tagihan);

    $sql_kontak = "SELECT 
	transaksi_akun.kontak as kontak, 
	kontak.email as email, 
	kontak.alamat_penagihan as alamat 
	FROM transaksi_akun 
	INNER JOIN kontak on 
	transaksi_akun.kontak = 
	kontak.nama WHERE transaksi_akun.kode_transaksi = '$kode'";
    $res_kontak = mysqli_query($connect, $sql_kontak);

        while($data_kontak = mysqli_fetch_array($res_kontak)){
            // $nama[0] = $data_kontak['kontak'];
            $kontak[$loop] = $data_kontak['kontak'];
            $email[$loop] = $data_kontak['email'];
            $alamat[$loop] = $data_kontak['alamat'];
        }

    $sql_transaksi = "SELECT tgl_transaksi AS awal, tgl_tempo AS akhir FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $res_transaksi = mysqli_query($connect, $sql_transaksi);

        while($data_transaksi = mysqli_fetch_array($res_transaksi)){

            $awal[$loop2] = $data_transaksi['awal'];
            $akhir[$loop2] = $data_transaksi['akhir'];
            $loop2++;
        }

    $sql_akun_biaya ="SELECT * FROM transaksi WHERE kredit = 0 AND kode_transaksi = '$kode'";
    $res_akun_biaya = mysqli_query($connect, $sql_akun_biaya);

    $sql_produk = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND qty_produk >''";
    $res_produk = mysqli_query($connect, $sql_produk);
    
    $sql_total = "SELECT sum(debit)-sum(harga_pajak) AS sub, sum(harga_pajak) AS pajak, sum(debit) AS total from transaksi WHERE kode_transaksi ='$kode' ";
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
                    <div class="col-xs-6 col-sm-3 col-md-3 text-right">
                    <?php ?>
                        <h2 style="margin-top:0.75em">
                            <?php ?>
                        </h2>
                    <?php  ?>
                    </div>
                </div>

                <div class="box-body" style="border-top:2px gray solid;">

                    <?php  ?>

                    <div class="container-fluid bg-info" style="height:100px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *Penerima </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary"><?php echo $kontak[0];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *E-mail </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary"><?php echo $email[0];?></p>
                            
                            </h4>   
                        </div>
                        
                        
                    </div> 

                    <?php  ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php ?>
                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>Alamat</strong>
                                <p class="text-primary pull-right"><?php echo $alamat[0];  ?></p>
                            </h4>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>Tanggal Transaksi</strong>
                                <p class="pull-right"><?php echo $awal[0]; ?></p>
                            </h4>
                        </div>
                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>Tanggal Jatuh Tempo</strong>
                                <p class="pull-right"><?php echo $akhir[0]; ?></p>
                            </h4>
                        
                        </div>


                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $kode2[1] ?></p>
                            </h4>
                        </div>
                    <?php  ?>
                    </div>

                    <div class="container-fluid" style="margin-top:100px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-2 col-xs-2 col-sm-2">
                                        Produk
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-1 col-xs-1 col-sm-1">
                                        Harga Pajak
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_akun_biaya = mysqli_fetch_array($res_akun_biaya)){ ?>
                                <tr>
                                    <td><?php $nama = explode('|', $data_akun_biaya['kode_akun'], 2); echo $nama[1]; ?></td>
                                    <td><?php  ?></td>
                                    <td><?php echo number_format($data_akun_biaya['harga_pajak'],2,',','.');  ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_biaya['debit'],2,',','.');  ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6 pull-right">
                                <h4>
                                <strong>SubTotal</strong>
                                <p class="text-primary pull-right"><?php echo number_format($data_total['sub'],2,',','.'); ?></p>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right"><?php echo number_format($data_total['pajak'],2,',','.'); ?></p>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6 pull-right">
                                <h3>
                                <strong>Sisa Tagihan</strong>
                                <p class="text-primary pull-right"><?php echo number_format($data_total['total'],2,',','.'); ?></p>
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