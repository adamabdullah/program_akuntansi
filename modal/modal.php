<?php
$connect = mysqli_connect("localhost", "root", "", "zadmin_akuntansi");
?>
 
  <div class="modal fade" id="tambah_kontak_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kontak</h4>
        </div>
        <div class="modal-body">
          <form id="form_kontak" action="#" class="well form-horizontal"  enctype="multipart/form-data">
          <div class="containter-fluid">
            <div class="row">              
                <div class="col-md-2">Nama Panggilan</div>
                <div class="col-md-10">
                  <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"/>
                  <span class="text-danger">
                    <strong id="nama_panggilan-error"></strong>
                  </span>
                </div>
            </div>
            <br>

            <div class="row">              
                <div class="col-md-2">
                  Tipe Kontak
                </div>
                <div class="col-md-10 tipe_modal_seluruh">
                  <div class="col-lg-3"><input type="checkbox" value="Pelanggan," name="tipe"/>Pelanggan</div>
                  <div class="col-lg-3"><input type="checkbox" value="Supplier," name="tipe"/>Supplier</div>
                  <div class="col-lg-3"><input type="checkbox" value="Karyawan," name="tipe"/>Karyawan</div>
                  <div class="col-lg-3"><input type="checkbox" value="Lain," name="tipe"/>Lain</div>
                  <span class="text-danger">
                    <strong id="tipe_modal_seluruh-error"></strong>
                  </span>
                </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                Email
              </div>
              <div class="col-md-10">
                <input class="form-control string email" placeholder="Contoh: contoh@example.co.id" type="email" id="person_email">
                <span class="text-danger">
                    <strong id="email-error"></strong>
                  </span>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                  Alamat Penagihan
                </div>
              <div class="col-md-10 placeholder-small">
                <textarea class="form-control text" placeholder="Contoh: Jalan Indonesia Blok C No. 27" name="person[billing_address]" id="person_billing_address" style="margin: 0px; height: 80px; width: 428px;"></textarea>
                <span class="text-danger">
                    <strong id="alamat_kontak-error"></strong>
                </span>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                  Phone
                </div>
              <div class="col-md-10 placeholder-small">
                <input class="form-control string tel" placeholder="0812345678" type="number" name="person[phone]" id="person_phone">
                <span class="text-danger">
                    <strong id="phone-error"></strong>
                </span>
              </div>
            </div>

          </div>
        <br>
        <!-- <a href="keterangan_lengkap" data-toggle="modal" class="pull-right" id="keterangan_lengkap" data-toggle="modal"      data-target="#modal_lengkap_kontak">Tampilkan lengkap</a> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary submitBtn" id="simpan-kontak" value="Simpan Kontak"/>
        </div>
      </form>
      </div>
    </div>
  </div>

 <div class="modal fade" id="modal_nambah_akun" role="dialog">
