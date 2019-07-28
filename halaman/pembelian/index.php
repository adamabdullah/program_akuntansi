<?php

include('../../config/connect.php');  
include('../../include/include.php');
// include('../../modal/modal.php');
head(); //call func head from include php

$sql_select_pembelian = "SELECT tgl_transaksi, kode, pelanggan, tgl_tempo, sisa_tagihan, total FROM transaksi_produk WHERE kolom='pembelian' AND MONTH(tgl_transaksi) = MONTH(NOW()) AND YEAR(tgl_transaksi) = YEAR(NOW()) ORDER BY kode ASC";
$res_select_pembelian = mysqli_query($connect,$sql_select_pembelian);

$sql_sum_tagihan = "SELECT SUM(sisa_tagihan) FROM transaksi_produk WHERE kolom = 'pembelian'";
$res_sum_tagihan = mysqli_query($connect, $sql_sum_tagihan); 

$sql_sum_tagihan_tempo = "SELECT SUM(sisa_tagihan) FROM transaksi_produk WHERE kolom = 'pembelian' AND tgl_tempo < CURDATE()";
$res_sum_tagihan_tempo = mysqli_query($connect, $sql_sum_tagihan_tempo);

$sql_sum_tagihan_lunas = "SELECT SUM(debit) AS debit FROM transaksi WHERE kode_transaksi like '%Purchase%' AND tgl_transaksi >= CURDATE() - INTERVAL 30 DAY";
$res_sum_tagihan_lunas = mysqli_query($connect, $sql_sum_tagihan_lunas);
while ($data_lunas = mysqli_fetch_array($res_sum_tagihan_lunas)) {
    $nominal_lunas = $data_lunas['debit'];
 } 


?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
<div class="content-wrapper">        

    <section class="content">
            
        <div id="container">

            <div class="box box-primary">
                <div class="box-body">
                    <div class="headJ" >
                        <div class="col-sm-4 col-md-4 col-lg-4" style="text-align:left">
                            
                                <h2>
                                    <small>Transaksi</small><br>Pembelian
                                </h2>
                                
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-2 pull-right">
                            <h2>
                                <a class="btn btn-primary" href="new/"  <?php echo $_SESSION['write']; ?>>
                                <i class="fa fa-plus"></i>
                                Buat Transaksi Baru
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>   

            
            <div class="row">

                <div class="col-xs-6 col-md-4">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <?php while($data_tagihan= mysqli_fetch_array($res_sum_tagihan)){
                            ?>
                        <h3><?php echo "Rp. ".number_format($data_tagihan['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                        <?php } ?>
                        
                        <p>Pembelian Belum Dibayar (IDR) 
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

                <div class="col-xs-6 col-md-4">
                    <div class="small-box bg-red">
                        <div class="inner">
                        <?php while($data_tagihan_tempo =mysqli_fetch_array($res_sum_tagihan_tempo)){
                            ?>
                        <h3><?php echo "Rp. ".number_format($data_tagihan_tempo['SUM(sisa_tagihan)'],2,",","."); ?></h3>
                        <?php } ?>

                        <p>Pembelian Jatuh Tempo (IDR)

                            <span class="badge bg-white"></span></p>

                        </div>
                        <div class="icon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <a href="#" id="ke_overdue" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-xs-6 col-md-4">
                    <div class="small-box bg-green">
                        <div class="inner">
                        
                        <h3><?php echo "Rp. ".number_format($nominal_lunas,2,",","."); ?></h3>

                        <p>Pembayaran Diterima dalam 30 Hari (IDR)

                            <span class="badge bg-white"></span></p>

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
                            
                            <table id="Pembelian" class="table" style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                        <!-- <th align="center"><p><input type="checkbox" id="cb0"/></p></th> -->
                                        <th><p>Tanggal</p></th>
                                        <th><p>Nomor</p></th>
                                        <th><p>Supplier</p></th>
                                        <th><p>Tanggal Jatuh Tempo</p></th>
                                        <!-- <th><p>Status</p></th> -->
                                        <th><p>Sisa Tagihan<a class="text-light-blue"> (in IDR)</a></p></th>
                                        <th><p>Total<a class="text-light-blue"> (in IDR)</a></p></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $row = mysqli_num_rows($res_select_pembelian);
                                
                                if($row>0)
                                {
                                while($data_select_pembelian = mysqli_fetch_array($res_select_pembelian)){ ?>
                                    <tr>
                                        <td><?php echo $data_select_pembelian['tgl_transaksi']; ?></td>
                                        <td class="kode"><h class="text-primary"><?php echo $data_select_pembelian['kode']; ?></h></td>
                                        <td><?php echo $data_select_pembelian['pelanggan']; ?></td>
                                        <td><?php echo $data_select_pembelian['tgl_tempo']; ?></td>
                                        <!-- <td><?php echo $data_select_pembelian['']; ?></td> -->
                                        <td><?php echo "Rp. ".number_format($data_select_pembelian['sisa_tagihan'],2,",",".");?></td>
                                        <td><?php echo "Rp. ".number_format($data_select_pembelian['total'],2,",","."); ?></td>
                                    </tr>

                                <?php } 
                                }else { ?> 
                                    <tr>
                                        <td align="center" colspan="9">kosong</td>
                                    </tr>
                                    <tr>
                                        
                                        <td align="center" colspan="9">
                                            <a href="new/" class="btn btn-primary"><img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">Buat Pembelian Baru</a>
                                        </td>

                                    </tr> 
                                
                                <?php }
                                ?>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
                        
            </div>  
                    
        </div>  <!-- close row-content -->

    </div>  <!-- close container -->
            
    </section>
</div>

<?php body_bottom(); ?>

</body>
</html>
<script>
$(document).ready(function()
{
    $('#Pembelian').DataTable();
    $('.kode').click(function(){
        var kode = $(this).text();
        var url = '/faktur_v2/halaman/report/pembelian.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();
    });

    $("#penagihan_baru").click(function(){
        var buat = "pembelian";
        
        var url = 'new/';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="jenis" value="' + buat + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
    });

    $("#ke_pembayaran").click(function(){

        var kode = "Purchase Payment";
        var transaksi = "Kas";
        
        var url = '../detail/pembayaran.php';
            var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="kode" value="' + kode + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();

    });

    $("#ke_overdue").click(function(){
        // alert();

        var kolom = "pembelian";
        var identifikasi = "Supplier";


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
                    url      : "tampung/pembelian.php",
                    type     : "POST",
                    data     : {year:year,month:month},
                    success  : function(data)
                    {
                        $('#Pembelian').html(data);
            	        $("#Pembelian").DataTable();

                        $('.kode').click(function(){
                            var kode = $(this).text();
                            var url = '/faktur_v2/halaman/report/pembelian.php';
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