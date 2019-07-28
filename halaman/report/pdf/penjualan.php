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

    $sql_kontak = "SELECT transaksi_produk.pelanggan AS nama, kontak.email AS email, kontak.alamat_penagihan AS alamat FROM transaksi_produk INNER JOIN kontak on transaksi_produk.pelanggan = kontak.nama WHERE transaksi_produk.kode = '$kode'";
    $res_kontak = mysqli_query($connect, $sql_kontak);

        while($data_kontak = mysqli_fetch_array($res_kontak)){
                
            $nama[$loop] = $data_kontak['nama'];
            $email[$loop] = $data_kontak['email'];
            $alamat[$loop] = $data_kontak['alamat'];
            $loop++;
        }

    $sql_penjualan = "SELECT tgl_transaksi AS awal, tgl_tempo AS akhir, sisa_tagihan FROM transaksi_produk WHERE kode = '$kode'";
    $res_penjualan = mysqli_query($connect, $sql_penjualan);

        while($data_penjualan = mysqli_fetch_array($res_penjualan)){

            $awal[$loop2] = $data_penjualan['awal'];
            $akhir[$loop2] = $data_penjualan['akhir'];
            $sisa[$loop2] = $data_penjualan['sisa_tagihan'];
            $loop2++;
        }

        $sql_produk = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND qty_produk >''";
        $res_produk = mysqli_query($connect, $sql_produk);
    
    $sql_total = "SELECT sum(transaksi.jumlah_uang) AS sub, sum(transaksi.harga_pajak) AS pajak, transaksi_produk.sisa_tagihan AS sisa, transaksi_produk.total-transaksi_produk.sisa_tagihan AS dibayar FROM transaksi INNER JOIN transaksi_produk ON transaksi.kode_transaksi = transaksi_produk.kode WHERE transaksi.kode_transaksi = '$kode' ";
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
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4><strong>
                                *Pelanggan </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4>
                                <p class="text-primary"><?php echo $nama[0];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4><strong>
                                *E-mail </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <h4>
                                <p class="text-primary"><?php echo $email[0];?></p>
                            
                            </h4>   
                        </div>
                        
                        
                    </div> 

                    <?php  ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php ?>
                        <div class="col-md-3 col-sm-7 col-xs-7">
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
                                        Kuantitas
                                    </th>
                                    <th class="col-md-1 col-xs-1 col-sm-1">
                                        Harga Pajak
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Harga Satuan (IDR)
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_produk = mysqli_fetch_array($res_produk)){ ?>
                                <tr>
                                    <td><?php $nama = explode('|', $data_produk['nama_produk'], 2); echo $nama[1]; ?></td>
                                    <td><?php  ?></td>
                                    <td style="text-align:center"><?php echo $data_produk['qty_produk']; ?></td>
                                    <td><?php echo $data_produk['harga_pajak']; ?></td>
                                    <td style="text-align:right"><?php echo $data_produk['jumlah_uang']; ?></td>
                                    <td style="text-align:right"><?php echo $data_produk['kredit']; ?></td>
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
                                <p class="text-primary pull-right"><?php echo $data_total['sub'];?></p>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right"><?php echo $data_total['pajak'];?></p>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h3>
                                <strong>Dibayar</strong>
                                <p class="text-primary pull-right"><?php echo $data_total['dibayar'];?></p>
                                </h3>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h3>
                                <strong>Sisa Tagihan</strong>
                                <p class="text-primary pull-right"><?php echo $data_total['sisa'];?></p>
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