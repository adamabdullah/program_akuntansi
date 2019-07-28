<!DOCTYPE HTML>
<html lang="en">
<head> 
	<?php 
	include('../../config/connect.php'); 
 
	include('../../include/include.php');
 
	include('../../modal/modal.php'); 


	$sql_sum = "SELECT SUM(sisa_tagihan) as sisa FROM transaksi_produk where kolom='penjualan'";
	$hasil_sum = mysqli_query($connect, $sql_sum);
	$data_sum = mysqli_fetch_array($hasil_sum); 

	 //untuk menseleksi piutang usaha dari orang - orang
	 // SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa, transaksi_produk.kolom from kontak inner join transaksi_produk on kontak.nama = transaksi_produk.pelanggan group by tipe_kontak having kolom='penjualan'

	 // SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa, transaksi_produk.kolom from kontak inner join transaksi_produk on kontak.nama = transaksi_produk.pelanggan group by kode having kolom='penjualan';

	 $sql_sum_supplier = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan where tipe_kontak like '%supplier%';";
	 $hasil_sum_supplier = mysqli_query($connect, $sql_sum_supplier);
	 $data_sum_supplier = mysqli_fetch_array($hasil_sum_supplier);
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
						<p class="text-primary" id="context-span">Kontak</p>
					</h2>
				</div>
				<div class="box-tools pull-right">
                    <h2>
                        <a class="btn btn-primary kontak_baru" href="#" <?php echo $_SESSION['write']; ?>><i class="fa fa-plus"></i> Kontak Baru</a>
                    </h2>
				</div>
			</div>
        </div>

        <div class="box">
        	<div class="container-fluid" style="background-color:#fff; padding:15px; border-radius: 0px 0px 9px 9px;">
                <ul id="myTab" class="nav nav-tabs"> <!-- tag myTab -->                
                    <li class="active"><a href="#pelanggan" id="pel_tab" data-toggle="tab">Pelanggan</a></li>
                    <li class=""><a href="#supplier" id="sup_tab" data-toggle="tab">Supplier</a></li>
                    <li class=""><a href="#karyawan" id="karyawan_tab" data-toggle="tab">Karyawan</a></li>
                    <li class=""><a href="#lainnya" id="" data-toggle="tab">Lainnya</a></li>
                    <li class=""><a href="#semua_tipe" id="" data-toggle="tab">Semua Tipe</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="pelanggan" class="tab-pane fade in active">
                    	<div class="row container-fluid">
                            <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                            	<a href="#" id="mengurutkan_nama_kontak">
                            	<div class="callout callout-warning">
					                <p>Piutang Belum Dibayar</p>

					                <h3><?php echo "Rp. ".number_format($data_sum['sisa'], 2, '.', ',');?></h3>
					            </div>
					            </a>
                            </div>
                           <!--   <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                            	<div class="callout callout-danger">
					                <p>Piutang Jatuh Tempo</p>

					                <h3>This is a yellow callout.</h3>
					            </div>
                            </div> -->
                        </div>
                        <table id="table_pelanggan" class="display">
						    <thead>
						        <tr>
						            <th>Nama</th>
						            <th>Alamat</th>
						            <th>Email</th>
						            <th>No Telpon</th>
						            <th>Saldo Tagihan</th>
						            <th>Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    	<?php
							    	$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan where tipe_kontak like '%pelanggan%' group by kontak.nama;";
	                                $result1 = mysqli_query($connect, $sql);
	                                $row1 = mysqli_num_rows($result1);                                                       
                                    while($data1 = mysqli_fetch_array($result1))
                                    {
          //                           	$cek_kontak = $data1['tipe_kontak']; 
          //                           	if (strpos($cek_kontak, 'Pelanggan,') !== false) 
										// {
											?>
												<tr>
										            <td><?php echo $data1['nama']; ?></td>
										            <td><?php echo $data1['alamat_penagihan']; ?></td>
										            <td><?php echo $data1['email']; ?></td>
										            <td><?php echo $data1['phone']; ?></td>
										            <td><?php echo "Rp. ".number_format($data1['sisa'], 2, '.', ',');?></td>
										            <td>
													    <a href="" data-sisa="<?php echo $data1['sisa']; ?>" data-telpon="<?php echo $data1['phone']; ?>" data-alamat="<?php echo $data1['alamat_penagihan']; ?>" data-email="<?php echo $data1['email']; ?>" data-nama="<?php echo $data1['nama']; ?>" data-tipe="<?php echo $data1['tipe_kontak']; ?>" class="btn btn-success btn-rounded btn-sm edit" <?php echo $_SESSION['write'] ?>><span class="fa fa-edit"></span></a>
													    <a href="" class="btn btn-danger btn-rounded btn-sm delete" <?php echo $_SESSION['write'] ?>><span class="fa fa-times"></span></a>
													</td>
										       </tr>
											<?php
										// }
                                    }

                                   
                                    
						    	?>
						    </tbody>
						</table>
                </div>
                <div id="supplier" class="tab-pane fade">
                	<div class="row container-fluid">
                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                        	<a href="#" id="mengurutkan_hutang">
                           	<div class="callout callout-warning">
					            <p>Hutang Belum Dibayar</p>
					            <h3><?php echo "Rp. ".number_format($data_sum_supplier['sisa'], 2, '.', ',');?></h3>
					        </div>
					        </a>
                        </div>
                    </div>
                    <h3>Supplier</h3>
                    <table id="table_supplier" class="display">
					    <thead>
					        <tr>
					            <th>Nama</th>
					            <th>Alamat</th>
					            <th>Email</th>
					            <th>No Telpon</th>
					            <th>Saldo Tagihan</th>
					            <th>Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
                		<?php
							$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan where tipe_kontak like '%supplier%' group by kontak.nama;";
	                        $result1 = mysqli_query($connect, $sql);
	                        $row1 = mysqli_num_rows($result1);                                                       
                            while($data1 = mysqli_fetch_array($result1))
                            {
                            	?>
									<tr>
										<td><?php echo $data1['nama']; ?></td>
										<td><?php echo $data1['alamat_penagihan']; ?></td>
										<td><?php echo $data1['email']; ?></td>
										<td><?php echo $data1['phone']; ?></td>
										<td><?php echo "Rp. ".number_format($data1['sisa'], 2, '.', ',');?></td>
										<td>
										<a href="" data-sisa="<?php echo $data1['sisa']; ?>" data-telpon="<?php echo $data1['phone']; ?>" data-alamat="<?php echo $data1['alamat_penagihan']; ?>" data-email="<?php echo $data1['email']; ?>" data-nama="<?php echo $data1['nama']; ?>" data-tipe="<?php echo $data1['tipe_kontak']; ?>" class="btn btn-success btn-rounded btn-sm edit"><span class="fa fa-edit"></span></a>
										<a href="" class="btn btn-danger btn-rounded btn-sm delete"><span class="fa fa-times"></span></a>
										</td>
							       	</tr>                            	
                            	<?php
                            }
                        ?>
                        </tbody>
                    	</table>    
                </div>
                <div id="karyawan" class="tab-pane fade">
                	<h3>Karyawan</h3>
 						<table id="table_karyawan" class="display">
					    <thead>
					        <tr>
					            <th>Nama</th>
					            <th>Alamat</th>
					            <th>Email</th>
					            <th>No Telpon</th>
					            <th>Saldo Tagihan</th>
					            <th>Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
                		<?php
							$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan where tipe_kontak like '%karyawan%' group by kontak.nama;";
	                        $result1 = mysqli_query($connect, $sql);
	                        $row1 = mysqli_num_rows($result1);                                                       
                            while($data1 = mysqli_fetch_array($result1))
                            {
                            	?>
									<tr>
										<td><?php echo $data1['nama']; ?></td>
										<td><?php echo $data1['alamat_penagihan']; ?></td>
										<td><?php echo $data1['email']; ?></td>
										<td><?php echo $data1['phone']; ?></td>
										<td><?php echo "Rp. ".number_format($data1['sisa'], 2, '.', ',');?></td>
										<td>
										<a href="" data-sisa="<?php echo $data1['sisa']; ?>" data-telpon="<?php echo $data1['phone']; ?>" data-alamat="<?php echo $data1['alamat_penagihan']; ?>" data-email="<?php echo $data1['email']; ?>" data-nama="<?php echo $data1['nama']; ?>" data-tipe="<?php echo $data1['tipe_kontak']; ?>" class="btn btn-success btn-rounded btn-sm edit"><span class="fa fa-edit"></span></a>
										<a href="" class="btn btn-danger btn-rounded btn-sm delete"><span class="fa fa-times"></span></a>
										</td>
							       	</tr>                            	
                            	<?php
                            }
                        ?>
                        </tbody>
                    	</table>  
                </div>
                <div id="lainnya" class="tab-pane fade">
                	<h3>Lain - lain</h3>
					<table id="table_lain" class="display">
					    <thead>
					        <tr>
					            <th>Nama</th>
					            <th>Alamat</th>
					            <th>Email</th>
					            <th>No Telpon</th>
					            <th>Saldo Tagihan</th>
					            <th>Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
                		<?php
							$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan where tipe_kontak like '%lain%' group by kontak.nama;";
	                        $result1 = mysqli_query($connect, $sql);
	                        $row1 = mysqli_num_rows($result1);                                                       
                            while($data1 = mysqli_fetch_array($result1))
                            {
                            	?>
									<tr>
										<td><?php echo $data1['nama']; ?></td>
										<td><?php echo $data1['alamat_penagihan']; ?></td>
										<td><?php echo $data1['email']; ?></td>
										<td><?php echo $data1['phone']; ?></td>
										<td><?php echo "Rp. ".number_format($data1['sisa'], 2, '.', ',');?></td>
										<td>
										<a href="" data-sisa="<?php echo $data1['sisa']; ?>" data-telpon="<?php echo $data1['phone']; ?>" data-alamat="<?php echo $data1['alamat_penagihan']; ?>" data-email="<?php echo $data1['email']; ?>" data-nama="<?php echo $data1['nama']; ?>" data-tipe="<?php echo $data1['tipe_kontak']; ?>" class="btn btn-success btn-rounded btn-sm edit"><span class="fa fa-edit"></span></a>
										<a href="" class="btn btn-danger btn-rounded btn-sm delete"><span class="fa fa-times"></span></a>
										</td>
							       	</tr>                            	
                            	<?php
                            }
                        ?>
                        </tbody>
                    	</table> 
                </div>
                <div id="semua_tipe" class="tab-pane fade">
                	<h3>Semua Tipe</h3>
					<table id="table_semua_tipe" class="display">
					    <thead>
					        <tr>
					            <th>Nama</th>
					            <th>Alamat</th>
					            <th>Email</th>
					            <th>No Telpon</th>
					            <th>Saldo Tagihan</th>
					            <th>Aksi</th>
					        </tr>
					    </thead>
					    <tbody>
                		<?php
							$sql = "SELECT kontak.alamat_penagihan, kontak.tipe_kontak, kontak.email, kontak.phone, kontak.nama as nama, ifnull(sum(transaksi_produk.sisa_tagihan),0) as sisa from kontak left join transaksi_produk on kontak.nama = transaksi_produk.pelanggan group by kontak.nama;";
	                        $result1 = mysqli_query($connect, $sql);
	                        $row1 = mysqli_num_rows($result1);                                                       
                            while($data1 = mysqli_fetch_array($result1))
                            {
                            	?>
									<tr>
										<td><?php echo $data1['nama']; ?></td>
										<td><?php echo $data1['alamat_penagihan']; ?></td>
										<td><?php echo $data1['email']; ?></td>
										<td><?php echo $data1['phone']; ?></td>
										<td><?php echo "Rp. ".number_format($data1['sisa'], 2, '.', ',');?></td>
										<td>
										<a href="" data-sisa="<?php echo $data1['sisa']; ?>" data-telpon="<?php echo $data1['phone']; ?>" data-alamat="<?php echo $data1['alamat_penagihan']; ?>" data-email="<?php echo $data1['email']; ?>" data-nama="<?php echo $data1['nama']; ?>" data-tipe="<?php echo $data1['tipe_kontak']; ?>" class="btn btn-success btn-rounded btn-sm edit"><span class="fa fa-edit"></span></a>
										<a href="" class="btn btn-danger btn-rounded btn-sm delete"><span class="fa fa-times"></span></a>
										</td>
							       	</tr>                            	
                            	<?php
                            }
                        ?>
                        </tbody>
                    	</table>
                </div>
            </div>

        </div>

        </section>
      

    </div>
    <?php body_bottom(); ?>
