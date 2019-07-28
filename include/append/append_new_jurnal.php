<?php 
include('../../config/connect.php'); 
?>
<tr>
    <td>
        <div class="form-group">
            <select id="akun" class="form-control select2 ambil_akun">
                <?php $sql_select_akun = "SELECT kode_akun, nama_akun FROM akun"; $res_select_akun = mysqli_query($connect, $sql_select_akun);
                    while($data_akun = mysqli_fetch_array($res_select_akun)){
                ?>
                    <option value="<?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?>"><?php echo $data_akun['kode_akun'].' | '.$data_akun['nama_akun']; ?></option>
                    <?php } ?>
                    
            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control deskripsi">		
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="number" name="debit" id="debit" class="form-control debit">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="number" name="kredit" id="kredit" class="form-control kredit">
        </div>
    </td>
    <td>
        <div class="form-group hapusROW">
            <a class="remove_fields dynamic" href="#"><i class="fa fa-minus"></i></a>
        </div>
    </td>
</tr>