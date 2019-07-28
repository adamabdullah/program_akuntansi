<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
  
include('../../../config/connect.php');   
include('../../../config/sql/querys.php');
include('../../../include/include.php');
include('../../../modal/modal.php');

$sql_0101_kontak = "SELECT * FROM kontak";
$result_0101_kontak = mysqli_query($connect,$sql_0101_kontak);

$sql_akun = "SELECT * FROM akun";
$result_0101_akun = mysqli_query($connect,$sql_akun);

$query = "SELECT max(ExtractNumber(kode_transaksi)) as no_transaksi from transaksi_akun where kolom='biaya'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$count = mysqli_num_rows($hasil);
if(isset($data['no_transaksi'])) 
{
	$kodeBarang = $data['no_transaksi'];
	$noUrut = (int)$kodeBarang; 
	$noUrut++; 
	$kodeBarang = $noUrut;
	?>
		<div id="keterangan" style="display: none;">Expenses # <?php echo $kodeBarang; ?></div>
	<?php
}
else
{
	$kodeBarang = "Expenses # 10000";
	?>
	<div id="keterangan" style="display: none;"><?php echo $kodeBarang; ?></div>
	<?php	
}

head(); //call func head from include php
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper"> 

        <section>
            
				<div class="row content">
					<label id="context-form" value="<?php echo $_POST['jenis']?>" hidden><?php echo $_POST['jenis']?></label>					
					<div class="col-sm-12 col-md-12 col-lg-6" style="text-align:left">
						
							<h2><small>Biaya</small><br>
								<p class="text-primary" id="context-span">Buat Biaya</p>
							</h2>
						
					</div>
				</div>   
				
				<div class="form_biaya">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* Bayar Dari</strong>
									
									<select id="akun" class="form-control">
								    <option id="akun_tambah"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan akun</option>
									<?php
									while($data_0101_akun = mysqli_fetch_array($result_0101_akun))
									{
										?>
											<option value="<?php echo $data_0101_akun['nama']; ?>" class="akun_append_isi"><?php echo $data_0101_akun['kode_akun']." | ".$data_0101_akun['nama_akun'];  ?></option>
										<?php
									}
									?>									
									</select>
									
								</div>
							
								<br>
								<div></div>
									<span class="text-danger">
										<strong id="bayar_dari-errors"></strong>
									</span>	
								<!-- <div class="col-xs-10 col-sm-4 col-md-3">
									<input type="checkbox" id="cek"><strong>Bayar Nanti</strong>
								</div> -->
									

								<div class="col-xs-6 col-sm-4 col-md-3 pull-right">
									<h2><strong>Total <a class="text-light-blue"> Rp. 0,00</a></strong></h2>
								</div>
							</div>
						</div>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Penerima</label>
									<br>
									<select id="kontak" class="form-control">
								    <option id="kontak_baru"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan kontak</option>
									<?php 
									while($data_0101_kontak = mysqli_fetch_array($result_0101_kontak))
									{
										$cek_kontak = $data_0101_kontak['tipe_kontak']; 
										// if (strpos($cek_kontak, 'Supplier') !== false) 
										// {
										    ?>
											<option value="<?php echo $data_0101_kontak['nama']; ?>" class="kontak_penerima"><?php echo $data_0101_kontak['nama']; ?></option>
										<?php
										// }
										// else
										// {
										    			
										// } 
									} ?>										
									</select>
								
									<!-- <textarea class="form-control" id="alamat" style="resize:vertical;" name="" id="" cols="30" rows="10"></textarea> -->
								</div>
								<div class="form-group">
									
										<span class="text-danger">
											<strong id="kontak-errors"></strong>
										</span>
								
								</div>
								<div class="form-group">
									<label>Alamat Penagihan</label>
									<textarea class="form-control" id="alamat" style="resize:vertical;" name="" id="" cols="30" rows="10"></textarea>
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
										<input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="tgl_transaksi">
									</div>
									<!-- /.input group -->
								</div>
								
								<div class="form-group" id="form-group-sp">
									<label>Syarat Pembayaran</label>
									<div class="input-group select">
									<div class="input-group-addon">
										<i class="fa fa-calendar-o"></i>
									</div>
										<select class="form-control select2" style="width: 100%;" id="syarat_pembayaran">
											<option></option>
											<option>Custom</option>
											<option>Net 30</option>
											<option>Cash On Delivery</option>
											<option>Net 15</option>
											<option>Bet 60</option>
										</select>
									</div>
								</div>
							<!-- /.form-group -->
							</div>
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Cara Pembayaran</label>
									<div class="input-group select">
										<select id="cara" class="form-control select2" style="width: 100%;" data-placeholder="Cara Pembayaran">
											<option></option>
											<option>Cek & Giro</option>
											<option>Kartu Kredit</option>
											<option>Kas/Tunai</option>
											<option>Transfer Bank</option>
										</select>
									</div>
									<div></div>
									<span class="text-danger">
										<strong id="cara_pembayaran-errors"></strong>
									</span>
								</div>
							<!-- /.form-group -->

							</div>

							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>No Biaya</label>
									<div class="input-group text">
									<div class="input-group-addon">
										<i class="fa fa-gear"></i>
									</div>
										<input type="text" id="no_biaya" class="form-control" readonly>
									</div>
								</div>
							<!-- /.form-group -->

							</div>
						</div>
						
						<!-- /.row -->
						<!-- <div class="row">
							<div class="col-lg-7 col-md-7 col-xs-10 col-sm-12 pull-right">
									<div class="pull-right">
										<h2><label>Harga Termasuk Pajak </label>
										<label class="switch">
											<input type="checkbox" checked>
											<span class="slider round"></span>
										</label></h2>
									</div>
							</div>
						</div> -->
					</div>

					<div class="container-fluid">
						<div class="box">						
							<div class="box-body no-padding">
								<table id="tabel_terima_uang" class="table table-border" style="width:100%">
							        <thead>
							            <tr>
							                <th>Akun Biaya</th>
							                <!-- <th>Deskripsi</th> -->
							                <th>Pajak</th>
							                <th>Jumlah</th>
							                <th></th>
							            </tr>
							        </thead>
							        <tbody>
							        	<tr id="colom_tabel_lama_terima_uang">
										    <td>
									        	<div class="row">
									        		<div class="col-md-11">
									        			<select id="akun_terima_dari_tabel" class="form-control akun_append">
									        				<option id="akun_terima_dari_tabel_baru"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan akun</option>
																<?php
																	$sql0 = "SELECT * FROM akun";
																	$result0 = mysqli_query($connect, $sql0);
																	while($data0 = mysqli_fetch_array($result0))
																	{
																		?>
																			<option value="<?php echo $data0['nama_akun'] ?>" class="pmbyrn"><?php echo $data0['kode_akun']." | ".$data0['nama_akun']; ?></option>
																		<?php
																	}
																?>
														</select>
									        		</div>
									        	</div>
									        	<div></div>
												<span class="text-danger">
													<strong id="akun_terima-errors"></strong>
												</span>	
									        </td>
									       <!--  <td>
										        <div class="row">
											        <div class="col-md-11">
										        		<input type="text" class="form-control deskripsi">		
										        	</div>
										        </div>
										    </td> -->
										    <td>
										    	<div class="row">
										    		<div class="col-md-11">
										    			<select id="pajak_terima_uang" class="form-control pajak_append_select" data-pajak="" data-uang_pajak="">
									        				<option id="nambah_pajak_baru_terima_uang"><i class="fa fa-plus" ></i>&nbsp;Ketuk untuk menambahkan pajak</option>
															<?php
																$sql0 = "SELECT * FROM pajak";
																$result0 = mysqli_query($connect, $sql0);
																while($data0 = mysqli_fetch_array($result0)) 
																{
																	?>
																		<option value="<?php echo $data0['nama_pajak'].',';?>" class="pajak_append_isi" data-value="<?php echo $data0['nama_pajak'].'-'.$data0['berapa_persen'].',';?>" ><?php echo $data0['nama_pajak']." | ".$data0['berapa_persen']."%"; ?></option>
																	<?php
																}
																	?>
														</select>
										    		</div>
										    	</div>
										    </td>
										    <td>
										        <div class="row">
											        <div class="col-md-11">
										        		<input type="text" class="form-control uang" data-uang=""></input>		
										        	</div>
										        </div>
										        <div></div>
												<span class="text-danger">
													<strong id="uang-errors"></strong>
												</span>
										    </td>
										   
									    </tr>
									    <br>
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
					</div>


            
                
                <div class="row">
					<div class="container-fluid"> 
						<div class="col-lg-6 col-sm-12">
						
							<div class="form-group">
								<label><strong>Memo</strong></label>
								<br>
								<textarea id="memo" cols="40"  style="resize: vertical; min-height:40px;"></textarea>
							</div>
							
						</div>
						<div class="col-lg-6 col-sm-12">
							<div class="form-group">
								<h4>Sub Total <p class="pull-right" id="sub_total">Rp. 0,00</p></h4>
							</div>
							<div class="form-group">
								<h4><b>Total Pajak</b> <p class="pull-right" id="ppn_angka"></p></h4>
							</div>
							<div class="form-group" id="pemesanan-only">

								<h2><b>Sisa Tagihan<p class="pull-right" id="total_semua"></p></b></h2>
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
							<button type="button" class="btn btn-primary" id="beli_biaya">
								<i class="fa fa-plus"></i> Buat Biaya Baru
							</button>
							</div>
						</div>
					</div>
				</div>
			</div>
				
        </section> 
    </div>

