<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php
$loop1 = 0;
$total1 = 0;

$loop2 = 0;
$total2 = 0;

$loop3 = 0;
$total3 = 0;

$sql_aset_lancar = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(debit-kredit) as hasil from transaksi WHERE tgl_transaksi between CURDATE() AND CURDATE() group by kode_akun having kode=1";
$res_aset_lancar = mysqli_query($connect, $sql_aset_lancar);

while($fetch1 = mysqli_fetch_array($res_aset_lancar)){
    $data1[$loop1] = $fetch1['kode_akun'];
    $raw1[$loop1] = $fetch1['hasil'];
    $total1 = $total1+$fetch1['hasil'];
    if($raw1[$loop1]<0){
        $data2[$loop1] = "(".number_format(abs($raw1[$loop1]),2,',','.').")";
    }elseif($raw1[$loop1]>=0){
        $data2[$loop1] = number_format(abs($raw1[$loop1]),2,',','.');
    }
    $loop1 = $loop1+1;
}

$sql_liabilitas_lancar = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(kredit-debit) as hasil from transaksi WHERE tgl_transaksi between CURDATE() AND CURDATE() group by kode_akun having kode=2";
$res_liabilitas_lancar = mysqli_query($connect, $sql_liabilitas_lancar);

while($fetch2 = mysqli_fetch_array($res_liabilitas_lancar)){
    $data3[$loop2] = $fetch2['kode_akun'];
    $raw2[$loop2] = $fetch2['hasil'];
    $total2 = $total2+$fetch2['hasil'];
    if($raw2[$loop2]<0){
        $data4[$loop2] = "(".number_format(abs($raw2[$loop2]),2,',','.').")";
    }elseif($raw2[$loop2]>=0){
        $data4[$loop2] = number_format(abs($raw2[$loop2]),2,',','.');
    }
    $loop2 = $loop2+1;
}

$sql_equitas = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(kredit-debit) as hasil from transaksi WHERE tgl_transaksi between CURDATE() AND CURDATE() group by kode_akun having kode=3";
$res_equitas = mysqli_query($connect, $sql_equitas);

while($fetch3 = mysqli_fetch_array($res_equitas)){
    $data5[$loop3] = $fetch3['kode_akun'];
    $raw3[$loop3] = $fetch3['hasil'];
    $total3 = $total3+$fetch3['hasil'];
    if($raw3[$loop3]<0){
        $data6[$loop3] = "(".number_format(abs($raw3[$loop3]),2,',','.').")";
    }elseif($raw3[$loop3]>=0){
        $data6[$loop3] = number_format(abs($raw3[$loop3]),2,',','.');
    }
    $loop3 = $loop3+1;
}


if($total1<0){
    $total1_1= floatval($total1);
    $tot1 = "(".number_format(abs($total1_1),2,',','.').")";
}else{
    $total1_1= floatval($total1);
    $tot1 = number_format(abs($total1_1),2,',','.');
}


if($total2<0){
    $total2_1= floatval($total2);
    $tot2 = "(".number_format(abs($total2_1),2,',','.').")";
}else{
    $total2_1= floatval($total2);
    $tot2 = number_format(abs($total2_1),2,',','.');
}

if($total3<0){
    $total3_1= floatval($total3);
    $tot3 = "(".number_format(abs($total3_1),2,',','.').")";
}else{
    $total3_1= floatval($total3);
    $tot3 = number_format(abs($total3_1),2,',','.');
}

$tot4 = 0;

$sql_income_this_year = "SELECT sum(kredit-debit) AS total, kode_akun from transaksi WHERE year(tgl_transaksi) = year(now()) and(kode_akun like '4%' or kode_akun like '5%' or kode_akun like '6%' or kode_akun like '7%' or kode_akun like '8%' or kode_akun like '9%')";
$res_income_this_year = mysqli_query($connect, $sql_income_this_year);
$data_income_this_year = mysqli_fetch_array($res_income_this_year);
$income_this_year = $data_income_this_year['total'];
$float_income_this_year = floatval($income_this_year);
$tot5 = number_format($income_this_year,2,',','.');


$sql_income_last_year = "SELECT sum(kredit-debit) AS total, kode_akun from transaksi WHERE year(tgl_transaksi) = year(now())-1 and(kode_akun like '4%' or kode_akun like '5%' or kode_akun like '6%' or kode_akun like '7%' or kode_akun like '8%' or kode_akun like '9%')";
$res_income_last_year = mysqli_query($connect, $sql_income_last_year);
$data_income_last_year = mysqli_fetch_array($res_income_last_year);
$income_last_year = $data_income_last_year['total'];
$float_income_last_year = floatval($income_last_year);
$tot6 = number_format($income_last_year,2,',','.');

