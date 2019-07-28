<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php 
	include('../../config/connect.php');
	include('../../config/produk.php');

	include('../../include/include.php');

	include('../../modal/edProduk.php');
	include('../../modal/modal.php');

	// this
		$res_all_produk = mysqli_query($connect, $sql_select_all_produk);
	//this

	head();
	?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

    <div class="content-wrapper">

    	<section class="content">
		
			<div class="box">
				<div class="box-header with-border">
					<div class="box-title">
						<h2>
							<p class="text-primary" id="context-span">Produk</p>
						</h2>
					</div>
					<div class="box-tools pull-right">
						<h2>
							<Button class="btn btn-primary" id="insertProduk"  <?php echo $_SESSION['write']; ?>><i class="fa fa-plus"></i> Produk Baru</Button>
						</h2>
					</div>
				</div>
			</div>

			<div class="box">
			
				<div class="container-fluid">
				<div class="box">
					
					<ul id="myTab" class="nav nav-tabs"> <!-- tag myTab -->
								
						<li class="active"><a href="#barang" id="" data-toggle="tab">Barang dan Jasa</a></li>
						<li class=""><a href="#gudang" id="" data-toggle="tab">Gudang</a></li>
					
					</ul> 
					<div class="tab-content">
						
						<div id="barang" class="tab-pane fade in active">

							<div class="container-fluid">

								<div class="row">
									<h3><strong> Ringkasan </strong></h3>
								</div>

								<div class="row">

									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="info-box bg-gray">
											<span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

											<div class="info-box-content">
											<span class="info-box-text">Stok Tersedia</span>
											<span class="info-box-number">90<small>%</small></span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>

									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="info-box bg-gray">
											<span class="info-box-icon bg-yellow"><i class="fa fa-cubes"></i></span>

											<div class="info-box-content">
											<span class="info-box-text">Stok Segera Habis</span>
											<span class="info-box-number">90<small>%</small></span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>

									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="info-box bg-gray">
											<span class="info-box-icon bg-red"><i class="fa fa-cubes"></i></span>

											<div class="info-box-content">
											<span class="info-box-text">Stok Habis</span>
											<span class="info-box-number">90<small>%</small></span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>

									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="info-box bg-gray">
											<span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>

											<div class="info-box-content">
											<span class="info-box-text">Daftar Gudang</span>
											<span class="info-box-number">90<small>%</small></span>
											</div>
											<!-- /.info-box-content -->
										</div>
										<!-- /.info-box -->
									</div>

								</div>
								<div class="row">
									<table id="example" class="table table-responsive table-hover">
										<thead class="bg-primary">
										<tr>
											<th>Kode Produk</th>
											<th>Nama</th>
											<th>Harga Beli</th>
											<th>Harga Jual</th>
											<th>Kuantitas</th>

											<!-- <th>Terjual</th>
											<th>Rate Harga</th>
											<th>Harga Beli Terakhir</th> -->
											<th style="text-align:center">Option</th>
										<!--	 -->
										</tr>
										</thead>
										<tbody>
											<?php while($data_kontak = mysqli_fetch_array($res_all_produk)){ ?>
											
											<tr>
												
													
												<td><p class="kodeProduk"><?php echo $data_kontak['kode_produk'] ?></p></td>
												<td class="namaProduk"><?php echo $data_kontak['nama_produk'] ?></td>
												<td class="beliSatuan"><?php echo $data_kontak['harga_beli_satuan'] ?></td>
												<td class="jualSatuan"><?php echo $data_kontak['harga_jual_satuan'] ?></td>
												<td class="qty"><?php echo $data_kontak['qty'] ?></td>

												<!-- <td>Soon</td>
												<td>Soon</td>
												<td>Soon</td> -->

												<td>
												<p class="akunJual" hidden><?php echo $data_kontak['akun_jual'] ?></p>
												<p class="akunBeli" hidden><?php echo $data_kontak['akun_beli'] ?></p>

													<Button class="btn btn-success editProduk"  <?php echo $_SESSION['write']; ?>><i class="fa fa-edit"></i></Button>
													<Button class="btn btn-danger deleteProduk"  <?php echo $_SESSION['write']; ?>><i class="fa fa-times"></i></Button>
												</td>
													<!--	 -->
											</tr>

											<?php } ?>
										</tbody>
									
									</table>
								</div>

							</div>
							
						</div>

						<div id="gudang" class="tab-pane fade">
							<h3>pembelian</h3>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
	$('#example').DataTable();

	$('.select2').select2();

	$('.editProduk').click(function(event){

	//parent tr
		var parentRow = $(this).parents('tr');


	//from p
		var kode = parentRow.find('p[class = "kodeProduk" ]').text();
		var akunJual = parentRow.find('p[class = "akunJual" ]').text();
		var akunBeli = parentRow.find('p[class = "akunBeli" ]').text();


	//from td
		var nama = parentRow.find('td[class = "namaProduk" ]').text();
		var beliSatuan = parentRow.find('td[class = "beliSatuan" ]').text();
		var jualSatuan = parentRow.find('td[class = "jualSatuan" ]').text();
		var qty = parentRow.find('td[class = "qty" ]').text();

		$("#edkodeProduk").val(kode);
		$("#ednamaProduk").val(nama);
		$("#buyPriceProduk").val(beliSatuan);
		$("#sellPriceProduk").val(jualSatuan);
		$("#edQty").val(qty);


		$('#modal-edit-produk').modal('show');

		//simpan edit		
		$('#saveEditProduk').click(function(){
			var editKode = $("#edkodeProduk").val();

			if(!editKode){
				editKode = kode;
			}else{

			}

			var editNama = $("#ednamaProduk").val();

			if(!editNama){
				editNama = nama;
			}else{

			}

			var buyPrice = $("#buyPriceProduk").val();

			if(!buyPrice){
				buyPrice = beliSatuan;
			}else{

			}

			var sellPrice = $("#sellPriceProduk").val();

			if(!sellPrice){
				sellPrice = jualSatuan;
			}else{

			}

			var edQty = $("#edQty").val();

			if(!edQty){
				edQty = qty;
			}else{

			}

			if($("#edAkunJual").val()=='default'){
				akunJual = akunJual;
			}else{
				akunJual = $("#edAkunJual").val();
			}

			if($("#edAkunBeli").val() == 'default'){
				akunBeli = akunBeli;
			}else{
				akunBeli = $("#edAkunBeli").val();
			}

			// alert(akunJual+" dan "+akunBeli);

			$.ajax({

				url:"/faktur_v2/config/edit_produk.php",
                        method:"POST",
                        data:{ kode:editKode, nama:editNama, buyPrice:buyPrice, sellPrice:sellPrice, qty:edQty, akunBeli:akunBeli, akunJual:akunJual},
                        success:function(data)
                        {
							// alert(data);

                            if(data=="Success")
								{ //swall berhasil edit
									swal(
										"Success!",
										"Data Sukses Diubah!",
										"success"
									).then(function() {
										window.location = "/faktur_v2/halaman/produk/";
									});

								}
								else{ //swall gagal edit

									swal(
										"Gagal", 
										"Data Gagal Diubah", 
										"error"
										).then(function() {
										window.location = "/faktur_v2/halaman/produk/";
									});
									
								}

						}
			});
		});

		

	});

	$('.deleteProduk').click(function(event){
		var parentRow = $(this).parents('tr');

		var kode = parentRow.find('p[class = "kodeProduk"]').text();

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

				$.ajax({
				url:"/faktur_v2/config/delete_produk.php",
				method:"POST",
				data:{kode:kode},
				success:function(data) 
							{
								if(data=="Success")
								{ //swall berhasil delete
									swal(
										"Success!",
										"Data Sukses Dihapus!",
										"success"
									).then(function() {
										window.location = "/faktur_v2/halaman/produk/";
									});

								}
								else{ //swall gagal delete

									swal(
										"Gagal", 
										"Data Gagal Dihapus", 
										"error"
										).then(function() {
										window.location = "/faktur_v2/halaman/produk/";
									});
									
								}
							}
				});
				
			} else {
				swal("Batal Menghapus");
			}
			});

        //endswall

	});

	$('#insertProduk').click(function(){
		$('#modal_produk').modal('show');
		
		$('#simpan-produk-modal').click(function(){

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
            url      : "/faktur_v2/config/save_produk.php",
            type     : "POST",
            data     : {pembelian_akun_kemana:pembelian_akun_kemana, harga_beli_satuan:harga_beli_satuan, harga_jual_satuan:harga_jual_satuan, penjualan_akun_kemana:penjualan_akun_kemana, nama_produk:nama_produk, kode_produk:kode_produk, quantity:quantity},
            success  : function(data)
            {
            	// alert(data);

				if(data=="Success")
				{ //swall berhasil edit
					swal(
						"Success!",
						"Data Sukses Disimpan!",
						"success"
					).then(function() {
						window.location = "/faktur_v2/halaman/produk/";
					});

				}
				else{ //swall gagal edit

					swal(
						"Gagal", 
						"Data Gagal Disimpan", 
						"error"
						).then(function() {
						window.location = "/faktur_v2/halaman/produk/";
					});
					
				}
            	
            }
        });
		})
	})

	
});
</script>