<?php body_bottom(); ?>
<script src="/faktur_v2/dist/js/jquery.mask.js"></script>
<script>
$(document).ready(function() 
{
	$(".select2").select2();
	$("#akun").editableSelect({ effects: 'fade', filter: false });
	var p = parseInt(0);

	var keterangan = $("#keterangan").text();
	$("#no_biaya").val(keterangan);

	$(".uang").mask('#.##0', {reverse: true});	
	$(".select2").select2();

	$("#pelanggan").select2({
	    placeholder: "Pilih Kontak",
	    allowClear: true
	});

	$("#cara_pembayaran").select2({
		placeholder: "Pilih Kontak",
	    allowClear: true
	})
	// $("#cek").change(function(){
	// 	// alert("");
	// 	//document.GetElemetById('form-group-sp').style.display("none");
		
	// });

	$("#kontak").editableSelect({ effects: 'fade', filter: false });
	$(".akun_append").editableSelect({ effects: 'fade', filter: false });
	$(".pajak_append_select").editableSelect({ effects: 'fade', filter: false });
	$("#akun").editableSelect({ effects: 'fade', filter: false });



	$('#form-group-sp').hide();
	$('#form-group-tempo').hide();

	// function addCommas(nStr)
	// {
	// 	nStr += '';
	// 	x = nStr.split('.');
	// 	x1 = x[0];
	// 	x2 = x.length > 1 ? '.' + x[1] : '';
	// 	var rgx = /(\d+)(\d{3})/;
	// 	while (rgx.test(x1)) {
	// 		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	// 	}
	// 	return x1 + x2;
	// }

	$(window).click(function()
		{
			var akun = $("#akun").val();
			var tanpa_spasi="";
			var sum2 = akun.split("|").length - 1;
			if (sum2 > 0)
			{
	 			var parts_lain = akun.split('|', 2);
				var b = parts_lain[1];
				tanpa_spasi = $.trim(b);

			}
			else
			{
				tanpa_spasi = akun;
			}
			$.ajax({
				url:"/faktur_v2/halaman/proses-kas/cek_akun_modal_append.php",
				method:"POST",
				data:{query:tanpa_spasi},
				  beforeSend: $.proxy(function(data) {
        		}, this),
				success:function(data)
				{
					if(data == "ada")
					{
						
					}
					else
					{
						$("#akun").val("");
					}
				}
				});


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
	 		$(".akun_append").each(function()
			{
				var a = $(this).val();
				var $t = $(this);
				var tanpa_spasi="";
				var sum = a.split("|").length - 1;
				if (sum > 0)
				{
		 			var parts_lain = a.split('|', 2);
					var b = parts_lain[1];
					tanpa_spasi = $.trim(b);
				}
				else
				{
					tanpa_spasi = a;
				}
				$.ajax({
					url:"/faktur_v2/halaman/proses-kas/cek_akun_modal_append.php",
					method:"POST",
					data:{query:tanpa_spasi},
					  beforeSend: $.proxy(function(data) {
	        		}, this),
					success:function(data)
					{
						if(data == "ada")
						{
							
						}
						else
						{
							$t.val("");
						}
					}
					});
			});
			$(".pajak_append_select").each(function()
			{
				var a = $(this).val();
				var $v = $(this);
				var tanpa_spasi="";
				var sum = a.split("|").length - 1;
				if (sum > 0)
				{
		 			var streetaddress= a.substr(0, a.indexOf('|')); 
					tanpa_spasi = $.trim(streetaddress);
				}
				else
				{
					tanpa_spasi = a;
				}
				 $.ajax({
					url:"/faktur_v2/halaman/proses-pajak/check_pajak_append.php",
					method:"POST",
					data:{query:tanpa_spasi},
					success:function(data)
					{
						if(data == "ada")
						{
							// alert("ada");
						}
						else
						{
							// alert("gak ada");
							$v.val("");
						}
					}
					});
			});
	 	});
	function cari_kontak(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/biaya/proses-kontak/cari_kontak.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$("#kontak").each(function(index) 
			{
				if ($(this).val() == query) 
				{
					$(this).siblings('.es-list').find('.kontak_penerima').hide();
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


	// $(document).on('click','.kontak_penerima',function()
	// {
	// 	check_kontak($(this).val());
	// });

	$(document).on('click','#kontak_baru',function()
	{
		$("#tambah_kontak_modal").modal('toggle');
	});

	$(document).on('click','#kontak_penerima_new',function()
	{
		$("#nama_panggilan").val($(this).text());
		$("#check_box input[value='Supplier,']").prop('checked', true);
		$("#tambah_kontak_modal").modal('toggle');
	});	

	function cari_nama_akun_append(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/cari_akun.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$(".akun_append").each(function(index) 
			{
				if ($(this).val() == query) 
				{
					$(this).siblings('.es-list').find('.pmbyrn').hide();
					$(this).next().html(data);
		            //Text found in div 
		        }
			});

		}
		});
 	}

 	function cari_nama_akun_append2(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/cari_akun_biaya.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$("#akun").each(function(index) 
			{
				if ($(this).val() == query) 
				{
					$(this).siblings('.es-list').find('.pmbyrn').hide();
					$(this).next().html(data);
		            //Text found in div 
		        }
			});

		}
		});
 	}

 	function check_akun(query)
 	{
 		var tanpa_spasi= "";
		var $t = $(this);
		if ( query.split("|").length - 1)
		{
 			var parts_lain = query.split('|', 2);
			var b = parts_lain[1];
			tanpa_spasi = $.trim(b);
		}
		else
		{
			tanpa_spasi = query;
		}
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/check_akun.php",
		method:"POST",
		data:{query:tanpa_spasi},
		success:function(data)
			{
				if(data == "ada")
				{
				}
				else
				{					
					var nama_akun2 = query.substring(0, query.indexOf('('));
					$("#nama_akun_modal").val(nama_akun2);
	 				$("#modal_nambah_akun").modal('toggle');	
				}
			}
		});
 	}

 	function cari_nama_pajak(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-pajak/cari_pajak.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
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
	
	$('#cek').click(function () 
	{
         var $this = $(this);
         if ($this.is(':checked')) 
         {
			 $('#form-group-sp').show();
			 $('#form-group-tempo').show();
			 $("#akun").prop('disabled', 'disabled');
			 
         } 
         else 
         {
			 $('#form-group-sp').hide();
			 $('#form-group-tempo').hide();
			 $("#akun").prop('disabled', false);
         }
     });

	$(document).on('keyup', '.akun_append',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		cari_nama_akun_append(id4);
	});

	$(document).on('keyup', '.pajak_append_select',function() //------------------------------untuk mengecek (akun)
	{
		var id4 = $(this).val();
		cari_nama_pajak(id4);
	});

	$(document).on('keyup', '.uang', function()
	{

		// var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
		// var j = rowIndex-1;
		// var angka_pajak = $("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak');
		// var uang = $(this).val();
		// var hasil = (uang*angka_pajak)/100;
		// var grand_total = uang+hasil;		
		// var t = $("#tabel_terima_uang tbody tr:eq("+j+") td .uang").data('uang');
		$("#total_semua").text("");
		var semua = parseInt(0);
		var angka = parseInt(0);
		var pajak_saja = parseInt(0);
		var w = 0;
		$(".uang").each(function()
		{
			var z = $(this).val();
			var k = z.split(".").join("");
			var a = parseInt(k) || 0;
			var angka_pajak = $("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('pajak') || 0;
			var uang_pajak = (a*angka_pajak)/100;
			semua = semua+a+uang_pajak;
			$("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
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

	$(document).on('change', '.pajak_append_select',function()
	{
		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		var w = parseInt(0);
		if($(this).val() == '')
		{
			$("#tabel_terima_uang tbody tr:eq("+h+") td .pajak_append_select").data('uang_pajak', 0);
 			$("#tabel_terima_uang tbody tr:eq("+h+") td .pajak_append_select").data('pajak', '');
			var pajak_saja = parseInt(0);
			var semua = parseInt(0);
			var angka = parseInt(0);
			$(".uang").each(function()
			{
				var z = $(this).val();
				var k = z.split(".").join("");
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
	});

	$(document).on('click', '.pajak_append_isi',function() //------------------------------untuk mengecek (akun)
	{
		// alert($(this).text());
		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
		var j = rowIndex-1;
		var id4 = $(this).text();
		var myString = id4.substr(id4.indexOf("|") + 1);
		var angka_pajak2 = myString.split("%").join("");
		$("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak', angka_pajak2);
		var pajak_saja = parseInt(0);
		var semua = parseInt(0);
		var angka = parseInt(0);
		var w = parseInt(0);
		$(".uang").each(function()
		{
			var z = $(this).val();
			var k = z.split(".").join("");
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

		// $("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak', angka_pajak);
	});

	$(document).on('click','#pmbyrn_modal_new',function()
	{
		var nama= $(this).text();
		$("#nama_akun_modal").val(nama);
		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
		$("#tombol_sebelumnya").text(rowIndex-1);
 		$("#modal_nambah_akun").modal('toggle');
 	});

 	$(document).on('keyup', '.akun_append',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		cari_nama_akun_append(id4);
	});

	$(document).on('keyup', '#akun',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		cari_nama_akun_append2(id4);
	});

 	$(document).on('click', '#pajak_modal_new', function() //dengan diketik
 	{
 		var nama= $(this).text();
 		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		$("#nama_pajak_modal").val(nama);
 		$("#tombol_sebelumnya_pajak").text(rowIndex-1);
 		$("#modal_buat_pajak").modal('toggle');
 	});

 	$(document).on('click','.penerima_modal',function(e)
 	{
 		$("#modal_akun_biaya").modal('toggle');
 	});

 	$(document).on('click','.penerima_modal2',function(e)
 	{
 		var akun = $(this).text();
 		$("#nama_akun_biaya").val(akun);
 		$("#modal_akun_biaya").modal('toggle');
 	});

 	$(document).on('click','#akun_tambah',function(e)
 	{
 		$("#modal_akun_biaya").modal('toggle');
 	});

 	$(document).on('click', '#akun_terima_dari_tabel_baru, #kontak_penerima_modal_akun, #tambah_baru_append_akun',function()
	{
		$("#nama_akun_modal").val("");
		 var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		$("#tombol_sebelumnya").text(rowIndex-1);
 		$("#modal_nambah_akun").modal('toggle');
	});

	$(document).on('click', '#nambah_pajak_baru_terima_uang, #pajak_append_baru, #nambah_pajak', function()
 	{
 		$("#nama_pajak_modal").val("");
 		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		$("#tombol_sebelumnya_pajak").text(rowIndex-1);
 		$("#modal_buat_pajak").modal('toggle');
 	});

 	$("#beli_biaya").click(function()
 	{
 		var grand = $("#total_semua").text();
 		var total_uang_tnpa_koma = grand.split(",").join("");
 		var tgl_transaksi = $("#tgl_transaksi").val();
 		var tgl_tempo = "";
 		var syarat_pembayaran = "";
 		var akun_bayar = $("#akun").val();
 		var penerima = $("#kontak").val();
 		var cara_pembayaran = $("#cara").val();
 		var no_biaya = $("#no_biaya").val();
 		var memo = $("textarea#memo").val();
		// var tag = $("#tags").val();

 		var uang_per_akun = [];
 		var uang_pajak_perakun = [];
 		var nama_pajak = [];
 		var deskripsi = [];
 		var akun = [];
 		$(".uang").each(function()
 		{
 			var a = $(this).val();
 			var sum = a.split(".").length - 1;
 			var z = "";
			if (sum > 0)
			{
				z = a.split(".").join("");	
			}
			else
			{
				z = $(this).val();
			}
 			uang_per_akun.push(z);
 		});

 		$(".pajak_append_select").each(function()
 		{
 			var g = $(this).data('uang_pajak');
 			uang_pajak_perakun.push(g);
 			var a = $(this).val();
 			nama_pajak.push(a);
 		});

 		// $(".deskripsi").each(function()
 		// {	
 		// 	var a = $(this).val();
 		// 	deskripsi.push(a);
 		// });

 		$(".akun_append").each(function()
 		{
 			var a = $(this).val();
 			akun.push(a);
 		});

 		var checked_byr_nanti = "off";
 		checked_byr_nanti = $("#cek:checked").val() || 0;
 		if(checked_byr_nanti == "on")
 		{
 			tgl_tempo = $("#tgl_tempo").val();
 			syarat_pembayaran = $("#syarat_pembayaran").val();
 		}



 		//----kalo dicentang bayar nanti, maka posisi akun jadi debit dan hutang usaha jadi kredit

 		$.ajax({
			url:"/faktur_v2/halaman/biaya/save_biaya/save_biaya.php",
			method:"POST",
			dataType :'json',
			data:{ akun_bayar:akun_bayar, total_uang_tnpa_koma:total_uang_tnpa_koma, tgl_transaksi:tgl_transaksi, tgl_tempo:tgl_tempo, syarat_pembayaran:syarat_pembayaran, cara_pembayaran:cara_pembayaran, uang_per_akun:uang_per_akun, nama_pajak:nama_pajak, deskripsi:deskripsi, akun:akun, no_biaya:no_biaya, penerima:penerima, cara_pembayaran:cara_pembayaran, uang_pajak_perakun:uang_pajak_perakun, syarat_pembayaran:syarat_pembayaran, memo:memo, checked_byr_nanti:checked_byr_nanti},
			success:function(data) 
			{
				if(data.code == "berhasil")
				{
					var url = '/faktur_v2/halaman/report/biaya.php';
					var form = $('<form action="' + url + '" method="post">' +
					'<input type="text" name="kode" value="' + no_biaya + '" />' +
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

	$("#tambah_penerimaan2").click(function()
 	{
 		p++;
 		$.ajax({
			url:"/faktur_v2/halaman/proses-kas/membuat_pembayaran_baru.php",
			method:"POST",
			data:{},
			success:function(data) 
			{
				$('#colom_tabel_lama_terima_uang').after(data);
				$(".akun_append").editableSelect({ effects: 'fade', filter: false });
				$(".pajak_append_select").editableSelect({ effects: 'fade', filter: false });				
				$(".uang").mask('#.##0', {reverse: true});
			}
		});
	 });
	 
	// $(document).on('click','.kurangi',function(e)
 	// {
 	// 	e.preventDefault();
	// 	var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 	// 	var h = parseInt(rowIndex-1);
 	// 	$("#tabel_terima_uang tbody tr:eq("+h+")").remove();
	//  });
	 
	 $(document).on('click','.kurangi',function(e)
 	{
 		e.preventDefault();
		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
		var h = parseInt(rowIndex-1);
		$("#tabel_terima_uang tbody tr:eq("+h+") td .pajak_append_select").data('pajak', '');
		$("#tabel_terima_uang tbody tr:eq("+h+") td .pajak_append_select").data('uang_pajak', '');
		$("#tabel_terima_uang tbody tr:eq("+h+") td .pajak_append_select").val("");
		$("#tabel_terima_uang tbody tr:eq("+h+") td .akun_append").val("");
		$("#tabel_terima_uang tbody tr:eq("+h+") td .uang").val("");
		$("#tabel_terima_uang tbody tr:eq("+h+")").remove();
		var pajak_saja = parseInt(0);
		var semua = parseInt(0);
		var angka = parseInt(0);
		var w = parseInt(0);
		$(".uang").each(function()
		{
			var z = $(this).val();
			var k = z.split(".").join("");
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

 	$("#simpan-akun").click(function()
    {
    	var nama_akun_modal = $("#nama_akun_modal").val();
    	var nomor_akun_modal = $("#nomor_akun_modal").val();
    	var kategori_modal = $("#kategori_modal").val();
    	// var pajak_modal = $("#pajak_modal").val();
    	var a = $("#tombol_sebelumnya").text();
    	$.ajax
        ({
            url      : "/faktur_v2/halaman/proses-kas/save_akun.php",
            type     : "POST",
            data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal},
            success  : function(data)
            {
            	location.reload();
    //         	$("#tabel_terima_uang tbody tr:eq("+a+") td .akun_append").val(nama_akun_modal);
				// $("#tabel_terima_uang tbody tr:eq("+a+") td .akun_append").siblings(".es-list").append("<li value='"+nomor_akun_modal+" | "+nama_akun_modal+"' id='pajak_append_isi' class='pajak_append_isi_value es-visible'>"+nomor_akun_modal+" | "+nama_akun_modal+"</li>");
				
            }
        });
    });

    $("#simpan-akun-biaya").click(function()
    {
    	var nama_akun_modal = $("#nama_akun_biaya").val();
    	var nomor_akun_modal = $("#nomor_akun_biaya").val();
    	var kategori_modal = $("#kategori_modal_biaya").val();
    	// var pajak_modal = $("#pajak_modal").val();
    	// var a = $("#tombol_sebelumnya").text();
    	$.ajax
        ({
            url      : "/faktur_v2/halaman/proses-kas/save_akun.php",
            type     : "POST",
            data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal},
            success  : function(data)
            {
            	location.reload();
            	// alert(data);
				
            }
        });
    });


});
</script>

</body>
</html>