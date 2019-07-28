<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../config/connect.php');
include('../../config/sql/querys.php');
include('../../include/include.php');



head(); //call func head from include php
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

    <div class="content-wrapper">
        <section class="content">
            <div class="box">
                
                <div class="box-header row">
                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:left">
                            <h2><small>Akun - Cash & Bank</small><br>
                                <p class="text-primary" id="context-span"><?php echo $akun ?></p>
                            </h2>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 pull-right" style="text-align:left">
                        
                            <h2><a href="new/" class="btn btn-sm btn-primary"><i class="fa fa-plus"> Insert Rekening Koran</i></a>
                            </h2>
                    </div>
                </div>
                <div class="box-body row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Transaksi Jurnal</a></li>
                            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                        </ul>

                        <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <table id="bankstatement" class="table table-responsive" style="margin-top:25px">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Tanggal</th> 
                                        <th>Deskripsi</th>	
                                        <th>Terima (dalam IDR)</th>	
                                        <th>Kirim (dalam IDR)</th>	
                                        <th>Saldo (dalam IDR)</th>	
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($data_bankstatement = mysqli_fetch_array($q_select_bankstatement1)){ 
                                        $saldo = $saldo + $data_bankstatement['debit'] - $data_bankstatement['kredit'];
                                        ?>

                                        <tr>
                                            <td><?php echo $data_bankstatement['tgl'] ?></td>
                                            <td><?php echo $data_bankstatement['deskripsi'] ?></td>
                                            <td><?php echo $data_bankstatement['debit'] ?></td>
                                            <td><?php echo $data_bankstatement['kredit'] ?></td>
                                            <td><?php echo $saldo ?></td>
                                            <td>tes</td>
                                        </tr>

                                    <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                        <!-- <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <h3>Menu 3</h3>
                            <p>Some content in menu 3.</p>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <?php body_bottom(); ?>
<script>
$(document).ready(function(){
    $("#bankstatement").DataTable();
    
   

        

});

</script>
</body>
</html>