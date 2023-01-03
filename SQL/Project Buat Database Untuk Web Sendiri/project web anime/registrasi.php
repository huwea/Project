<?php 

require 'function.php';
//jika tombol register di klik
if(isset($_POST["register"])){
  if(registrasi($_POST) > 0){
    echo "  <script>
          alert('user baru berhasil ditambahkan!');
          document.location.href = 'login_user.php';
        </script>";

  }else{
    echo mysqli_error($conn);
  }
}


 ?>
<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">

    <title>FORM REGISTER</title>
</head>
<body >
  <div class="bg-image"></div>
  <div class="container bg-dark login">
    <div class="text-center text-white main-teks">FORM REGISTER</div>
    <hr class="garis">
    <form action="" method="post">
      <input type="hidden" name="level" value="user">
      <div class="form-group  text-white">
        <label for="">Username</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
            <input type="text" name="username" class="form-control" placeholder="Masukkan User Name Anda" id="username" autocomplete="off" autofocus  required>
        </div>
      </div>
      <div class="form-group  text-white">
        <label for="">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
          </div>
        <input type="Password" name="password" id="password" autocomplete="off" class="form-control" placeholder="Masukkan User Password Anda..."  required>
        </div>
      </div>
      <div class="form-group  text-white">
        <label for="">Konfirmasi Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
          </div>
        <input type="Password" name="password2" id="password2" autocomplete="off" class="form-control" placeholder="Masukkan User Password Anda..."  required>
        </div>
      </div>
      <div class="text-center mb-3 mt-3">
        <button type="submit" name="register" class="btn btn-primary mr-2 mt-3">REGISTER</button>
        <button type="reset" class="btn btn-danger ml-2 mt-3">RESET</button>
      </div>
      

    </form>
  </div>

  
  <!-- javascript -->
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="js/script.js"></script> -->
</body>
</html>