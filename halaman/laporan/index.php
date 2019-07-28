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

    <div class="box">
        <div class="box-header row">
            <div class="col-md-5">
                <h2>
                    <small>Laporan</small>
                    <p class="text-primary" id="context-span">Laporan</p>
                </h2>
            </div>
            <div class="col-md-3">
            
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
    </div>       
            <!-- Sidebar Holder -->

            <!-- Page Content Holder --> 
        <section>
            
            <!-- <div id="container"> -->            
                
                <div class="row content">
            
                    <div class="container-fluid" style="background-color:#fff; padding:15px; border-radius: 0px 0px 9px 9px;"> <!-- tag container-myjurnal -->
                        
                            <ul id="myTab" class="nav nav-tabs"> <!-- tag myTab -->
                            
                                <li class="active"><a href="#main" id="" data-toggle="tab">Sekilas Bisnis</a></li>
                                <!-- <li class=""><a href="#jual" id="" data-toggle="tab">Penjualan</a></li>
                                <li class=""><a href="#beli" id="" data-toggle="tab">Pembelian</a></li>
                                <li class=""><a href="#aset" id="" data-toggle="tab">Aset</a></li>
                                <li class=""><a href="#bank" id="" data-toggle="tab">Bank</a></li>
                                <li class=""><a href="#pajak" id="" data-toggle="tab">Pajak</a></li> -->
                            
                            </ul> 

                                <div class="tab-content">
                                    <div id="main" class="tab-pane fade in active">
                                        <div class="container">
                                            <div class="row form-group">
                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="neraca/">Neraca</a></h4>
                                                    <p>
                                                        Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).
                                                    </p>
                                                    <a href="neraca/" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>

                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="buku_besar/">Buku Besar</a></h4>
                                                    <p>
                                                        Laporan ini menampilkan semua transaksi yang telah dilakukan untuk suatu periode. Laporan ini bermanfaat jika Anda memerlukan daftar kronologis untuk semua transaksi yang telah dilakukan oleh perusahaan Anda.
                                                    </p>
                                                    <!-- <button class="btn" id="">Lihat Laporan</button> -->
                                                    <a href="buku_besar/" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="laba&rugi/">Laporan Laba-Rugi</a></h4>
                                                    <p>
                                                        Menampilkan setiap tipe transaksi dan jumlah total untuk pendapatan dan pengeluaran anda.
                                                    </p>
                                                    <a href="laba&rugi/" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>

                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="jurnal/">Jurnal</a></h4>
                                                    <p>
                                                        Daftar semua jurnal per transaksi yang terjadi dalam periode waktu. Hal ini berguna untuk melacak di mana transaksi Anda masuk ke masing-masing rekening
                                                    </p>
                                                    <a href="jurnal/" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>
                                            </div>

                                            <!-- <div class="row form-group">
                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="">Laporan Laba-Rugi <span class="label label-primary">New</span></a></h4>
                                                    <p>
                                                        (Early Release) Menampilkan setiap tipe transaksi dan jumlah total untuk pendapatan dan pengeluaran anda.
                                                    </p>
                                                    <a href="#" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div> -->

                                              <!--   <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="">Trial Balance</a></h4>
                                                    <p>
                                                        Menampilkan saldo dari setiap akun, termasuk saldo awal, pergerakan, dan saldo akhir dari periode yang ditentukan.
                                                    </p>
                                                    <a href="#" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div> -->
                                            <!-- </div> -->
<!-- 
                                            <div class="row form-group">
                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="">Arus Kas</a></h4>
                                                    <p>
                                                        (Early Release) Menampilkan setiap tipe transaksi dan jumlah total untuk pendapatan dan pengeluaran anda.                                                    
                                                    </p>
                                                    <a href="#" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>

                                                <div class="container col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                    <h4><a href="">Ringkasan Bisnis</a></h4>
                                                    <p>
                                                        Laporan Ringkasan Bisnis Menampilkan ringkasan dari laporan keuangan standar beserta wawasannya.
                                                    </p>
                                                    <a href="#" class="btn btn-small btn-default">Lihat Laporan</a>

                                                </div>
                                            </div> -->

                                        </div>



                                    </div>

                                    <div id="jual" class="tab-pane fade">
                                    <h3>Penjualan</h3>
                                    <p>Fitur ini akan berfungsi setelah update sofware selanjutnya.</p>
                                    </div>

                                    <div id="beli" class="tab-pane fade">
                                    <h3>Pembelian</h3>
                                    <p>Fitur ini akan berfungsi setelah update sofware selanjutnya.</p>
                                    </div>

                                    <div id="aset" class="tab-pane fade">
                                    <h3>Aset</h3>
                                    <p>Fitur ini akan berfungsi setelah update sofware selanjutnya.</p>
                                    </div>

                                    <div id="bank" class="tab-pane fade">
                                    <h3>Bank</h3>
                                    <p>Fitur ini akan berfungsi setelah update sofware selanjutnya.</p>
                                    </div>

                                    <div id="pajak" class="tab-pane fade">
                                    <h3>Pajak</h3>
                                    <p>Fitur ini akan berfungsi setelah update sofware selanjutnya.</p>
                                    </div>

                                </div>

                            </div>
                             
                        </div>
                    
                    </div>  <!-- close row-content -->
                </div>

            
            
        </section>
    </div>

<?php body_bottom(); ?>

</body>
</html>
<script>
$(document).ready(function() 
{ 
    $("#lap_jurnal").click(function(){
        location.href = "jurnal/";
    });
    

});
</script>