<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 
 
include('../../config/connect.php');

include('../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];
    $kode2 = explode('#', $kode, 2);

    $loop = 0;
    $loop2 = 0;

    $sisa_tagihan = "SELECT CASE WHEN sisa_tagihan > 0 THEN 'Belum Lunas' WHEN sisa_tagihan = 0 THEN 'Lunas' END AS kategori FROM transaksi_produk WHERE kode = '$kode'";
    $res_tagihan = mysqli_query($connect, $sisa_tagihan);

    $sql_kontak = "SELECT 
	transaksi_akun.kontak as kontak, 
	kontak.email as email, 
	kontak.alamat_penagihan as alamat 
	FROM transaksi_akun  
	INNER JOIN kontak on 
	transaksi_akun.kontak = 
	kontak.nama WHERE transaksi_akun.kode_transaksi = '$kode'"; 
    $res_kontak = mysqli_query($connect, $sql_kontak);

        while($data_kontak = mysqli_fetch_array($res_kontak)){
            // $nama[0] = $data_kontak['kontak'];
            $kontak[$loop] = $data_kontak['kontak'];
            $email[$loop] = $data_kontak['email'];
            $alamat[$loop] = $data_kontak['alamat'];
        }

    $sql_transaksi = "SELECT tgl_transaksi AS awal, tgl_tempo AS akhir, cara_pembayaran FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $res_transaksi = mysqli_query($connect, $sql_transaksi);

        while($data_transaksi = mysqli_fetch_array($res_transaksi)){

            $awal[$loop2] = $data_transaksi['awal'];
            $akhir[$loop2] = $data_transaksi['akhir'];
            $caraPembayaran[$loop2] = $data_transaksi['cara_pembayaran'];
            $loop2++;
        }

    $sql_transaksi_dari ="SELECT * FROM transaksi WHERE kredit > 0 AND kode_transaksi = '$kode' AND kolom != 'biaya_pajak'";
    $res_transaksi_dari = mysqli_query($connect, $sql_transaksi_dari);
    $data_transaksi_kredit = mysqli_fetch_array($res_transaksi_dari);
    
    

    $sql_akun_biaya ="SELECT * FROM transaksi WHERE kredit = 0 AND kode_transaksi = '$kode' AND kolom != 'biaya_pajak'";
    $res_akun_biaya = mysqli_query($connect, $sql_akun_biaya);

    $sql_produk = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND qty_produk >''";
    $res_produk = mysqli_query($connect, $sql_produk);
    
    $sql_total = "SELECT sum(debit)-sum(harga_pajak) AS sub, sum(harga_pajak) AS pajak, sum(debit) AS total from transaksi WHERE kode_transaksi ='$kode' ";
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
                    <div class="col-xs-6 col-sm-3 col-md-3 text-right">
                    <?php ?>
                        <h2 style="margin-top:0.75em">
                            <?php ?>
                        </h2>
                    <?php  ?>
                    </div>
                </div>

                <div class="box-body" style="border-top:2px gray solid;">

                    <?php  ?>

                    <div class="container-fluid bg-info" style="height:100px;">
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *Penerima </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary" id="nama"><?php echo $kontak[0];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4><strong>
                                *E-mail </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-3">
                            <h4>
                                <p class="text-primary" id="email"><?php echo $email[0];?></p>
                            
                            </h4>   
                        </div>
                        
                        
                    </div> 

                    <?php  ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php ?>
                        <div class="col-md-3 col-sm-7 col-xs-7">
                            <h4>
                                <strong>Alamat</strong>
                                <p class="text-primary pull-right" id="alamat"><?php echo $alamat[0];  ?></p>
                            </h4>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7" style="margin-left:15px;">
                            <div class="row">
                                <h4>
                                    <strong>Tanggal Transaksi</strong>
                                    <p class="pull-right" id="tgl_transaksi"><?php echo $awal[0]; ?></p>
                                </h4>
                            </div>
                            <div class="row">
                                <h4>
                                    <strong>Tanggal Jatuh Tempo</strong>
                                    <p class="pull-right" id="tgl_tempo"><?php echo $akhir[0]; ?></p>
                                </h4>
                            
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-7" style="margin-left:15px;">
                            <h4>
                                <strong>Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $kode2[1] ?></p>
                            </h4>
                            <div id="cara_pembayaran" hidden><?php echo $caraPembayaran[0] ?>
                            </div>
                        </div>
                    <?php  ?>
                    </div>

                    <div class="container-fluid" style="margin-top:100px">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="bg-primary">

                                    <th class="col-md-2 col-xs-2 col-sm-2">
                                        Produk
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2">
                                        Deskripsi
                                    </th>
                                    <th class="col-md-1 col-xs-1 col-sm-1">
                                        Harga Pajak
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_akun_biaya = mysqli_fetch_array($res_akun_biaya)){ ?>
                                <tr>
                                    <div class="nama_pajak_ori" hidden><?php echo $data_akun_biaya['nama_pajak_ori'] ?></div>
                                    <div class="kode_akun" hidden><?php echo $data_akun_biaya['kode_akun']; ?></div>
                                    <td><?php $nama = explode('|', $data_akun_biaya['kode_akun'], 2); echo $nama[1]; ?></td>
                                    <td><?php  ?></td>
                                    <td class="harga_pajak"><?php echo number_format($data_akun_biaya['harga_pajak'] ,2,'.',',');  ?></td>
                                    <td class="harga_akun" style="text-align:right"><?php echo number_format($data_akun_biaya['debit'],2,'.',',');  ?></td>
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
                                <p class="text-primary pull-right" id="sub_total"><?php echo number_format($data_total['sub'],2,'.',','); ?></p>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right" id="total_pajak"><?php echo number_format($data_total['pajak'],2,'.',','); ?></p>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <h3>
                                <strong>Sisa Tagihan</strong>
                                <p class="text-primary pull-right" id="total_keseluruhan"><?php echo number_format($data_total['total'],2,'.',','); ?></p>
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
            form.setAttribute("action", "pdf/biaya.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/biaya.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

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
                                        window.location = "/faktur_v2/halaman/biaya/";
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

        var kode = "<?php echo $kode; ?>";
        var bayar_dari = "<?php echo $data_transaksi_kredit['kode_akun']; ?>";
        var tgl_transaksi = $("#tgl_transaksi").text();
        var tgl_tempo = $("#tgl_tempo").text();

        var nama = $("#nama").text();
        var email = $("#email").text();
        var alamat = $("#alamat").text();

        var cara_pembayaran = $("#cara_pembayaran").text();
        var sub_total = $("#sub_total").text();
        var total_pajak = $("#total_pajak").text();
        var total_keseluruhan = $("#total_keseluruhan").text();

        var kode_akun = [];
        var nama_pajak_ori = [];
        var harga_pajak = [];
        var jumlah_akun = [];
        var khusus_pajak = [];

        

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
            var b = a.split(",").join("");
            jumlah_akun.push(b);
        });
        // alert(bayar_dari);
    

        // $(".khusus_pajak").each(function()
        // {
        //     var a = $(this).text();
        //     khusus_pajak.push(a);
        // });

        var url = '/faktur_v2/halaman/biaya/update/';
        var form = $('<form action="' + url + '" method="post">' +
        // '<input type="text" name="khusus_pajak" value="' + khusus_pajak + '" />' +
        '<input type="text" name="bayar_dari" value="' + bayar_dari + '" />' +
        '<input type="text" name="kode" value="' + kode + '" />' +
        '<input type="text" name="alamat" value="' + alamat + '" />' +
        '<input type="text" name="tgl_transaksi" value="' + tgl_transaksi + '" />' +
        '<input type="text" name="nama" value="' + nama + '" />' +
        '<input type="text" name="cara_pembayaran" value="' + cara_pembayaran + '" />' +
        '<input type="text" name="alamat" value="' + alamat + '" />' +
        '<input type="text" name="terima_dari" value="' + kode_akun + '" />' +
        '<input type="text" name="nama_pajak_ori" value="' + nama_pajak_ori + '" />' +
        '<input type="text" name="harga_pajak" value="' + harga_pajak + '" />' +
        '<input type="text" name="jumlah_akun" value="' + jumlah_akun + '" />' +
         '</form>');
        $('body').append(form);
        form.submit();

    });

    $("#kembali").click(function(){
        history.back();
    })


});
</script>