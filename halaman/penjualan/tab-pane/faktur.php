<?php
include('../../../config/connect.php');  
?>
<div style="margin-top:55px; ">
                    
    <table id="table_faktur" class="display" style="width:100%">

        <thead class="table-header">
        <tr>
            <th align="center"><input type="checkbox" id="cb0"/></th>
            <th>tanggal</th>
            <th>Nomor</th>
            <th>Pelanggan</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Status</th>
            <th>Sisa Tagihan<ao style="color:blue"> (in IDR)</ao></th>
            <th>Total<ao style="color:blue"> (in IDR)</ao></th>
            <th>Tags</th>
        </tr>
        </thead>

        <tbody>
            <?php
                $sql = "SELECT * FROM penjualan where jenis_transaksi='faktur'";
                $result1 = mysqli_query($connect, $sql);
                $row1 = mysqli_num_rows($result1);
                if ( $row1 != 0) {                                                            
            
                    while($data1 = mysqli_fetch_array($result1))
                    {
                        ?>
                        <tr>
                            <td align="right"><input type="checkbox" id="cb1"/></td>
                            <td><?php echo $data1['tgl_transaksi']; ?></td>
                            <td><?php echo $data1['nomor_transaksi']; ?></td>
                            <td><?php echo $data1['nama']; ?></td>
                            <td><?php echo $data1['tgl_tempo']; ?></td>
                            <td><?php echo $data1['status']; ?></td>
                            <td><?php echo $data1['sisa_tagihan']; ?></td>
                            <td><?php echo $data1['total']; ?></td>
                            <td><?php echo $data1['tags']; ?></td>
                        </tr>
                    <?php
                    } 
                } else { 

                    ?>
                    <tr>
                        <td align="center" colspan="9">kosong</td>
                        
                    </tr>
                    <tr>
                        
                        <td align="center" colspan="9">
                            <button type="button" id="new_transaksi" class="btn btn-primary">
                                                    <img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">
                                                    Buat Penjualan Baru
                            </button>
                        </td>

                    </tr>

                    <?php }?>

        </tbody>

    </table>

</div>
<script>
$(document).ready(function () 
{
    $('#table_faktur').DataTable();

});
</script>
