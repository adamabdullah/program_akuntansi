<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');
if(!empty($_POST)){
    $kode = $_POST['kode'];
}else{
    header("Location: /faktur_v2/");
}


$kode2 = explode('#', $kode, 2);
$loop = 0 ;
$loop1 = 0;

$select = "SELECT transaksi.kode_akun as akun, transaksi.debit as debit, transaksi.kredit as kredit, transaksi_akun.tgl_transaksi as tgl from transaksi INNER JOIN transaksi_akun on transaksi.kode_transaksi = transaksi_akun.kode_transaksi where transaksi.kode_transaksi='$kode'";
$res = mysqli_query($connect, $select);

$selectsum = "SELECT sum(debit) AS debit, sum(kredit) AS kredit FROM transaksi WHERE kode_transaksi ='$kode'";
$ressum = mysqli_query($connect, $selectsum);

while($data1 = mysqli_fetch_array($res)){
    $akun[$loop] = $data1['akun'];
    $debit[$loop] = $data1['debit'];
    $kredit[$loop] = $data1['kredit'];

    $tgl = $data1['tgl'];
    $loop++;
}

while($data2 = mysqli_fetch_array($ressum)){
    $resultDebit[$loop1] = $data2['debit'];
    $resultKredit[$loop1] = $data2['kredit'];
    $loop1++;
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
                            <p id="kode" class="text-primary"><?php echo $kode; ?></p>
                        </h2>
                        <!-- </div> -->
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 text-right">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 text-right">
                    <?php ?>
                        <h2 style="margin-top:0.75em">
                            <?php ?>
                        </h2>
                    <?php  ?>
                    </div>
                </div>

                <div class="box-body" style="border-top:2px gray solid;">

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <strong id="tgl">Tgl Transaksi : </strong>
                            </h4>
                            <h4>
                                <p><?php echo $tgl; ?></p>
                            </h4>
                        </div>
                        
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <strong>No Transaksi : </strong>
                            </h4>
                            <h4>
                                <p><?php echo $kode2[1] ?></p>
                            </h4>
                        </div>
                    </div>

                    <div class="container-fluid" style="margin-top:100px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="col-md-3 col-xs-3 col-sm-3">
                                        Kode Akun
                                    </th>
                                    <th class="col-md-3 col-xs-3 col-sm-3">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Debit (IDR)
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Kredit (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i = 0; $i<$loop;$i++){?>
                                <tr>
                                    <td class="namaAkun"><?php echo $akun[$i]; ?></td>
                                    <td></td>
                                    <td class="jumlahDebit" style="text-align:right"><?php echo number_format($debit[$i],2,',','.'); ?></td>
                                    <td class="jumlahKredit" style="text-align:right"><?php echo number_format($kredit[$i],2,',','.'); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong> Total Debit </strong></h4>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong> Total Kredit</strong></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong id="debit"><?php echo number_format($resultDebit[0],2,',','.'); ?></strong></h4>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-6">
                                        <h4><strong id="kredit"><?php echo number_format($resultKredit[0],2,',','.'); ?></strong></h4>
                                    </div>

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
                                <button id="edit" class="btn btn-success"  <?php echo $_SESSION['write']; ?>> Ubah</button>
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
            form.setAttribute("action", "pdf/jurnal_entry.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/jurnal_entry.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

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
                                        window.location = "/faktur_v2/halaman/jurnal/";
                                    });
                                }
				    });

                   
                } else {
                    swal("Batal Menghapus");
                }
                });

        //endswall
    });

    $("#kembali").click(function(){
        history.back();
    });

    $("#edit").click(function(){
        var kode = $("#kode").text();
        var tgl = "<?php echo $tgl ?>";
        var debit = $("#debit").text();
        var kredit = $("#kredit").text();
        // alert(kode);
        
        var url = "/faktur_v2/halaman/jurnal/edit.php";
        var form = $('<form action="' + url + '" method="post">' +
        '<input type="text" name="kode" value="' + kode + '" />' +
        '<input type="text" name="tgl" value="' + tgl + '" />' +
        '<input type="text" name="debit" value="' + debit + '" />' +
        '<input type="text" name="kredit" value="' + kredit + '" />' +
         '</form>');
        $('body').append(form);
        form.submit();

    });

});
</script>