<?php
include('../../config/connect.php'); 
include('../../config/sql/querys.php');
include('../../include/include.php');
include('../../modal/modal.php'); 
head(); //call func head from include php


if($_SESSION['write'] === "disabled"){
	//echo $_SESSION['write'];
	header("location:/faktur_v2/"); 
}else{ 
   
		// mencari kode barang dengan nilai paling besar 
		// $query = "SELECT max(no_transaksi_kirim) as maxKode FROM kirim_uang";
		$query2 = "SELECT kode_transaksi as no_transaksi_kirim from transaksi where kolom='kirim_uang'"; 
		$hasil2 = mysqli_query($connect,$query2);
		$data2 = mysqli_num_rows($hasil2);
  
		$query = "SELECT max(ExtractNumber(kode_transaksi)) as no_transaksi_kirim from transaksi where kolom='kirim_uang'";
		$hasil = mysqli_query($connect,$query);
		$data = mysqli_fetch_array($hasil); 
		if($data2 == '')
		{
			$kodeBarang = "Bank Withdrawal # 10000";
			?>
			<div id="keterangan" style="display: none;"><?php echo $kodeBarang; ?></div>
			<?php
		}
		else
		{
			$kodeBarang = $data['no_transaksi_kirim'];
			$noUrut = (int)$kodeBarang; 
			$noUrut++;
			$kodeBarang = $noUrut;
			?>
			<div id="keterangan" style="display: none;">Bank Withdrawal # <?php echo $kodeBarang; ?></div>
			<?php
		}

		
?>
</head>
	<body class="hold-transition skin-blue sidebar-mini">

		<?php body_top(); ?> 
			<div class="content-wrapper">        
				
				<section class="content">

				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<h2><small>Transaksi</small><br><strong class="text-light-blue">Kirim Uang</strong></h2>
						</div>
					</div>
					<div class="row">
						<div class="box box-primary">
							<div class="col-md-3">
								<br>
								<label class="control-label">
									Bayar dari
								</label>
								<br>
								<select id="bayar_dari"  class="form-control">
									<?php
									$sql2 = "SELECT * FROM akun where kategori_akun='Kas & Bank' and kode_akun like '1%'";
									$result2 = mysqli_query($connect, $sql2);
									$jumlah=0;
									$kurangi=0;
									$total=0;
									while($data2 = mysqli_fetch_array($result2))
									{
										?>
											<option value="<?php echo $data2['nama_akun'] ?>"><?php echo $data2['kode_akun']." | ".$data2['nama_akun'] ?></option>
										<?php
									}
										?>
								</select>
							</div>
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<h2 class="pull-right">
									<span class="translation_missing">Total Amount</span>
									<span id="header_amount"></span>
								</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="text-danger">
								<strong id="bayar_dari-errors"></strong>
							</span>	
						</div>
					</div>
					<br>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label class="control-label"> 
								Penerima
							</label>
							<br>
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
													<option value="<?php echo $data2['nama'] ?>" class="kontak_isi"><?php echo $data3['nama'] ?></option>
												<?php
											}
										?>
									</select>
							</div>

						<div class="col-md-3">
							<label class="control-label">
								Tgl Transaksi
							</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" id="tanggalan" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>
						<div class="col-md-3">
							<label class="control-label">
								No Transaksi
							</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-credit-card"></i>
								</div>
								<input type="text" id="no_transaksi" class="form-control" placeholder="Auto" aria-describedby="basic-addon1" readonly>
							</div>
						</div>
					
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="text-danger">
								<strong id="penerima-errors"></strong>
							</span>	
						</div>
					</div>
					<br>
					<br>
					<div class="row">
						<div class="col-md-12">
							<table id="tabel_terima_uang" class="display" style="width:100%">
								<thead>
									<tr>
										<th>Pembayaran Untuk</th>
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
																$jumlah=0;
																$kurangi=0;
																$total=0;
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
										<!-- <td>
											<div class="row">
												<div class="col-md-11">
													<input type="text" class="form-control deskripsi">		
												</div>
											</div>
										</td> -->
										<td>

											<div class="row">
												<div class="col-md-11">
													<select id="pajak_terima_uang" class="form-control pajak_append_select" data-pajak="0" data-uang_pajak="">
														<option id="nambah_pajak_baru_terima_uang"><i class="fa fa-plus" ></i>&nbsp;Ketuk untuk menambahkan pajak</option>
														<?php
															$sql0 = "SELECT * FROM pajak";
															$result0 = mysqli_query($connect, $sql0);
															$jumlah=0;
															$kurangi=0;
															$total=0;
															while($data0 = mysqli_fetch_array($result0))
															{
																?>
																<option value="<?php echo $data0['nama_pajak']." | ".$data0['berapa_persen']; ?>" class="pajak_append_isi" data-value="<?php echo $data0['nama_pajak'].' | '.$data0['berapa_persen']."%";?>" ><?php echo $data0['nama_pajak']." | ".$data0['berapa_persen']."%"; ?></option>
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
													<input type="text" class="form-control uang" data-uang="998"></input>
												</div>
											</div>
											<div></div>
											<span class="text-danger">
												<strong id="uang-errors"></strong>
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>

					<div class="row">
						<div class="col-md-2">
							<button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false" id="tambah_penerimaan"><i class="fa fa-plus"></i>Tambah Data</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="col-md-6" align="right">Sub Total</div>
							<div class="col-md-6" align="right" id="sub_total"></div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="col-md-6" align="right">PPN</div>
							<div class="col-md-6" align="right" id="ppn_angka"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="col-md-6" align="right"><h2><strong>Total</strong></h2></div>
							<div class="col-md-6" align="right"><h2><strong  id="total_semua"></strong></h2></div>
						</div>
					</div>
					<br><br><br>
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6" align="right">
							<button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false">Batal</button>&nbsp;
							<button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" id="buat_pengiriman">Buat Pengiriman</button>
						</div>
					</div>

				</div>
				</section>
			</div>

		<?php body_bottom(); ?>

	</body>
</html>


<script>
$(document).ready(function()
{

	$("#kontak").editableSelect({ effects: 'fade', filter: false });
	$("#bayar_dari").editableSelect({ effects: 'fade', filter: false });

	$(".akun_append").editableSelect({ effects: 'fade', filter: false });
	$(".pajak_append_select").editableSelect({ effects: 'fade', filter: false });

	$(".select2").select2();
	$("#kategori_modal").editableSelect();
 	$("#pajak_modal").editableSelect();
 	$(".uang").mask('#.##0', {reverse: true});
 	var keterangan = $("#keterangan").text();
	$("#no_transaksi").val(keterangan);
  	var p = parseInt(0);
 	$(window).click(function() 
	{
		// var bayar_dari = $("#bayar_dari").val();
		// $.ajax({
		// 		url:"/faktur_v2/halaman/proses-kas/check_akun.php",
		// 		method:"POST",
		// 		data:{query:pelanggan},
		// 		  beforeSend: $.proxy(function(data) {
  //       		}, this),
		// 		success:function(data)
		// 		{
		// 			if(data == "ada")
		// 			{
						
		// 			}
		// 			else
		// 			{
		// 				$("#bayar_dari").val("");
		// 			}
		// 		}
		// });
		

		var pelanggan = $("#kontak").val();
		$.ajax({
				url:"/faktur_v2/halaman/proses-kontak/check_kontak.php",
				method:"POST",
				data:{query:pelanggan},
				  beforeSend: $.proxy(function(data) {
        		}, this),
				success:function(data)
				{
					if(data == "ada")
					{
						
					}
					else
					{
						$("#kontak").val("");
					}
				}
				});
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
 	var ppn = parseInt(0);
 	function check_pajak(query,nomer)
 	{
 		var tanpa_spasi= "";
		var $t = $(this);
		var bilangan = parseInt(0);
		if ( query.split("|").length - 1)
		{
			var streetaddress= query.substr(0, query.indexOf('|')); 
			tanpa_spasi = $.trim(streetaddress);

			var parts_lain = query.split('|', 2);
			var b = parts_lain[1];
			bilangan = b.split("%").join("");
		}
		else
		{
			tanpa_spasi = query;
		}
		// var uang = $("#tabel_terima_uang tbody tr:eq("+nomer+") td .uang").val();
		// var uang1 = uang.split(".").join("");
		// var uang2 = parseInt(uang1);
		// var hasil = (bilangan*uang2)/100;
		// var hasil2 = parseInt(hasil);
		
		$.ajax({
		url:"/faktur_v2/halaman/proses-pajak/check_pajak_append.php",
		method:"POST",
		data:{query:tanpa_spasi},
		success:function(data)
			{
				if(data == "ada")
				{
				}
				else
				{
					var nama_akun = query.substring(0, query.indexOf('('));
					$("#nama_pajak_modal").val(nama_akun);
	 				$("#modal_buat_pajak").modal('toggle');
				}
			}
		});
 	}

 	function cari_nama_akun_append(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/cari_akun.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			// $('.akun_append').siblings('.es-list').find('.pmbyrn').hide();
			// $('.akun_append').next().html(data);
			// $('#pembayaran_utk_akun').siblings('.es-list').find('.pmbyrn').hide();
			// $('#pembayaran_utk_akun').next().html(data);
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

 	function cari_kontak(query)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/cari_kontak.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$('#kontak').siblings('.es-list').find('.kontak_isi').hide();
			$('#kontak').next().html(data);
		}
		});
 	}

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

 	$(document).on('keyup', '.akun_append',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		cari_nama_akun_append(id4);
	});

	$(document).on('click', '.pmbyrn',function() //------------------------------untuk mengecek (akun)
	{
		var id4 = $(this).text();
		check_akun(id4);
	});

	$(document).on('keyup', '.pajak_append_select',function() //------------------------------untuk mengecek (akun)
	{
		var id4 = $(this).val();
		cari_nama_pajak(id4);
	});
	
	$(document).on('keyup','#kontak',function()
	{
		cari_kontak($(this).val());
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

	$(document).on('change', '.pajak_append_select',function()
	{
		if($(this).val() == "")
		{
			var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
			var j = rowIndex-1;
			var id4 = parseInt(0);
			$("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak', id4);
			var semua = parseInt(0);
			var angka = parseInt(0);
			var w = parseInt(0);
			var pajak_saja = parseInt(0);
			$(".uang").each(function()
			{
				var z = $(this).val();
				var k = z.split(".").join("");
				var a = parseInt(k) || 0;
				var angka_pajak = $("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('pajak');
				var angka_pajak2 = parseInt(angka_pajak) || 0;
				var uang_pajak = (a*angka_pajak2)/100;
				semua = semua+a+uang_pajak;
				pajak_saja = pajak_saja+uang_pajak;
				$("#tabel_terima_uang tbody tr:eq("+w+") td .pajak_append_select").data('uang_pajak', uang_pajak);
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

	$(document).on('keyup', '.uang', function()
	{

		// var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
		// var j = rowIndex-1;
		// var angka_pajak = $("#tabel_terima_uang tbody tr:eq("+j+") td .pajak_append_select").data('pajak');
		// var uang = $(this).val();
		// var hasil = (uang*angka_pajak)/100;
		// var grand_total = uang+hasil;		
		// var t = $("#tabel_terima_uang tbody tr:eq("+j+") td .uang").data('uang');
		$("#grand_uang").text("");
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
		$("#ppn_angka").text(khusus_pajak)
	});


	$(document).on('click', '#akun_terima_dari_tabel_baru, #kontak_penerima, #tambah_baru_append_akun',function()
	{
		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		$("#tombol_sebelumnya").text(rowIndex-1);
 		$("#modal_nambah_akun").modal('toggle');
	});

	$(document).on('click','#pmbyrn_modal_new',function(e)
	{
		$("#nama_akun_modal").val($(this).text());
		$("#modal_nambah_akun").modal('toggle');
	});

	$(document).on('click', '#nambah_pajak_baru_terima_uang, #pajak_append_baru, #nambah_pajak', function()
 	{
 		var rowIndex = $('#tabel_terima_uang tr').index($(this).closest('tr'));
 		$("#tombol_sebelumnya_pajak").text(rowIndex-1);
 		$("#modal_buat_pajak").modal('toggle');
 	});

 	$(document).on('click', '#pajak_modal_new', function()
 	{
 		$("#nama_pajak_modal").val($(this).text());
 		$("#modal_buat_pajak").modal('toggle');
 	});

 	

 	$(document).on('click','#kontak_baru',function()
	{
		$("#nama_panggilan").val("");
		$("#tambah_kontak_modal").modal('toggle');
	});

	$(document).on('click','#kontak_penerima_modal_akun',function(e)
	{
		$("#modal_nambah_akun").modal('toggle');
	});

	$(document).on('click','.kontak_baru',function()
	{
		$("#nama_panggilan").val("");
		$("#tambah_kontak_modal").modal('toggle');
	});

	$(document).on('click','#kontak_penerima_new',function()
	{
		$("#nama_panggilan").val($(this).text());
		$("#check_box input[value='Supplier,']").prop('checked', true);
		$("#tambah_kontak_modal").modal('toggle');
	});	

 	$("#buat_pengiriman").click(function()
	{
		// alert();
		var bayar_dari = $("#bayar_dari").val();
		var penerima = $('#kontak').val();
		var tanggalan = $("#tanggalan").val();
		var no_transaksi = $("#no_transaksi").val();
		// var tag = $("#tags").val();
		var po = $("#total_semua").text();
		var ho = po.split(",").join("");
		var total_semua = ho;
		var akun_kirim = [];
		var deskripsi = [];
		var pajak = [];
		var uang = [];
		var nama_pajak = [];	
		var nama_pajak_ori = [];

		$(".akun_append").each(function(index) 
		{
			var a = $(this).val();
			if(a == '' )
			{
				a="";
				akun_kirim.push(a);
			}
			else
			{
				a = $(this).val();
				akun_kirim.push(a);
			}			
		});
		// $(".deskripsi").each(function()
		// {
		// 	var o = $(this).val();
		// 	if(o == '' )
		// 	{
		// 		o="";
		// 		deskripsi.push(o);
		// 	}
		// 	else
		// 	{
		// 		o = $(this).val();
		// 		deskripsi.push(o);
		// 	}
		// });
		$(".uang").each(function(index) 
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
 			uang.push(z);
		});

	
		$(".pajak_append_select").each(function(index) 
		{
			var tmp_pajak_ori = $(this).val();
			nama_pajak_ori.push(tmp_pajak_ori);

			var pajak_perakun_total = $(this).data('uang_pajak');		
			var nama_pajak2 = $(this).val();
			if(nama_pajak2 == '' )
			{
				nama_pajak2="0";
				nama_pajak.push(nama_pajak2);
			}
			else
			{
				nama_pajak.push(nama_pajak2);
			}

			if(pajak_perakun_total == '' )
			{
				pajak_perakun_total = parseInt(0);
				pajak.push(pajak_perakun_total);
			}
			else
			{
				pajak.push(pajak_perakun_total);
			}
		});

		$.ajax({
            url      : "/faktur_v2/halaman/kas/query-insert-kirim.php",
            type     : "POST",
            dataType :'json',
            data     : { nama_pajak_ori:nama_pajak_ori , bayar_dari:bayar_dari, nama_pajak:nama_pajak, penerima:penerima, tanggalan:tanggalan, no_transaksi:no_transaksi, akun_kirim:akun_kirim, pajak:pajak, uang:uang, total_semua:total_semua},
            success  : function(data) 
            {
				console.log(data);
				if(data.msg == "berhasil")
				{
					var url = '/faktur_v2/halaman/report/kas_kirim.php';
					var form = $('<form action="' + url + '" method="post">' +
					'<input type="text" name="kode" value="' + no_transaksi + '" />' +
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

	// $(document).on('input', '.uang', function()
	// {
	// 	var a = $(this).val();
	// 	alert(a)
	// });

 	$("#tambah_penerimaan").click(function()
 	{
 		p++;
 		var jumlah = 1;
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

 	$("#simpan-akun").click(function()
    {
    	var nama_akun_modal = $("#nama_akun_modal").val();
    	var nomor_akun_modal = $("#nomor_akun_modal").val();
    	var kategori_modal = $("#kategori_modal").val();
    	var pajak_modal = $("#pajak_modal").val();
    	var a = $("#tombol_sebelumnya").text();
    	$.ajax
        ({
            url      : "/faktur_v2/halaman/proses-kas/save_akun.php",
            type     : "POST",
            data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal, pajak_modal:pajak_modal},
            success  : function(data)
            {
            	location.reload();
            	// $("#tabel_terima_uang tbody tr:eq("+a+") td .akun_append").val(nama_akun_modal);
            	// $("#tabel_terima_uang tbody tr:eq("+a+") td .akun_append").siblings(".es-list").append("<li value='"+nomor_akun_modal+" | "+nama_akun_modal+"' id='pajak_append_isi' class='pajak_append_isi_value es-visible'>"+nomor_akun_modal+" | "+nama_akun_modal+"</li>");
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
            	// $("#tabel_terima_uang tbody tr:eq("+a+") td .pajak_append_select").val(nama+" | "+jumlah+"%");
            	// $("#tabel_terima_uang tbody tr:eq("+a+") td .pajak_append_select").siblings(".es-list").append("<li value='"+nama+" | "+jumlah+"' id='pajak_append_isi' class='pajak_append_isi_value es-visible'>"+nama+" | "+jumlah+" %</li>");

            }
        });
 	});
});
</script>
<?php }  ?>