<?php
include('../../../config/connect.php'); 
include('../../../config/sql/querys.php'); 

include('../../../include/include.php');
include('../../../modal/modal.php');
head(); //call func head from include php

if($_SESSION['write'] == "disabled"){
	//echo $_SESSION['write'];
	header("location:/faktur_v2/"); 
}else{ 

$query = "SELECT max(ExtractNumber(kode_transaksi)) as no_transaksi_kirim from transaksi where kolom='transfer_uang'";
		$query2 = "SELECT kode_transaksi as no_transaksi_kirim from transaksi where kolom='transfer_uang'";

		$hasil2 = mysqli_query($connect,$query2);
		$hasil = mysqli_query($connect,$query);

		$data = mysqli_fetch_array($hasil);
		$data2 = mysqli_num_rows($hasil2);
		if($data2 == 0)
		{
			$kodeBarang = "Bank Transfer # 10000";
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
			<div id="keterangan" style="display: none;">Bank Transfer # <?php echo $kodeBarang; ?></div>
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
								<h2><small>Transaksi</small><br><strong class="text-light-blue">Transfer Uang</strong></h2>
							</div>
						</div>
						<div class="row">
							<div class="box box-primary">
								<div class="col-md-4">
									<label class="control-label">
										Transfer Dari
									</label>
									<br>
									<select id="transfer_dari"  class="form-control">
										<option id="akun_terima_dari_tabel_baru"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan akun</option>
										<?php
										$sql2 = "SELECT * FROM akun where kategori_akun='Kas & Bank'";
										$result2 = mysqli_query($connect, $sql2);
										while($data2 = mysqli_fetch_array($result2))
										{
											?>
												<option class="transfer_dari" value="<?php echo $data2['nama_akun']; ?>"><?php echo $data2['kode_akun']." | ".$data2['nama_akun'] ?></option>
											<?php
										}
											?>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label">
										Setor Ke
									</label>
									<br>
									<select id="setor_ke"  class="form-control">
										<option id="akun_terima_dari_tabel_baru"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan akun</option>
										<?php
										$sql2 = "SELECT * FROM akun where kategori_akun='Kas & Bank'";
										$result2 = mysqli_query($connect, $sql2);
										$jumlah=0;
										$kurangi=0;
										$total=0;
										while($data2 = mysqli_fetch_array($result2))
										{
											?>
												<option class="setor_ke" value="<?php echo $data2['nama_akun'] ?>"><?php echo $data2['kode_akun']." | ".$data2['nama_akun'] ?></option>
											<?php
										}
											?>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label">
										Jumlah
									</label>
									<br>
									<input type="text" class="form-control uang" >
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-4">
								<label class="control-label">
									Memo
								</label>
								<br>
								<textarea class="form-control" style="max-width: 370px;" id="memo"></textarea>
							</div>
						
							<div class="col-md-4">
								<label class="control-label">
									No Transaksi
								</label>
								<input type="text" class="form-control no_transaksi" readonly>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 pull-right">
								<label class="control-label">
									Tgl Transaksi
								</label>
								<input type="date" class="form-control tanggalan" value="<?php echo date("Y-m-d"); ?>" >
							</div>
						</div>
						
						<div class="row" style="margin-top: 200px">
							<div class="col-md-6"></div>
							<div class="col-md-6" align="right">
								<button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false">Batal</button>&nbsp;<button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" id="buat_pengiriman_terima_uang">Buat Transfer</button>
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
	$('.select2').select2()
	$("#setor_ke").editableSelect({ effects: 'fade', filter: false });
	$("#transfer_dari").editableSelect({ effects: 'fade', filter: false });
	var keterangan = $("#keterangan").text();
	$(".no_transaksi").val(keterangan);
	$(".uang").mask('#.##0', {reverse: true});
	$(window).click(function()
	{
		var total_spasi="";
		var transfer_dari = $("#transfer_dari").val();
		var sum1 = transfer_dari.split("|").length - 1;

		var spasi = "";
		var setor_ke = $("#setor_ke").val();
		var sum2 = setor_ke.split("|").length - 1;

		if(sum2 > 0)
		{
			var parts_lain = setor_ke.split('|', 2);
			var b = parts_lain[1];
			spasi = $.trim(b);
		}
		else
		{
			spasi = setor_ke;
		}

		if(sum1 > 0)
		{
			var parts_lain = transfer_dari.split('|', 2);
			var b = parts_lain[1];
			tanpa_spasi = $.trim(b);
		}
		else
		{
			tanpa_spasi = transfer_dari;
		}

		$.ajax({
			url:"/faktur_v2/halaman/proses-kas/cek_akun_modal_append.php",
			method:"POST",
			data:{query:spasi},
			  beforeSend: $.proxy(function(data) {
        	}, this),
			success:function(data)
			{
				if(data == "ada")
				{
					
				}
				else
				{
					$("#setor_ke").val("");
				}
			}
		});

		
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
					$("#transfer_dari").val("");
				}
			}
		});
	});

	function cari_nama_akun(query, wadah, isi)
	{
		$.ajax({
		url:"/faktur_v2/halaman/proses-kas/cari_akun.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
			$(wadah).siblings('.es-list').find(isi).hide();
			$(wadah).next().html(data);
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
					if ( query.indexOf('(') == -1)
					{
 				  		$("#modal_nambah_akun").modal('toggle');
					}
					else
					{
						var nama_akun2 = query.substring(0, query.indexOf('('));
						$("#nama_akun_modal").val(nama_akun2);
	 				  	$("#modal_nambah_akun").modal('toggle');
					}
					
				}
			}
		});
 	} 

 	$(document).on('keyup', '#transfer_dari',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		var wadah = "#transfer_dari";
		var isi = ".nilai_akun";
		cari_nama_akun(id4, wadah, isi);
	});

	

	$(document).on('click','#akun_terima_dari_tabel_baru, #kontak_penerima',function()
	{
		$("#nama_akun_modal").val("");
		$("#modal_nambah_akun").modal('toggle');
		$("#kategori_modal").editableSelect();
		$("#pajak_modal").editableSelect();
	});


	$(document).on('keyup', '#setor_ke',function() //------------------------------untuk mengecek (akun) (append)
	{
		var id4 = $(this).val();
		var wadah = "#setor_ke";
		var isi = ".setor_ke";
		cari_nama_akun(id4, wadah, isi);
	});

	$(document).on('click' , '#pmbyrn_modal_new',function()
	{
		var a = $(this).text();
		check_akun(a);
	});

	$("#buat_pengiriman_terima_uang").click(function()
	{
		var akun_ke = $("#setor_ke").val();
		var akun_dari = $("#transfer_dari").val();
		var no_transaksi = $(".no_transaksi").val(); 
		var uang = $(".uang").val();
		var uang1 = uang.split('.').join("");
		var tanggalan = $(".tanggalan").val();
		var memo = $("#memo").val();

		
		$.ajax
        ({
            url      : "/faktur_v2/halaman/kas/transfer_uang/query-insert-transfer.php",
            type     : "POST",
            dataType : 'json',
            data     : {akun_ke:akun_ke, akun_dari:akun_dari, no_transaksi:no_transaksi, uang:uang1, tanggalan:tanggalan, memo:memo},
            success  : function(data)
            {
				console.log(data);
				if(data.msg == "berhasil")
			    {
					var url = '/faktur_v2/halaman/report/kas_transfer.php';
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

});
</script>
<?php } ?>