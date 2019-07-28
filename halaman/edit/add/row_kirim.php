<?php 
include('../../../config/connect.php'); 

include('../../../include/include.php');

 
$select_all_akun = "SELECT kode_akun AS kode, nama_akun AS nama FROM akun";
$res_all_akun = mysqli_query($connect, $select_all_akun);

$select_pajak = "SELECT nama_pajak, berapa_persen AS persen FROM pajak";
$res_pajak = mysqli_query($connect, $select_pajak);
?>

<tr>

    <td>
        <div class="form-group">
            <select class="form-control select2 penerima" style="width: 100%;">
            <?php while($data_all_akun = mysqli_fetch_array($res_all_akun)){ ?>
                <option value="<?php echo $data_all_akun['kode']." | ".$data_all_akun['nama'] ?>" ><?php echo $data_all_akun['kode']." | ".$data_all_akun['nama'] ?></option>
            <?php } ?>									
            </select>
        </div>
    </td>

    <td>
        <div class="form-group">
            <select class="form-control select2 persen" id="pajak" style="width: 100%;">
                <option value="0"> - </option>

                <?php while($data_pajak = mysqli_fetch_array($res_pajak)){ ?>
                    <option value="<?php echo $data_pajak['persen'] ?>"><?php echo $data_pajak['nama_pajak']." | ".$data_pajak['persen'] ?></option>
                <?php } ?>

            </select>
        </div>
    </td>

    <td>
        <div class="from-group">
            <input type="number" class="form-control debit" id="uang" placeholder="uang">
        </div>
    </td>

    <td>
        <div class="form-group">
            <a class="form-control" href="#">
                <i class="fa fa-minus-circle"></i>
            </a>
        </div>
    </td>	

</tr>