<div id="tombol_sebelumnya" style="display: none;"></div>
<div id="akun_lengkap_modal" style="display: none;"></div>
<div id="akun_patokan" style="display: none;"></div>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Menambah Akun</h4>
        </div>
        <div class="modal-body">
          <div class="containter-fluid">
            <div class="row">
              <div class="col-md-4"><h4>Nama</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="nama_akun_modal" id="nama_akun_modal"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4"><h4>Nomor</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="nomor_akun_modal" id="nomor_akun_modal"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4"><h4>Kategori</h4></div>
              <div class="col-md-8">
                 <select id="kategori_modal" class="form-control">
                  <?php
                    $sql0 = "SELECT DISTINCT kategori_akun FROM akun";
                    $result0 = mysqli_query($connect, $sql0);
                    while($data0 = mysqli_fetch_array($result0))
                    {
                      ?>
                        <option value="<?php echo $data0['kategori_akun'] ?>" id="pmbyrn" class="pmbyrn"><?php echo $data0['kategori_akun']?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <br>
           <!--  <div class="row">
              <div class="col-md-4"><h4>Pajak</h4></div>
              <div class="col-md-8">
                 <select id="pajak_modal" class="form-control">
                  <?php
                    $sql1 = "SELECT * FROM pajak";
                    $result1 = mysqli_query($connect, $sql1);
                    while($data1 = mysqli_fetch_array($result1))
                    {
                      ?>
                        <option value="<?php echo $data1['nama_pajak'] ?>" id="pajak_modal_input" class="pajak_modal_input"><?php echo $data1['nama_pajak']." - ".$data1['berapa_persen'];?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div> -->
            <br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" id="simpan-akun"value="Simpan Akun"/>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="modal_akun_biaya" role="dialog">
<div id="tombol_sebelumnya" style="display: none;"></div>
<div id="akun_lengkap_modal" style="display: none;"></div>
<div id="akun_patokan" style="display: none;"></div>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Menambah Akun</h4>
        </div>
        <div class="modal-body">
          <div class="containter-fluid">
            <div class="row">
              <div class="col-md-4"><h4>Nama</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="nama_akun_modal" id="nama_akun_biaya"></div>

            </div>
            <br>
            <div class="row">
              <div class="col-md-4"><h4>Nomor</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="nomor_akun_modal" id="nomor_akun_biaya"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4"><h4>Kategori</h4></div>
              <div class="col-md-8">
                 <select id="kategori_modal_biaya" class="form-control">
                  <?php
                    $sql0 = "SELECT DISTINCT kategori_akun FROM akun";
                    $result0 = mysqli_query($connect, $sql0);
                    while($data0 = mysqli_fetch_array($result0))
                    {
                      ?>
                        <option value="<?php echo $data0['kategori_akun'] ?>" id="pmbyrn" class="pmbyrn"><?php echo $data0['kategori_akun']?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <br>
           <!--  <div class="row">
              <div class="col-md-4"><h4>Pajak</h4></div>
              <div class="col-md-8">
                 <select id="pajak_modal" class="form-control">
                  <?php
                    $sql1 = "SELECT * FROM pajak";
                    $result1 = mysqli_query($connect, $sql1);
                    while($data1 = mysqli_fetch_array($result1))
                    {
                      ?>
                        <option value="<?php echo $data1['nama_pajak'] ?>" id="pajak_modal_input" class="pajak_modal_input"><?php echo $data1['nama_pajak']." - ".$data1['berapa_persen'];?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div> -->
            <br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" id="simpan-akun-biaya"value="Simpan Akun"/>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="modal_buat_pajak" role="dialog">
    <div id="tombol_sebelumnya_pajak" style="display: none;"></div>
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pajak</h4>
        </div>
        <div class="modal-body">
          <div class="containter-fluid">
             <div class="row">
              <div class="col-md-4"><h4>Nama Pajak Baru</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="nama_pajak_modal" id="nama_pajak_modal"></div>
            </div>
             <div class="row">
              <div class="col-md-4"><h4>Jumlah Pajak %</h4></div>
              <div class="col-md-8"> <input class="form-control string" placeholder="" type="text" name="jumlah_pajak_modal" id="jumlah_pajak_modal"></div>
            </div>
             <div class="row">
              <div class="col-md-4"><h4>Akun Pajak Penjualan</h4></div>
              <div class="form-group col-md-8">
                <select id="akun_pajak_penjualan" class="form-control select2">
                    <?php
                      $sql1 = "SELECT * FROM akun";
                      $result1 = mysqli_query($connect, $sql1);
                      while($data1 = mysqli_fetch_array($result1))
                      {
                        ?>
                          <option value="<?php echo $data1['kode_akun']." | ".$data1['nama_akun'] ?>" id="pajak_modal_input" class="pajak_modal_input"><?php echo $data1['kode_akun']." | ".$data1['nama_akun'];?></option>
                        <?php
                      }
                    ?>
                </select> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><h4>Akun Pajak Pembelian</h4></div>
              <div class="form-group col-md-8">
                <select id="akun_pajak_pembelian" class="form-control select2">
                    <?php
                      $sql1 = "SELECT * FROM akun";
                      $result1 = mysqli_query($connect, $sql1);
                      while($data1 = mysqli_fetch_array($result1))
                      {
                        ?>
                          <option value="<?php echo $data1['kode_akun']." | ".$data1['nama_akun'] ?>" id="pajak_modal_input" class="pajak_modal_input"><?php echo $data1['kode_akun']." | ".$data1['nama_akun'];?></option>
                        <?php
                      }
                    ?>
                </select> 
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" id="simpan-pajak-modal"value="Simpan Pajak"/>
        </div>
      </div>
      
    </div>
  </div>



   <div class="modal fade" id="modal_lengkap_kontak" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="containter-fluid">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="modal_produk" role="dialog">
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
                <input type="text" class="form-control" id="nama_produk">
              </div>
              <div class="col-md-6">
                <strong>Kode Produk</strong>
                <br>
                <input type="text" class="form-control" id="kode_produk">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <strong>Quantity</strong>
                <br>
                <input type="text" class="form-control" id="quantity">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="checkbox">
                  <label><input id="beli_produk" type="checkbox" value=""><strong>Saya Beli Produk Ini</strong></label>
                </div>
              </div>
            </div>  
            <div class="row" id="parent_pembelian">
              <div class="col-md-6">
                <strong>Harga Beli Satuan</strong>
                <br>
                <input type="number" class="form-control" id="harga_beli_satuan">
              </div>
              <div class="col-md-6">
                <strong>Akun Pembelian</strong>
                <br>
                <select class="form-control select2" id="pembelian_akun_kemana" date-placeholder="Masuk akun mana">
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
                  <label><input id="jual_produk" type="checkbox" value=""><strong>Saya Jual Produk Ini</strong></label>
                </div>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-6">
                <strong>Harga Jual Satuan</strong>
                <br>
                <input type="number" class="form-control" id="harga_jual_satuan">
              </div>
              <div class="col-md-6" id="parent_penjualan">
                <strong>Akun Penjualan</strong>
                <br>
                <select class="form-control select2" id="penjualan_akun_kemana" date-placeholder="Masuk akun mana">
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
          <input type="submit" name="submit" class="btn btn-success" id="simpan-produk-modal"value="Simpan"/>
        </div>
      </div>
      
    </div>
  </div>

