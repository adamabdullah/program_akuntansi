<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

if(!empty($_POST)){ 
    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $sql_select_transaksi_akun = "SELECT * FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $sql_total = "SELECT  SUM(kredit)-SUM(harga_pajak) AS subtotal, SUM(debit) as total FROM transaksi WHERE kode_transaksi = '$kode'";
    
    
    $res_total = mysqli_query($connect,$sql_total);
    $data_total = mysqli_fetch_array($res_total);

    $res_select_transaksi_akun = mysqli_query($connect, $sql_select_transaksi_akun);
    $data_select_transaksi_akun = mysqli_fetch_array($res_select_transaksi_akun);

}else {
    header('Location: /faktur_v2/');
    exit; 
}

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
                            <p class="text-primary"><?php echo $kode2[0] ?></p>
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
                                *Pelanggan</strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary"><?php echo $data_select_transaksi_akun['kontak']; ?></p>
                            </h4>   
                        </div>
                         
                        <div class="col-md-3 col-sm-4 col-xs-4 pull-right">
                            <h3>
                                <strong>Total</strong> <p class="text-primary pull-right">  <?php echo $data_total['total']; ?></p>
                            </h3>
                        </div>
                    </div>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                        <div class="col-md-5 col-sm-7 col-xs-7">
                            <h5>
                                <strong>*Cara Pembayaran</strong>
                                <p class="text-primary pull-right"><?php echo $data_select_transaksi_akun['cara_pembayaran']; ?></p>
                            </h5>
                            <h5>
                                <strong>*Tanggal Transaksi</strong>
                                <p class="pull-right"><?php echo $data_select_transaksi_akun['tgl_transaksi']; ?></p>
                            </h5>
                        </div>

                        <div class="col-md-4 col-sm-5 col-xs-5 pull-right">
                            <h5>
                                <strong>*Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $kode2[1]; ?></p>
                            </h5>
                        </div>
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-6 col-sm-6 col-xs-6">
                                        Kode Penjualan
                                    </th>

                                    <th class="col-md-6 col-sm-6 col-xs-6" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $data_select_transaksi_akun['tag']; ?></td>                                    
                                    <!-- <td>Pajak</td> -->
                                    <td style="text-align:right"><?php echo $data_total['total']; ?></td>
                                </tr>
                            
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <h3>
                                <strong>Total</strong>
                                <p class="text-primary pull-right">  <?php echo $data_total['total']; ?></p>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" style="margin-top:55px">
                        <div class="row">
                        
                            <div class="col-md-1">
                                <button class="btn btn-danger" id="delete"  <?php echo $_SESSION['write']; ?>><i class="fa fa-trash"></i> Hapus</button>
                            </div>
                            <div class="col-md-1 col-md-offset-3">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       Cetak <i class="fa fa-print"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" id="receive_paymentPDF">PDF</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-1 pull-right">
                                <button class="btn btn-success" id="edit"> Ubah</button>
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

    $("#delete").click(function(){
        // swal
        swal({
                title: "Peringatan",
                text: "Data akan dihapus secara permanen, dan pembayaran ini akan dibatalkan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var kode = "<?php echo $kode; ?>";
                    var uang = "<?php echo $data_total['total']; ?>";
                    var tag = "<?php echo $data_select_transaksi_akun['tag']; ?>";
                    

                    $.ajax({
					url:"/faktur_v2/config/delete_Payment.php",
					method:"POST",
					data:{kode:kode, uang:uang, tag:tag},
					success:function(data) 
                                {
                                    if(data=="Success"){
                                        swal({
                                            title: "Succes!",
                                            text: "Penerimaan Berhasil!",
                                            type: "success"
                                        }).then(function() {
                                            window.location = "/faktur_v2/halaman/penjualan/";
                                        });
                                        }else{
                                            alert("error");
                                        }
                                }
				    });

                   
                } else {
                    swal("Batal Menghapus");
                }
                });

        //endswall
    });

	 $("#edit").click(function(){

        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "/faktur_v2/halaman/edit/receive_payment.php");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            form.submit();
        
    });

    $("#receive_paymentPDF").click(function(){
        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "pdf/receive_payment.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/receive_payment.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

            form.submit();
    });

});
</script>