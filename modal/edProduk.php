<!-- ///// -->
<div class="modal fade" id="modal-edit-produk" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div id="index_produk" style="display: none;"></div>
          <h4 class="modal-title">Produk Baru</h4>
        </div>
        <div class="modal-body">
          <div class="containter-fluid">
            <div class="row">
              <div class="col-md-6"><strong>Infromation Detail</strong></div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <strong>Nama</strong>
                <br>
                <input type="text" class="form-control" id="ednamaProduk">
              </div>
              <div class="col-md-6">
                <strong>Kode Produk</strong>
                <br>
                <input type="text" class="form-control" id="edkodeProduk">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <strong>Quantity</strong>
                <br>
                <input type="text" class="form-control" id="edQty">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <!-- <div class="checkbox">
                  <label><input id="beli_produk" type="checkbox" value=""><strong>Saya Beli Produk Ini</strong></label>
                </div> -->
              </div>
            </div>  
            <div class="row" id="parent_pembelian">
              <div class="col-md-6">
                <strong>Harga Beli Satuan</strong>
                <br>
                <input type="number" class="form-control" id="buyPriceProduk">
              </div>
              <div class="col-md-6">
                <strong>Akun Pembelian</strong>
                <br>
                <select class="form-control select2" id="edAkunBeli" date-placeholder="Masuk akun mana">
                <option value="default">Klik Untuk Mengubah Akun</option>
                  <?php
                    $mysql = "SELECT * FROM akun WHERE kode_akun like '5-%' OR kode_akun like '1-107%'";
                    $hasil = mysqli_query($connect, $mysql);
                    while($baris = mysqli_fetch_array($hasil))
                      {
                        ?>
                          <option class="form-control" value="<?php echo $baris['kode_akun']." | ".$baris['nama_akun']; ?>"><?php echo $baris['kode_akun']." | ".$baris['nama_akun']; ?></option>
                        <?php
                      }
                    ?>                 
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="checkbox">
                  <!-- <label><input id="jual_produk" type="checkbox" value=""><strong>Saya Jual Produk Ini</strong></label> -->
                </div>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-6">
                <strong>Harga Jual Satuan</strong>
                <br>
                <input type="number" class="form-control" id="sellPriceProduk">
              </div>
              <div class="col-md-6" id="parent_penjualan">
                <strong>Akun Penjualan</strong>
                <br>
                <select class="form-control select2" id="edAkunJual" date-placeholder="Masuk akun mana">
                <option value="default">Klik Untuk Mengubah Akun</option>
                  <?php
                    $mysql = "SELECT * FROM akun WHERE kode_akun like '4-4%' OR kode_akun like '7-7%'";
                    $hasil = mysqli_query($connect, $mysql);
                    while($baris = mysqli_fetch_array($hasil))
                      {
                        ?>
                          <option class="form-control" value="<?php echo $baris['kode_akun']." | ".$baris['nama_akun']; ?>"><?php echo $baris['kode_akun']." | ".$baris['nama_akun']; ?></option>
                        <?php
                      }
                    ?>                 
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-success" id="saveEditProduk"value="Simpan"/>
        </div>
      </div>
      
    </div>
  </div>