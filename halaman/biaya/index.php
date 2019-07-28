<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

head(); //call func head from include php

$sql_select_biaya = "SELECT transaksi_akun.tgl_transaksi AS tgl_transaksi, transaksi_akun.kontak AS kontak, transaksi_akun.kode_transaksi AS kode_transaksi, SUM(transaksi.debit) AS total FROM transaksi_akun INNER JOIN transaksi ON transaksi_akun.kode_transaksi = transaksi.kode_transaksi WHERE transaksi_akun.kolom ='biaya' AND MONTH(transaksi.tgl_transaksi) = MONTH(NOW()) AND YEAR(transaksi.tgl_transaksi) = YEAR(NOW()) GROUP BY kode_transaksi";
$res_select_biaya = mysqli_query($connect, $sql_select_biaya);

$sql_biaya_bulan_ini = "SELECT 
                            SUM(transaksi.debit) AS total FROM transaksi_akun 
                            INNER JOIN transaksi ON 
                            transaksi_akun.kode_transaksi = transaksi.kode_transaksi 
                            WHERE transaksi_akun.kolom ='biaya' 
                            AND YEAR(transaksi_akun.tgl_transaksi) = YEAR(NOW()) 
                            AND MONTH(transaksi_akun.tgl_transaksi) = MONTH(NOW());";
$res_biaya_bulan_ini = mysqli_query($connect, $sql_biaya_bulan_ini);

$sql_biaya_last_30d = "SELECT 
                            SUM(transaksi.debit) AS total FROM transaksi_akun 
                            INNER JOIN transaksi ON 
                            transaksi_akun.kode_transaksi = transaksi.kode_transaksi 
                            WHERE transaksi_akun.kolom ='biaya'  AND
                            transaksi_akun.tgl_transaksi between SUBDATE(CURDATE(), 30) and SUBDATE(CURDATE(), 0)";
$res_biaya_last_30d = mysqli_query($connect, $sql_biaya_last_30d);


?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper">        

        <section class="content">

            <div class="box box-primary">
                <div class="box-body row">
                    <div class="col-sm-4 col-md-4 col-lg-4" style="text-align:left">
                
                            <h2>
                                <small>Biaya</small><br><p class="text-primary">Pengeluaran</p>
                            </h2>
                            
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 pull-right">
                        <h2>
                        <a class="btn btn-primary" href="/faktur_v2/halaman/biaya/new/"  <?php echo $_SESSION['write']; ?>><i class="fa fa-plus"></i> Buat Biaya Baru</a>
                        </h2>
                    </div>
                </div>
            </div>

        <!-- <div class="box box-primary"> -->
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <?php while($data_biaya_bln_ini = mysqli_fetch_array($res_biaya_bulan_ini)){ ?>
                        <h3><?php echo "Rp. ".number_format($data_biaya_bln_ini['total'],2,",","."); ?></h3>
                        <?php } ?>
                        <p>Biaya Bulan Ini (IDR) 

                            <span class="badge bg-white"></span></p>
                                
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                        <?php while($data_biaya_last_30d = mysqli_fetch_array($res_biaya_last_30d)){ ?>                        
                        <h3><?php echo "Rp. ".number_format($data_biaya_last_30d['total'],2,",","."); ?></h3>

                        <p>Biaya 30 Hari Terakhir (IDR)

                            <span class="badge bg-white"></span></p>
                        <?php } ?>
                        </div>
                        <div class="icon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        <!-- </div> -->

            
                
            
            <div class="box box-primary" > 

                <div class="box-header with-border">
                    <strong class="box-title">List Transaksi Pembelian</strong>
                </div>

                <div class="box-body">  

                    <div class="row">

                        <div class="col-md-3 col-xs-5 col-sm-5">
                            <label class="text-primary">Sortir</label>
                            <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="month" id="sort" value="<?php echo date('Y-m'); ?>" class="form-control"></div>
                        </div>

                    </div>

                    <div class="row-content" style="margin-top:55px;">
                        <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                            
                            <table id="Biaya" class="display" style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                        <!-- <th align="center"><p><input type="checkbox" id="cb0"/></p></th> -->
                                        <th><p>Tanggal</p></th>
                                        <th><p>Kode</p></th>
                                        <th><p>Penerima</p></th>
                                        <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php while($data_select_biaya = mysqli_fetch_array($res_select_biaya)){ ?>

                                        <tr>
                                        <td><?php echo $data_select_biaya['tgl_transaksi']; ?></td>
                                        <td class="kode" value="<?php echo $data_select_biaya['kode_transaksi']; ?>"><h class="text-primary"><?php echo $data_select_biaya['kode_transaksi']; ?></h></td>
                                        <td><?php echo $data_select_biaya['kontak']; ?></td>
                                        <td><?php echo $data_select_biaya['total']; ?></td>
                                        </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        </div>

                    </div>    
                </div>    
            </div>

    </section>
</div>

<?php body_bottom(); ?>

</body>
</html>
<script src="/faktur_v2/dist/js/halaman/index_penjualan.js"></script>
<script>
$(document).ready(function() 
{
    $('.kode').click(function(){
        var kode = $(this).text();
        var url = '/faktur_v2/halaman/report/biaya.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();
    });
    $('#Biaya').DataTable();
    // $('#biaya_baru').click(function(){
    //     location.href="/faktur_v3/halaman/biaya/new/";
    // })
    $(".uang").mask('#.##0,00', {reverse: true});

    $("#sort").change(function(){
        var date = new Date($('#sort').val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;

        // alert(year+" dan "+month);

            $.ajax
                ({
                    url      : "tampung/biaya.php",
                    type     : "POST",
                    data     : {year:year,month:month},
                    success  : function(data)
                    {
                        $('#Biaya').html(data);
            	        $("#Biaya").DataTable();

                        $('.kode').click(function(){
                            var kode = $(this).text();
                            var url = '/faktur_v2/halaman/report/biaya.php';
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