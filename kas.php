<?php
include('../../config/connect.php');  
?>
        <!-- Header -->
        <!-- Sidebar Holder -->

        <!-- Page Content Holder --> 
        <div id="container">
        	 <nav class="navbar navbar-expand-lg navbar bg-light adas" >
                <div class="container-fluid">
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                        <ul class="nav navbar-nav ml-auto">
                        <button type="button" class="btn btn-primary">
                            <img class="img_icon" width="35px" height="35px" src="dist/img/icon/sales.svg">
                            Jual
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-primary">
                            <img class="img_icon" width="35px" height="35px" src="dist/img/icon/purchase.svg">
                                    Beli
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-primary">
                            <img class="img_icon" width="35px" height="35px" src="dist/img/icon/expense.svg">
                                    Biaya
                        </button>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
            	<div class="row" id="content-halaman">
            		<div class="col-sm-3 col-md-3 col-lg-3">
	                        <h2>
	                            <small>Akun</small>
	                            <br>
	                            Daftar Akun
	                        </h2>
                	</div>
                	<br>
                	<div class="col-sm-8 col-md-8 col-lg-8">
                		<div class="col-md-2 pull-right">
                			<div class="dropdown">
						        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						        	<i class="fa fa-plus"></i>
			                    	Action
			                    </button>
		                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		                        <li><a href="#">Transfer Uang</a></li>
		                        <li><a href="#">Terima Uang</a></li>
		                        <li><a href="#" >Kirim Uang</a></li>
		                      </ul>
		                    </div>
                		</div>             		
                		<div class="col-md-2 pull-right">
                			 <div class="dropdown" id="transaksi">
						        <button class="btn btn-primary dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						        	<i class="fa fa-bars"></i>
			                    	Buat Transaksi
			                    </button>
	                      		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			                        <li><a href="#">Transfer Uang</a></li>
			                        <li><a href="#">Terima Uang</a></li>
			                        <li><a href="#" id="kirim_uang">Kirim Uang</a></li>
		                    	</ul>
		                    </div>
                		</div>

                		<div class="pull-right">
			                
		                   
                		</div>
                    </div>
                </div>   
            </div>
            <div class="row content1">
                <div class="col-sm-12 col-md-12 col-lg-12">
                   <div class="dropdown pull-right">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Tindakan
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Pengaturan Akun</a></li>
                        <li><a href="#">Atur Saldo Awal</a></li>
                        <li><a href="#">Penutupan Buku</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-item" href="#">Import Jurnal Umum</a></li>
                        <li><a class="dropdown-item" href="#">Ekspor Akun</a></li>
                      </ul>
                    </div>
                    <br><br><br>
                        <table id="kas" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kontak</th>
                                <th>Deskripsi</th>
                                <th>Terima(dalam IDR)</th>
                                <th>Kirim(dalam IDR)</th>
                                <th>Saldo(dalam IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT * FROM terima_uang where setor_ke='Kas'";
                            $result2 = mysqli_query($connect, $sql);
                            $sql2 = "SELECT * FROM kirim_uang where bayar_dari_kirim='Kas'";
                            $result3 = mysqli_query($connect, $sql2);
                            $jumlah=0;
                            $kurangi=0;
                            $total=0;
                            while($data2 = mysqli_fetch_array($result2))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $data2['tgl_transaksi']; ?></td>
                                    <td><?php echo $data2['yang_membayar']; ?></td>
                                    <td><?php echo "Bank Deposit #".$data2['no_transaksi']; ?></td>
                                    <td><?php echo $jumlah=$data2['total']; ?></td>
                                    <td>0</td>
                                    <td><?php echo $total=$total+$jumlah; ?></td>
                                </tr>
                            <?php
                            }

                            while($data3 = mysqli_fetch_array($result3))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $data3['tgl_transaksi_kirim']; ?></td>
                                    <td><?php echo $data3['penerima_kirim']; ?></td>
                                    <td><?php echo "Bank Deposit #".$data3['no_transaksi_kirim']; ?></td>
                                    <td>0</td>
                                    <td><?php echo $kurangi=$data3['total_kirim']; ?></td>
                                    <td><?php echo $total=$total-$kurangi; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                            
                        </tbody>
                    </table>
                    </table>
                    
                </div>
            </div>
        </div>
<script>
$(document).ready(function () 
{
    $('#kas').DataTable({"ordering": false});
    $("#kirim_uang").click(function()
    {
    	$.ajax
        ({
            url      : "halaman/kas/kirim_kas.php",
            type     : "POST",
            data     : {},
            success  : function(data)
            {
                $('#content-halaman-awal').html(data);
                $('#tabel').remove();
                $("#dropdownMenuButton").html("");
            }
        });
    });

});
</script>
