<?php include('../../../config/connect.php');
 ?> 





<tr>
	<td>
		<div class="row">
			<div class="col-md-12"> 
			<select id="akun_append" class="form-control produk_append"> 
			    <option id="tambah_baru_append_akun"><i class="fa fa-plus"></i>&nbsp;Ketuk untuk menambahkan produk</option>
					<?php
						$sql0 = "SELECT * FROM produk";
						$result0 = mysqli_query($connect, $sql0);
						while($data0 = mysqli_fetch_array($result0))
						{
							?>
								<option value="<?php echo $data0['nama_produk'].',';?>" id="akun_append_isi" class="isi_produk"><?php echo $data0['kode_produk']." | ".$data0['nama_produk']; ?></option>
							<?php
						}
					?>
			</select>
		</div>
	</div>
	</td>
	<td>
		<textarea name="" id="" cols="20" rows="1" class="deskripsi"></textarea>
	</td>
	<td>
		<div class="form-group"><input type="number" class="form-control quantity" id="jumlah" placeholder="jumlah" style="width: 7em" min=0 id=""></div>
	</td>
	<td>
		<div class="form-group">
			<select class="form-control" id="" placeholder="satuan" style="width: 7em" disabled="true"></select>
		</div>
	</td>
	<td>
		<div class="form-group">
			<input type="number" class="form-control harga_satuan" id="satuan" placeholder="satuan">
		</div>
	</td>
	<td>
		<div class="row">
			<div class="col-md-12"> 
			<select id="pajak_append_select" class="form-control pajak_append_select" data-pajak="1220"> 
			    <option id="pajak_append_baru"><i class="fa fa-plus" ></i>&nbsp;Ketuk untuk menambahkan pajak</option>
				<?php
					$sql0 = "SELECT * FROM pajak";
					$result0 = mysqli_query($connect, $sql0);
					$jumlah=0;
					$kurangi=0;
					$total=0;
					while($data0 = mysqli_fetch_array($result0))
					{
						?>
							<option value="<?php echo $data0['nama_pajak'].',';?>"  id="pajak_append_isi" class="pajak_append_isi"  data-value="<?php echo $data0['nama_pajak'].'|'.$data0['berapa_persen'];?>"><?php echo $data0['nama_pajak']." | ".$data0['berapa_persen']."%"; ?></option>
						<?php
					}
				?> 
			</select>
		</div>
	</div>
	</td>
	<td>
		<div class="form-group">
			<input type="number" class="form-control jumlah_uang_produk" id="uang" placeholder="uang" data-uang="998"></div>
		</td>
	<td>
		<div class="form-group">
			<a class="form-control" href="#" class="kurangi"><i class="fa fa-minus-circle"></i></a>
		</div>
	</td>	
</tr>