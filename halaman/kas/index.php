<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');
  
include('../../include/include.php');

include('../../modal/modal.php'); 

head(); //call func head from include php

//awal hutang
$sql_nominal_belum_lunas = "SELECT SUM(sisa_tagihan) FROM transaksi_produk WHERE kolom='penjualan' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$result_nominal_belum_lunas = mysqli_query($connect, $sql_nominal_belum_lunas);
 
$sql_belum_lunas = "SELECT count(*) FROM transaksi_produk WHERE sisa_tagihan>0 and kolom='penjualan' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$result_belum_lunas = mysqli_query($connect, $sql_belum_lunas);
//akhir hutang 

//transaksi untuk penjualan mendatang 30
$sql_kumpulan_jatuh = "SELECT transaksi_produk.sisa_tagihan as sisa_tagihan FROM transaksi_produk WHERE kolom='penjualan' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$res_kumpulan = mysqli_query($connect,$sql_kumpulan_jatuh);

//awal tempo
$sql_sum_tagihan = "SELECT SUM(sisa_tagihan) FROM transaksi_produk WHERE kolom = 'pembelian' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$res_sum_tagihan = mysqli_query($connect, $sql_sum_tagihan);

$sql_tempo = "SELECT count(*) as jml FROM transaksi_produk WHERE kolom = 'pembelian' AND tgl_tempo <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND CURDATE() <=tgl_tempo";
$result_tempo = mysqli_query($connect, $sql_tempo); 
//akhir tempo

//awal lunas
$sql_nominal_lunas = "SELECT SUM(total) FROM penjualan WHERE sisa_tagihan = 0";
$result_nominal_lunas = mysqli_query($connect, $sql_nominal_lunas);
$result_nominal_lunas2 = mysqli_query($connect, $sql_nominal_lunas);

$sql_lunas = "SELECT count(*) FROM penjualan WHERE sisa_tagihan= 0";
$result_lunas = mysqli_query($connect, $sql_lunas);
$result_lunas2 = mysqli_query($connect, $sql_lunas);
//akhir lunas

$sementara = 0;

$sql = "SELECT * FROM akun WHERE kategori_akun = 'Kas & Bank'";
$result2 = mysqli_query($connect, $sql);
while($data2 = mysqli_fetch_array($result2))
{
    $saldo_kas = "SELECT sum(debit)-sum(kredit) AS saldo FROM transaksi WHERE kode_akun LIKE '%".$data2['nama_akun']."%'";
    $res_saldo_kas = mysqli_query($connect, $saldo_kas);
    while ($data_saldo_kas = mysqli_fetch_array($res_saldo_kas)) 
    {
        $sementara = $sementara + $data_saldo_kas['saldo'];
        $get_saldo = $sementara;
        # code...
    }
}


