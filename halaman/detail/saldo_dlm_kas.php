<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

// if(empty($_POST['kolom'])){
//     header('Location: /faktur_v2/'); 
// }else{ 
// //   $kolom = $_POST['kolom'];
// //   $identifikasi = $_POST['identifikasi'];

//     $total = 0 ;
// }

 $sql_select_pembelian = "SELECT * FROM akun WHERE kategori_akun = 'Kas & Bank'";
$res_select_pembelian = mysqli_query($connect,$sql_select_pembelian);


head(); //call func head from include php
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

    <div class="content-wrapper">
        <section class="content">
            <div class="box">
                 <h2>Saldo Dalam Kas</h2>
                <div class="box-header row">
                
                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:left">
                            <!-- <h2><p class="text-primary" id="context-span"><?php echo $transaksi ?></p></h2> -->
                    </div>

                </div>
                <div class="box-body row">
                    <div class="col-md-12">
                        <!-- <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Saldo Dalam Kas</a></li> -->
                            <!-- <li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
                            <!-- <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
                        <!-- </ul> -->

                        <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <table id="tabel" class="table table-responsive" style="margin-top:25px">
                                <thead class="bg-primary">
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Kategori Akun</th>
                                    <th><p>Saldo di Bank<a class="text-light-blue"> (in IDR)</a></p></th>
                                </tr>
                                    
                                </thead>

                                <tbody>
                                    <?php while($data_select_pembelian = mysqli_fetch_array($res_select_pembelian)){ 
                                        $sql1 = "SELECT sum(debit)-sum(kredit) AS saldo, kode_akun FROM transaksi WHERE kode_akun LIKE '%".$data_select_pembelian['nama_akun']."%'";
                                        $res1 = mysqli_query($connect, $sql1);
                                        while($data_saldo = mysqli_fetch_array($res1))
                                        {
                                            if($data_saldo['saldo'] != 0)
                                            {
                                        ?>
                                        <tr>
                                            <td class='tampung_nomor'><?php echo $data_select_pembelian['kode_akun']; ?></td>
                                            <td class='kode'><p><?php echo $data_select_pembelian['nama_akun']; ?></p></td>
                                            <td><?php echo $data_select_pembelian['kategori_akun']; ?></td>
                                            <td><?php echo number_format($data_saldo['saldo'],2,",","."); ?></td> 
                                    <?php }}} ?>
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

    $("#tabel").DataTable();
    
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