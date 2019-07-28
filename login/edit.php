<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GMP | Edit</title>
  <?php 
  session_start();
  
  include('../config/connect.php');   
  include('../include/include.php');   
  
  includeCSS(); //call func head from include php
  ?>
  

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../"><b>Welcome</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Edit Password</p>

    
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <input type="text" id="user" class="form-control" value="<?php echo $_SESSION['username'] ?>" readonly>
      </div>
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <input type="password" id="oldPass" class="form-control" placeholder="Password Lama">
      </div>
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <input type="password" id="newPass1" class="form-control new-password" placeholder="Password Baru">
      </div>
      <div class="form-group has-feedback">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <input type="password" id="newPass2" class="form-control new-password" placeholder="Ketikan Kembali Password Baru">
        
      </div>
      <div class="row">
        <!-- <div class="col-xs-6">
          <a href=""><span>Lupa password?</span></a>
        </div> -->
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!-- <input type="checkbox"> Remember Me -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="masuk" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/faktur_v2/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/faktur_v2/dist/js/swal/sweetalert.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
$(document).ready(function() {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' /* optional */
  });

  $("#masuk").click(function(){

    var pass1 = "<?php echo $_SESSION['password'] ?>";
    var pass2 = $("#oldPass").val();

    if(pass1 == pass2){
        var newPass1 = $("#newPass1").val();
        var newPass2 = $("#newPass2").val();

        $("#oldPass").css("border", "");
        
       if(newPass1 != newPass2 || newPass1 == "" || newPass2 == "" ||  newPass1.length < 6 || newPass2.length < 6 ){
         
          if(newPass1 == newPass2 && newPass1 == "" || newPass1.length < 6){

          swal ( "Aww" ,  "Password minimal memiliki 6 karakter!" ,  "warning" );
          $("#newPass1").css("border", "1px solid red");
          $("#newPass2").css("border", "");

          }
          else if(newPass1 == newPass2 && newPass2 == "" || newPass2.length < 6){

          swal ( "Aww" ,  "Password minimal memiliki 6 karakter!" ,  "warning" );
          $("#newPass2").css("border", "1px solid red");
          $("#newPass1").css("border", "");

          }
          else
          {

            swal ( "Hmm" ,  "Password 1 dan password 2 tidak sama!" ,  "error" );
            $(".new-password").css("border", "1px solid red");
         
          }
       }else{

            $(".new-password").css("border", "");

              $.ajax(
              {
              url:"/faktur_v2/config/session/edit.php", ///
              method:"POST",
              data:{newPass1:newPass1},
              success:function(data) 
              {
                // alert(data);

                if(data!="gagal"){
                        swal({
                          title: "Succes!",
                          text: "Edit Password Berhasil!",
                          type: "success"
                        }).then(function() {

                          var url = '/faktur_v2/';
                          $(location).attr('href', url)
                          

                        });
                        }else{
                          swal("error");
                        }
              }
              });

       }
      
    }else{
      swal ( "Oops" ,  "Anda salah memasukkan password lama !" ,  "warning" );
      $("#oldPass").val('');
      $("#oldPass").css("border", "1px solid red");
          
      $(".new-password").css("border", "");
    
    }
  })



});
</script>
</body>
</html>
