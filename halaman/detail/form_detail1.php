<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

head(); //call func head from include php
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

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
                            <p class="text-primary">kode transaksi</p>
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
                    <div class="container-fluid bg-info" style="height:100px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *Bayar Dari</strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary">nama akun</p>
                            </h4>   
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-4 pull-right">
                            <h3>
                                <strong>Total</strong> <p class="text-primary pull-right">Rp. 0,00</p>
                            </h3>
                        </div>
                    </div>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                        <div class="col-md-3 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Penerima</strong>
                                <p class="text-primary pull-right">nama</p>
                            </h5>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Tanggal Transaksi</strong>
                                <p class="pull-right">Tanggal</p>
                            </h4>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Nomer Transaksi</strong>
                                <p class="pull-right">Nomor</p>
                            </h4>
                        </div>
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Akun
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Pajak
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nama Akun</td>
                                    <td>Deskripsi</td>
                                    <td>Pajak</td>
                                    <td style="text-align:right">Jumlah</td>
                                </tr>
                            
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <h4>
                                <strong>SubTotal</strong>
                                <p class="text-primary pull-right">harga</p>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <h4>
                                <strong>Nama Pajak</strong>
                                <p class="text-primary pull-right">harga</p>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <h4>
                                <strong>Total</strong>
                                <p class="text-primary pull-right">harga</p>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <h3>
                                <strong>Total</strong>
                                <p class="text-primary pull-right">harga</p>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" style="margin-top:55px">
                        <div class="row">
                        
                            <div class="col-md-1">
                                <button class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                            </div>
                            <div class="col-md-1 col-md-offset-3">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       Cetak <i class="fa fa-print"></i>
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" id="buat_penagihan">PDF</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       Tindakan <i class="fa fa-copy"></i>
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" id="buat_penagihan">Duplikat Transaksi</a></li>
                                        <li><a href="#" id="buat_penagihan">Atur Transaksi Berulang</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1 pull-right">
                                <button class="btn btn-success"> Ubah</button>
                            </div>

                            <div class="col-md-1 pull-right">
                                <button class="btn"> Kembali</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <?php body_bottom(); ?>
</body>
<script>
$(document).ready(function(){

});
</script>