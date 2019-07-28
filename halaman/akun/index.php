<!DOCTYPE HTML>
<html lang="en">
<head>

<?php  
 
include('../../config/connect.php');

include('../../include/include.php');

include('../../modal/modal.php');
head();

$loop = 0;

$sql_select = "SELECT * FROM akun";
$res_select = mysqli_query($connect, $sql_select);

while($data = mysqli_fetch_array($res_select)){
    $kode_akun[$loop] = $data['kode_akun'];
    $nama_akun[$loop] = $data['nama_akun'];
    $kategori[$loop] = $data['kategori_akun'];
 
    $akun[$loop] = $data['kode_akun']." | ".$data['nama_akun'];
    $kategori[$loop] = $data['kategori_akun'];

    $loop++;
}
 

?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top(); ?> 

    <div class="content-wrapper">
	<section>
		<div class="box">
			<div class="box-header with-border">
				<div class="box-title">
					<h2>
						<p class="text-primary" id="context-span">Daftar Akun</p>
					</h2>
				</div>
				<div class="box-tools pull-right">
                    <h2>
                        <a class="btn btn-primary" id='insertAkun'  <?php echo $_SESSION['write']; ?>><i class="fa fa-plus"></i> Buat Akun Baru</a>
                    </h2>
				</div>
			</div>
        </div>
			
        <div class="box">

			<div class="container-fluid">
                 
                <div class="row box-body">
                    <table id="tabel_akun" class="table table-responsive">
                        <thead class="bg-info">
                            <tr>
                                <td>Kunci</td>
                                <td>Kode Akun</td>
                                <!-- <td>Nama Akun</td> -->
                                <td>Kategori Akun</td>
                                <td>Saldo(IDR)</td>
                                <td>Tombol</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php for($i = 0; $i<$loop; $i++){  ?>
                            <tr>
                                <td></td>
                                <td><?php echo $akun[$i]; ?></td>
                                <td><?php echo $kategori[$i]; ?></td>
                                <?php 
                                    $sql_saldo = "SELECT sum(debit)-sum(kredit) AS saldo FROM transaksi WHERE kode_akun = '$akun[$i]'";
                                    $res_saldo = mysqli_query($connect, $sql_saldo);     
                                    while($data2 = mysqli_fetch_array($res_saldo)) { ?>

                                <td>
                                    <?php echo $data2['saldo']; ?>
                                </td>
                                <td>
                                    <a href="" data-akun_lengkap="<?php echo $akun[$i] ?>" data-nama_akun="<?php echo $nama_akun[$i]; ?>" data-akun="<?php echo $kode_akun[$i]; ?>" data-kategori="<?php echo $kategori[$i]; ?>" class="btn btn-success btn-rounded btn-sm edit"  <?php echo $_SESSION['write']; ?>><span class="fa fa-edit"></span></a>
                                    <a href=""  data-akun="<?php echo $kode_akun[$i]; ?>" data-nama_akun="<?php echo $nama_akun[$i]; ?>" data-kategori="<?php echo $kategori[$i]; ?>" class="btn btn-danger btn-rounded btn-sm delete"  <?php echo $_SESSION['write']; ?>><span class="fa fa-times"></span></a></td>

                                    <?php } ?>
                            
                            </tr>
                        <?php } ?>
                        </tbody>                    
                    </table>
                
                </div>
			</div>
        </div>
		

		</section>
    </div> 
	
    <?php body_bottom(); ?>
	
</body>
<script>
$(document).ready(function(){
	$("#tabel_akun").DataTable();
    var kode_patokan = '';
    $(document).on('click','.edit',function(e)
    {
        e.preventDefault();
        var kode = $(this).data('akun');
        var nama = $(this).data('nama_akun');
        var kategori = $(this).data('kategori');
        var akun_lengkap = $(this).data('akun_lengkap');
        $("#nama_akun_modal").val(nama);
        $("#nomor_akun_modal").val(kode);
        $("#kategori_modal").val(kategori);

        $("#akun_patokan").val(kode);
        $("#akun_lengkap_modal").val(akun_lengkap);
 
        $("#modal_nambah_akun").modal('toggle');
        $('#simpan-akun').attr('id','simpan_akun_baru');          
    });

    $(document).on('click','#simpan_akun_baru', function(e)
    {
        e.preventDefault();
        alert("update");
        var akun_patokan = $("#akun_patokan").val();
        var nama_akun_modal = $("#nama_akun_modal").val();
        var nomor_akun_modal = $("#nomor_akun_modal").val();
        var kategori_modal = $("#kategori_modal").val();
        var akun_update = nomor_akun_modal+" | "+nama_akun_modal;
        var akun_lengkap = $("#akun_lengkap_modal").val();

        $.ajax
        ({
            url      : "/faktur_v2/halaman/akun/update_query.php",
            type     : "POST",
            data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal, akun_lengkap:akun_lengkap, akun_update:akun_update, akun_patokan:akun_patokan},
            success  : function(data)
            {
                swal("Berhasil ditambahkan", "", "success");
                setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                  }, 1000);
            }
        });
    });

    $(document).on('click','.delete',function(e)
    {
        e.preventDefault();
        var kode = $(this).data('akun');
       swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this contact!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) 
              {
                $.ajax({
                    url      : "/faktur_v2/halaman/akun/delete_query.php",
                    type     : "POST",
                    data     : {kode:kode},
                    success  : function(data)
                    {
                        // alert(data);
                    }
                });
                swal("Poof! Your contact has been deleted!", {
                  icon: "success",
                });
                setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                  }, 1000);
              } else {
                swal({text:"Your contact file is safe!",icon:"success",});
              }
            });
       
    });

    $('#insertAkun').click(function(){
		$('#modal_nambah_akun').modal('show');
        $("#nama_akun_modal").val("");
        $("#nomor_akun_modal").val("");
        $("#kategori_modal").val("");simpan_akun_baru
         $('#simpan_akun_baru').attr('id','simpan-akun'); 
    });

    $(document).on('click',"#simpan-akun", function()
    {
        // alert("insert");
        var nama_akun_modal = $("#nama_akun_modal").val();
        var nomor_akun_modal = $("#nomor_akun_modal").val();
        var kategori_modal = $("#kategori_modal").val();
        // var pajak_modal = $("#pajak_modal").val();
        var a = $("#tombol_sebelumnya").text();
                $.ajax
                ({
                    url      : "/faktur_v2/config/akun/save_akun.php",
                    type     : "POST",
                    data     : {nama_akun_modal:nama_akun_modal, nomor_akun_modal:nomor_akun_modal, kategori_modal:kategori_modal},
                    success  : function(data)
                    {
                        if(data!="gagal"){
                            swal("Berhasil ditambahkan", "", "success");
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                        }else{
                            swal("Gagal ditambahkan", "", "success");
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                        }
                    }
                });
    });

});
</script>