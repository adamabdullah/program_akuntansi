 <div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <div class="modal fade" id="tambah_kontak_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <form id="form_kontak" action="#" class="well form-horizontal"  enctype="multipart/form-data">
          <div class="containter-fluid">
            <div class="row">              
                <div class="col-md-2">Nama Panggilan</div>
                <div class="col-md-10"><input type="text" class="form-control" id="nama_panggilan"></div>
            </div>
            <br>

            <div class="row">              
                <div class="col-md-2">
                  Tipe Kontak
                </div>
                <div class="col-md-10">
                  <div class="col-lg-3"><input type="checkbox" value="Pelanggan," name="tipe" />Pelanggan</div>
                  <div class="col-lg-3"><input type="checkbox" value="Supplier," name="tipe"/>Supplier</div>
                  <div class="col-lg-3"><input type="checkbox" value="Karyawan," name="tipe"/>Karyawan</div>
                  <div class="col-lg-3"><input type="checkbox" value="Lain," name="tipe"/>Lain</div>
                </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                Email
              </div>
              <div class="col-md-10">
                <input class="form-control string email required" placeholder="Contoh: contoh@example.co.id" type="email" id="person_email">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                  Alamat Penagihan
                </div>
              <div class="col-md-10 placeholder-small">
                <textarea class="form-control text required" placeholder="Contoh: Jalan Indonesia Blok C No. 27" name="person[billing_address]" id="person_billing_address" style="margin: 0px; height: 80px; width: 428px;"></textarea>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-2">
                  Phone
                </div>
              <div class="col-md-10 placeholder-small">
                <input class="form-control string tel required" placeholder="0812345678" type="number" name="person[phone]" id="person_phone">
              </div>
            </div>

          </div>
        <br>
        <a href="keterangan_lengkap" data-toggle="modal" class="pull-right" id="keterangan_lengkap" data-toggle="modal"      data-target="#modal_lengkap_kontak">Tampilkan lengkap</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary submitBtn" id="simpan-kontak"value="Simpan Kontak"/>
        </div>
        </form>
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


