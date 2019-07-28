<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 
include('../../config/connect.php');  
include('../../include/include.php');
include('../../modal/modal.php');

if(isset($_POST['kode'])){   
	$kode= $_POST['kode'];
	$kode2 = explode('#', $kode, 2);

	$sql_select_transaksi_akun = "SELECT * FROM transaksi_akun WHERE kode_transaksi = '$kode'";
	$res_select_transaksi_akun = mysqli_query($connect, $sql_select_transaksi_akun);
	while($data_select_transaksi_akun = mysqli_fetch_array($res_select_transaksi_akun)){
		$nama = $data_select_transaksi_akun['kontak'];
		$tgl = $data_select_transaksi_akun['tgl_transaksi'];
		$cara_pembayaran = $data_select_transaksi_akun['cara_pembayaran'];
		$tag = $data_select_transaksi_akun['tag'];
		$memo = $data_select_transaksi_akun['memo'];
	}

	$sql_select_nominal = "SELECT debit FROM transaksi WHERE kode_transaksi = '$kode'";
	$res_select_nominal = mysqli_query($connect, $sql_select_nominal);
	$data_nominal = mysqli_fetch_array($res_select_nominal);

	$sql_select_kontak = "SELECT nama FROM kontak";
	$res_select_kontak = mysqli_query($connect, $sql_select_kontak);


	$arrCara_pembayaran = array("Cek & Giro", "Kartu Kredit", "Kas/Tunai", "Transfer Bank");
	$cara_pembayaran_length = count($arrCara_pembayaran);

	$select_sisa_tagihan_old = "SELECT kode, sisa_tagihan FROM transaksi_produk WHERE kode = '$tag' ";
	$res_sisa_tagihan_old = mysqli_query($connect, $select_sisa_tagihan_old);
	while($data_sisa_tagihan_old = mysqli_fetch_array($res_sisa_tagihan_old)){
		$sisa_tagihan_old = (int)$data_sisa_tagihan_old['sisa_tagihan'];
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
								<p class="text-primary" id="context-span"><?php echo $kode2[0]; ?></p>
							</h2>
						
					</div>

				</div>   
				

				
				<div class="form_penjualan">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* Penerima Pembayaran</strong>
									 <div class="form-group">
                                        <select id="pembayar" class="form-control select2" disabled>
                                            <?php while($data_select_kontak = mysqli_fetch_array($res_select_kontak)){ ?>
                                            <option value="<?php echo $data_select_kontak['nama']; ?>" <?php if($data_select_kontak['nama'] == $nama ){ echo "selected=selected";} ?>><?php echo $data_select_kontak['nama']; ?></option>
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
                                        <?php for($i = 0; $i < $cara_pembayaran_length; $i++){ ?>
											<option value="<?php echo $arrCara_pembayaran[$i]; ?>" <?php if($arrCara_pembayaran[$i] == $cara_pembayaran){ echo "selected=selected";} ?>>
												<?php echo $arrCara_pembayaran[$i]; ?>
											</option>
										<?php } ?>
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
										<input type="date" class="form-control" id="tgl" value="<?php echo $tgl; ?>">
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
										<input type="text" class="form-control" id="nomor_transaksi" value="<?php echo $kode2[1]; ;?>" readonly>
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
									<tr class="row">
									<th class="col-md-6 col-xs-6 col-sm-6">Kode Transaksi</th>
									<th class="col-md-3 col-xs-3 col-sm-3">Sisa Tagihan</th>
									<th class="col-md-3 col-xs-3 col-sm-3">Terima Pembayaran</th>
									<th></th>
									</tr>
								</thead>
								<tbody>
                                    <tr class="row">
                                        <td class="col-md-6 col-xs-6 col-sm-6">
                                            <p id="kode" value="<?php echo $tag ?>"><?php echo $tag ?></p>
                                        </td>

										<td class="col-md-3 col-xs-3 col-sm-3">
											<p><?php echo "Rp. ".number_format($sisa_tagihan_old, 2, ',', '.'); ?></p>
                                        </td>

                                        <td class="col-md-3 col-xs-3 col-sm-3">
                                           
											<input type="text" id="bayar" value="<?php echo $data_nominal['debit']; ?>" class="form-control">

											<div class="alert alert-warning alert-dismissible" id="alert" hidden="true">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h4><i class="icon fa fa-ban"></i> Alert!</h4>
												Periksa Kembali inputan diatas.
											</div>

                                        </td>
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
								<textarea cols="40" id="memo" style="resize: vertical; min-height:40px;"><?php echo $memo ?></textarea>
							</div>
							
						</div>
						<div class="col-lg-6 col-sm-12">


							<div class="form-group" id="pemesanan-only">
								<h2><b>Total<p class="pull-right"><?php echo "Rp. ".number_format($data_nominal['debit'], 2, ',', '.'); ?></p></b></h2>
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
							<button type="button" class="btn btn-primary" id="update">
								<i class="fa fa-plus"></i> Update <?php echo $kode2[0] ?>
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
	$('#bayar').mask('#,##0.00',{reverse:true});

    $("#bayar").keyup(function(){
        var bayar = document.getElementById("bayar").value;
		
        
        document.getElementById("total_bayar").innerHTML= "Rp. "+bayar;
    });

    $("#update").click(function(){
		var bayar = document.getElementById("bayar").value;
       
        var bayar2 = bayar.split(",").length-1;
		
		if(bayar2 > 0){
			var hasilBayar = bayar.split(",").join("");
		}else{
			var hasilBayar = bayar;
		}
		var sisaTagihanOld = parseFloat(<?php echo $sisa_tagihan_old ?>);
		var bayarOld = parseFloat(<?php echo $data_nominal['debit'] ?>);

		var bayarNew = parseFloat(hasilBayar);
		var tgl = $("#tgl").val();
		var memo = $("#memo").val();
		var kode = "<?php echo $kode ?>";
		var tag = $("#kode").text();
		var opsi = $("#opsi").val();
		
		
		if(tgl==""){
			tgl = "<?php echo $tgl;  ?>";
		}

		if(bayarNew>bayarOld+sisaTagihanOld){
			$("#alert").attr("hidden",false);
			
		}else{
			$("#alert").attr("hidden",true);
			sisaTagihanNew = bayarOld-bayarNew+sisaTagihanOld;

			//alert("kode : "+kode+"\ntgl :"+tgl+"\nopsi :"+opsi+"\nmemo :"+memo+"\ntag :"+tag+"\ncicil :"+bayarNew+"\nsisa :"+sisaTagihanNew);

			$.ajax({
				url:"/faktur_v2/config/edit_Payment.php",
				method:"POST",
				data:{ kode:kode, sisaTagihanNew:sisaTagihanNew, bayarNew:bayarNew, tgl:tgl, tag:tag, memo:memo, opsi:opsi},
				success:function(data)
				{
					
					if(data=="Success"){
					swal({
						title: "Succes!",
						text: "Penerimaan Berhasil!",
						type: "success"
					}).then(function() {
						window.location = "/faktur_v2/halaman/pembelian/";
					});
					}else{
						alert("error");
					}
				}

			});
			
		}

        

    })

});
</script>

</body>
</html>