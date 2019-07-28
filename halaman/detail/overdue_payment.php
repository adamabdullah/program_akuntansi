<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

if(empty($_POST['kode'])){
    header('Location: /faktur_v2/'); 
}else{ 
  echo $transaksi = $_POST['kode'];
  echo $akun = $_POST['transaksi'];
// $akun="Kas";
// $transaksi="purchase";
    $total = 0 ;
}

$sql_select = "SELECT
                tgl_transaksi AS tgl, 
                kode_transaksi AS kode, 
                debit, 
                kredit 
                FROM transaksi 
                WHERE kode_akun LIKE '%$akun%' AND kode_transaksi LIKE '%$transaksi%'";
$res_select = mysqli_query($connect, $sql_select);


head(); //call func head from include php
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

    <div class="content-wrapper">
        <section class="content">
            <div class="box">
                
                <div class="box-header row">
                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:left">
                            <h2><p class="text-primary" id="context-span"><?php echo $transaksi ?></p></h2>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 pull-right" style="text-align:left">
                        
                            <h2><Button class="btn btn-sm btn-primary"><i class="fa fa-plus">Buat Transaksi</i></Button>
                            </h2>
                    </div>
                </div>
                <div class="box-body row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Payment</a></li>
                            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                        </ul>

                        <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <table class="table table-responsive" style="margin-top:25px">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Tanggal</th> 
                                        <!-- <th>Kontak</th>	 -->
                                        <th>Deskripsi</th>	
                                        <th>Terima (dalam IDR)</th>	
                                        <th>Kirim (dalam IDR)</th>	
                                        <th>Saldo (dalam IDR)</th>	
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($data_select = mysqli_fetch_array($res_select)){ 
                                    $total = $total + $data_select['debit'] - $data_select['kredit'];
                                    if($total<0){
                                        $tot1 = number_format(abs($total) ,2,",",".");
                                        $tot2 = "(".$tot1.")"; 
                                    }else {
                                        $tot2 = number_format(abs($total) ,2,",",".");
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $data_select['tgl']; ?></td>
                                        <!-- <td><?php echo $data_select['kontak']; ?></td> -->
                                        <td class="kode"><p class="text-primary"><?php echo $data_select['kode']; ?></td>
                                        <td><?php echo number_format($data_select['debit'],2,",","."); ?></td>
                                        <td><?php echo number_format($data_select['kredit'],2,",","."); ?></td>
                                        <td><?php echo $tot2 ?></td>
                                        <td><?php ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <h3>Menu 3</h3>
                            <p>Some content in menu 3.</p>
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
    
    $('.kode').click(function(){
        var kode = $(this).text();
        var jenis= kode.substr(0, kode.indexOf('#')); 
        // alert(jenis);

        if(jenis=="Bank Deposit "){
            var url = '/faktur_v2/halaman/report/kas_terima.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Bank Withdrawal "){
            var url = '/faktur_v2/halaman/report/kas_kirim.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Bank Transfer "){
            var url = '/faktur_v2/halaman/report/kas_transfer.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Expenses "){
            var url = '/faktur_v2/halaman/report/biaya.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Sales Invoice "){
            var url = '/faktur_v2/halaman/report/penjualan.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Purchase Invoice "){
            var url = '/faktur_v2/halaman/report/pembelian.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Jurnal Entry "){
            var url = '/faktur_v2/halaman/report/jurnal_entry.php';
				var form = $('<form action="' + url + '" method="post">' +
				'<input type="text" name="kode" value="' + kode + '" />' +
				'</form>');
				$('body').append(form);
				form.submit();

        }else if(jenis=="Receive Payment "){
            var url = '/faktur_v2/halaman/report/receive_payment.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="kode" value="' + kode + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();

        }else if(jenis=="Purchase Payment "){
            var url = '/faktur_v2/halaman/report/purchase_payment.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="kode" value="' + kode + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();

        }

        

         
    });

});
</script>