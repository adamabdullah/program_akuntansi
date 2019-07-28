<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

head(); //call func head from include php

$sql_select_jurnal = "SELECT transaksi_akun.kode_transaksi AS kode, transaksi_akun.tgl_transaksi AS tgl, sum(transaksi.debit) AS total FROM transaksi_akun INNER JOIN transaksi ON transaksi_akun.kode_transaksi = transaksi.kode_transaksi WHERE transaksi.kode_transaksi LIKE '%Jurnal%' AND MONTH(transaksi.tgl_transaksi) = MONTH(NOW()) AND YEAR(transaksi.tgl_transaksi) = YEAR(NOW()) GROUP BY transaksi.kode_transaksi";
$res_select_jurnal = mysqli_query($connect, $sql_select_jurnal);

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
                                <small>Transaksi</small><br><p class="text-primary">Jurnal</p>
                            </h2>
                            
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 pull-right">
                        <h2>
                        <a class="btn btn-primary" href="/faktur_v2/halaman/akun/new/"  <?php echo $_SESSION['write']; ?>><i class="fa fa-plus"></i> Buat Jurnal Baru</a>
                        </h2>
                    </div>
                </div>
            </div>
                
            
            <div class="box box-primary" style=" border-radius: 0px 0px 9px 9px;"> <!-- tag box -->
                <div class="box-header with-border">
                    <strong class="box-title">Daftar Transaksi</strong>
                </div>
                
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-3 col-xs-5 col-sm-5">
                            <label class="text-primary">Tanggal Mulai</label>
                            <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="month" id="sort" value="<?php echo date('Y-m'); ?>" class="form-control"></div>
                        </div>

                    </div>

                    <div class="row-content" style="margin-top:55px;">
                        <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                            <table id="Jurnal" class="table table-hover table-responsive">
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
                                <?php while($data_select_jurnal = mysqli_fetch_array($res_select_jurnal)){ ?>

                                        <tr>
                                        <td><?php echo $data_select_jurnal['tgl']; ?></td>
                                        <td class="kode" value="<?php echo $data_select_jurnal['kode']; ?>"><p class="text-primary"><?php echo $data_select_jurnal['kode']; ?></p></td>
                                        <td> - </td>
                                        <td><?php echo number_format($data_select_jurnal['total'] ,2,',','.'); ?></td>
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
        var url = '/faktur_v2/halaman/report/jurnal_entry.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();
    });

    $('#Jurnal').DataTable();

    $("#sort").change(function(){
        var date = new Date($('#sort').val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;

        // alert(year+" dan "+month);

            $.ajax
                ({
                    url      : "tampung/jurnal.php",
                    type     : "POST",
                    data     : {year:year,month:month},
                    success  : function(data)
                    {
                        $('#Jurnal').html(data);
            	        $("#Jurnal").DataTable();

                        $('.kode').click(function(){
                            var kode = $(this).text();
                            var url = '/faktur_v2/halaman/report/jurnal_entry.php';
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