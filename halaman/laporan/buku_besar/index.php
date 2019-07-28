<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 

    
    <div class="content-wrapper"> 

    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>
                    <p class="text-primary" id="context-span">Laporan Buku Besar <small>(IDR)</small></p>
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
        <section id="buku_besar">

            <div id="buku_besar">
            
                <div id="row-content" class="row content">
            
                    <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                        
                        <table class="table table-hover table-responsive" cellpadding="5">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Nama Akun</th>
                                    <th>Kode Transaksi</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_utk_rincian_akun = "select transaksi.kode_akun as kode, transaksi_akun.tgl_transaksi from transaksi inner join transaksi_akun on transaksi.no = transaksi_akun.no WHERE transaksi_akun.tgl_transaksi between '".date('Y-M-D')."'AND '".date('Y-m-d')."' group by kode_akun";
                                
                                $hasil2 = mysqli_query($connect,$sql_utk_rincian_akun);
                                while($data_tempo = mysqli_fetch_array($hasil2))
                                {   $saldo = 0;
                                    
                                    $contoh = $data_tempo['kode'];
                                    ?>
                                        <tr>
                                            <td colspan="5" class="bg-danger"><strong><?php echo $contoh; ?></strong></td>
                                        </tr>
                                    <?php
                                    $sql_utk_rincian_akun = "select transaksi.kode_transaksi as kode_transaksi, transaksi.debit as debit, transaksi.kredit as kredit, transaksi_akun.tgl_transaksi as tgl from transaksi inner join transaksi_akun on transaksi.no = transaksi_akun.no WHERE transaksi.kode_akun='$contoh' AND transaksi_akun.tgl_transaksi between '".date('Y-m-d')."'AND '".date('Y-m-d')."'";
                                    $hasil112 = mysqli_query($connect,$sql_utk_rincian_akun);
                                    while($data_tempo = mysqli_fetch_array($hasil112))
                                    { $saldo = $saldo + $data_tempo['debit'] - $data_tempo['kredit'];
                                        if($saldo>=0){
                                            $anu =  number_format(($saldo),2,',','.');
                                        }else if($saldo<0){
                                            $anu = "(".abs($saldo).")"; 
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $data_tempo['tgl']; ?></td>
                                            <td><?php echo $data_tempo['kode_transaksi']; ?></td>
                                            <td><?php echo $data_tempo['debit']; ?></td>
                                            <td><?php echo $data_tempo['kredit']; ?></td>
                                            <td><?php echo $anu; ?></td>
                                        </tr>
                                    <?php
                                    } ?> 
                                    <tr>
                                        <td colspan="4"><strong>( <?php echo $contoh ?> ) | Saldo Akhir</strong></td>
                                        <td class="bg-info"><strong><?php echo $anu ?></strong></td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <?php
                                }
                                ?>
                                    
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

        
        var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "pdf.php");

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
            // alert(f +"-"+ l);

                $.ajax
                    ({
                        url      : "tampung.php",
                        type     : "POST",
                        data     : {f:f,l:l},
                        success  : function(data)
                        {
                            $('#buku_besar').html(data);
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
                            $('#buku_besar').html(data);
                            // $('#row-content').remove();
                            
                        }
                    });
       
    });

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
                            $('#buku_besar').html(data);
                            // $('#row-content').remove();
                            
                        }
                    });



});
</script>