</body>
<script>
$(document).ready(function(){
	$("#kontak").DataTable();
	$("#table_supplier").DataTable();
	$("#table_karyawan").DataTable();
	$("#table_lain").DataTable();
	$("#table_semua_tipe").DataTable();

	var table_pelanggan = $('#table_pelanggan').DataTable();
	var tipe_patokan = [];
	var nama_patokan = '';


	$(document).on('click','.edit',function(e)
	{
		e.preventDefault();
		$("#nama_panggilan-error").text("");
		$("#tipe_modal_seluruh-error").text("");
		$("#email-error").text("");
		$("#alamat_kontak-error").text("");
		$("#phone-error").text("");
		$('#tambah_kontak_modal input:checkbox').removeAttr('checked');

		var rowIndex = $('tr').index($(this).closest('tr'));
		$("#tombol_sebelumnya_pajak").text(rowIndex-1);
		var nama = $(this).data('nama');
		var tipe = $(this).data('tipe');
		var email = $(this).data('email');
		var alamat = $(this).data('alamat');
		var telp = $(this).data('telpon');
		var tipe2 = tipe.split(',');
		var tipe_modal = [];
		tipe_patokan = tipe2.slice();
		nama_patokan=nama;
        $.each($("#tambah_kontak_modal input[name='tipe']"), function(index)
        {
	        var a = $(this).val();
	        var b = a.split(",").join("");
	        tipe_modal.push(b);

        });
        $.each(tipe2, function(idx, value) {
		    if ($.inArray(value, tipe_modal) !== -1) 
		    {
		 		$("#tambah_kontak_modal input[value='"+value+",']").attr('checked',true);
		    } 
		    else 
		    {
		        // console.log('Not Match: ' + value);
		    }
		});
		$("#tambah_kontak_modal #nama_panggilan").val(nama);
		$("#tambah_kontak_modal #person_email").val(email);
		$("#tambah_kontak_modal textarea#person_billing_address").val(alamat);
		$("#tambah_kontak_modal #person_phone").val(telp);
		$("#tambah_kontak_modal").modal('toggle');
	});


	$(document).on('click','#pel_tab',function(e)
	{
		e.preventDefault();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/kontak/tabel/pelanggan.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	$('#table_pelanggan').html(data);
            	$("#table_pelanggan").DataTable();
            } 
        });
	});

	$(document).on('click','#sup_tab',function(e)
	{
		e.preventDefault();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/kontak/tabel/supplier.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	$('#table_supplier').html(data);
            	$("#table_supplier").DataTable();
            }
        });
	});

	$(document).on('click','.delete',function(e)
	{
		e.preventDefault();
		var parentRow = $(this).parents('tr');
		var nama = parentRow.find('td:nth-child(1)').text();
		var a = parentRow.find('td:nth-child(5)').text();
		var b = a.split("Rp.").join("");
		if (b == 0.00)
		{
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this contact!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) 
			  {
			  	$.ajax({
		            url      : "/faktur_v2/halaman/kontak/query-delete.php",
		            type     : "POST",
		            data     : {nama:nama},
		            success  : function(data)
		            {
		            	
		            }
		        });
			    swal("Poof! Your contact has been deleted!", {
			      icon: "success",
			    });
			    setTimeout(function(){// wait for 5 secs(2)
			           location.reload(); // then reload the page.(3)
			      }, 1000);
			  } else {
			    swal({text:"Your contact file is safe!",icon:"success",});
			  }
			});
		}
		else
		{
			swal("Ada transaksi untuk kontak ini", "", "error");
		}
	});

	$(document).on('click','#mengurutkan_nama_kontak',function(e)
	{
		e.preventDefault();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/kontak/tabel/piutang.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	$('#table_pelanggan').html(data);
            	$("#table_pelanggan").DataTable();
            }
        });
	});
	
	$(document).on('click','#mengurutkan_hutang',function(e)
	{
		e.preventDefault();
		$.ajax
        ({
            url      : "/faktur_v2/halaman/kontak/tabel/hutang.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
            	$('#table_supplier').html(data);
            	$("#table_supplier").DataTable();
            }
        });
	});

	$(".kontak_baru").click(function()
	{
		$("#nama_panggilan-error").text("");
		$("#tipe_modal_seluruh-error").text("");
		$("#email-error").text("");
		$("#alamat_kontak-error").text("");
		$("#phone-error").text("");
		$('#tambah_kontak_modal input:checkbox').removeAttr('checked');
		$("#tambah_kontak_modal #nama_panggilan").val("");
		$("#tambah_kontak_modal #person_email").val("");
		$("#tambah_kontak_modal textarea#person_billing_address").val("");
		$("#tambah_kontak_modal #person_phone").val("");
		
		$("#tambah_kontak_modal").modal('toggle');
		$('#simpan-kontak').attr('id','simpan_kontak_baru'); 
	});
