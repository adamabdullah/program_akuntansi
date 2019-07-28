<html lang="eng">
<head>

<?php
  include'config/connect.php';
  include'include/include.php';
  

  head(); //call func head from include.php

?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php body_top();?>
  <div class="content-wrapper">

    <h1>welcome</h1>

  </div>


<?php body_bottom(); ?>
</body>

</html>
<script>
  $.widget.bridge('uibutton', $.ui.button);
  $('#example').DataTable();
  $(".nama_akun").click(function()
            {
                var kategori_akun = $(this).data('kategori_akun');
                var nama_akun = $(this).data('nama_akun');
                var kode_akun = $(this).data('kode_akun');
                if (nama_akun == "Kas")
                {
                  location.href="halaman/kas/kas.php"
                    // $.ajax
                    // ({
                    //     url      : "halaman/kas/kas.php",
                    //     type     : "POST",
                    //     data     : {kategori_akun:kategori_akun, nama_akun:nama_akun,kode_akun:kode_akun},
                    //     success  : function(data)
                    //     {
                    //         $('#content-halaman-awal').html(data);
                    //         $('#tabel').remove();
                    //         $("#dropdownMenuButton").html("");
                    //     }
                    // });
                }
                else
                {
                   
                }
               
            });

   
</script>