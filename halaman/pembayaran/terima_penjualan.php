<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 
include('../../config/connect.php');  
include('../../include/include.php');
include('../../modal/modal.php');

if(isset($_POST['kode'])){   
    $kode= $_POST['kode'];
    $sql_sel_transaksi_produk = "SELECT * FROM transaksi_produk WHERE kode = '$kode'";
    $res_sel_transaksi_produk = mysqli_query($connect, $sql_sel_transaksi_produk);
    $res_sel_transaksi_produk2 = mysqli_query($connect, $sql_sel_transaksi_produk); 

    $sql_akun = "SELECT * FROM akun WHERE kategori_akun = 'Kas & Bank' AND kode_akun like '1%'";
    $res_akun = mysqli_query($connect, $sql_akun);
    
    $sql_make_kode = "SELECT max(ExtractNumber(kode_transaksi)) AS no_transaksi FROM transaksi_akun WHERE kode_transaksi like'%Receive%'";
    $res_make_kode = mysqli_query($connect, $sql_make_kode);
    $data_make_kode = mysqli_fetch_array($res_make_kode);
    if($data_make_kode['no_transaksi']>0){ 
        $nomor = (int) $data_make_kode['no_transaksi'];
        $nomor++;
        $kode_baru = "Receive Payment # ".$nomor;

    }else{
        $kode_baru = "Receive Payment # 10000";
    }
  }else{
    header('Location: /faktur_v2/');
    exit; 
  }




head(); //call func head from include php