$("#simpan_kontak_baru").click(function(e)
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
	$(document).on('click','#simpan-kontak',function(e)
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
            url      : "/faktur_v2/halaman/kontak/proses-kontak/update_kontak.php",
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
			          	swal("Kontak telah diupdate", "", "success");
            	}
				else
				{
					swal("Cek kembali", "Masih ada yang kosong", "error");
				}	
			}
		});	
	});
	

	$(document).on('click', '#simpan-kontak',function(e)
	{

		e.preventDefault();
		// var field = $('#form_kontak').parsley(options);
		// alert(field);
		var nama_kontak = $("#nama_panggilan").val();
    	var tipe = [];
    	var tipe_kontak ='';
    	var parentRow = $(this).parents('tr');
		var nama = parentRow.find('td:nth-child(1)').text();
    	 $.each($("input[name='tipe']:checked"), function()
		{
			tipe.push($(this).val());
			var tipe_kontak = $(this).val();
        });
    	var person_phone = $("#person_phone").val();
    	var alamat_kontak = $("#person_billing_address").val();
    	var email_kontak = $("#person_email").val();
    	$.ajax
        ({
            url      : "/faktur_v2/halaman/kontak/proses-kontak/update_kontak.php",
            type     : "POST",
            dataType :'json',
            data     : {tipe_kontak:tipe_kontak, nama_kontak:nama_kontak, person_phone:person_phone, alamat_kontak:alamat_kontak, email_kontak:email_kontak, tipe:tipe, tipe_patokan:tipe_patokan, nama_patokan:nama_patokan},
            success  : function(data)
            {
				
			}
        });
	});
});
</script>