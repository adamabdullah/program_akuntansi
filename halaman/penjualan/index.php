<!DOCTYPE HTML>
<html lang="en">
<head> 

<?php  
  
include('../../config/connect.php');
 
include('../../include/include.php'); 

head(); //call func head from include php

//awal hutang 
$sql_nominal_belum_lunas = "SELECT SUM(sisa_tagihan) FROM transaksi_produk where kolom='penjualan'";
$result_nominal_belum_lunas = mysqli_query($connect, $sql_nominal_belum_lunas);
  
$sql_belum_lunas = "SELECT count(*) FROM transaksi_produk WHERE sisa_tagihan>0 and kolom='penjualan'";
$result_belum_lunas = mysqli_query($connect, $sql_belum_lunas);
//akhir hutang

//awal tempo
$sql_nominal_jatuh_tempo = "SELECT SUM(sisa_tagihan) FROM transaksi_produk WHERE tgl_tempo< CURDATE()  and kolom='penjualan'";
$result_nominal_jatuh_tempo = mysqli_query($connect, $sql_nominal_jatuh_tempo);

$sql_tempo = "SELECT count(*) FROM transaksi_produk WHERE tgl_tempo < CURDATE() AND kolom='penjualan'";
$result_tempo = mysqli_query($connect, $sql_tempo);
//akhir tempo

//awal lunas
$sql_sum_tagihan_lunas = "SELECT SUM(debit) AS debit FROM transaksi WHERE kode_transaksi like '%Receive%' AND tgl_transaksi >= CURDATE() - INTERVAL 30 DAY";
$res_sum_tagihan_lunas = mysqli_query($connect, $sql_sum_tagihan_lunas);
while ($data_lunas = mysqli_fetch_array($res_sum_tagihan_lunas)) {
    $nominal_lunas = $data_lunas['debit'];
 } 
//akhir lunas


?>   
 
