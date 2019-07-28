<!DOCTYPE HTML>
<html lang="en">
<head>
 
<?php 

include('../../../config/connect.php');

include('../../../include/include.php');  
 
include('../../../modal/modal.php');
$kode = $_POST['kode_full'];
$sql = "SELECT * FROM transaksi_produk where kode='".$kode."'";
$hasil = mysqli_query($connect,$sql);
$data_1 = mysqli_fetch_array($hasil);

head(); //call func head from include php
?>  
 
</head>
<body class="hold-transition skin-blue sidebar-mini">


    <?php body_top(); ?> 
    <div class="content-wrapper"> 
        <section>
            
				<div class="row content">
					<div value="" id="kode_rahasia" hidden></div>
					<div value="" id="debit_rahasia" hidden></div>					
					<div class="col-sm-12 col-md-12 col-lg-6" style="text-align:left">
						
							<h2><small>Transaksi</small><br>
								<input type="text" id="jenis" value="<?php echo $_POST['jenis']?>" hidden>
								<p class="text-primary" id="context-span"></p>
							</h2>
						
					</div>
 
					<div class="col-sm-12 col-md-12 col-lg-4 pull-right">
						<h2><div class="dropdown form-group">
							<button class="btn btn-md btn-primary form-control dropdown-toggle"  type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-bars pull-left"></i>Buat Transaksi
							<span class="caret"></span>
							</button>
							<ul class="dropdown-menu form-control" aria-labelledby="dropdownMenu1">
								<li><a href="#" id="form_penagihan">Penagihan Penjualan</a></li>
								<li><a href="#" id="form_pemesanan">Pemesanan Penjualan</a></li>
								<li><a href="#" id="form_pengiriman">Pengiriman Penjualan</a></li>
								<li><a href="#" id="form_penawaran">Penawaran Penjualan</a></li>
							</ul>
						</div></h2>
					</div>
				</div>   
				

				
				<div class="form_penjualan">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* Pelanggan</strong>
									 <select id="kontak" class="form-control">
								    	<option id="kontak_baru"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan kontak</option>
										 <?php
											$sql3 = "SELECT * FROM kontak";
											$result3 = mysqli_query($connect, $sql3);
											$jumlah=0;
											$kurangi=0;
											$total=0;
											while($data3 = mysqli_fetch_array($result3))
											{
											    ?>
													<option value="<?php echo $data2['nama'] ?>" class="kontak_penerima"><?php echo $data3['nama'] ?></option>
										        <?php
											}
										?>
									</select>
								</div>								
							
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* E-mail</strong>
									
									<input type="text" class="form-control" id="email" placeholder="input you email here.." name="email" id="email" disabled readonly>
									
								</div>
									

								<div class="col-xs-6 col-sm-4 col-md-3 pull-right">
									<h2><strong>Total <a class="text-light-blue" id="header_amount"> Rp. 0,00</a></strong></h2>
								</div>
							</div>
							<span class="text-danger">
									<strong id="pelanggan-errors"></strong>
								</span>
						</div>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Alamat Penagihan</label>
									<textarea class="form-control" id="alamat" style="resize:vertical;" name="" id="alamat_penagihan" cols="30" rows="10"></textarea>
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
										<input type="date" class="form-control" id="tgl_transaksi" value="">
									</div>
									<!-- /.input group -->
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label id="penawaran-only2">Tanggal Jatuh Tempo :</label>
					
									<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="date" class="form-control" id="tgl_tempo">
									</div>
									<!-- /.input group -->
								</div>
								<div class="form-group">
									<label>Syarat Pembayaran</label>
									<div class="input-group select">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<select class="form-control select2" style="width: 100%;" id="syarat_pembayaran">
											<option>Custom</option>
											<option>Net 30</option>
											<option>Cash On Delivery</option>
											<option>Net 15</option>
											<option>Net 60</option>
										</select>
									</div>
								</div>
							<!-- /.form-group -->
							</div>
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Nomor Transaksi</label>
									<div class="input-group text">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<input type="text" class="form-control" name="" id="nomor_transaksi">
									</div>
								</div>
							
								<div class="form-group">
									<label>No Referensi Pelanggan</label>
									<div class="input-group text">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<input type="text" class="form-control" name="" id="no_ref_pelanggan">
									</div>
								</div>
							<!-- /.form-group -->

							</div>

							</div> 
						</div>
						<!-- /.row -->
						<div class="row">
							<div class="col-lg-7 col-md-7 col-xs-10 col-sm-12 pull-right">
									<div class="pull-right">
										<h2><label>Harga Termasuk Pajak </label>
										<label class="switch">
											<input type="checkbox" checked>
											<span class="slider round"></span>
										</label></h2>
									</div>
							</div>
						</div>
					</div>

					<div class="container-fluid">
						<div class="box">						
							<div class="box-body no-padding">
							<table class="table table-hover" id="tabel_pemesanan_penjualan">
								<thead class="bg-info">
									<tr>
									<th>Produk</th>
									<!-- <th>Deskripsi</th> -->
									<th>Kuantitas</th>
								<!-- 	<th>Satuan</th> -->
									<th>Harga Satuan</th>
									<th>Pajak</th>
									<th>Jumlah</th>
									<th></th>
									</tr>
								</thead>
								<tbody>
								<tr id="lama">
								<td><div class="row">
									
								<div class="col-md-12"> 
									<select id="produk_append" class="form-control produk_append"> 
									    <option id="tambah_produk"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan produk</option>
										<?php
											$mysql = "SELECT * FROM produk";
											$hasil = mysqli_query($connect, $mysql);
											while($baris = mysqli_fetch_array($hasil))
												{
													?>
														<option value="<?php echo $baris['nama_produk']; ?>" class="isi_produk"><?php echo $baris['kode_produk']." | ".$baris['nama_produk']; ?></option>
													<?php
												}
											?>
									</select>
								</div>
								<div></div>
								<span class="text-danger">
									<strong id="produk_append-errors"></strong>
								</span>
								</td>
	</div></td>
								<!-- <td><textarea name="" id="" cols="20" rows="1" class="deskripsi"></textarea></td> -->
								<td><div class="form-group"><input class="form-control quantity" id="jumlah" placeholder="jumlah" style="width: 7em" min=0 id=""></div><span class="text-danger">
									<strong id="quantity-errors"></strong>
								</span></td>
								<!-- <td><div class="form-group"><select class="form-control" id="" placeholder="satuan" style="width: 7em" disabled="true"></select></div></td> -->
								<td><div class="form-group"><input class="form-control harga_satuan" id="satuan" placeholder="satuan"></div><span class="text-danger">
									<strong id="harga_satuan-errors"></strong>
								</span></td>
								<td><div class="row">
			<div class="col-md-12"> 
			<select id="pajak_awal" class="form-control pajak_append_select" data-pajak="" data-uang_pajak="">
			    <option id="pajak_append_baru"><i class="fa fa-plus" ></i>&nbsp;Ketuk untuk menambahkan pajak</option>
				<?php
					$sql0 = "SELECT * FROM pajak";
					$result0 = mysqli_query($connect, $sql0);
					while($data0 = mysqli_fetch_array($result0))
					{
						?>
							<option value="<?php echo $data0['nama_pajak'].',';?>"  id="pajak_append_isi" class="pajak_append_isi"  data-value="<?php echo $data0['nama_pajak'].'|'.$data0['berapa_persen'];?>"><?php echo $data0['nama_pajak']." | ".$data0['berapa_persen']."%"; ?></option>
						<?php
					}
				?> 
			</select>
		</div>
	</div></td>
								<td><div class="form-group">
									<input class="form-control jumlah_uang_produk" id="uang" placeholder="uang" data-uang="">
									</div>
									<span class="text-danger">
									<strong id="jumlah_uang_produk-errors"></strong>
								</span></td>
								<td></td>	
								</tr>
								</tbody>
							</table>
							</div>
							<!-- /.box-body -->
							
					</div>
					<div class="row">
						<div class="col-md-2">
							<button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false" id="tambah_penerimaan2"><i class="fa fa-plus"></i>Tambah Data</button>
						</div>
					</div>

				
				

            
                
                <div class="row">
					<div class="container-fluid">
						<div class="col-lg-6 col-sm-12">
							
							<div class="form-group">
								<label><strong>Pesan</strong></label>
								<br>
								<textarea name="" cols="40" id="pesan" style=" min-height:40px; max-width:100%;"></textarea>
							</div>
						
							<div class="form-group">
								<label><strong>Memo</strong></label>
								<br>
								<textarea name="" cols="40" id="memo" style="resize: vertical; min-height:40px;"></textarea>
							</div>
							
						</div>
						<div class="col-lg-6 col-sm-12">
							<div class="form-group">
								<h4>Sub Total <p class="pull-right" id="sub_total">Rp. 0,00</p></h4>
							</div>
							<div class="form-group">
								<h4><b>Total Pajak</b> <p class="pull-right" id="ppn_angka">Rp. 0,00</p></h4>
							</div>
							<!-- <div class="form-group">
								<h4><b>Total</b> <p class="pull-right">Rp. 0,00</p></h4>
							</div> -->
							<div class="form-group" id="pemesanan-only">
								<h2><b>Sisa Tagihan<p class="pull-right" id="total_semua">Rp. 0,00</p></b></h2>
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
							<button type="button" class="btn btn-primary" id="buat_penjualan">
								<i class="fa fa-plus"></i> Edit Penjualan
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
</body>
<script>
$(document).ready(function(){
	$("#kontak").editableSelect({ effects: 'fade', filter: false });
	$("#pajak_awal").editableSelect({ effects: 'fade', filter: false });
	$(".produk_append").editableSelect({ effects: 'fade', filter: false });
	$(".jumlah_uang_produk").mask('#,##0.00', {reverse: true});
	$(".harga_satuan").mask('#,##0.00', {reverse: true});
	$(".select2").select2();

	$(window).click(function()
	{
		var a = $("#kontak").val().split("(").length - 1;
 		if(a > 0)
 		{
 			var nama_akun = $("#kontak").val().substring(0, $("#kontak").val().indexOf('('));;
 			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-kontak/check_kontak.php",
			method:"POST",
			data:{query:nama_akun},
			dataType:"JSON",
			success:function(data)
				{

					if(data.keterangan == "tidak ada")
					{
						$("#kontak").val("");
						$("#email").val("");
					}
					else
					{
						$("#email").val(data.email);
						$("#alamat").val(data.alamat_penagihan);
					}
				}
			});	
 		}
 		else
 		{
 			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-kontak/check_kontak.php",
			method:"POST",
			data:{query:$("#kontak").val()},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "tidak ada")
					{
						$("#kontak").val("");
						$("#email").val("");
					}
					else
					{
		 				$("#email").val(data.email);
						$("#alamat").val(data.alamat_penagihan);
					}
				}
			});	
 		}
 		$(".produk_append").each(function()
		{

			var value = $(this).val();
			var $t = $(this);
			var tanpa_spasi = "";
			var count = value.split("|").length-1;
			if ( count > 0)
			{
	 			var streetaddress= value.substr(0, value.indexOf('|')); 
				tanpa_spasi = $.trim(streetaddress);
			}
			else
			{
				tanpa_spasi = value;
			}
			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-produk/check_produk.php",
			method:"POST",
			data:{query:tanpa_spasi},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "tidak ada")
					{
						$t.val("");
					}
					else
					{
						
					}
				}
			});
		});

		$(".pajak_append_select").each(function()
		{
			var a = $(this).val();
			var $t = $(this);
			var tanpa_spasi = "";
			if ( a.split("|").length - 1)
			{
	 			var streetaddress= a.substr(0, a.indexOf('|')); 
				tanpa_spasi = $.trim(streetaddress);
			}
			else
			{
				tanpa_spasi = a;
			}
			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-pajak/check_pajak.php",
			method:"POST",
			data:{query:tanpa_spasi},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "tidak ada")
					{
						$t.val("");
					}
					else
					{
						
					}
				}
			});
		});

	});

	function cari_kontak(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/penjualan/proses-kontak/cari_kontak.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$("#kontak").siblings('.es-list').find('.kontak_awal').hide();
			$("#kontak").next().html(data);			
		}
		});
 	}

 	function check_kontak(query)
 	{
 		var a = query.split("(").length - 1;
 		if(a > 0)
 		{
 			var nama_akun = query.substring(0, query.indexOf('('));;
 			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-kontak/check_kontak.php",
			method:"POST",
			data:{query:nama_akun},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "tidak ada")
					{
						var nama_akun = query.substring(0, query.indexOf('('));
						$("#nama_panggilan").val(nama_akun);
		 				$("#tambah_kontak_modal").modal('toggle');
					}
					else
					{
						$("#email").val(data.email);
						$("#alamat").val(data.alamat_penagihan);
					}
				}
			});	
 		}
 		else
 		{
 			$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-kontak/check_kontak.php",
			method:"POST",
			data:{query:query},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "tidak ada")
					{
						$("#tambah_kontak_modal").modal('toggle');
					}
					else
					{
		 				$("#email").val(data.email);
						$("#alamat").val(data.alamat_penagihan);
					}
				}
			});	
 		}
 		
 	}

 	function coba()
 	{
 		$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-kontak/check_kontak.php",
			method:"POST",
			data:{},
			dataType:"JSON",
			success:function(data)
				{
					// alert(data.keterangan);
				}
			});	
 	}

 	function check_produk(query, baris)
 	{
 		var streetaddress= query.substr(0, query.indexOf('|'));
 		$.ajax({
			url:"/faktur_v2/halaman/penjualan/proses-produk/check_produk.php",
			method:"POST",
			data:{query:streetaddress},
			dataType:"JSON",
			success:function(data)
				{
					if(data.keterangan == "ada")
					{
						var a = parseInt(data.harga_satuan);
						var b = a.toLocaleString();
						var c = b.split(",").join(".");
						$("#tabel_pemesanan_penjualan tbody tr:eq("+baris+") td").find("input.harga_satuan").val(c);
						$("#tabel_pemesanan_penjualan tbody tr:eq("+baris+") td").find("input.jumlah_uang_produk").val(c);
						$("#tabel_pemesanan_penjualan tbody tr:eq("+baris+") td").find("input.quantity").val(1);
						var a = parseInt(0);
					 	$(".jumlah_uang_produk").each(function()
					 	{
					 		var y = $(this).val();
					 		if(y == '')
					 		{
					 			y=0;
					 			a = a + y;
					 		}
					 		else
					 		{
					 			var z = y.split(".").join("");
					 			var g = parseInt(z);
					 			a = a + g;
					 		}
					 		
					 	});
					 	var i = a.toLocaleString();
					 	$("#total_semua").text(i);
					}

				}
			});	 
 		
 	}

 	function cari_produk(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/penjualan/proses-produk/cari_produk.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			// $('.akun_append').siblings('.es-list').find('.pmbyrn').hide();
			// $('.akun_append').next().html(data);
			// $('#pembayaran_utk_akun').siblings('.es-list').find('.pmbyrn').hide();
			// $('#pembayaran_utk_akun').next().html(data);
			$(".produk_append").each(function(index) 
			{
				if ($(this).val() == query) 
				{
					$(this).siblings('.es-list').find('.isi_produk').hide();
					$(this).next().html(data);
		            //Text found in div 
		        }
			});

		}
		});
 	}

 	function cari_pajak(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/penjualan/proses-pajak/cari_pajak.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			// $('.akun_append').siblings('.es-list').find('.pmbyrn').hide();
			// $('.akun_append').next().html(data);
			// $('#pembayaran_utk_akun').siblings('.es-list').find('.pmbyrn').hide();
			// $('#pembayaran_utk_akun').next().html(data);
			$(".pajak_append_select").each(function(index) 
			{
				if ($(this).val() == query) 
				{
					$(this).siblings('.es-list').find('.pajak_append_isi').hide();
					$(this).next().html(data);
		            //Text found in div 
		        }
			});

		}
		});
 	}

	$(document).on('keyup','#kontak',function()
	{
		cari_kontak($(this).val());
	});

	$(document).on('click','.kontak_penerima',function()
	{
		check_kontak($(this).text());
	});

	$(document).on('click','#kontak_baru',function()
	{
		$("#tambah_kontak_modal").modal('toggle');
	});

	$(document).on('keyup','.produk_append',function()
	{
		var a = $(this).val();
		cari_produk(a);
	});

	$(document).on('keyup', '.jumlah_uang_produk', function()
 	{
 		var a = parseInt($(this).val());
 		var jumlah = parseInt($(this).val());
 		var sum = $(this).val().split(",").length - 1;
 		var total = parseInt(0);
 		if(sum > 0)
 		{
 			var jikw=$(this).val().split(",").join("");
 			total = jikw;
 		}
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var reset_satuan = parseInt(0);
 		var harga_satuan = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.harga_satuan").val();
 		var quantity = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.quantity").val();
 		var sum1 = harga_satuan.split(",").length - 1;
 		if(sum1 > 0)
 		{
 			var jikw=harga_satuan.split(",").join("");
 			harga_satuan = jikw;
 		}

 		var sum2 = quantity.split(",").length - 1;
 		if(sum2 > 0)
 		{
 			var jikw=quantity.split(",").join("");
 			quantity = jikw;
 		}
 		reset_satuan = total/quantity;
 		var coba = reset_satuan.toLocaleString();
 	// 	// var loq = coba.split(",").join(".");
 		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.harga_satuan").val(coba);

 		$("#total_semua").text("");
		var semua = parseInt(0);
		var angka = parseInt(0);
		var pajak_saja = parseInt(0);
		var w = 0;
		$(".jumlah_uang_produk").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak') || 0;
			var uang_pajak = (a*angka_pajak)/100;
			semua = semua+a+uang_pajak;
			$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			angka = angka+a;
			pajak_saja = pajak_saja+uang_pajak;
			w++;
		});
		var output = semua.toLocaleString();
		$("#total_semua").text(output);
		var output_pajak = angka.toLocaleString();
		$("#sub_total").text(output_pajak);
		var khusus_pajak = pajak_saja.toLocaleString();
		$("#ppn_angka").text(khusus_pajak);
 	});

 	$(document).on('keyup', '.harga_satuan', function()
 	{
 		var harga_satuan = $(this).val();
 		var sum = $(this).val().split(",").length - 1;
 		if(sum > 0)
 		{
 			var jikw=$(this).val().split(",").join("");
 			harga_satuan = jikw;
 		}
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var quantity = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.quantity").val();
 		reset_jumlah = harga_satuan*quantity;
 		var coba = reset_jumlah.toLocaleString();
 		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.jumlah_uang_produk").val(coba);
 		$("#total_semua").text("");
 		var semua = parseInt(0);
		var angka = parseInt(0);
		var pajak_saja = parseInt(0);
		var w = 0;
 		$(".jumlah_uang_produk").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak') || 0;
			var uang_pajak = (a*angka_pajak)/100;
			semua = semua+a+uang_pajak;
			$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			angka = angka+a;
			pajak_saja = pajak_saja+uang_pajak;
			w++;
		});
		var output = semua.toLocaleString();
		$("#total_semua").text(output);
		var output_pajak = angka.toLocaleString();
		$("#sub_total").text(output_pajak);
		var khusus_pajak = pajak_saja.toLocaleString();
		$("#ppn_angka").text(khusus_pajak);
 	});

 	$(document).on('keyup', '.quantity',function()
 	{
 		var jumlah = $(this).val() || 0;
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var reset_total = parseInt(0);
 		var harga_satuan = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.harga_satuan").val() || 0;

 		var sum_titik = harga_satuan.split(",").length-1;

 		if(sum_titik > 0)
 		{
 			var pl = harga_satuan.split(",").join("");
 			harga_satuan = pl;
 		}

 		reset_total = jumlah*harga_satuan;

 		var output = reset_total.toLocaleString();
 		var final_satuan1 = output.toLocaleString();
 		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.jumlah_uang_produk").val(final_satuan1);
 		var semua = parseInt(0);
		var angka = parseInt(0);
		var pajak_saja = parseInt(0);
		var w = 0;
 		$(".jumlah_uang_produk").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak') || 0;
			var uang_pajak = (a*angka_pajak)/100;
			semua = semua+a+uang_pajak;
			$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			angka = angka+a;
			pajak_saja = pajak_saja+uang_pajak;
			w++;
		});
		var output = semua.toLocaleString();
		$("#total_semua").text(output);
		var output_pajak = angka.toLocaleString();
		$("#sub_total").text(output_pajak);
		var khusus_pajak = pajak_saja.toLocaleString();
		$("#ppn_angka").text(khusus_pajak);
 	});

 	$(document).on('click', '.pajak_append_isi',function() //------------------------------untuk mengecek (akun)
	{
		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
		var j = rowIndex-1;
		var id4 = $(this).text();
		var myString = id4.substr(id4.indexOf("|") + 1);
		var angka_pajak2 = myString.split("%").join("");

		$("#tabel_pemesanan_penjualan tbody tr:eq("+j+") td .pajak_append_select").data('pajak', angka_pajak2);
		var pajak_saja = parseInt(0);
		var semua = parseInt(0);
		var angka = parseInt(0);
		var w = parseInt(0);

		$(".jumlah_uang_produk").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			var a = parseInt(k) || 0;
			// alert($("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak'));
			var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak');

			var angka_pajak2 = parseInt(angka_pajak) || 0;
			var uang_pajak = (a*angka_pajak2)/100;
			pajak_saja = pajak_saja+uang_pajak;
			$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			semua = semua+a+uang_pajak;
			angka = angka+a;
			w++;
		});

		var output = semua.toLocaleString();

		$("#total_semua").text(output);
		var output_pajak = angka.toLocaleString();
		$("#sub_total").text(output_pajak);
		var khusus_pajak = pajak_saja.toLocaleString();
		$("#ppn_angka").text(khusus_pajak);

		// $("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak', angka_pajak);
	});

	$(document).on('change', '.quantity',function()
 	{
 		var a = $(this).val();
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		if(a == '')
 		{
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.harga_satuan").val(0);
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.jumlah_uang_produk").val(0);
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td").find("input.produk_append").val(0);
 		}	
 	});	

 	$(document).on('change', '.pajak_append_select',function()
	{
		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var w = parseInt(0);
 		if($(this).val()=='')
 		{
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").data('uang_pajak', 0);
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").data('pajak', '');
			var pajak_saja = parseInt(0);
			var semua = parseInt(0);
			var angka = parseInt(0);
			$(".jumlah_uang_produk").each(function()
			{
				var z = $(this).val();
				var k = z.split(",").join("");
				var a = parseInt(k) || 0;
				var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak');
				var angka_pajak2 = parseInt(angka_pajak) || 0;
				var uang_pajak = (a*angka_pajak2)/100;
				pajak_saja = pajak_saja+uang_pajak;
				$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
				semua = semua+a+uang_pajak;
				angka = angka+a;
				w++;
			});

			var output = semua.toLocaleString();

			$("#total_semua").text(output);
			var output_pajak = angka.toLocaleString();
			$("#sub_total").text(output_pajak);
			var khusus_pajak = pajak_saja.toLocaleString();
			$("#ppn_angka").text(khusus_pajak);
	 	}
	});

	$(document).on('change', '.produk_append',function()
	{
		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		if($(this).val()=='')
 		{
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").data('uang_pajak', 0);
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").data('pajak', '');
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").val('');
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .quantity").val('');
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .harga_satuan").val('');
 			$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .jumlah_uang_produk").val('');
 		}
	});

	$(document).on('click', '#tambah_produk_new_append, #tambah_baru_append_akun, #tambah_produk',function() //menambahkan produk baru tanpa ketik
 	{
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		$("#nama_produk").val("");
 		$("#index_produk").text(rowIndex-1);
	 	$("#modal_produk").modal('toggle');
	 	$('#jual_produk').attr('checked',true);
	 	$("#jual_produk").prop('disabled', true);
	 	$("#beli_produk").attr('checked',true);
 	});

 	$(document).on('click', '#tambah_produk_append',function() //menambahkan produk baru dengan ketik
 	{
 		$('#jual_produk').attr('checked',true);
 		var nama_akun2 = $(this).text().substring(0, $(this).text().indexOf('('));
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		$("#index_produk").text(rowIndex-1);
 		 $("#nama_produk").val(nama_akun2);
 		 $('#jual_produk').attr('checked',true);
	 	$("#jual_produk").prop('disabled', true);
	 	$("#beli_produk").attr('checked',true);
	 	$("#modal_produk").modal('toggle');	
 	});

 	$(document).on('click','#pajak_modal_new',function()
 	{
 		$("#nama_produk").val("");
 		var nama_akun2 = $(this).text().substring(0, $(this).text().indexOf('('));
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		$("#nama_pajak_modal").val(nama_akun2);
	 	$("#tombol_sebelumnya_pajak").text(rowIndex-1);
	 	$("#modal_buat_pajak").modal('toggle');
 	});

 	$(document).on('click', '#pajak_append_baru, #nambah_pajak',function() //menambahkan produk baru tanpa ketik
 	{
 		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		$("#tombol_sebelumnya_pajak").text(rowIndex-1);
	 	$("#modal_buat_pajak").modal('toggle');
 	});

 	$("#tambah_penerimaan2").click(function()
 	{
 		$.ajax({
			url:"/faktur_v2/halaman/penjualan/append_update/index.php",
			method:"POST",
			data:{},
			success:function(data) 
			{
				$('#lama').after(data);
				$(".produk_append").editableSelect({ effects: 'fade', filter: false });
				$(".pajak_append_select").editableSelect({ effects: 'fade', filter: false });
				$(".jumlah_uang_produk").mask('#,##0.00', {reverse: true});
				$(".harga_satuan").mask('#,##0.00', {reverse: true});
			}
		});
 	});

 	$("#simpan-pajak-modal").click(function()
 	{
 		var nama = $("#nama_pajak_modal").val();
		var jumlah = $("#jumlah_pajak_modal").val();
		var akun_pajak_penjualan = $("#akun_pajak_penjualan").val();
		var akun_pajak_pembelian = $("#akun_pajak_pembelian").val();
		var a = $("#tombol_sebelumnya_pajak").text();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/proses-pajak/save_pajak.php",
            type     : "POST",
            data     : {nama:nama, jumlah:jumlah,akun_pajak_penjualan:akun_pajak_penjualan, akun_pajak_pembelian:akun_pajak_pembelian},
            success  : function(data)
            {
            	location.reload();
            	// $("#tabel_pemesanan_penjualan tbody tr:eq("+a+") td .pajak_append_select").val(nama+" | "+jumlah+"%");
            	// $("#tabel_pemesanan_penjualan tbody tr:eq("+a+") td .pajak_append_select").siblings(".es-list").append("<li value='"+nama+" | "+jumlah+"' id='pajak_append_isi' class='pajak_append_isi_value es-visible'>"+nama+" | "+jumlah+" %</li>");

            }
        });
 	});

 	var kode = "<?php echo $_POST['kode_full']; ?>";
 	var dibayar = "<?php echo $_POST['dibayar']; ?>";
	var email = "<?php echo $_POST['email']; ?>";
	var pelanggan = "<?php echo $_POST['pelanggan']; ?>";
	var alamat = "<?php echo $_POST['alamat']; ?>"
	var tgl_transaksi = "<?php echo $_POST['tgl_transaksi']; ?>";
	var tgl_tempo = "<?php echo $_POST['tgl_tempo'] ?>";
	var syarat_pembayaran = "<?php echo $_POST['syarat_pembayaran'] ?>";
	var a = "<?php echo $_POST['sub_total'] ?>";
	var b = parseInt(a);
	var g = "<?php echo $_POST['total_pajak']; ?>";
	var h = parseInt(g);
	var k = "<?php echo $_POST['sisa_tagihan'] ?>";
	var l = parseInt(k);
	var total_pajak = h.toLocaleString();
	var sub_total = b.toLocaleString();

	var sisa_tagihan = l.toLocaleString();
	$("#debit_rahasia").text(k);
	$("#kode_rahasia").text(kode);
	$("#total_semua").text(sisa_tagihan);
	$("#header_amount").text(sisa_tagihan);
	$("#sub_total").text(sub_total);
	$("#ppn_angka").text(total_pajak);
	$("#email").val(email);
	$("#nomor_transaksi").val(kode);
	$("#kontak").val(pelanggan);
	$("textarea#alamat").val(alamat);
	$("#tgl_transaksi").val(tgl_transaksi);
	$("#tgl_tempo").val(tgl_tempo);
	$('#syarat_pembayaran').val(syarat_pembayaran).trigger('change');
	<?php 
	$nama_pajak_ori = $_POST['nama_pajak_ori'];
	$kode =  $_POST['kode'];
	$harga_pajak=$_POST['harga_pajak'];
	$harga_satuan = $_POST['harga_satuan'];
	$harga_stlh_satuan = $_POST['harga_stlh_satuan'];
	$qty_produk = $_POST['qty_produk'];
	$nama_produk = $_POST['nama_produk'];
	// $nama=[];
	// foreach ($nama_produk as $key => $value) 
	// {
	// 	# code...
	// }
	// $sql = "SELECT * from produk where nama_produk ='".$nama_produk."';";
	// $konek = mysqli_connect($connect, $sql);
	// while($data3 = mysqli_fetch_array($konek))
	// {
	// 	echo $data3['kode_produk'];
	// }


	?>
	//----------khusus array
	var harga_pajak1 = "<?php echo $harga_pajak; ?>";
	var harga_satuan1 = "<?php echo $harga_satuan; ?>";
	var harga_stlh_satuan1 = "<?php echo $harga_stlh_satuan; ?>";
	var qty_produk1 = "<?php echo $qty_produk; ?>";
	var nama_produk1 = "<?php echo $nama_produk; ?>";
	var nama_pajak_ori1 = "<?php echo $nama_pajak_ori; ?>";

	var nama_produk = nama_produk1.split(',');
	var qty_produk = qty_produk1.split(',');
	var nama_pajak_ori = nama_pajak_ori1.split(',');
	var harga_satuan = harga_satuan1.split(',');
	var harga_stlh_satuan = harga_stlh_satuan1.split(',');
	var harga_pajak = harga_pajak1.split(',');
	var panjang = nama_produk.length;


	if(panjang >= 1)
	{
		$.each(nama_produk,function(index,obj)
		{

			var p = parseInt(harga_stlh_satuan[index]);
			var z = p.toLocaleString();
			var o = parseInt(harga_satuan[index]);
			var h = o.toLocaleString();
			var $t = $(this);	
			

			if(index == 0)
			{

				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td").find("input.produk_append").val(obj);
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.quantity").val(qty_produk[index]);
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.quantity").val(qty_produk[index]);
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.harga_satuan").val(h+".00");
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.jumlah_uang_produk").val(z+".00");
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.pajak_append_select").val(nama_pajak_ori[index]);
				var myString1 = nama_pajak_ori[index].substr(nama_pajak_ori[index].indexOf("|") + 1);
				var angka_pajak21 = myString1.split("%").join("");
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.pajak_append_select").data('pajak', angka_pajak21);
				$("#tabel_pemesanan_penjualan tbody tr:eq("+index+") td div").find("input.pajak_append_select").data('uang_pajak',harga_pajak[index]);
			}
			else if (index > 0) 
			{	 
				$.ajax({
					url:"/faktur_v2/halaman/penjualan/append_lawas/index.php",
					method:"POST",
					data:{},
					success:function(data) 
					{
						$('#lama').after(data);
						$(".produk_append").editableSelect({ effects: 'fade', filter: false });
						$(".pajak_append_select").editableSelect({ effects: 'fade', filter: false });
						$(".harga_satuan").mask('#,##0.00', {reverse: true});
						$(".jumlah_uang_produk").mask('#,##0.00', {reverse: true});
						$("#tabel_pemesanan_penjualan tbody tr:eq(1) td").find("input.produk_append").val(obj);
						$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.quantity").val(qty_produk[index]);
					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.quantity").val(qty_produk[index]);
					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.harga_satuan").val(h+".00");
					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.jumlah_uang_produk").val(z+".00");
					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.pajak_append_select").val(nama_pajak_ori[index]);
					var myString1 = nama_pajak_ori[index].substr(nama_pajak_ori[index].indexOf("|") + 1);
					var angka_pajak21 = myString1.split("%").join("");

					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.pajak_append_select").data('pajak', angka_pajak21);
					$("#tabel_pemesanan_penjualan tbody tr:eq(1) td div").find("input.pajak_append_select").data('uang_pajak',harga_pajak[index]);
					}
				});
			}
				
		});

	}

	function mentotal_uang()
	{
		var pajak_saja = parseInt(0);
		var semua = parseInt(0);
		var angka = parseInt(0);
		var w = parseInt(0);
		$(".uang").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('pajak');
			var angka_pajak2 = parseInt(angka_pajak) || 0;
			var uang_pajak = (a*angka_pajak2)/100;
			pajak_saja = pajak_saja+uang_pajak;
			$("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			semua = semua+a+uang_pajak;
			angka = angka+a;
			w++;
		});
		var output = semua.toLocaleString();
		$("#total_semua").text(output);
		var output_pajak = angka.toLocaleString();
		$("#sub_total").text(output_pajak);
		var khusus_pajak = pajak_saja.toLocaleString();
		$("#ppn_angka").text(khusus_pajak);
	}



	$(document).on('click', '.kurangi',function(e)
	{
		e.preventDefault();
		var rowIndex = $('#tabel_pemesanan_penjualan tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var kode_transaksi22= $("#nomor_transaksi").val();
 		var a = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .produk_append").val();
		 var b = $("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .jumlah_uang_produk").val();
		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .jumlah_uang_produk").val("");
		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .quantity").val("");
		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .produk_append").val("");
		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .harga_satuan").val("");
		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td .pajak_append_select").val("");
		var pajak_saja = parseInt(0);
		var semua = parseInt(0);
		var angka = parseInt(0);
		var w = parseInt(0);
		$(".jumlah_uang_produk").each(function()
		{
			var z = $(this).val();
			var k = z.split(",").join("");
			
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('pajak');
			var angka_pajak2 = parseInt(angka_pajak) || 0;
			var uang_pajak = (a*angka_pajak2)/100;
			pajak_saja = pajak_saja+uang_pajak;
			$("#tabel_pemesanan_penjualan tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
			semua = semua+a+uang_pajak;
			angka = angka+a;
			w++;
		});
			var output = semua.toLocaleString();
			$("#total_semua").text(output);
			var output_pajak = angka.toLocaleString();
			$("#sub_total").text(output_pajak);
			var khusus_pajak = pajak_saja.toLocaleString();
			$("#ppn_angka").text(khusus_pajak);
 		var nama_produk = a;
 		var uang_produk = b.split(",").join("");
 		var nama_pajak_spesifik = [];	
 		var uang_pajak_spesifik = [];
 		var uang_perproduk = [];
 		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+") td div input.pajak_append_select").each(function()
 		{
 			 var g = $(this).data('uang_pajak');
 			uang_pajak_spesifik.push(g);
 			var a = $(this).val();
 			nama_pajak_spesifik.push(a);
 		});
 		$("#tabel_pemesanan_penjualan tbody tr:eq("+h+")").remove();
 		$.ajax({
			url:"/faktur_v2/halaman/penjualan/update/delete-query/index.php",
			method:"POST",
			data:{kode_transaksi22:kode_transaksi22, nama_produk:nama_produk, uang_produk:uang_produk, nama_pajak_spesifik:nama_pajak_spesifik, uang_pajak_spesifik:uang_pajak_spesifik},
			success:function(data) 
			{
				// alert(data);
			}
		});
	});

 	$("#buat_penjualan").click(function(e)
 	{

 		e.preventDefault();

 		var kode_rahasia = $("#kode_rahasia").text();
		var nomor_transaksi =$("#nomor_transaksi").val();

 		var kontak = $("#kontak").val();
 		var email = $("#email").val();
 		var alamat = $("#alamat").val();
 		var tgl_transaksi = $("#tgl_transaksi").val();
 		var tgl_tempo = $("#tgl_tempo").val();
 		var syarat_pembayaran = $("#syarat_pembayaran option:selected").text();
 		var no_ref_pelanggan = $("#no_ref_pelanggan").val();
 		var pesan = $("textarea#pesan").val();
 		var memo = $("textarea#memo").val();
		// var tag = $("#tag").val();

 		var total = $("#total_semua").text();
 		var total_semuanya = total.split(",").join("");

 		var nama_pajak = [];
 		var uang_pajak = [];
 		var nama_produk = [];
 		var deskripsi = [];
 		var quantity = [];
 		var harga_satuan = [];
 		var jumlah_uang_produk = [];
 		var uang_perproduk_pajak = [];

 		$(".pajak_append_select").each(function(index) 
		{
			var nama = $(this).val();
			var uang = $(this).data('uang_pajak');
			if (uang == '')
			{
				uang = parseInt(0);
			}

			if (nama == '') 
			{
				nama = '';
			}
			uang_pajak.push(uang);
			nama_pajak.push(nama);
		});	

		$(".produk_append").each(function(index) 
		{
			var a = $(this).val();
			if(a == '' )
			{
				a="";
				nama_produk.push(a);
			}
			else
			{
				a = $(this).val();
				nama_produk.push(a);
			}			
		});

		$(".quantity").each(function()
		{
			var a = $(this).val();
			quantity.push(a);
		});

		$(".harga_satuan").each(function()
		{
			var a = $(this).val();
			var sum = a.split(",").length-1;
			if(sum > 0)
			{
				var b = a.split(",").join("");
				harga_satuan.push(b);
			}
			else
			{
				a = $(this).val();
				harga_satuan.push(a);
			}
		});

		$(".jumlah_uang_produk").each(function()
		{
			var a = $(this).val();
			var sum = a.split(",").length-1;
			if(sum > 0)
			{
				var b = a.split(",").join("");
				jumlah_uang_produk.push(b);
			}
			else
			{
				a = $(this).val();
				jumlah_uang_produk.push(a);
			}
		}); 

 		$.ajax
        ({
            url      : "/faktur_v2/halaman/penjualan/update/update-query/update.php",
            type     : "POST",
            dataType : 'json',
            data     : {kode_rahasia:kode_rahasia, nomor_transaksi:nomor_transaksi, kontak:kontak, email:email, alamat:alamat, tgl_transaksi:tgl_transaksi, tgl_tempo:tgl_tempo, syarat_pembayaran:syarat_pembayaran, no_ref_pelanggan:no_ref_pelanggan, pesan:pesan, memo:memo, total_semuanya:total_semuanya, nama_pajak:nama_pajak, uang_pajak:uang_pajak, nama_produk:nama_produk, quantity:quantity, harga_satuan:harga_satuan, jumlah_uang_produk:jumlah_uang_produk, sdh_dibayar:dibayar,uang_perproduk_pajak:uang_perproduk_pajak},
            success  : function(data)
            {
            	if(data.code == "berhasil")
				{
					var url = '/faktur_v2/halaman/report/penjualan.php';
					var form = $('<form action="' + url + '" method="post">' +
					'<input type="text" name="kode" value="' + nomor_transaksi + '" />' +
					'</form>');
					$('body').append(form);
					form.submit();
				}
				else
				{
					swal("Cek kembali", "Masih ada yang kosong", "error");
				}
            		
        	
            	
            }
        });
 	});

 	 $("#simpan-kontak").click(function(e)
    {
    	e.preventDefault();
    	var nama_kontak = $("#nama_panggilan").val();
    	var tipe = [];
    	var tipe_kontak ='';
    	 $.each($("input[name='tipe']:checked"), function()
		{
			tipe.push($(this).val());
			var tipe_kontak = $(this).val();
        });
    	var person_phone = $("#person_phone").val();
    	var alamat_kontak = $("#person_billing_address").val();
    	var email_kontak = $("#person_email").val();

    	$.ajax({
            url      : "/faktur_v2/halaman/proses-kas/save_kontak.php",
            type     : "POST",
            dataType :'json',
            data     : {tipe_kontak:tipe_kontak, nama_kontak:nama_kontak, person_phone:person_phone, alamat_kontak:alamat_kontak, email_kontak:email_kontak, tipe:tipe},
            success  : function(data)
            {
				if(data.code == "berhasil")
			    {
                	setTimeout(function(){
					    location.reload(); 
					    }, 1000);
			          	swal("Kontak telah tambahkan", "", "success");
            	}
				else
				{
					swal("Cek kembali", "Masih ada yang kosong", "error");
				}	
			}
		});	
    });

 	$("#simpan-produk-modal").click(function()
 	{
 		if ($('#beli_produk').is(":checked"))
		{
			var pembelian_akun_kemana = $("#pembelian_akun_kemana").val();
			var harga_beli_satuan = $("#harga_beli_satuan").val();
		}
		else
		{
			var pembelian_akun_kemana = "0";
			var harga_beli_satuan = "0";
		}
		var harga_jual_satuan = $("#harga_jual_satuan").val();
		var penjualan_akun_kemana = $("#penjualan_akun_kemana").val();
		var nama_produk = $("#nama_produk").val();
		var kode_produk = $("#kode_produk").val();
		var quantity = $("#quantity").val();
		var a = $("#index_produk").text();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/penjualan/proses-produk/save_produk.php",
            type     : "POST",
            data     : {pembelian_akun_kemana:pembelian_akun_kemana, harga_beli_satuan:harga_beli_satuan, harga_jual_satuan:harga_jual_satuan, penjualan_akun_kemana:penjualan_akun_kemana, nama_produk:nama_produk, kode_produk:kode_produk, quantity:quantity},
            success  : function(data)
            {
            	// alert(data);
            	location.reload();
            	// $("#tabel_pemesanan_penjualan tbody tr:eq("+a+") td .produk_append").val(kode_produk+" | "+nama_produk);
            	// $("#tabel_pemesanan_penjualan tbody tr:eq("+a+") td .produk_append").siblings(".es-list").append("<li value='"+kode_produk+" | "+nama_produk+"' id='produk_isi' class='produk_isi es-visible'>"+kode_produk+" | "+nama_produk+"</li>");

            }
        });
 	});	
	
	


});
</script>
