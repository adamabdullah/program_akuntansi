<?php
include('../../../config/connect.php');  
?>
<div style="margin-top:55px; ">
    <table id="table_pengiriman" class="display" style="width:100%">
        <thead class="table-header">

        <tr>
            <th align="center"><p><input type="checkbox" id="cb0"/></p></th>
            <th><p>Tanggal</p></th>
            <th><p>Nomor</p></th>
            <th><p>Pelanggan</p></th>
            <th><p>Status</p></th>
            <th><p>Tags</p></th>
        </tr>

        </thead>

        <tbody>
            <?php
                $sql = "SELECT * FROM penjualan where jenis_transaksi='pengiriman'";
                $result1 = mysqli_query($connect, $sql);
                $row1 = mysqli_num_rows($result1);
                // if ( $row1 != 0) {                                                            
            
                    while($data1 = mysqli_fetch_array($result1))
                    {
                        ?>
                        <tr>
                            <td align="right"><input type="checkbox" id="cb1"/></td>
                            <td><?php echo $data1['tgl_transaksi']; ?></td>
                            <td><?php echo $data1['nomor_transaksi']; ?></td>
                            <td><?php echo $data1['nama']; ?></td>
                            <td><?php echo $data1['status']; ?></td>
                            <td><?php echo $data1['tags']; ?></td>
                        </tr>
                    <?php
                    } 
                ?>
               

        </tbody>

    </table>
</div>

<script>
$(document).ready(function () 
{

    $('#table_pengiriman').DataTable({
   'language': {
      'emptyTable': '<br> Data Kosong <br> <br><button type="button" id="new_transaksi" class="btn btn-primary"><img class="img_icon" width="35px" height="25px" src="../../dist/img/icon/sales.svg">Buat Pengiriman Baru</button>'
   }
});

});
</script>