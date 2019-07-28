<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
include('../../config/connect.php'); 
include('../../modal/modal.php');

include('../../include/include.php');

if(!empty($_POST)){
    $kode = $_POST['kode'];
	$kode2 = explode('#', $kode, 2);

	$loop = 0; $loop1 = 0; $loop2 = 0;

	$select_all_akun = "SELECT kode_akun AS kode, nama_akun AS nama FROM akun";
	$res_all_akun = mysqli_query($connect, $select_all_akun);
	
	$select_akun = $res_all_akun -> fetch_all(MYSQLI_ASSOC);

	foreach($select_akun as $key){
		echo $key['kode'];
	}


	$select_akun = "SELECT kode_akun AS kode, nama_akun AS nama FROM akun WHERE kategori_akun = 'Kas & Bank' AND kode_akun like '1%'";
	$res_akun = mysqli_query($connect, $select_akun);

	$select_pajak = "SELECT nama_pajak, berapa_persen AS persen FROM pajak";
	$res_pajak = mysqli_query($connect, $select_pajak);


	$select_t_akun = "SELECT kontak, tgl_transaksi FROM transaksi_akun WHERE kode_transaksi = '$kode'";
	$res_t_akun = mysqli_query($connect, $select_t_akun);
	while($data_res_t_akun = mysqli_fetch_array($res_t_akun)){
		$kontak[$loop] = $data_res_t_akun['kontak'];
		$tgl[$loop] = $data_res_t_akun['tgl_transaksi'];

	}


	$select_kontak = "SELECT nama FROM kontak";
	$res_kontak = mysqli_query($connect, $select_kontak);

	$select_pengirim = "SELECT kode_akun, kredit FROM transaksi WHERE kode_transaksi = '$kode' AND kredit > 0";
	$res_pengirim = mysqli_query($connect, $select_pengirim);
	while($data_pengirim = mysqli_fetch_array($res_pengirim)){
		$pengirim[$loop] = $data_pengirim['kode_akun'];
		$total[$loop] = $data_pengirim['kredit'];
	}

	$select_penerima = "SELECT kode_akun, debit, nama_pajak_ori AS pajak_ori FROM transaksi WHERE kode_transaksi = '$kode' AND debit > 0 AND kode_akun NOT LIKE '%PPN%'";
	$res_penerima = mysqli_query($connect, $select_penerima);
	while($data_penerima = mysqli_fetch_array($res_penerima)){
		$akun_penerima[$loop1] = $data_penerima['kode_akun']; 
		$debit_penerima[$loop1] = $data_penerima['debit'];
		$pajak_ori[$loop1] = $data_penerima['pajak_ori'];
		

		$loop1++;
	}
	$rows_res_penerima = mysqli_num_rows($res_penerima);
	
	

	$select_total_pajak = "SELECT debit FROM transaksi WHERE kode_transaksi = '$kode' AND debit > 0 AND kode_akun LIKE '%PPN%'";
	$res_total_pajak = mysqli_query($connect, $select_total_pajak);
	while($data_total_pajak = mysqli_fetch_array($res_total_pajak)){
		$total_pajak = $data_total_pajak['debit'];
	}
	
	
	

}else {
    header("Location: /faktur_v2/");
}

	
head();
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper"> 
		<section>

			<div class="row content">
				<div class="col-md-3">
					<h2><small>Transaksi</small><br>
						<p class="text-primary" id="context-span">Kirim Uang</p>
					</h2>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-body bg-info">
					<div class="form-group row">
						<div class="col-xs-10 col-sm-4 col-md-3">
							<strong class="text-black">* Bayar dari</strong>

							<select id="pengirim" class="form-control select2">
								<?php								
								while($data_res_akun = mysqli_fetch_array($res_akun))
								{
									?>
										<option class="pengirim" value="<?php echo $data_res_akun['kode']." | ".$data_res_akun['nama']; ?>" <?php if($data_res_akun['kode']." | ".$data_res_akun['nama']==$pengirim[$loop]){echo "selected = selected";} ?> ><?php echo $data_res_akun['kode']." | ".$data_res_akun['nama'] ?></option>
									<?php
								}
									?>
							</select>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-12 pull-right">
							<h2><strong>Jumlah Total <a class="text-light-blue"> <?php echo "Rp. ".number_format($total[$loop],2,",","."); ?></a></strong></h2>
						</div>
					</div>
				</div>
			</div>
	
			<div class="box-body row">
				<div class="col-md-3 col-lg-4 col-xs-8 col-sm-8">

					<label class="control-label">Penerima</label>
						<select id="kontak"  class="form-control select2">
						<?php
						
						while($data_kontak = mysqli_fetch_array($res_kontak))
						{
							?>
								<option class="transfer_dari" value="<?php echo $data_kontak['nama']; ?>" <?php if($data_kontak['nama'] == $kontak[$loop]){ echo "selected = selected"; } ?> ><?php echo $data_kontak['nama']; ?></option>
							<?php
						}
							?>
					</select>
					
				</div>

				<div class="col-md-3 col-lg-4 col-xs-5 col-sm-5">

					<div class="form-group">
						<label class="control-label">
							Tgl Transaksi
						</label>
							<div class="input-group text">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
								<input type="date" class="form-control" value="<?php echo $tgl[$loop];?>" id="tgl">
							</div>
					</div>

				</div>
				
				<div class="col-md-3 col-lg-4 col-xs-5 col-sm-5">
					<div class="form-group">
						<label class="control-label">
							No Transaksi
						</label>
						<input type="text" class="form-control no_transaksi" id="no" value="<?php echo $kode ?>" readonly>
					</div>
					
				</div>
			</div>

			<div class="container-fluid">
				<div class="box">						
					<div class="box-body table-responsive no-padding">
					<table id="table-kirim" class="table table-hover">
						<thead class="bg-info">
							<tr>
							<th>Nama Akun</th>
							<th>Pajak</th>
							<th>Jumlah</th>
							<th></th>
							</tr>
						</thead>
						<tbody>

						<?php for( $i = 0; $i < $rows_res_penerima; $i++ ){?>

						<tr id="atas">

							<td>
								<div class="form-group">
									<select class="form-control select2 penerima" style="width: 100%;">
										<!-- <option value="<?php echo $akun_penerima[$i] ?>" selected = selected ><?php echo $akun_penerima[$i]." (Old)" ?></option> -->

										<?php foreach($select_akun as $keys=>$value)
										{ ?>
											<option value="<?php echo $value ?>"><?php echo $value ?></option>
										<?php } ?>
																		
									</select>
								</div>
							</td>
							
							<td>
								<div class="form-group">
									<select class="form-control select2 persen" id="pajak" style="width: 100%;">
										<option value="0"> - </option>
						
										<?php while($data_pajak = mysqli_fetch_array($res_pajak)){ ?>
											<option value="<?php echo $data_pajak['persen'] ?>" <?php if($pajak_ori[$i] == $data_pajak['nama_pajak']." | ".$data_pajak['persen']){echo "selected=selected";} ?> ><?php echo $data_pajak['nama_pajak']." | ".$data_pajak['persen'] ?></option>
										<?php } ?>
						
									</select>
								</div>
							</td>

							<td>
								<div class="from-group">
									<input type="number" class="form-control debit" id="uang" placeholder="uang" value="<?php echo $debit_penerima[$i] ?>">
								</div>
							</td>

							<td>
								<div class="form-group">
									<a class="form-control" href="#">
										<i class="fa fa-minus-circle"></i>
									</a>
								</div>
							</td>	

						</tr>
						
						<?php } ?>
						</tbody>
					</table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="row">
				<div class="container-fluid">
					<div class="col-md-3">
						<button id="tambah_data" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</button>
					</div>
				</div>
			</div>

				<div class="row">
						<div class="container-fluid">
							<div class="col-lg-6 col-sm-12 pull-right">
								<div class="form-group">
									<h4>Sub Total <p class="pull-right" id="subTotal">Rp. 0,00</p></h4>
								</div>
								<div class="form-group">
									<h4><b>Pajak</b> <p class="pull-right" id="tax">Rp. 0,00</p></h4>
								</div>
								<div class="form-group" id="pemesanan-only">
									<h2><b>Total<p class="pull-right" id="Total">Rp. 0,00</p></b></h2>
								</div>
								
							</div>
						</div>                    
					</div>  <!-- close row-content -->

	

		</section>
	</div>
