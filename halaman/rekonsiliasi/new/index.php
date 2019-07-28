<!DOCTYPE HTML>
<html lang="en">
<head>

<?php  
if(isset($_POST['jenis'])){  
	//Do something

  }  
 
include('../../../config/connect.php');   
include('../../../config/sql/querys.php');
include('../../../include/include.php');
include('../../../modal/modal.php');
 

head(); //call func head from include php

$data = mysqli_fetch_array($q_select_bankstatement2); 
$count = mysqli_num_rows($q_select_bankstatement2);
if(isset($data['kode'])) 
{
	$kodeTransaksi = $data['nom'];
	$noUrut = (int)$kodeTransaksi; 
	$noUrut++; 
	$kodeTransaksi = "Reconsiliation # ".$noUrut;
}
else
{
	$kodeTransaksi = "Reconsiliation # 10000";
}
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 
    <div class="content-wrapper"> 
        <section>
            
				<div class="row content">					
					<div class="col-sm-12 col-md-12 col-lg-6" style="text-align:left">
						
						<h2><small>Bank Statement</small><br>
							<p class="text-primary" id="context-span">Rekening koran</p>
						</h2>
					</div>
				</div>   
				

				
				<div class="form_penjualan">
				<!-- buka -->

					<div class="box box-primary">
						<div class="box-body bg-info">
							<div class="form-group row">		

								<div class="col-xs-6 col-sm-4 col-md-3 pull-right">
									<h2><strong>Total <a class="text-light-blue" id="header_amount"> Rp. 0,00</a></strong></h2>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="box-body">
						<div class="row">
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Tanggal terima rekenin koran</label>
					
									<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
										<input type="date" class="form-control" id="tgl_terima" value="<?php echo date('Y-m-d') ?>">
									</div>
									<!-- /.input group -->
								</div>
								<!-- /.form-group -->
							</div>
							<!-- /.col -->
							<div class="col-md-12 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label>Kode Transaksi</label>
									<div class="input-group text">
										<input type="text" class="form-control" id="kode" value="<?php echo $kodeTransaksi ?>" readonly>
									</div>
								</div>
								
							<!-- /.form-group -->

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
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Terima (IDR)</th>
                                            <th>Keluar (IDR)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                        
                                                <input type="date" class="newtgl" value="<?php echo date('Y-m-d') ?>">
                                                
                                            </td>
                                            <td><input type="text" class="newdesc"></td>
                                            <td><input type="number" class="newdebit"></td>
                                            <td><input type="number" class="newkredit"></td>
                                            <td></td>
                                        </tr>
                                        <tr id="bawah">

                                        </tr>
                                    
                                    </tbody>
                                </table>
							</div>
							<!-- /.box-body -->
							
					    </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false" id="tambah_data_reconsiliation"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>



				<div class="row">
					<div class="container-fluid">
						<div class="col-lg-6 col-sm-6 col-md-6 pull-right">
							<div class="form-group pull-right">
							<!-- <input type="button" class="btn btn-lg btn-primary" value="aw"> -->
							<button type="button" id="cancel" class="btn btn-danger">
								<i class="fa fa-times"></i> Batal
							</button>
							<button type="button" class="btn btn-primary" id="insert_rekening_koran">
								<i class="fa fa-plus"></i> Simpan Rekening Koran
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
<script src="/faktur_v2/dist/js/halaman/append.js"></script>
<script src="/faktur_v2/dist/js/halaman/insert.js"></script>
<script>
$(document).ready(function() 
{
    $(document).on('click', '.removeRow',function(e)
	{
        e.preventDefault();
        $(this).closest("tr").remove();
        
    });
   
});
</script>
</body>
</html>