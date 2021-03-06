<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
  
include('../../config/connect.php');  
include('../../include/include.php');
include('../../modal/modal.php');

if(empty($_POST['kode'])){
	header("Location: /faktur_v2/");
}else{
	// echo $_POST['kode'];
	$kode = $_POST['kode'];
	$tgl = $_POST['tgl'];
	$debit = $_POST['debit'];
	$kredit = $_POST['kredit'];
		
}

head(); //call func head from include php
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper"> 

        <section>
            
				<div class="row content">

					<div id="alert" class="alert alert-warning alert-dismissible" hidden="true">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Warning!</h4>
						<p id="span" class="span">Debit dan Kredit harus sama</p>
					</div>	

					<div class="col-sm-12 col-md-12 col-lg-6" style="text-align:left">
						
							<h2><small>Akun</small><br>
								<p class="text-primary" id="context-span">Edit Jurnal (belum selesai)</p>
							</h2>
						
					</div>
				</div>   
				

				
				<div class="form_biaya">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">
								<div class="col-xs-10 col-sm-4 col-md-3">
									<strong class="text-black">* No Transaksi</strong>
									<input type="text" name="" id="" class="form-control" value="<?php echo $kode ?>" readonly>
									
									
								</div>		

								<div class="col-xs-10 col-sm-4 col-md-3">
									<div class="form-group">
										<label>Tanggal Transaksi :</label>
						
										<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
											<input type="date" class="form-control" id="tgl" value="<?php echo $tgl ?>">
										</div>
										<!-- /.input group -->
									</div>
								</div>						

							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="container-fluid">
							<div class="box">						
								<div class="box-body table no-padding">
									<table id="tabel_terima_uang" class="table table-hover table_jurnal">
										<thead class="bg-info">
											<tr>
												<th>Akun</th>
												<th>Deskripsi</th>
												<th>Debit</th>
												<th>Kredit</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$sql_select_transaksi = "SELECT kode_akun, debit, kredit FROM transaksi WHERE kode_transaksi = '$kode'";
											$res_select_transaksi = mysqli_query($connect, $sql_select_transaksi);
											while($dataS = mysqli_fetch_array($res_select_transaksi)){
										?>
											
										<tr id="atas">
											<td>
												<div class="form-group">
													<select id="akun" class="form-control select2 ambil_akun">
													<option value="<?php echo $dataS['kode_akun']?>"><?php echo $dataS['kode_akun']?></option>
														<?php $sql_select_akun = "SELECT kode_akun, nama_akun FROM akun"; $res_select_akun = mysqli_query($connect, $sql_select_akun);
															while($data_akun = mysqli_fetch_array($res_select_akun)){
														?>
															<option value="<?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?>"><?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?></option>
															<?php } ?>
															
													</select>
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" class="form-control deskripsi">		
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="number" value="<?php echo (int)$dataS['debit'] ?>" name="debit" id="debit" class="form-control debit">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="number" value="<?php echo (int)$dataS['kredit'] ?>" name="kredit" id="kredit" class="form-control kredit">
												</div>
											</td>
											<td>
												<a class="remove_fields dynamic" href="#"><i class="fa fa-minus"></i></a>
											</td>
										</tr>
										<?php } ?>
										<tr id="bawah">
										</tr>

										</tbody>
									</table>
								</div>
								<!-- /.box-body -->
							</div>
							<div class="row">
								<div class="col-md-2">
									<button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false" id="new_kolom"><i class="fa fa-plus"></i>Tambah Data</button>
								</div>
							</div>
						</div>
					</div>


            
                
                <div class="row content">
					<div class="container-fluid"> 
						<div class="col-lg-6 col-sm-12">
							<div class="row">
								<label><strong>Memo</strong></label>
							</div>

							<div class="row">
								<textarea id="memo" cols="40" style="resize: vertical; min-height:40px;"></textarea>
							</div>
						</div>
						<div class="col-lg-2 col-sm-5">
							<h4>
								<label for="">Total Debit</label>
							</h4>
							<h4>
								<label id="totalDebit">Rp. <?php echo $debit ?></label>
							</h4>
						</div>

						<div class="col-lg-3 col-sm-6">
							<h4>
								<label for="">Total Kredit</label>
							</h4>
							<h4>
								<label id="totalKredit">Rp. <?php echo $kredit ?></label>
							</h4>
							
							
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
							<button type="button" class="btn btn-primary" id="buat_jurnal">
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
<!-- <script src="/faktur_v2/dist/js/jquery.mask.js"></script> -->
<script>
$(document).ready(function() 
{

	// $(".uang").mask('#.##0', {reverse: true});	
	$(".select2").select2();

	$("#new_kolom").click(function(){
		

		$.ajax({
			url:"/faktur_v2/include/append/append_new_jurnal.php",
			method:"POST",
			data:{},
			success:function(data) 
			{
				// alert();
				$('#bawah').before(data);
				$('.select2').select2();
				
			}
		});

	});

	$(document).on('keyup', '.debit', function()
	{
		var totalD = 0;
		$('.debit').each(function(){
			var debit = parseInt($(this).val()) || 0;
			totalD=totalD+debit;
		});

		document.getElementById('totalDebit').innerHTML = "Rp. "+totalD.toLocaleString();

		//ambil nomor baris
		var rowIndex = $('.table_jurnal tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);

		//validasi harus isi salah satu input
		var ambilKredit = $(".table_jurnal tbody tr:eq("+h+") td .kredit").val();
		var ambilDebit = $(".table_jurnal tbody tr:eq("+h+") td .debit").val();
		if(ambilKredit!="" && ambilKredit != "0" && ambilKredit != "0.00" && ambilDebit!="" &&ambilDebit != "0" &&ambilDebit != "0.00"){

			$(".table_jurnal tbody tr:eq("+h+") td .kredit").css("border", "1px solid red");
			$(".table_jurnal tbody tr:eq("+h+") td .debit").css("border", "1px solid red");
			document.getElementById("buat_jurnal").disabled=true;
			
		}else{
			$(".table_jurnal tbody tr:eq("+h+") td .kredit").css("border", "");
			$(".table_jurnal tbody tr:eq("+h+") td .debit").css("border", "");
			document.getElementById("buat_jurnal").disabled=false;
		}

	});

	$(document).on('keyup', '.kredit', function()
	{
		var totalK = 0;
		$('.kredit').each(function(){
			var kredit = parseInt($(this).val()) || 0;
			totalK=totalK+kredit;
		});
		
		document.getElementById('totalKredit').innerHTML = "Rp. "+totalK.toLocaleString();

		//ambil nomor baris
		var rowIndex = $('.table_jurnal tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);

		//validasi harus isi salah satu input
		var ambilDebit = $(".table_jurnal tbody tr:eq("+h+") td .debit").val();
		var ambilKredit = $(".table_jurnal tbody tr:eq("+h+") td .kredit").val();
		if(ambilDebit!="" &&ambilDebit != "0" &&ambilDebit != "0.00" &&ambilKredit!="" &&ambilKredit != "0" &&ambilDebit != "0.00"){

			$(".table_jurnal tbody tr:eq("+h+") td .kredit").css("border", "1px solid red");
			$(".table_jurnal tbody tr:eq("+h+") td .debit").css("border", "1px solid red");
			document.getElementById("buat_jurnal").disabled=true;
			
		}else{
			$(".table_jurnal tbody tr:eq("+h+") td .kredit").css("border", "");
			$(".table_jurnal tbody tr:eq("+h+") td .debit").css("border", "");
			document.getElementById("buat_jurnal").disabled=false;
		}


	});

	$(document).on('click', '.hapusROW', function(e)
	{
		// alert();
		e.preventDefault();
		var rowIndex = $('.table_jurnal tr').index($(this).closest('tr'));
 		var h = parseInt(rowIndex-1);
 		$(".table_jurnal tbody tr:eq("+h+")").remove();

			var totalD = 0;
			var totalK = 0;
			$('.debit').each(function(){
				var debit = parseInt($(this).val()) || 0;
				totalD=totalD+debit;
			});

			$('.kredit').each(function(){
				var kredit = parseInt($(this).val()) || 0;
				totalK=totalK+kredit;
			});
			
			document.getElementById('totalDebit').innerHTML = "Rp. "+totalD.toLocaleString();
			document.getElementById('totalKredit').innerHTML = "Rp. "+totalK.toLocaleString();
	});

	



	$("#buat_jurnal").click(function(e){
		// alert();
		
		var kode = "<?php echo $kode; ?>";
		var tgl = $("#tgl").val();
		var res_akun = [];
		var res_desc = [];
		var res_debit = [];
		var res_kredit = [];

		var iniDebit = 0;
		var iniKredit = 0;

		if($("#memo").value != ""){
			var memo = $("#memo").val();
			// alert(memo);
		}else{
			var memo = kode;
		}

		$('.ambil_akun').each(function(index){

			var tmp =$(this).val();
			if(tmp == ''){
				tmp = "-";
				res_akun.push(tmp);
			}else{

				res_akun.push(tmp);

			}

			
		});

		$('.deskripsi').each(function(index){

			var tmp = $(this).val();
			if(tmp == ''){
				tmp = '-';
				res_desc.push(tmp);
			}else{
				
				res_desc.push(tmp);

			}
		});
		
		$('.debit').each(function(){
			var tmp = $(this).val();
			if(tmp == ''){
				tmp = '';
				res_debit.push(tmp);
			}else {
				res_debit.push(tmp);
				// alert(res_debit);
			}
		});

		$('.kredit').each(function(){
			var tmp = $(this).val();
			if(tmp == ''){
				tmp = '';
				res_kredit.push(tmp);
			}else {
				res_kredit.push(tmp);
				// alert(res_kredit);
			}
		});

		
		for (var i = 0; i < res_akun.length; ++i) {
			debitParseint = parseInt(res_debit[i]) || 0;
			kreditParseint = parseInt(res_kredit[i]) || 0;

			iniDebit = iniDebit + debitParseint;
			iniKredit = iniKredit + kreditParseint;

			
			// alert("nama akun : "+res_akun[i]+"\ndeskripsi :"+res_desc[i]+"\njumlah debit : "+res_debit[i]+"\njumlah kredit : "+res_kredit[i]);
		}
		iniDebit = parseInt(iniDebit);
		iniKredit = parseInt(iniKredit);
		// alert(iniDebit+"a\n"+iniKredit);
		
		if(iniDebit != iniKredit){
			
			// $("#alert").attr("hidden", true);
			$("#alert").attr("hidden",false);
			document.documentElement.scrollTop = 0;
		}else{
			// alert("Ashiap");
			$("#alert").attr("hidden",true);
			// e.preventDefault();
			$.ajax({
					url:"/faktur_v2/config/jurnal/edit_jurnal.php", ///
					method:"POST",
					data:{kode:kode, res_akun:res_akun, res_desc:res_desc, res_debit:res_debit, res_kredit:res_kredit, memo:memo, tgl:tgl},
					success:function(data) 
					{
						// alert(data);

						if(data!="gagal"){
								swal({
									title: "Succes!",
									text: "Edit Berhasil!",
									type: "success"
								}).then(function() {

									var url = '/faktur_v2/halaman/report/jurnal_entry.php';
									var form = $('<form action="' + url + '" method="post">' +
									// '<input type="text" name="khusus_pajak" value="' + khusus_pajak + '" />' +
									'<input type="text" name="kode" value="' + kode + '" />' +
									'</form>');
									$('body').append(form);
									form.submit();

								});
								}else{
									swal("error");
								}
					}
			})
		}

		
		
	});




	
});
</script>

</body>
</html>