<div class="main-footer content">
	<div class="box-body col-md-2 col-lg-2 pull-right">
		<button type="button" class="btn btn-danger" aria-haspopup="true" aria-expanded="false" id="cancel">Batal</button>
	</div>
	<div class="box-body col-md-2 col-lg-2 pull-right">
		<button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" id="edit">Edit Pengiriman</button>
	</div>
</div>


<?php body_bottom(); ?>
<script>
$(document).ready(function()
{
	$(".select2").select2();

	var debit = [];
	var sub_total = 0;
	$(".debit").each(function(){
		var tmp_debit = $(".debit").val();
		debit.push(tmp_debit);
	});


	debit.forEach(function(value){
		var value2 = parseInt(value);

		sub_total = sub_total + value2;
	})
	document.getElementById("subTotal").innerHTML = sub_total;
	document.getElementById("tax").innerHTML = "<?php echo $total_pajak ?>";

	var total = parseInt(<?php echo $total_pajak ?>) + sub_total;

	document.getElementById("Total").innerHTML = ""+total;
	//document ready function

	$("#tambah_data").click(function(){
		$.ajax({
			url:"/faktur_v2/halaman/edit/add/row_kirim.php",
			method:"POST",
			data:{},
			success:function(data) 
			{
				alert();
				$('#atas').after(data);
				$(".select2").select2();
				
			}
		});
	})

	$(document).on('keyup', '.debit', function()
	{
		var i = parseInt(0);
		var tmp_sub = parseInt(0);
		var tmp_pajak = parseInt(0);
		
		$(".debit").each(function()
		{
			//sub uang
			var a = $(this).val();
			var b = a.split(",").join("");
			var tmp_uang = parseInt(b) || 0;
			
			tmp_sub = tmp_sub+tmp_uang;
			
			//pajak

			var angka_pajak = $("#table-kirim tbody tr:eq("+i+") td .persen").val();
			var getPajak = parseInt(angka_pajak) || 0;
			var getHargaPajak = tmp_uang*getPajak/100;

			tmp_pajak = tmp_pajak + getHargaPajak;
			
			//loop
			i++;
		});

		getTotal = tmp_sub + tmp_pajak;

		document.getElementById("subTotal").innerHTML = tmp_sub;
		document.getElementById("tax").innerHTML = tmp_pajak;
		document.getElementById("Total").innerHTML = getTotal;
			
		
	});

	$(document).on('change', '.persen', function()
	{
		var i = parseInt(0);
		var tmp_sub = parseInt(0);
		var tmp_pajak = parseInt(0);
		
		$(".debit").each(function()
		{
			//sub uang
			var a = $(this).val();
			var b = a.split(",").join("");
			var tmp_uang = parseInt(b) || 0;
			
			tmp_sub = tmp_sub+tmp_uang;
			
			//pajak

			var angka_pajak = $("#table-kirim tbody tr:eq("+i+") td .persen").val();
			var getPajak = parseInt(angka_pajak) || 0;
			var getHargaPajak = tmp_uang*getPajak/100;

			tmp_pajak = tmp_pajak + getHargaPajak;
			
			//loop
			i++;
		});

		getTotal = tmp_sub + tmp_pajak;

		document.getElementById("subTotal").innerHTML = tmp_sub;
		document.getElementById("tax").innerHTML = tmp_pajak;
		document.getElementById("Total").innerHTML = getTotal;
			
		
		
	});

	$("#edit").click(function(){
		
		
		var pengirim = $("#pengirim").val();
		var kontak = $("#kontak").val();
		var tgl = $("#tgl").val();

		var kredit = $("#Total").text();

		var arrPenerima = [];

		$(".penerima").each(function(){
			var penerima = $(this).val();

			arrPenerima.push(penerima);
		})
		var arrTax = [];
		var arrNameTax = [];

		$(".persen").each(function(){
			var tmp_persen = $(this).val();
			var tmp_nameTax = $(this).find('option:selected').text();

			arrTax.push(tmp_persen);
			arrNameTax.push(tmp_nameTax);
		})


			swal({
				title: "Peringatan",
					text: "Klik `OK` Untuk Mengedit",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willEdit) => 
					{
						if (willEdit) 
						{

							//ajax
							$.ajax
							({
								url		: "",
								type	: "POST",
								data	: { },
								success	: function(data)
								{
									var kode = $(this).text();
									var url = '/faktur_v2/halaman/edit/query/edit_kirim.php';
											var form = $('<form action="' + url + '" method="post">' +
											'<input type="text" name="kode" value="' + "<?php echo $kode ?>" + '" />' +
											'<input type="text" name="pengirim" value="' + pengirim + '" />' +
											'<input type="text" name="kontak" value="' + kontak + '" />' +
											'<input type="text" name="tgl" value="' + tgl + '" />' +
											'<input type="text" name="kredit" value="' + kredit + '" />' +
											'<input type="text" name="arrPenerima" value="' + arrPenerima + '" />' +
											'<input type="text" name="arrTax" value="' + arrTax + '" />' +
											'<input type="text" name="arrNameTax" value="' + arrNameTax + '" />' +
											'</form>');
											$('body').append(form);
											form.submit();
								}

							});
							//ajax
									
						} else 
						{ swal("Batal"); }
                });

        //endswall


	});
	
	$("#cancel").click(function(){
		history.back();
	});

});
</script>

</body>
</html>