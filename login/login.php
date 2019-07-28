<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GMP | Log in</title>
  <?php 
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
    <p class="login-box-msg">LogIn untuk Masuk Jurnal</p>

    
      <div class="form-group has-feedback">
        <input type="text" id="user" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
  
    var user = $("#user").val();
    var pass = $("#pass").val();
    // alert(user);  alert(pass);
    var form = $('<form action="/faktur_v2/config/session/login.php" method="POST">' +
      '<input type="text" name="user" value="' + user + '" hidden/>' +
      '<input type="password" name="pass" value="' + pass + '" hidden/>' +
      '</form>');
      $('body').append(form);
      form.submit();
      
  })



});
</script>
</body>
</html>