?>   

</head>

<body class="hold-transition skin-blue sidebar-mini">

<?php body_top(); ?> 

    
    <div class="content-wrapper"> 

    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">
                <h2>
                    <p class="text-primary" id="context-span">Laporan Neraca<small>(IDR)</small></p>
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
        <section id="neraca">

            <div id="neraca">
            
                <div id="row-content" class="row content">
            
                    <div class="container-fluid" style="background-color:#fff; padding:50px 15px 17px 15px; border-radius: 0px 0px 9px 9px; border-top:solid; border-color:gray"> <!-- tag container-myjurnal -->
                        
                        <table class="table table-hover table-responsive" cellpadding="5">
                            <thead class="bg-primary">
                                <tr>
                                    <th></th>
                                    <th style="text-align:right"><?php echo date('Y-m-d')." | ".date('Y-m-d');?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="bg-danger" colspan="2"><strong>Aset</strong></td>
                                </tr>

                                <tr>
                                    <!-- <td style="padding-left:25px"><strong>Akun Lancar</strong></td> -->
                                </tr>

                                <?php for($i=0;$i<$loop1;$i++){?>
                                    <tr>
                                        <td style="padding-left:40px"><?php echo $data1[$i]; ?></td>
                                        <td style="text-align:right"><?php echo $data2[$i]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="bg-info">
                                    <td><strong>Total Aset Lancar</strong></td>
                                    <td style="text-align:right"><strong><?php echo $tot1 ?></strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td class="bg-danger" colspan="2"><strong>Liabilitas dan Modal</strong></td>
                                </tr>

                                <tr>
                                    <td style="padding-left:25px"><strong>Liabilitas</strong></td>
                                </tr>
                                <?php for($i=0;$i<$loop2;$i++){?>
                                    <tr>
                                        <td style="padding-left:40px"><?php echo $data3[$i]; ?></td>
                                        <td style="text-align:right"><?php echo $data4[$i]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="bg-warning">
                                    <td style="padding-left:25px"><strong>Total Liabilitas</strong></td>
                                    <td style="text-align:right"><strong><?php echo $tot2 ?></strong></td>
                                </tr>
                                
                                <tr>
                                <td></td>
                                <td></td>
                                </tr>

                                <tr>
                                    <td style="padding-left:25px"><strong>Modal</strong></td>
                                </tr>
                                <?php for($i=0;$i<$loop3;$i++){?>
                                    <tr>
                                        <td style="padding-left:40px"><?php echo $data5[$i]; ?></td>
                                        <td style="text-align:right"><?php echo $data6[$i]; ?></td>
                                    </tr>
                                <?php  
                                    $tot4 = $tot4 + $floatdata6; } ?>
                                <tr>
                                    <td style="padding-left:40px">Pendapatan Periode Ini</td>
                                    <td style="text-align:right"><?php echo $tot5; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:40px">Pendapatan Tahun Lalu</td>
                                    <td style="text-align:right"><?php echo $tot6; ?></td>
                                </tr>
                                <?php 
                                    $totalModalPemilik = $total3_1 + $data_income_this_year['total'] + $data_income_last_year['total'];
                                    $tampil_total_modal_pemilik = number_format($totalModalPemilik,2,',','.');

                                    $total_LiabilitasModal = $totalModalPemilik + $total2_1;
                                    $tampil_total_LiabilitasModal = number_format($total_LiabilitasModal,2,',','.');
                                ?>
                                <tr>
                                    <td class="bg-warning" style="padding-left:25px"><strong>Total Modal Pemilik</strong></td>
                                    <td class="bg-warning" style="text-align:right"><?php echo $tampil_total_modal_pemilik; ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-info"><strong>Total Liabilitas dan Modal</strong></td>
                                    <td class="bg-info" style="text-align:right"><strong><?php echo $tampil_total_LiabilitasModal; ?></strong></td>
                                </tr>

                                
                                
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
                            $('#neraca').html(data);
                            // console.log(data);
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
                            $('#neraca').html(data);
                            // console.log(data);
                            // $('#row-content').remove();
                            
                        }
                    });
       
    });


});
</script>