?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper">        
            <!-- Sidebar Holder -->
            <!-- Page Content Holder --> 
        <section class="content">
           
            <div class="box box-primary">
                <div class="box-body row">
                    <div class="col-sm-4 col-md-4 col-lg-4" style="text-align:left">
                        
                            <h2>
                                <small>Kas&Bank</small><br><p class="text-primary">Akun Kas</p>
                            </h2>
                            
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 pull-right">
                        <h2><button class="btn btn-primary" type="button" aria-haspopup="true" aria-expanded="true" id="tambah_akun" <?php echo $_SESSION['write']; ?>>
                            <i class="fa fa-plus"></i>
                            Buat Akun Baru
                            </button></h2>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="small-box bg-green">
                            <div class="inner">
                            <?php while($data_nominal_belum_lunas= mysqli_fetch_array($result_nominal_belum_lunas)){
                                ?>
                            <h3><?php echo "Rp. ".number_format($data_nominal_belum_lunas['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                            <?php } ?>
                            
                            <p>Pemasukan Dalam 30 Hari Mendatang (dalam IDR) 
                            <?php while($data_belum_lunas= mysqli_fetch_array($result_belum_lunas)){ 
                                
                                ?>

                                <span class="badge bg-white"><?php echo $data_belum_lunas['count(*)'] ?></span></p>

                            <?php } ?>
                                    
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="#" class="small-box-footer pemasukan_30hari">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="small-box bg-red">
                            <div class="inner">
                            <?php while($data_tagihan= mysqli_fetch_array($res_sum_tagihan)){
                                ?>
                            <h3><?php echo "Rp. ".number_format($data_tagihan['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                            <?php } ?>
                            
                            <p>Pengeluaran 30 Hari Mendatang (IDR) 
                            <?php while($data_pembelian = mysqli_fetch_array($result_tempo)){ ?>
                                <span class="badge bg-white"><?php echo $data_pembelian['jml']; ?></span></p>
                            <?php } ?>
                                    
                            </div>
                            <div class="icon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <a href="#" class="small-box-footer pengeluaran_30_mendatang">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3><?php echo "Rp. ".number_format($get_saldo,2,",","."); ?></h3>         
                            <p class="small-box-header">Saldo Dalam Kas (IDR)

                                <span class="badge bg-white"></span></p>

                            <h3></h3>

                            </div>
                            <div class="icon">
                            <i class="fa fa-check-square"></i>
                            </div>
                            <a href="#" class="small-box-footer saldo_dalam_bank">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- <div class="col-xs-6 col-sm-6 col-md-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                            <p class="small-box-header">Saldo Kartu Kredit (IDR)

                                <span class="badge bg-white"></span></p>

                            <h3></h3>

                            </div>
                            <div class="icon">
                            <i class="fa fa-check-square"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div> -->

                </div>
            </div>
                       
            <div class="box box-primary" style="border-radius: 0px 0px 9px 9px;"> <!-- tag container-myjurnal -->
                <div class="box-header with-border">
                    <a href="#"> <h2 id="list" style="display: inline-block">List Akun Kas</h2></a>
                    <div class="col-md-2 col-sm-1 pull-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" <?php echo $_SESSION['write']; ?>>
                            <i class="fa fa-bars"></i>
                            Buat Transaksi
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="/faktur_v2/halaman/kas/transfer_uang/transfer_uang.php" >Transfer Uang</a></li>
                                <li><a href="/faktur_v2/halaman/kas/terima_uang/terima_uang.php">Terima Uang</a></li>
                                <li><a href="/faktur_v2/halaman/kas/kirim_kas.php">Kirim Uang</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="box-body"> 
                
                <?php  while($data_kmpln = mysqli_fetch_array($res_kumpulan))
                                { } ?>
                        <table id="example" class="table table-hover table-responsive" style="width:100%">
                            <thead class="table-header">
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Kategori Akun</th>
                       <!--              <th>Saldo di Jurnal(IDR)</th> -->
                                    <th>Saldo di Bank(IDR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM akun WHERE kategori_akun = 'Kas & Bank'";
                                $result2 = mysqli_query($connect, $sql);
                                while($data2 = mysqli_fetch_array($result2))
                                {
                                    $sql1 = "SELECT sum(debit)-sum(kredit) AS saldo FROM transaksi WHERE kode_akun LIKE '%".$data2['nama_akun']."%'";
                                    $res1 = mysqli_query($connect, $sql1);
                                    ?>
                                    <tr>
                                        <td class="tampung_nomor"><?php echo $data2['kode_akun']; ?></td>
                                        <td class="kode"><p class="text-primary"><?php echo $data2['nama_akun']; ?></p></td>
                                        <td><?php echo $data2['kategori_akun']; ?></td>
                                  <!--       <td>jurnal</td> -->
                                        <?php while($data_saldo = mysqli_fetch_array($res1)){?>
                                        <td><?php echo number_format($data_saldo['saldo'],2,",","."); ?></td> 
                                        <?php } ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                
                </div>  <!-- close box-body -->
                      

                
            </div>
        </section>
    </div>

<?php body_bottom(); ?>

</body>
</html>

<script>
$(document).ready(function() 
{
    var a = 0;

    $('#example').DataTable();

    $("#tambah_akun").click(function()
    {
        $("#modal_nambah_akun").modal('toggle');
    });

    $(".pemasukan_30hari").click(function(e)
    {
        e.preventDefault();
        var kode = "Penjualan Belum Dibayar";

        var url = '../detail/pemasukkan_30_mendatang.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
    });

     $(".pengeluaran_30_mendatang").click(function(e)
    {
        e.preventDefault();
        var kode = "Penjualan Belum Dibayar";

        var url = '../detail/pengeluaran_30_mendatang.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
    });

    $(document).on('click','.saldo_dalam_bank', function(e)
    {
        e.preventDefault();
        var kode = "Penjualan Belum Dibayar";

        var url = '../detail/saldo_dlm_kas.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
            // $("#draft").html( "" );
            // $("#list").after( "<h2 id='draft' style='display: inline-block'>/Saldo dalam kas</h2>" );
            // $.ajax
            // ({
            //     url      : "/faktur_v2/config/saldo_kas.php",
            //     type     : "POST",
            //     data     : {},
            //     success  : function(data)
            //     {
            //         $("#example").html(data);
            //         $("#example").DataTable();
            //     } 
            // });
    });

    

    $(document).on('click','#list', function(e)
    {
        e.preventDefault();
        a=0;
        $("#draft").remove();
        $.ajax
        ({
            url      : "/faktur_v2/config/akun_kas_table.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	 $("#example").html(data);
                 $("#example").DataTable();
            } 
        });
    });
    // $("#list").click(function()
    // {
    //     e.preventDefault();
    //     $("#draft").remove();
        // $.ajax
        // ({
        //     url      : "/faktur_v2/config/pemasukan_30hari.php",
        //     type     : "POST",
        //     data     : {},
        //     success  : function(data)
        //     {
        //     	 $("#example").html(data);
        //          $("#example").DataTable(html);
        //     } 
        // });
    // });

    $("#simpan-akun").click(function()
    {
        var nama_akun_modal = $("#nama_akun_modal").val();
        var nomor_akun_modal = $("#nomor_akun_modal").val();
        var kategori_modal = $("#kategori_modal").val();
        // var pajak_modal = $("#pajak_modal").val();
        var a = $("#tombol_sebelumnya").text();
        $.ajax
        ({
            url      : "/faktur_v2/halaman/proses-kas/save_akun.php",
            type     : "POST",
            data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal},
            success  : function(data)
            {
                swal("Berhasil ditambahkan", "", "success");
                setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                  }, 1000);
            }
        });
    });

    $(document).on('click','.kode', function(){
        var kode = $(this).text();
        var url = '/faktur_v2/halaman/detail/';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();
    });  
    
});
</script>
