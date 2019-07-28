<!DOCTYPE HTML>
<html lang="en">
<head>

<?php 

include('../../../config/connect.php');

include('../../../include/include.php');

head(); //call func head from include php

if(isset($_POST['first'])&&isset($_POST['last'])){
    $first = $_POST['first'];
    $last = $_POST['last'];

    $loop1 = 0;
    $total1 = 0;

    $loop2 = 0;
    $total2 = 0;

    $loop3 = 0;
    $total3 = 0;

    $sql_aset_lancar = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(debit-kredit) as hasil from transaksi WHERE tgl_transaksi between '$first' AND '$last' group by kode_akun having kode=1";
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

    $sql_liabilitas_lancar = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(kredit-debit) as hasil from transaksi WHERE tgl_transaksi between '$first' AND '$last' group by kode_akun having kode=2";
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

    $sql_equitas = "SELECT left(kode_akun,instr(kode_akun,'-')-1) as kode,kode_akun,  sum(kredit-debit) as hasil from transaksi WHERE tgl_transaksi between '$first' AND '$last' group by kode_akun having kode=3";
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

    $sql_income_this_year = "SELECT sum(kredit-debit) AS total, kode_akun from transaksi WHERE year(tgl_transaksi) between year('$first') and year('$last') and(kode_akun like '4%' or kode_akun like '5%' or kode_akun like '6%' or kode_akun like '7%' or kode_akun like '8%' or kode_akun like '9%')";
    $res_income_this_year = mysqli_query($connect, $sql_income_this_year);
    $data_income_this_year = mysqli_fetch_array($res_income_this_year);
    $income_this_year = $data_income_this_year['total'];
    $float_income_this_year = floatval($income_this_year);
    $tot5 = number_format($income_this_year,2,',','.');


    $sql_income_last_year = "SELECT sum(kredit-debit) AS total, kode_akun from transaksi WHERE year(tgl_transaksi) between year('$first')-1 and year('$last')-1 and(kode_akun like '4%' or kode_akun like '5%' or kode_akun like '6%' or kode_akun like '7%' or kode_akun like '8%' or kode_akun like '9%')";
    $res_income_last_year = mysqli_query($connect, $sql_income_last_year);
    $data_income_last_year = mysqli_fetch_array($res_income_last_year);
    $income_last_year = $data_income_last_year['total'];
    $float_income_last_year = floatval($income_last_year);
    $tot6 = number_format($income_last_year,2,',','.');


}else{
    header("Location: /faktur_v2/");
}


?>   

</head>

<body onload="window.print();" >
                                
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
             

</body>
</html>
