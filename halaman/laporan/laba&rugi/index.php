<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

$sel_akun_4 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '4%' AND tgl_transaksi between curdate() AND curdate()";
$res_akun_4 = mysqli_query($connect, $sel_akun_4);

$sel_akun_5 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '5%' AND tgl_transaksi between curdate() AND curdate()";
$res_akun_5 = mysqli_query($connect, $sel_akun_5);

$sel_akun_6 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '6%' AND tgl_transaksi between curdate() AND curdate()";
$res_akun_6 = mysqli_query($connect, $sel_akun_6);

$sel_akun_7 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '7%' AND tgl_transaksi between curdate() AND curdate()";
$res_akun_7 = mysqli_query($connect, $sel_akun_7);

$sel_akun_8 = "SELECT kode_akun, kredit-debit AS total from transaksi WHERE kode_akun like '8%' AND tgl_transaksi between curdate() AND curdate()";
$res_akun_8 = mysqli_query($connect, $sel_akun_8);

date_default_timezone_set('Asia/Jakarta');
?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 

    
    <div class="content-wrapper"> 

    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>
                    <p class="text-primary" id="context-span">Laporan Laba & Rugi <small>(IDR)</small></p>
                </h2>
            </div>
            <div class="box-tools pull-right">
                <h2>
                <div class="dropdown">
                    <button class="btn btn-lg btn-primary dropdown-toggle"  type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-upload pull-left"> Export <span class="caret"></span></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#" id="to_pdf">PDF</a></li>
                        <li><a href="#" id="to_xls">EXCEL</a></li>
                    </ul>
                </div></h2>
            </div>
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-xs-5 col-sm-5">
                    <label>Tanggal Mulai</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" id="f" value="<?php echo date('Y-m-d'); ?>" class="form-control"></div>
                </div>

                <div class="col-md-3 col-xs-5 col-sm-5">
                    <label>Tanggal Selesai</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" id="l" value="<?php echo date('Y-m-d'); ?>" class="form-control"></div>
                </div>

                <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2">
                    <!-- <h2>
                        <button class="btn btn-primary form-control">filter</button>
                    </h2> -->
                </div>

            </div>
        </div>
    </div>       
            <!-- Sidebar Holder -->

            <!-- Page Content Holder --> 
        <section>
        <div id="profitNloss">
            
            <div id="row-content" class="row content">
        
                <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                    
                    <table class="table table-hover" cellpadding="5">
                        <thead class="bg-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th class="pull-right"><?php echo date("d-m-Y"); ?></th>
                        </tr>
                        </thead>

                        <tbody>
<!-- akun 4 -->
                            <tr class="bg-info">
                                <td colspan="2"><Strong>Pendapatan Dari Penjualan</Strong></td>
                            </tr>
                            <?php $total1 = (int)0; while($data_akun_4 = mysqli_fetch_array($res_akun_4)){
                                $total1 = $total1 + $data_akun_4['total']; ?>
                                <tr>
                                    <td><?php echo $data_akun_4['kode_akun'] ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_4['total'] ,2,',','.'); ?></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td><p>Total Pendapatan Dari Penjualan</p></td>
                                <td style="text-align:right"><?php echo   number_format($total1 ,2,',','.'); ?></td>
                            </tr>
<!-- akun 4 -->

<!-- akun 5 -->
                            <tr class="bg-info">
                                <td colspan="2"><Strong>Harga Pokok Penjualan</Strong></td>
                            </tr>
                            <?php $total2 = (int)0; while($data_akun_5 = mysqli_fetch_array($res_akun_5)){
                                $total2 = $total2 + $data_akun_5['total']; 
                                ?>
                                <tr>
                                    <td><?php echo $data_akun_5['kode_akun'] ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_5['total'] ,2,',','.'); ?></td>
                                </tr>
                            <?php } $total1 = $total1 + $total2; ?>

                            <tr>
                                <td><p>Total Harga Pokok Penjualan</p></td>
                                <td style="text-align:right"><?php echo  number_format($total2 ,2,',','.'); ?></td>
                            </tr>
<!-- akun 5 -->

<!-- laba kotor -->
                                <tr>
                                    <td><strong class="text-primary">Laba Kotor</strong></td>
                                    <td style="text-align:right "><strong class="text-primary"><?php echo number_format($total1,2,',','.'); ?></strong></td>
                                </tr>
<!-- laba kotor -->
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>

<!-- akun 6 -->
                            <tr class="bg-info">
                                <td colspan="2"><Strong>Biaya Operasional</Strong></td>
                            </tr>
                            <?php $total3 = (int)0; while($data_akun_6 = mysqli_fetch_array($res_akun_6)){
                                $total3 = $total3 + $data_akun_6['total']; 
                                ?>
                                <tr>
                                    <td><?php echo $data_akun_6['kode_akun'] ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_6['total'] ,2,',','.'); ?></td>
                                </tr>
                            <?php } $total1 = $total1 - $total3;  ?>

                            <tr>
                                <td><p>Total Biaya Operasional</p></td>
                                <td style="text-align:right"><?php echo number_format($total3 ,2,',','.'); ?></td>
                            </tr>
                            <tr>
                                <td><strong class="text-primary">Pendapatan Bersih Operasional</strong></td>
                                <td style="text-align:right"><strong class="text-primary"><?php echo number_format($total1,2,',','.'); ?></strong></td>
                            </tr>
