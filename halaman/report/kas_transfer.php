<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $sql_pengirim = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND kredit >0";
    $sql_penerima = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND debit >0 ";
    $sql_tgl = "SELECT tgl_transaksi FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $sql_data = "SELECT * FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $sql_total = "SELECT SUM(debit) AS total FROM transaksi WHERE kode_transaksi = '$kode'";

    $res_data = mysqli_query($connect, $sql_data);
    $res_pengirim = mysqli_query($connect, $sql_pengirim);
    $res_penerima = mysqli_query($connect, $sql_penerima);
    $res_tgl = mysqli_query($connect, $sql_tgl);
    $res_total = mysqli_query($connect, $sql_total);
    
    $data_data = mysqli_fetch_array($res_data);
    
}else {
    header("Location: /faktur_v2/");
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
                            <p class="text-primary"><?php echo $kode; ?></p>
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
                    
                    <div class="container-fluid bg-info" style="height:100%;">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6" style="padding:15px">
                                        <h4 style="padding:15px">Transfer Dari</h4>
                                        <h4 style="padding:15px">Setor ke</h4>
                                        <h4 style="padding:15px">Tag</h4>
                                        <h4 style="padding:15px">Tanggal Transaksi</h4>
                                        <h4 style="padding:15px">Jumlah</h4>
                                    </div>
                                    <div class="col-md-6" style="padding:15px">
                                    <?php while($data_pengirim = mysqli_fetch_array($res_pengirim)){ ?>
                                        <h4 style="padding:15px"><?php $kata = $data_pengirim['kode_akun']; $kata2 = explode("|", $kata, 2); echo $kata2[1]; ?></h4>
                                    <?php } ?>
                                    <?php while($data_penerima = mysqli_fetch_array($res_penerima)){?>
                                        <h4 style="padding:15px"><?php $kata = $data_penerima['kode_akun']; $kata2 = explode("|", $kata, 2); echo $kata2[1]; ?></h4>
                                    <?php } ?>

                                     <h4 style="padding:15px"><?php echo $data_data['tag_2']; ?></h4>

                                    <?php while($data_tgl = mysqli_fetch_array($res_tgl)){?>
                                        <h4 style="padding:15px"><?php echo $data_tgl['tgl_transaksi']; ?></h4>
                                    <?php } ?>
                                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                                        <h4 style="padding:15px"><?php echo $data_total['total']; ?></h4>
                                    <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-5 pull-right" style="padding:15px">
                                <div class="row">
                                    <h4>No Transaksi</h4>
                                </div>
                                <div class="row">
                                    <h4><?php echo $kode2[1];?></h4>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="container-fluid" style="margin-top:55px">
                        <div class="row">
                        
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <button class="btn btn-danger" id="delete"  <?php echo $_SESSION['write']; ?>><i class="fa fa-trash"></i> Hapus</button>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 col-md-offset-3">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Cetak <i class="fa fa-print"></i>
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" id="to_pdf">PDF</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Tindakan <i class="fa fa-copy"></i>
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" id="buat_penagihan">Duplikat Transaksi</a></li>
                                        <li><a href="#" id="buat_penagihan">Atur Transaksi Berulang</a></li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="col-md-1 col-sm-2 col-xs-2 pull-right">
                                <button class="btn btn-success" id="edit"  <?php echo $_SESSION['write']; ?>> Ubah</button>
                            </div>

                            <div class="col-md-1 col-sm-2 col-xs-2 pull-right">
                                <button class="btn" id="kembali"> Kembali</button>
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

    // alert("<?php echo $kode; ?>");

    $("#to_pdf").click(function(){
        
        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "pdf/kas_transfer.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/kas_transfer.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

            form.submit();

    });

    $("#delete").click(function(){
        // swal
        swal({
                title: "Peringatan",
                text: "Data akan dihapus secara permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var kode = "<?php echo $kode; ?>";
                    

                    $.ajax({
					url:"/faktur_v2/config/delete_transaksi_akun.php",
					method:"POST",
					data:{kode:kode},
					success:function(data) 
                                {
                                    swal({
                                        title: "Succes!",
                                        text: "Data Sukses Dihapus!",
                                        type: "success"
                                    }).then(function() {
                                        window.location = "/faktur_v2/halaman/kas/";
                                    });
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
            form.setAttribute("action", "/faktur_v2/halaman/edit/transfer_uang.php");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            form.submit();
        
    });

    $("#kembali").click(function(){
        history.back();
    })

});
</script>