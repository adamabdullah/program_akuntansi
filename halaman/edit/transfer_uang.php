<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
include('../../config/connect.php'); 

include('../../include/include.php'); 
include('../../modal/modal.php');
if(!empty($_POST)){
    $kode = $_POST['kode'];
	$kode2 = explode('#', $kode, 2);
	$sql = "SELECT * FROM transaksi_akun where kode_transaksi='".$kode."';";
	$hasilnya = mysqli_query($connect, $sql);
	$data_1 = mysqli_fetch_array($hasilnya);

	$loop = 0; $loop1 = 0; $loop2 = 0;

	$select_akun = "SELECT kode_akun AS kode, nama_akun AS nama FROM akun WHERE kategori_akun = 'Kas & Bank'";

	
	$sql_akun = "SELECT kode_akun, nama_akun FROM akun WHERE kategori_akun = 'Kas & Bank'";
    $sql_pengirim = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND kredit >0";
    $sql_penerima = "SELECT kode_akun FROM transaksi WHERE kode_transaksi = '$kode' AND debit >0 ";
    $sql_tgl = "SELECT tgl_transaksi AS tgl, memo  FROM transaksi_akun WHERE kode_transaksi = '$kode'";
    $sql_total = "SELECT SUM(debit) AS total FROM transaksi WHERE kode_transaksi = '$kode'";

	$res_akun = mysqli_query($connect, $sql_akun);
	$res_akun2 = mysqli_query($connect, $sql_akun);
	$result_akun = mysqli_query($connect, $select_akun);

	//fetch recipient and shipper
	$res_pengirim = mysqli_query($connect, $sql_pengirim);
	while($data_pengirim = mysqli_fetch_array($res_pengirim)){
		$selectedPengirim[$loop] = $data_pengirim['kode_akun'];
		$loop++;
	}


	$res_penerima = mysqli_query($connect, $sql_penerima);
	while($data_penerima = mysqli_fetch_array($res_penerima)){
		$selectedPenerima[$loop1] = $data_penerima['kode_akun'];
		$loop1++;
	}
	

    $res_tgl = mysqli_query($connect, $sql_tgl);
	$res_total = mysqli_query($connect, $sql_total);
	
	while($data_tgl = mysqli_fetch_array($res_tgl)){

		$getTgl[$loop2] = $data_tgl['tgl'];
		$getMemo[$loop2] = $data_tgl['memo'];

		$loop1++;

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
	<section class="content">

		<div class="row content">
			<div class="col-md-3">
				<h2><small>Transaksi</small><br>
					<p class="text-primary" id="context-span"><?php echo $kode2[0];?></p>
				</h2>
			</div>
		</div>

		<div class="box box-primary">
			<div class="box-body bg-info">
				<div class="form-group row">
					<div class="col-xs-10 col-sm-4 col-md-3">
						<strong class="text-black">* Transfer dari</strong>

						<select id="pengirim"  class="form-control select2">
							<?php
							while($data_akun = mysqli_fetch_array($res_akun))
							{
								?>
									<option class="transfer_dari" value="<?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?>" <?php if($data_akun['kode_akun']." | ".$data_akun['nama_akun'] == $selectedPengirim[0]){ echo 'selected = selected';} ?>>
										<?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?>
									</option>
								<?php
							}
								
							?>
							
						</select>
					</div>
					<div class="col-md-3 col-xs-10 col-sm-4">
						<strong class="text-black">* Setor ke</strong>
						<select id="penerima"  class="form-control select2">
							<?php
							
							while($data_akun2 = mysqli_fetch_array($res_akun2))
							{
								?>
									<option class="transfer_dari" value="<?php echo $data_akun2['kode_akun'].' | '.$data_akun2['nama_akun']; ?>" <?php if($data_akun2['kode_akun']." | ".$data_akun2['nama_akun'] == $selectedPenerima[0]){ echo 'selected = selected';} ?>>
										<?php echo $data_akun2['kode_akun'].' | '.$data_akun2['nama_akun']; ?>
									</option>
								<?php
							}
								?>
						</select>
					</div>
					<div class="col-md-3 col-xs-10 col-sm-4">
						<div class="form-group">
							<strong class="text-black">* Jumlah</strong>
							<?php while($data_total = mysqli_fetch_array($res_total)){ ?>
							<input type="number" class="form-control" id="uang" value="<?php echo $data_total['total']; ?>">
							<?php } ?>
						</div>
					</div>
				
				</div>
			</div>
		</div>

		<div class="box-body row">
			<div class="col-md-12 col-lg-4 col-xs-12 col-sm-12">
				<label class="control-label">
					Memo
				</label>
				<textarea class="form-control" style="resize:vertical;" cols="30" rows="4" id="memo"><?php echo $getMemo[0]; ?></textarea>
			</div>
			
			<div class="col-md-12 col-lg-4 col-xs-12 col-sm-12 pull-right">
				<div class="form-group">
					<label class="control-label">
						No Transaksi
					</label>
					<input type="text" class="form-control no_transaksi" value="<?php echo $kode2[1]; ?>" readonly>
				</div>
				<div class="form-group">
					<label class="control-label">
						Tgl Transaksi
					</label>
					
					<input id="tgl" type="date" value="<?php echo $getTgl[0];?>" class="form-control tanggalan" >
					
				</div>
			</div>
		</div>

		

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
</div>

<?php body_bottom(); ?>

<script>
$(document).ready(function()
{
	$(".select2").select2();
	
	$("#edit").click(function(){
		var kode = "<?php echo $kode ?>";
		var pengirim = $("#pengirim").val();
		var penerima = $("#penerima").val();
		var uang = $("#uang").val();
		var memo = $("#memo").val();
		var date = $("#tgl").val();
		// var tag = $("#tag").val();
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
								url		: "/faktur_v2/halaman/edit/query/edit_transfer.php",
								type	: "POST",
								dataType : 'json',
								data	: {kode:kode, pengirim:pengirim, penerima:penerima, uang:uang, memo:memo, date:date },
								success	: function(data)
								{
									console.log(data);
									if(data.code == "berhasil")
									{
										var url = '/faktur_v2/halaman/report/kas_transfer.php';
										var form = $('<form action="' + url + '" method="post">' +
										'<input type="text" name="kode" value="' + kode + '" />' +
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

