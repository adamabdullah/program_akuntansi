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

    $sql_kontak = "SELECT transaksi_produk.pelanggan AS nama, kontak.email AS email, kontak.alamat_penagihan AS alamat FROM transaksi_produk INNER JOIN kontak on transaksi_produk.pelanggan = kontak.nama WHERE transaksi_produk.kode = '$kode'";
    $res_kontak = mysqli_query($connect, $sql_kontak);
    $semua = 0;
        while($data_kontak = mysqli_fetch_array($res_kontak)){
                
            $nama[$loop] = $data_kontak['nama'];
            $email[$loop] = $data_kontak['email'];
            $alamat[$loop] = $data_kontak['alamat'];
            $loop++;
        }

    $sql_penjualan = "SELECT tgl_transaksi AS awal, tgl_tempo AS akhir, sisa_tagihan FROM transaksi_produk WHERE kode = '$kode'";
    $res_penjualan = mysqli_query($connect, $sql_penjualan);

        while($data_penjualan = mysqli_fetch_array($res_penjualan)){

            $awal[$loop2] = $data_penjualan['awal'];
            $akhir[$loop2] = $data_penjualan['akhir'];
            $sisa[$loop2] = $data_penjualan['sisa_tagihan'];
            $semua = $semua + $sisa[$loop2];
            $loop2++;
        }

        $sql_produk = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode' AND qty_produk >''";
        $res_produk = mysqli_query($connect, $sql_produk);
    
    $sql_total = "SELECT sum(transaksi.jumlah_uang) AS sub, sum(transaksi.harga_pajak) AS pajak, transaksi_produk.sisa_tagihan AS sisa, transaksi_produk.total-transaksi_produk.sisa_tagihan AS dibayar, transaksi.syarat_pembayaran, transaksi.nama_pajak_ori FROM transaksi INNER JOIN transaksi_produk ON transaksi.kode_transaksi = transaksi_produk.kode WHERE transaksi.kode_transaksi = '$kode' ";
    $res_total = mysqli_query($connect,$sql_total);
    

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
                            <p class="text-primary" id="kode_full"><?php echo $kode; ?></p>
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
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <h4><strong>
                                *Supplier </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <h4>
                                <p class="text-primary nama"><?php echo $nama[0];?></p>
                            
                            </h4>   
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <h4><strong>
                                *E-mail </strong>
                            </h4>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <h4>
                                <p class="text-primary email"><?php echo $email[0];?></p>
                            
                            </h4>   
                        </div>
                        
                        
                    </div> 

                    <?php  ?>

                    <div class="container-fluid"  style="padding-top:10px; height:70px;">
                    <?php ?>
                        <div class="col-md-3 col-sm-7 col-xs-9">
                            <h4>
                                <strong>Alamat</strong>
                                <p class="text-primary pull-right alamat"><?php echo $alamat[0];  ?></p>
                            </h4>
                        </div>

                        <div class="col-md-4 col-sm-7 col-xs-9">
                            <h4>
                                <strong>Tanggal Transaksi</strong>
                                <p class="pull-right tgl_transaksi"><?php echo $awal[0]; ?></p>
                            </h4>
                        </div>
                        <div class="col-md-4 col-sm-7 col-xs-9">
                            <h4>
                                <strong>Tanggal Jatuh Tempo</strong>
                                <p class="pull-right tgl_tempo"><?php echo $akhir[0]; ?></p>
                            </h4>
                        
                        </div>


                        <div class="col-md-4 col-sm-7 col-xs-9">
                            <h4>
                                <strong>Nomer Transaksi</strong>
                                <p class="pull-right"><?php echo $kode2[1] ?></p>
                            </h4>
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
                                        Kuantitas
                                    </th>
                                    <th class="col-md-1 col-xs-1 col-sm-1">
                                        Harga Pajak
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Harga Satuan (IDR)
                                    </th>
                                    <th class="col-md-2 col-xs-2 col-sm-2" style="text-align:right">
                                        Jumlah (IDR)
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($data_produk = mysqli_fetch_array($res_produk)){ ?>
                                <tr>
                                    <div class="nama_kode_produk" hidden><?php echo  $data_produk['nama_produk'] ?></div>
                                    <div class="nama_pajak_ori" hidden><?php echo  $data_produk['nama_pajak_ori'] ?></div>
                                    
                                    <td><?php $nama = explode('|', $data_produk['nama_produk'], 2); echo $nama[1]; ?></td>
                                    <td><?php  ?></td>
                                    <td style="text-align:center" class="qty_produk"><?php echo $data_produk['qty_produk']; ?></td>
                                    <td class="harga_pajak"><?php echo $data_produk['harga_pajak']; ?></td>
                                    <td style="text-align:right" class="harga_satuan"><?php echo $data_produk['jumlah_uang']; ?></td>
                                    <td style="text-align:right" class="harga_setelah_satuan"><?php echo $data_produk['debit']+$data_produk['harga_pajak']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        
                    </div>

                    <div class="container-fluid" style="margin-top:20px">
                    <?php while($data_total = mysqli_fetch_array($res_total)){ ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h4>
                                <strong>SubTotal</strong>
                                <p class="text-primary pull-right sub_total"><?php echo $data_total['sub'];?></p>
                                <div class="syarat_pembayaran" hidden><?php echo  $data_total['syarat_pembayaran']; ?></div>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h4>
                                <strong>Total Pajak</strong>
                                <p class="text-primary pull-right total_pajak"><?php echo $data_total['pajak'];?></p>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h3>
                                <strong>Dibayar</strong>
                                <p class="text-primary pull-right" id="dibayar"><?php echo $data_total['dibayar'];?></p>
                                </h3>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-sm-7 col-xs-7 pull-right">
                                <h3>
                                <strong>Sisa Tagihan</strong>
                                <p class="text-primary pull-right sisa_tagihan"><?php echo $semua;?></p>
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
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"  <?php echo $_SESSION['write']; ?>>
                                    Tindakan <i class="fa fa-copy"></i>
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                       <!--  <li><a href="#" id="buat_penagihan">Duplikat Transaksi</a></li>
                                        <li><a href="#" id="buat_penagihan">Atur Transaksi Berulang</a></li> -->
                                        <li><a href="#" id="bayar_pembelian">Bayar Pembelian</a></li>
                                    </ul>
                                </div>
                            </div>
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
            form.setAttribute("action", "pdf/pembelian.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "kode");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", "<?php echo $kode ?>");
            form.appendChild(hiddenField);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf/pembelian.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

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
					url:"/faktur_v2/config/delete_transaksi_produk.php",
					method:"POST",
					data:{kode:kode},
					success:function(data) 
                                {
                                    swal({
                                        title: "Succes!",
                                        text: "Data Sukses Dihapus!",
                                        type: "success"
                                    }).then(function() {
                                        window.location = "/faktur_v2/halaman/pembelian/";
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

        var url = '/faktur_v2/halaman/pembelian/update/';
        var harga_pajak = [];
        var harga_satuan = [];
        var harga_setelah_satuan = [];
        var qty_produk = [];
        var nama_produk = [];
        var nama_pajak_ori = [];

        var kode_full = $("#kode_full").text();
        var alamat = $(".alamat").text();
        var tgl_transaksi = $(".tgl_transaksi").text();
        var tgl_tempo = $(".tgl_tempo").text();
        var nama = $(".nama").text();
        var email = $(".email").text();
        var syarat_pembayaran = $(".syarat_pembayaran").text();
        var sub_total = $(".sub_total").text();
        var total_pajak = $(".total_pajak").text();
        var sisa_tagihan = $(".sisa_tagihan").text();
        var dibayar = $("#dibayar").text();

        // alert(kode_full);

        $(".nama_kode_produk").each(function()
        {
            var a = $(this).text();
            // alert(a); 
            nama_produk.push(a);
        });
        
        $(".qty_produk").each(function()
        {
            var a = $(this).text();
            qty_produk.push(a);
        });
        
        $(".harga_pajak").each(function()
        {
            var a = $(this).text();
            harga_pajak.push(a);
        });
        
        $(".harga_satuan").each(function()
        {
            var a = $(this).text();
            harga_satuan.push(a);
        });

        $(".harga_setelah_satuan").each(function()
        {
            var a = $(this).text();
            harga_setelah_satuan.push(a);
        });

        $(".nama_pajak_ori").each(function()
        {
            var a = $(this).text();
            nama_pajak_ori.push(a);
        });

         var form = $('<form action="' + url + '" method="post">' +
        '<input type="text" name="harga_pajak" value="' + harga_pajak + '" />' +
        '<input type="text" name="harga_satuan" value="' + harga_satuan + '" />' +
        '<input type="text" name="harga_stlh_satuan" value="' + harga_setelah_satuan + '" />' +
        '<input type="text" name="qty_produk" value="' + qty_produk + '" />' +
        '<input type="text" name="nama_produk" value="' + nama_produk + '" />' +
        '<input type="text" name="nama_pajak_ori" value="' + nama_pajak_ori + '" />' +
        '<input type="text" name="email" value="' + email + '" />' +
        '<input type="text" name="kode_full" value="' + kode_full + '" />' +
        '<input type="text" name="nama" value="' + nama + '" />' +
        '<input type="text" name="alamat" value="' + alamat + '" />' +
        '<input type="text" name="tgl_transaksi" value="' + tgl_transaksi + '" />' +
        '<input type="text" name="tgl_tempo" value="' + tgl_tempo + '" />' +
        '<input type="text" name="syarat_pembayaran" value="' + syarat_pembayaran + '" />' +
        '<input type="text" name="sub_total" value="' + sub_total + '" />' +
        '<input type="text" name="total_pajak" value="' + total_pajak + '" />' +
        '<input type="text" name="sisa_tagihan" value="' + sisa_tagihan + '" />' +
        '<input type="text" name="dibayar" value="' + dibayar + '" />' +
        '</form>');
        $('body').append(form);
        form.submit();

    });
    
    $("#kembali").click(function(){
        history.back();
    })

    $("#bayar_pembelian").click(function(){
        var kode = "<?php echo $kode; ?>";
        var url = '/faktur_v2/halaman/pembayaran/bayar_pembelian.php';
                var form = $('<form action="' + url + '" method="post">' +
                '<input type="text" name="kode" value="' + kode + '" />' +
                '</form>');
                $('body').append(form);
                form.submit();
    });

});
</script>