<!-- akun 6 -->

                            <tr>
                                <td></td>
                                <td></td>
                            </tr>

<!-- akun 7 -->
                            <tr class="bg-info">
                                <td colspan="2"><Strong>Pendapatan Lainnya</Strong></td>
                            </tr>
                            <?php $total4 = (int)0; while($data_akun_7 = mysqli_fetch_array($res_akun_7)){
                                $total4 = $total4 + $data_akun_7['total']; 
                                 ?>
                                <tr>
                                    <td><?php echo $data_akun_7['kode_akun'] ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_7['total'] ,2,',','.'); ?></td>
                                </tr>
                            <?php } $total1 = $total1 - $total4; ?>

                            <tr>
                                <td><p>Total Pendapatan Lainnya</p></td>
                                <td style="text-align:right"><?php echo number_format($total4 ,2,',','.'); ?></td>
                            </tr>
<!-- akun 7 -->

<!-- akun 8 -->
                            <tr class="bg-info">
                                <td colspan="2"><Strong>Biaya Lainnya</Strong></td>
                            </tr>
                            <?php $total5 = (int)0; while($data_akun_8 = mysqli_fetch_array($res_akun_8)){
                                $total5 = $total5 + $data_akun_8['total']; 
                                ?>
                                <tr>
                                    <td><?php echo $data_akun_8['kode_akun'] ?></td>
                                    <td style="text-align:right"><?php echo number_format($data_akun_8['total'],2,',','.'); ?></td>
                                </tr>
                            <?php } $total1 = $total1 - $total5; ?>

                            <tr>
                                <td><p>Total Biaya Lainnya</p></td>
                                <td style="text-align:right"><?php echo number_format($total5,2,',','.');  ?></td>
                            </tr>
<!-- akun 8 -->

<!-- laba kotor -->
                                <tr>
                                    <td><strong class="text-primary">Laba Bersih</strong></td>
                                    <td style="text-align:right "><strong class="text-primary"><?php echo number_format($total1,2,',','.');  ?></strong></td>
                                </tr>
<!-- laba kotor -->

                        </tbody>
                    </table>
                            
                 
                </div> 
            </div> 
                 
               

            </div>
            
        </section>

        <div class="box container-fluid  pull-right">
            <a href="/faktur_v2/halaman/laporan/" class="btn btn-lg btn-primary">kembali</a>
        </div>

    </div>

<?php body_bottom(); ?>

</body>
</html>
<script>
$(document).ready(function() 
{ 
    $("#to_xls").click(function(){
        var first = $("#f").val();
        var last = $("#l").val();

        
        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "excel.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "first");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", first);
            form.appendChild(hiddenField);

            var hiddenField2 = document.createElement("input");
            hiddenField2.setAttribute("name", "last");
            hiddenField2.setAttribute("type", "hidden");
            hiddenField2.setAttribute("value", last);
            form.appendChild(hiddenField2);

            document.body.appendChild(form);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('excel.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

            form.submit();

    });
    $("#to_pdf").click(function(){
        var first = $("#f").val();
        var last = $("#l").val();
        // alert(last);

        
        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "pdf.php");

            // setting form target to a window named 'formresult'
            form.setAttribute("target", "formresult");

            var hiddenField = document.createElement("input");              
            hiddenField.setAttribute("name", "first");
            hiddenField.setAttribute("value", first)
            hiddenField.setAttribute("type", "hidden");            ;
            form.appendChild(hiddenField);

            var hiddenField2 = document.createElement("input");
            hiddenField2.setAttribute("name", "last");
            hiddenField2.setAttribute("value", last);
            hiddenField2.setAttribute("type", "hidden");
            form.appendChild(hiddenField2);

            document.body.appendChild(form);
            // alert(first);

            // creating the 'formresult' window with custom features prior to submitting the form
            window.open('pdf.php', 'formresult', 'scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no');

            form.submit();
    });



    $("#f").change(function(){

        var datef = new Date($('#f').val());
            dayf = datef.getDate();
            monthf = datef.getMonth() + 1;
            yearf = datef.getFullYear();

        var datel = new Date($('#l').val());
            dayl = datel.getDate();
            monthl = datel.getMonth() + 1;
            yearl = datel.getFullYear();

            var f = [yearf, monthf, dayf].join('-');
            var l = [yearl, monthl, dayl].join('-');
            // alert(f +"-"+ l);

                $.ajax
                    ({
                        url      : "tampung.php",
                        type     : "POST",
                        data     : {f:f,l:l},
                        success  : function(data)
                        {
                            $('#profitNloss').html(data);
                           
                            
                        }
                    });
       
    });

    $("#l").change(function(){

        var datef = new Date($('#f').val());
            dayf = datef.getDate();
            monthf = datef.getMonth() + 1;
            yearf = datef.getFullYear();

        var datel = new Date($('#l').val());
            dayl = datel.getDate();
            monthl = datel.getMonth() + 1;
            yearl = datel.getFullYear();

            var f = [yearf, monthf, dayf].join('-');
            var l = [yearl, monthl, dayl].join('-');
            // alert(f +"-"+ l);
            $.ajax
                    ({
                        url      : "tampung.php",
                        type     : "POST",
                        data     : {f:f,l:l},
                        success  : function(data)
                        {
                            $('#profitNloss').html(data);
                           
                            
                        }
                    });
       
    });



});
</script>