</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper">        
            <!-- Sidebar Holder -->

            <!-- Page Content Holder --> 
        <section class="content">
            
            <div id="container">

                <div class="box box-primary">
                    <div class="box-body" >
                        <div class="col-sm-4 col-md-4 col-lg-4" style="text-align:left">
                            
                                <h2>
                                    <small>Transaksi</small><br>Penjualan
                                </h2>
                                
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-2 pull-right">
                            <h2>
                                <a class="btn btn-primary" href="/faktur_v2/halaman/penjualan/new/"  <?php echo $_SESSION['write']; ?>>
                                <i class="fa fa-plus"></i>
                                Buat Transaksi Baru</a>
                                </h2>

                        </div>
                    </div>
                </div>

            <!-- <div class="container-fluid"> -->
            
                <div class="row">

                    <div class="col-xs-6 col-md-4">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                            <?php while($data_nominal_belum_lunas= mysqli_fetch_array($result_nominal_belum_lunas)){
                                ?>
                            <h3><?php echo "Rp. ".number_format($data_nominal_belum_lunas['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                            <?php } ?>
                            
                            <p>Penjualan Belum Dibayar (dalam IDR) 
                            <?php while($data_belum_lunas= mysqli_fetch_array($result_belum_lunas)){ 
                                
                                ?>

                                <span class="badge bg-white"><?php echo $data_belum_lunas['count(*)'] ?></span></p>

                            <?php } ?>
                                    
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="#" id="belum_dibayar" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-4">
                        <div class="small-box bg-red">
                            <div class="inner">
                            <?php while($data_nominal_jatuh_tempo=mysqli_fetch_array($result_nominal_jatuh_tempo)){
                                ?>
                            <h3><?php echo "Rp. ".number_format($data_nominal_jatuh_tempo['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                            <?php } ?>

                            <p>Penjualan Jatuh Tempo (dalam IDR)
                            <?php 
                                                               
                                while($data_tempo = mysqli_fetch_array($result_tempo)){ 
                                    
                                ?>

                                <span class="badge bg-white"> <?php echo $data_tempo['count(*)'] ?></span></p>

                            <?php } ?>

                            </div>
                            <div class="icon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <a href="#" class="small-box-footer" id="ke_overdue">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-4">
                        <div class="small-box bg-green">
                            <div class="inner">
                            
                            <h3><?php echo "Rp. ".number_format($nominal_lunas,2,",","."); ?></h3>
                            

                            <p>Pelunasan Diterima 30 Hari Terakhir (dalam IDR)</p>
                              
                            </div>
                            <div class="icon">
                            <i class="fa fa-check-square"></i>
                            </div>
                            <a href="#" class="small-box-footer" id="ke_pembayaran">
                            More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            <!-- </div> -->

            
                
                <!-- <div class="row content"> -->
            
                    <div class="box box-primary" > 

                        <div class="box-header with-border">
                             <a href="#" id="list_transaksi"> <h2 id="list" style="display: inline-block">List Transaksi Penjualan</h2></a>
                        </div>
                        
                        <div class="box-body">  

                            <div class="row">

                                <div class="col-md-3 col-xs-5 col-sm-5">
                                    <label class="text-primary">Tanggal Mulai</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="month" id="sort" value="<?php echo date('Y-m'); ?>" class="form-control"></div>
                                </div>

                            </div>

                            <div class="row-content" style="margin-top:55px;">
                                <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                                    
                                    <table id="Penjualan" class="display" style="width:100%">
                                        <thead class="table-header">
                                            <tr>
                                                <th><p>Tanggal</p></th>
                                                <th><p>Nomor</p></th>
                                                <th><p>Pelanggan</p></th>
                                                <th><p>Tanggal Jatuh Tempo</p></th>
                                                <th><p>Status</p></th>
                                                <th><p>Sisa Tagihan<a class="text-light-blue"> (in IDR)</a></p></th>
                                                <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $sql = "SELECT * FROM transaksi_produk where kolom='penjualan' AND MONTH(tgl_transaksi) = MONTH(NOW()) AND YEAR(tgl_transaksi) = YEAR(NOW()) ORDER BY tgl_transaksi ASC";
                                                $result1 = mysqli_query($connect, $sql);
                                                $row1 = mysqli_num_rows($result1);
                                                if ( $row1 > 0) {                                                            
                                            
                                                    while($data1 = mysqli_fetch_array($result1))
                                                    {
                                                        ?>
                                                        <tr><td><?php echo $data1['tgl_transaksi']; ?></td>
                                                            <td class="kode"><h class="text-primary"><?php echo $data1['kode']; ?></h></td>
                                                            <td><?php echo $data1['pelanggan']; ?></td>
                                                            <td><?php echo $data1['tgl_tempo']; ?></td>
                                                            <td><?php echo $data1['status']; ?></td>
                                                            <td><?php echo $data1['sisa_tagihan']; ?></td>
                                                            <td><?php echo $data1['total']; ?></td>
                                                        </tr>
                                                    <?php
                                                    } 
                                                } else { 

                                                    ?>
                                                    <tr><td align="center" colspan="9">kosong</td></tr>
                                                    <tr>
                                                        
                                                        <td align="center" colspan="9">
                                                            <a href="new/" class="btn btn-primary"><img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">Buat Penjualan Baru</a>
                                                        </td>

                                                    </tr>   <?php }?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                                
                    </div>  
                    
                 <!-- close row-content -->

            </div>  <!-- close container -->
            
        </section>
    </div>

<?php body_bottom(); ?>

</body>
</html>
<script>
$(document).ready(function() 
{    
   $('#Penjualan').DataTable();

    $(document).on('click', '#belum_dibayar',function (e)
    {
        e.preventDefault();
        var kode = "Penjualan Belum Dibayar";

        var url = '../detail/penjualan_blm_dibayar.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
        
		// $.ajax
        // ({
        //     url      : "/faktur_v2/halaman/penjualan/tabel/penjualan_blm_dibayar.php",
        //     type     : "POST",
        //     data     : {},
        //     success  : function(data)
        //     {
        //     	$("#table_faktur").html(data);
        //     	$("#table_faktur").DataTable();
        //     }
        // });
    });

    $(document).on('click', '#list_transaksi',function (e)
    {
        e.preventDefault();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/penjualan/tabel/list_penjualan.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	$("#Penjualan").html(data);
            	$("#Penjualan").DataTable();
            }
        });
       
    });

   $('.kode').click(function(){
        var kode = $(this).text();
        var url = '/faktur_v2/halaman/report/penjualan.php';
		var form = $('<form action="' + url + '" method="post">' +
		'<input type="text" name="kode" value="' + kode + '" />' +
		'</form>');
		$('body').append(form);
		form.submit();
    });

    $("#ke_pembayaran").click(function(){

        var kode = "Receive Payment";

        var url = '../detail/pembayaran.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();

    });

    $("#ke_overdue").click(function(){
        // alert();

        var kolom = "penjualan";
        var identifikasi = "Pelanggan";


        var url = '../detail/overdue.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kolom" value="' + kolom + '" />' +
            '<input type="text" name="identifikasi" value="' + identifikasi + '"/>' +
            '</form>');
            $('body').append(form);
            form.submit();

    });

    $("#sort").change(function(){
        var date = new Date($('#sort').val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;

        // alert(year+" dan "+month);

            $.ajax
                ({
                    url      : "tampung/penjualan.php",
                    type     : "POST",
                    data     : {year:year,month:month},
                    success  : function(data)
                    {
                        $('#Penjualan').html(data);
            	        $("#Penjualan").DataTable();

                        $('.kode').click(function(){
                            var kode = $(this).text();
                            var url = '/faktur_v2/halaman/report/penjualan.php';
                                    var form = $('<form action="' + url + '" method="post">' +
                                    '<input type="text" name="kode" value="' + kode + '" />' +
                                    '</form>');
                                    $('body').append(form);
                                    form.submit();
                        });
                    }
                });
    });

    

});
</script>
