<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');

include('../../include/include.php');
 
if(!empty($_POST)){
    $kode = $_POST['kode'];
    // $sql_penerima = "SELECT kode_akun,debit FROM transaksi WHERE kode_transaksi = '$kode' AND debit > 0 AND kolom != 'terima_uang_pajak'";

     $sql_penerima = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND debit > 0 ";

    $sql_person = "SELECT * FROM transaksi_akun WHERE kode_transaksi = '$kode'";

    $sql_pengirim = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND debit = 0 AND kolom != 'terima_uang_pajak'";

    $sql_pajak = "SELECT harga_pajak FROM transaksi WHERE kode_transaksi = '$kode' AND harga_pajak != 0  and kolom='terima_uang_pajak'";

    $sql_total = "SELECT  SUM(kredit)-SUM(harga_pajak) AS subtotal, SUM(debit) as total FROM transaksi WHERE kode_transaksi = '$kode'";
    

    $res_penerima = mysqli_query($connect, $sql_penerima);
    $res_person = mysqli_query($connect, $sql_person);
    $res_pengirim = mysqli_query($connect, $sql_pengirim);
    $res_pajak = mysqli_query($connect, $sql_pajak);
    $res_total = mysqli_query($connect,$sql_total);

    

}else {

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
                    <?php while($data_terima = mysqli_fetch_array($res_penerima)){ ?>
                    <div class="container-fluid bg-info" style="height:100px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *Penerima </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary bayar_dari"><?php echo $data_terima['kode_akun'];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-4 pull-right">
                            <h3>
                                <strong>Total</strong> <p class="text-primary pull-right"><?php echo $data_terima['debit'];?></p>
                            </h3>
                           
                        </div>
                    </div> 
                    <?php } ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php while($data_person= mysqli_fetch_array($res_person)){ ?>
                        <div class="col-md-3 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Pembayar</strong>
                                <p class="text-primary pull-right kontak"><?php echo $data_person['kontak']; ?></p>
                            </h5>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Tanggal Transaksi</strong>
                                <p class="pull-right tgl_transaksi"><?php echo $data_person['tgl_transaksi']; ?></p>
                            </h4>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $data_person['kode_transaksi']; ?></p>
                            </h4>
                        </div>
                         <!-- <div class="col-md-3 col-sm-7 col-xs-7">
                            <h4>
                                <strong>*Tag</strong>
                                <p class="pull-right"><?php echo $data_person['tag_2'];  ?></p>
                            </h4>
                        </div> -->
                    <?php } ?>
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Akun
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3">
                                        Pajak
                                    </th>
                                    <th class="col-md-3 col-sm-3 col-xs-3" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_pengirim = mysqli_fetch_array($res_pengirim)){ ?>
                                <tr>
                                     <td class="harga_pajak" hidden><?php echo $data_pengirim['harga_pajak']; ?></td>
                                    <div class="nama_pajak_ori" hidden><?php echo $data_pengirim['nama_pajak_ori'] ?></div>
                                    <td class="kode_akun"> <?php echo $data_pengirim['kode_akun']; ?></td>
                                    <td class="deskripsi"><?php echo $data_pengirim['deskripsi']; ?></td>
                                    <td><?php echo $data_pengirim['harga_pajak']; ?></td>
                                    <td style="text-align:right" class="harga_akun"><?php echo $data_pengirim['kredit']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <h4>
                                <strong>SubTotal</strong>
                                <p class="text-primary pull-right sub_total"><?php echo $data_total['subtotal'];?></p>
                                </h4>
                            </div>
                        </div>
                        <?php while($data_pajak = mysqli_fetch_array($res_pajak)){?>
                        <div class="row">
                            <!-- <div class="col-md-4 pull-right">
                                <h4>
                                <strong>Nama Pajak</strong>
                                <p class="text-primary pull-right"><?php echo $data_pajak['nama_pajak'];?></p>
                                </h4>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right"><?php echo $data_pajak['harga_pajak'];?></p>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <h3>
                                <strong>Total</strong>
                                <p class="text-primary pull-right total"><?php echo $data_total['total'];?></p>
                                </h3>
                            </div>
                        </div>
                    <?php } ?>
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
                                <button class="btn btn-success"  id="edit"  <?php echo $_SESSION['write']; ?>> Ubah</button>
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
            form.setAttribute("action", "pdf/kas_terima.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/kas_terima.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

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

    $("#kembali").click(function(){
        history.back();
    });

    $("#edit").click(function()
    {
        var kode = "<?php echo $kode; ?>";
        var bayar_dari = $(".bayar_dari").text();
        var tgl_transaksi = $(".tgl_transaksi").text();
        // var tgl_tempo = $("#tgl_tempo").text();
        var nama = $(".kontak").text();
        var total_keseluruhan = $("#total").text();

        var kode_akun = [];
        var nama_pajak_ori = [];
        var harga_pajak = [];
        var jumlah_akun = [];
        var khusus_pajak = [];
        var deskripsi = [];

        $(".kode_akun").each(function()
        {
            var a = $(this).text();
            kode_akun.push(a);
        });

        $(".nama_pajak_ori").each(function()
        {
            var a = $(this).text();
            nama_pajak_ori.push(a);
        });

        $(".harga_pajak").each(function()
        {
            var a = $(this).text();
            harga_pajak.push(a);
        });

        $(".harga_akun").each(function()
        {
            var a = $(this).text();
            jumlah_akun.push(a);
        });

        $(".deskripsi").each(function()
        {
            var a = $(this).text();
            deskripsi.push(a);
        });

        var url = '/faktur_v2/halaman/edit/terima_uang.php';
        var form = $('<form action="' + url + '" method="post">' +
        // '<input type="text" name="khusus_pajak" value="' + khusus_pajak + '" />' +
        '<input type="text" name="bayar_dari" value="' + bayar_dari + '" />' +
        '<input type="text" name="kode" value="' + kode + '" />' +
        '<input type="text" name="tgl_transaksi" value="' + tgl_transaksi + '" />' +
        '<input type="text" name="nama" value="' + nama + '" />' +
        '<input type="text" name="terima_dari" value="' + kode_akun + '" />' +
        '<input type="text" name="nama_pajak_ori" value="' + nama_pajak_ori + '" />' +
        '<input type="text" name="harga_pajak" value="' + harga_pajak + '" />' +
        '<input type="text" name="jumlah_akun" value="' + jumlah_akun + '" />' +
        '<input type="text" name="deskripsi" value="' + deskripsi + '" />' +
         '</form>');
        $('body').append(form);
        form.submit();
    });

});
</script>