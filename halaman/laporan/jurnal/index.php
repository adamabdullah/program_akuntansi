<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php
$loop1 = 0;
$total1 = 0;

$select_kode = "SELECT kode_transaksi AS kode, tgl_transaksi AS tgl FROM transaksi_akun WHERE tgl_transaksi between CURDATE() AND CURDATE()
                UNION 
                SELECT kode AS kode,tgl_transaksi AS tgl FROM transaksi_produk WHERE tgl_transaksi between CURDATE() AND CURDATE() ORDER BY tgl ASC";
$res_kode = mysqli_query($connect, $select_kode);

?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 

    
    <div class="content-wrapper"> 

    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>
                    <p class="text-primary" id="context-span">Laporan Jurnal <small>(IDR)</small></p>
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

            </div>
        </div>
    </div>       
            <!-- Sidebar Holder -->

            <!-- Page Content Holder --> 
        <section>

            <div id="jurnal">
            
                <div id="row-content" class="row content">
            
                    <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                        
                        <table class="table table-hover table-responsive" id="tbJurnal" cellpadding="5">
                            <thead class="row bg-primary">
                                <th>Akun</th>
                                <th style="text-align:right">Debit</th>
                                <th style="text-align:right">Kredit</th>
                            </thead>
                            <tbody>
                            <?php while($data_kode = mysqli_fetch_array($res_kode)){
                                $total_debit = 0;
                                $total_kredit = 0;
                                ?>
                                <tr>
                                    <td class="bg-info" colspan="3"><?php echo $data_kode['kode']." | ".$data_kode['tgl']; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <?php $sql_transaksi = "SELECT kode_akun, debit, kredit FROM transaksi WHERE kode_transaksi = '".$data_kode['kode']."'";
                                    $res_transaksi = mysqli_query($connect, $sql_transaksi);
                                    while($data_transaksi = mysqli_fetch_array($res_transaksi)){
                                        $total_debit = $total_debit + $data_transaksi['debit'];
                                        $total_kredit = $total_kredit + $data_transaksi['kredit'];
                                ?>
                                    <tr> 
                                        <td style="padding-left:20px"><?php echo $data_transaksi['kode_akun']; ?></td>
                                        <td style="text-align:right"><?php echo number_format($data_transaksi['debit'],2,',','.'); ?></td>
                                        <td style="text-align:right"><?php echo number_format($data_transaksi['kredit'],2,',','.'); ?></td>
                                    </tr>
                                    

                                <?php } ?>
                                <tr>
                                        <td style="text-align:right"><strong>Total</strong></td>
                                        <td style="text-align:right"><?php echo number_format($total_debit,2,',','.'); ?></td>
                                        <td style="text-align:right"><?php echo number_format($total_kredit,2,',','.'); ?></td>
                                    </tr>
                            <?php } ?>



                            </tbody>
                        
                        </table>
                                
                    </div> 

                </div>
            </div>

        </section>

        <div class="box container-fluid pull-right">
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

            var f = [yearf, monthf, dayf].join('/');
            var l = [yearl, monthl, dayl].join('/');

                $.ajax
                    ({
                        url      : "tampung.php",
                        type     : "POST",
                        data     : {f:f,l:l},
                        success  : function(data)
                        {
                            $('#tbJurnal').html(data);
                            // $('#row-content').remove();
                            
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

            var f = [yearf, monthf, dayf].join('/');
            var l = [yearl, monthl, dayl].join('/');
            //alert(f +"-"+ l);
            // alert(f+","+l);
            $.ajax
                    ({
                        url      : "tampung.php",
                        type     : "POST",
                        data     : {f:f,l:l},
                        success  : function(data)
                        {
                            $('#tbJurnal').html(data);
                            // $('#row-content').remove();
                            
                        }
                    });
       
    });


});
</script>