?>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper"> 
        <section>
            
				<div class="row content">			
					<div class="col-sm-12 col-md-12 col-lg-6" style="text-align:left">
						
							<h2><small>Transaksi</small><br>
								<p class="text-primary" id="context-span">Penerimaan</p>
							</h2>
						
					</div>

				</div>   
				

				
				<div class="form_penjualan">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* Pelanggan</strong>
									 <div class="form-group">
                                        <select id="pembayar" class="form-control select2" disabled>
                                            <?php while($data_sel_transaksi_produk = mysqli_fetch_array($res_sel_transaksi_produk)){ ?>
                                            <option value="<?php echo $data_sel_transaksi_produk['pelanggan']; ?>"><?php echo $data_sel_transaksi_produk['pelanggan']; ?></option>
                                            <?php } ?>
                                        </select>
                                     </div>
								</div>
							
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* Setor Ke</strong>
									<div class="form-group">
                                        <select id="penerima" class="form-control select2">
                                            <?php while($data_akun = mysqli_fetch_array($res_akun)){?>
                                            <option value="<?php echo $data_akun['kode_akun']." | ".$data_akun['nama_akun'] ;?>"><?php echo $data_akun['kode_akun']." | ".$data_akun['nama_akun'] ;?></option>
                                            <?php } ?>
                                        </select>
                                     </div>
									
								</div>
									
							</div>
						</div>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Cara Pembayaran</label>
									<select name="opsi" id="opsi" class="select2 form-control">
                                        <option>Cek & Giro</option>
                                        <option>Kartu Kredit</option>
                                        <option>Kas/Tunai</option>
                                        <option>Transfer Bank</option>
                                    </select>
								</div>
								<!-- /.form-group -->
								
							</div>
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Tanggal Transaksi :</label>
					
									<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<input type="date" class="form-control" id="tgl" value="<?php echo date("Y-m-d"); ?>">
									</div>
									<!-- /.input group -->
                                </div>
                                
							</div>
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12 pull-right">
								<div class="form-group">
									<label>Nomor Transaksi</label>
									<div class="input-group text">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<input type="text" class="form-control" id="nomor_transaksi" value="<?php echo $kode_baru ;?>" readonly>
									</div>
								</div>
								
							<!-- /.form-group -->

							</div>

							</div> 
						</div>
						<!-- /.row -->
					</div>

					<div class="container-fluid">
						<div class="box">						
							<div class="box-body no-padding">
							<table class="table table-hover" id="tabel_pemesanan_penjualan">
								<thead class="bg-info">
									<tr>
									<th>Kode Transaksi</th>
									<th>Deskripsi</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Total</th>
									<th>Sisa Tagihan</th>
									<th>Jumlah</th>
									<th></th>
									</tr>
								</thead>
								<tbody>
                                    <tr><?php while($data_sel_transaksi_produk2 = mysqli_fetch_array($res_sel_transaksi_produk2)){ ?>
                                        <td>
                                            <p id="kode" value="<?php echo $kode ?>"><?php echo $kode ?></p>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <p id="tempo" value="<?php echo $data_sel_transaksi_produk2['tgl_tempo']?>"><?php echo $data_sel_transaksi_produk2['tgl_tempo']?></p>
                                        </td>
                                        <td>
                                            <p id="total" value="<?php echo $data_sel_transaksi_produk2['total'];?>"><?php echo $data_sel_transaksi_produk2['total'];?></p>
                                        </td>
                                        <td>
                                            <p id="sisa" data-anu="<?php echo $data_sel_transaksi_produk2['sisa_tagihan'];?>"><?php echo $data_sel_transaksi_produk2['sisa_tagihan'];?></p>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="bayar" class="form-control">

                                                <div class="alert alert-warning alert-dismissible" id="alert" hidden="true">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                                    Periksa Kembali inputan diatas.
                                                </div>

                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>

								</tbody>
							</table>
							</div>
							<!-- /.box-body -->
							
					</div>

                
                <div class="row">
					<div class="container-fluid">
						<div class="col-lg-6 col-sm-12">
						
							<div class="form-group">
								<label><strong>Memo</strong></label>
								<br>
								<textarea cols="40" id="memo" style="resize: vertical; min-height:40px;"></textarea>
							</div>
							
						</div>
						<div class="col-lg-6 col-sm-12">


							<div class="form-group" id="pemesanan-only">
								<h2><b>Total<p class="pull-right" id="total_bayar">Rp. 0,00</p></b></h2>
							</div>
							
						</div>
					</div>                    
				</div>  <!-- close row-content -->

				<div class="row">
					<div class="container-fluid">
						<div class="col-lg-6 col-sm-6 col-md-6 pull-right">
							<div class="form-group pull-right">
							<!-- <input type="button" class="btn btn-lg btn-primary" value="aw"> -->
							<button type="button" class="btn btn-danger">
								<i class="fa fa-times"></i> Batal
							</button>
							<button type="button" class="btn btn-primary" id="terima">
								<i class="fa fa-plus"></i> Terima Pembayaran
							</button>
							</div>
						</div>
					</div>  
				</div>
			</div>
				
        </section>
        <?php 
       
        ?>
        
    </div>

<?php body_bottom(); ?>
<!-- <script src="/faktur_v3_new/dist/js/jquery.mask.js"></script> -->
<script>
$(document).ready(function() 
{
    $('.select2').select2();

    $("#bayar").keyup(function(){
        var bayar = document.getElementById("bayar").value;
        
        document.getElementById("total_bayar").innerHTML= "Rp. "+bayar+",00";
    });

    $("#terima").click(function(){
        var bayar = document.getElementById("bayar").value;
        var sisa = $("#sisa").text();
        var sisa2 = parseInt(sisa);
        // alert(sisa2);
        if(bayar>sisa2||bayar<1){
            $("#alert").attr("hidden",false);
            document.getElementById("alert").focus();
        }else{
            var kode = document.getElementById("nomor_transaksi").value; //kode penerimaan
            var kontak = document.getElementById("pembayar").value; //kontak atau pelanggan
            var tgl = document.getElementById("tgl").value; //tgl transaksi
            var cara = document.getElementById("opsi").value; //cara pembayaran
            var tag = "<?php echo $kode; ?>"; //pembayaran untuk kode transaksi ini
            var debit = document.getElementById("penerima").value;  //kolom akun yang terisi debit
            var kredit = "1-10100 | Piutang Usaha"; //kolom akun yang terisi kredit
            var uang = bayar; //nominal debit atau kredit
            var sisa_tagihan = sisa2-bayar; //sisa tagihan yang baru
            var memo = document.getElementById("memo").value;
            // alert(memo);
            
                $.ajax({
                        url:"/faktur_v2/config/penerimaan_penjualan.php",
                        method:"POST",
                        data:{ kode:kode, kontak:kontak, tgl:tgl, cara:cara, tag:tag, debit:debit, kredit:kredit, uang:uang, sisa_tagihan:sisa_tagihan, memo:memo },
                        success:function(data)
                        {
                            swal({
                                title: "Success!",
                                text: "Penerimaan Berhasil!",
                                type: "success"
                            }).then(function() {
                                window.location = "/faktur_v2/halaman/penjualan/";
                            });
                        }
                });
            

        }

    })

});
</script>

</body>
</html>